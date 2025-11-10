@extends('layouts.app')

@section('title', 'Verifikasi OTP')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Verifikasi OTP</div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('user.otp.verify') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Masukkan Kode OTP (6 digit)</label>
                            <input type="text" name="otp" maxlength="6" class="form-control @error('otp') is-invalid @enderror" placeholder="123456" required>
                            @error('otp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Verifikasi</button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('user.otp.resend') }}" class="mt-3">
                        @csrf
                        <button class="btn btn-outline-primary w-100" type="submit">Kirim Ulang OTP</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('user.register') }}">Ubah data pendaftaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
