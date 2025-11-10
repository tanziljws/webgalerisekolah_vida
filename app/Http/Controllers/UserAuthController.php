<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Mail\OtpCodeMail;
use Carbon\Carbon;

class UserAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|string|max:20|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.unique' => 'Username sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.unique' => 'No. telepon sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if (!$request->email && !$request->phone) {
            return back()->withErrors(['email' => 'Isi email atau no. telepon minimal salah satu.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password, // hashed by model cast
            'is_verified' => false,
        ]);

        // Generate OTP
        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Kirim OTP via email bila tersedia
        if ($user->email) {
            try {
                Mail::to($user->email)->send(new OtpCodeMail($otp));
            } catch (\Exception $e) {
                // Lewati error kirim email, user masih bisa masukkan OTP yang ditampilkan di halaman dev jika diperlukan
            }
        }
        // TODO: Kirim via SMS bila konfigurasi SMS tersedia

        // Simpan sesi untuk verifikasi OTP
        session(['otp_user_id' => $user->id]);

        return redirect()->route('user.otp')->with('status', 'Kode OTP telah dikirim. Silakan cek email/HP Anda.');
    }

    public function showOtpForm(Request $request)
    {
        if (!session('otp_user_id')) {
            return redirect()->route('user.register');
        }
        return view('user.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $userId = session('otp_user_id');
        $user = $userId ? User::find($userId) : null;
        if (!$user) {
            return redirect()->route('user.register')->withErrors(['otp' => 'Sesi OTP berakhir. Silakan daftar ulang.']);
        }

        if (!$user->otp_code || !$user->otp_expires_at || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP kedaluwarsa. Silakan kirim ulang.']);
        }

        if ($request->otp !== $user->otp_code) {
            return back()->withErrors(['otp' => 'OTP tidak valid.']);
        }

        // Verifikasi berhasil
        $user->is_verified = true;
        if ($user->email && !$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
        }
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Bersihkan sesi OTP dan login user
        session()->forget('otp_user_id');
        Auth::guard('user')->login($user);

        return redirect()->route('guest.home')->with('status', 'Akun berhasil diverifikasi.');
    }

    public function resendOtp(Request $request)
    {
        $userId = session('otp_user_id');
        $user = $userId ? User::find($userId) : null;
        if (!$user) {
            return redirect()->route('user.register');
        }

        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        if ($user->email) {
            try {
                Mail::to($user->email)->send(new OtpCodeMail($otp));
            } catch (\Exception $e) {
            }
        }

        return back()->with('status', 'OTP baru telah dikirim.');
    }

    public function showLoginForm()
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('guest.home');
        }
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Verifikasi CAPTCHA wajib diisi.'
        ]);

        // Verify reCAPTCHA
        try {
            $verify = Http::asForm()->post(config('services.recaptcha.verify_url'), [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ])->json();

            if (!($verify['success'] ?? false)) {
                return back()
                    ->withErrors(['g-recaptcha-response' => 'Verifikasi CAPTCHA gagal.'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Tidak dapat memverifikasi CAPTCHA.'])
                ->withInput();
        }

        $identity = $request->identity;
        $user = User::where('username', $identity)
            ->orWhere('email', $identity)
            ->orWhere('phone', $identity)
            ->first();

        if (!$user) {
            return back()->withErrors(['identity' => 'Akun tidak ditemukan.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        if (!$user->is_verified) {
            session(['otp_user_id' => $user->id]);
            return redirect()->route('user.otp')->withErrors(['otp' => 'Akun belum diverifikasi. Silakan masukkan OTP.']);
        }

        Auth::guard('user')->login($user);
        return redirect()->intended(route('guest.home'));
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('guest.home');
    }
}
