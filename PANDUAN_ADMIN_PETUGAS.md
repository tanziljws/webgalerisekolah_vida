# 📚 Panduan Lengkap: Sistem Admin & Petugas Terpisah

## 🎯 Konsep Sistem

### Admin (Tabel `admins`)
- **Fungsi**: Mengelola seluruh sistem
- **Akses**: Full access ke semua fitur
- **Login**: `/admin/login`
- **Dashboard**: `/admin`

### Petugas (Tabel `petugas`)
- **Fungsi**: Mengelola konten (Posts, Galeri, Foto)
- **Akses**: Terbatas hanya Posts, Galeri, dan Foto
- **Login**: `/petugas/login`
- **Dashboard**: `/petugas`

---

## 🚀 Cara Setup Sistem

### 1. Migration & Seeder Sudah Dijalankan ✅
```bash
# Tabel admins sudah dibuat
# Admin default sudah dibuat dengan seeder
```

### 2. Login sebagai Admin

**URL**: `http://localhost/ujikom/admin/login`

**Kredensial Default**:
- Username: `admin`
- Password: `admin123`

### 3. Tambah Petugas Baru

Setelah login sebagai admin:

1. Buka menu **PETUGAS**
2. Klik **Tambah Petugas**
3. Isi form:
   - Username: (contoh: `petugas1`)
   - Password: (contoh: `petugas123`)
4. Klik **Simpan**

### 4. Login sebagai Petugas

**URL**: `http://localhost/ujikom/petugas/login`

**Kredensial**: 
- Username: `petugas1` (sesuai yang dibuat admin)
- Password: `petugas123` (sesuai yang dibuat admin)

---

## 📊 Perbedaan Admin vs Petugas

| Fitur | Admin | Petugas |
|-------|-------|---------|
| **Dashboard** | ✅ Full statistik | ✅ Limited statistik |
| **Posts** | ✅ CRUD | ✅ CRUD |
| **Kategori** | ✅ CRUD | ❌ |
| **Galeri** | ✅ CRUD | ✅ CRUD |
| **Foto** | ✅ CRUD | ✅ CRUD |
| **Kelola Petugas** | ✅ CRUD | ❌ |
| **Profile Website** | ✅ Edit | ❌ |
| **Testimoni** | ✅ Approve/Delete | ❌ |

---

## 🔐 Alur Kerja

### Alur Admin:
1. Admin login di `/admin/login`
2. Admin masuk ke dashboard admin
3. Admin bisa tambah/edit/hapus petugas
4. Admin bisa mengelola semua konten
5. Admin logout dari panel admin

### Alur Petugas:
1. Admin dulu yang membuat akun petugas
2. Petugas login di `/petugas/login` dengan kredensial yang diberikan admin
3. Petugas masuk ke dashboard petugas
4. Petugas hanya bisa kelola Posts, Galeri, dan Foto
5. Petugas logout dari panel petugas

---

## 🔧 File-file Penting

### Models
- `app/Models/Admin.php` - Model untuk admin
- `app/Models/Petugas.php` - Model untuk petugas

### Controllers
- `app/Http/Controllers/AuthController.php` - Login admin
- `app/Http/Controllers/PetugasAuthController.php` - Login petugas
- `app/Http/Controllers/AdminController.php` - Dashboard admin
- `app/Http/Controllers/PetugasDashboardController.php` - Dashboard petugas

### Config
- `config/auth.php` - Konfigurasi guard dan provider

### Routes
- `routes/web.php` - Semua routes (admin & petugas terpisah)

### Views
- `resources/views/auth/login.blade.php` - Login admin
- `resources/views/petugas/auth/login.blade.php` - Login petugas
- `resources/views/layouts/admin.blade.php` - Layout admin
- `resources/views/layouts/petugas.blade.php` - Layout petugas

### Database
- `database/migrations/2025_11_10_054059_create_admins_table.php` - Tabel admins
- `database/seeders/AdminSeeder.php` - Seeder admin default

---

## ⚙️ Guards & Providers

### Guards (Authentication)
```php
'web' => 'admins',      // Default guard untuk admin
'admin' => 'admins',    // Guard khusus admin
'petugas' => 'petugas', // Guard khusus petugas
'user' => 'users',      // Guard untuk public user
```

### Providers (Data Source)
```php
'admins' => Admin::class,     // Tabel admins
'petugas' => Petugas::class,  // Tabel petugas
'users' => User::class,       // Tabel users (public)
```

---

## 🛡️ Middleware

### Admin Routes
```php
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(...)
```
- Hanya user dari tabel `admins` yang bisa akses
- Auto redirect ke `/admin/login` jika belum login

### Petugas Routes
```php
Route::middleware(['auth:petugas'])->prefix('petugas')->name('petugas.')->group(...)
```
- Hanya user dari tabel `petugas` yang bisa akses
- Auto redirect ke `/petugas/login` jika belum login

---

## 📱 URL Lengkap

### Admin
- **Login**: `http://localhost/ujikom/admin/login`
- **Dashboard**: `http://localhost/ujikom/admin`
- **Posts**: `http://localhost/ujikom/admin/posts`
- **Kategori**: `http://localhost/ujikom/admin/kategori`
- **Galeri**: `http://localhost/ujikom/admin/galery`
- **Foto**: `http://localhost/ujikom/admin/foto`
- **Petugas**: `http://localhost/ujikom/admin/petugas`
- **Profile**: `http://localhost/ujikom/admin/profile`
- **Testimoni**: `http://localhost/ujikom/admin/testimonials`

### Petugas
- **Login**: `http://localhost/ujikom/petugas/login`
- **Dashboard**: `http://localhost/ujikom/petugas`
- **Posts**: `http://localhost/ujikom/petugas/posts`
- **Galeri**: `http://localhost/ujikom/petugas/galery`
- **Foto**: `http://localhost/ujikom/petugas/foto`

---

## ❓ Troubleshooting

### Error "SQLSTATE[42S02]: Base table or view not found: 'admins'"
**Solusi**: Jalankan migration
```bash
php artisan migrate
```

### Error "Username tidak ditemukan" saat login admin
**Solusi**: Jalankan seeder admin
```bash
php artisan db:seed --class=AdminSeeder
```

### Admin tidak bisa login
**Penyebab**: Kredensial salah
**Solusi**: 
- Username: `admin`
- Password: `admin123`

### Petugas tidak bisa login
**Penyebab**: Belum dibuat oleh admin
**Solusi**: Login sebagai admin → Buka menu Petugas → Tambah petugas baru

### Halaman admin redirect ke `/admin/login` terus
**Solusi**: Clear cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Error 404 saat akses `/login`
**Normal**: Route `/login` sudah dihapus
**Solusi**: 
- Admin login di: `/admin/login`
- Petugas login di: `/petugas/login`

---

## 🎓 Cara Menambah Admin Baru (Jika Diperlukan)

### Via Tinker
```bash
php artisan tinker
```

```php
\App\Models\Admin::create([
    'name' => 'Admin Baru',
    'username' => 'admin2',
    'email' => 'admin2@smkn4bogor.sch.id',
    'password' => bcrypt('password123')
]);
exit
```

### Via Database (phpMyAdmin)
```sql
INSERT INTO admins (name, username, email, password, created_at, updated_at)
VALUES (
    'Admin Baru',
    'admin2',
    'admin2@smkn4bogor.sch.id',
    '$2y$12$...(hash dari bcrypt)',
    NOW(),
    NOW()
);
```

---

## ✅ Checklist Setup Lengkap

- [x] Tabel `admins` sudah dibuat
- [x] Admin default sudah dibuat (username: `admin`, password: `admin123`)
- [x] Guard `admin` dan `petugas` sudah dikonfigurasi
- [x] Routes admin dan petugas sudah terpisah
- [x] Login admin: `/admin/login`
- [x] Login petugas: `/petugas/login`
- [x] Admin bisa tambah petugas
- [x] Petugas bisa kelola Posts, Galeri, Foto
- [x] UI responsive dan konsisten

---

## 📝 Catatan Penting

1. **Admin ≠ Petugas**: Mereka adalah user yang berbeda di tabel berbeda
2. **Petugas harus dibuat oleh Admin**: Petugas tidak bisa registrasi sendiri
3. **Setiap guard terpisah**: Admin tidak bisa login di panel petugas, begitu juga sebaliknya
4. **Password di-hash**: Gunakan `bcrypt()` atau `Hash::make()` saat membuat user baru
5. **Jangan hapus admin terakhir**: Pastikan selalu ada minimal 1 admin aktif

---

**Sistem Sudah Siap Digunakan!** 🎉

Login sekarang:
- Admin: `http://localhost/ujikom/admin/login`
- Petugas: `http://localhost/ujikom/petugas/login`
