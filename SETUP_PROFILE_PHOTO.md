# 📸 Setup Upload Foto Profil

## Langkah 1: Jalankan Setup Storage

### Cara Otomatis (Recommended):
1. **Double-click** file `setup_storage.bat`
2. Tunggu sampai selesai
3. Tekan Enter untuk close

### Cara Manual:
Buka Command Prompt di folder project, lalu jalankan:

```bash
# 1. Buat symbolic link
php artisan storage:link

# 2. Buat folder profiles (jika belum ada)
mkdir storage\app\public\profiles

# 3. Set permission
icacls storage /grant Everyone:(OI)(CI)F /T
```

---

## Langkah 2: Cek Konfigurasi PHP

Buka file `C:\xampp\php\php.ini` dan pastikan:

```ini
; Upload file size
upload_max_filesize = 10M
post_max_size = 10M

; Memory limit
memory_limit = 256M

; File uploads enabled
file_uploads = On
```

**Setelah edit php.ini:**
1. Save file
2. Restart Apache di XAMPP Control Panel

---

## Langkah 3: Testing Upload Foto

1. **Login** sebagai user
2. Klik **"Edit Profil"** di navbar dropdown
3. Klik tombol **"Ubah Foto"** (biru)
4. Pilih foto (JPG, PNG, atau JPEG, max 2MB)
5. Preview foto akan muncul
6. Klik **"Simpan Perubahan"**

### ✅ Hasil yang Diharapkan:
- ✅ Foto langsung berubah di profile page
- ✅ Foto langsung berubah di navbar
- ✅ Foto langsung berubah di form komentar
- ✅ Foto tersimpan di `storage/app/public/profiles/`
- ✅ Foto lama terhapus (jika ada)

---

## Troubleshooting

### ❌ Error: "The profile photo must be an image"
**Solusi:**
- Pastikan file yang diupload adalah JPG, PNG, atau JPEG
- Cek ukuran file tidak lebih dari 2MB

### ❌ Error: "Failed to upload"
**Solusi:**
1. Cek folder `storage/app/public/profiles` ada
2. Jalankan: `php artisan storage:link`
3. Restart Apache

### ❌ Foto tidak muncul setelah upload
**Solusi:**
1. Hard refresh browser: `Ctrl + Shift + R`
2. Cek file ada di `storage/app/public/profiles/`
3. Cek symbolic link: `public/storage` harus mengarah ke `storage/app/public`

### ❌ Error 500 saat submit form
**Solusi:**
1. Cek log error: `storage/logs/laravel.log`
2. Pastikan permission folder storage benar
3. Restart Apache setelah edit php.ini

---

## Struktur Folder

```
ujikom/
├── public/
│   └── storage/              ← Symbolic link ke storage/app/public
│
├── storage/
│   └── app/
│       └── public/
│           └── profiles/     ← Folder upload foto profil
│               ├── 1234567890_1.jpg
│               └── 1234567891_2.png
│
└── setup_storage.bat        ← Script setup otomatis
```

---

## Fitur Upload Foto Profil

### ✨ Yang Sudah Diimplementasi:
- ✅ Upload foto (JPG, PNG, JPEG)
- ✅ Preview foto real-time sebelum upload
- ✅ Validasi ukuran max 2MB
- ✅ Validasi tipe file
- ✅ Auto-delete foto lama
- ✅ Nama file unik (timestamp + user_id)
- ✅ Auto-create folder jika belum ada
- ✅ Cache busting (foto langsung update)
- ✅ Update di semua tempat (navbar, profile, komentar)

### 🔒 Keamanan:
- ✅ Validasi server-side dan client-side
- ✅ Middleware auth (hanya user login)
- ✅ CSRF protection
- ✅ File type validation
- ✅ File size validation

---

## Testing Checklist

- [ ] Setup storage link berhasil
- [ ] Folder profiles ada
- [ ] Permission folder benar
- [ ] php.ini sudah dikonfigurasi
- [ ] Apache sudah direstart
- [ ] User bisa login
- [ ] Form edit profil bisa dibuka
- [ ] Tombol "Ubah Foto" berfungsi
- [ ] Preview foto muncul saat pilih file
- [ ] Form bisa submit tanpa error
- [ ] Foto tersimpan di database
- [ ] Foto file ada di folder profiles
- [ ] Foto muncul di profile page
- [ ] Foto muncul di navbar
- [ ] Foto muncul di komentar
- [ ] Foto lama terhapus dari server

---

## Kontak Support

Jika masih ada masalah, cek:
1. Browser Console (F12) untuk error JavaScript
2. Laravel Log: `storage/logs/laravel.log`
3. Apache Error Log: `C:\xampp\apache\logs\error.log`
