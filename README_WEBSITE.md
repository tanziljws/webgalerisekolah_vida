# Website SMKN 4 BOGOR - Laravel

Website sekolah dengan 2 tipe user: Guest (pengunjung) dan Admin (petugas).

## 🏗️ Struktur Website

### **1. Tipe User**
- **Guest (Tamu/Pengunjung)**: Hanya bisa melihat tampilan publik
- **Admin (Petugas)**: Harus login untuk mengakses dashboard admin

### **2. Halaman Guest (Public)**
- **Beranda** (`/`) - Halaman utama dengan hero section dan berita terbaru
- **Profil** (`/profil`) - Informasi lengkap tentang sekolah
- **Galeri** (`/galeri`) - Foto-foto kegiatan sekolah

### **3. Halaman Admin (Protected)**
- **Dashboard** (`/admin`) - Overview dengan statistik
- **Posts** (`/admin/posts`) - Manajemen berita/artikel
- **Kategori** (`/admin/kategori`) - Manajemen kategori berita
- **Galeri** (`/admin/galeri`) - Manajemen galeri foto
- **Foto** (`/admin/foto`) - Manajemen foto
- **Petugas** (`/admin/petugas`) - Manajemen akun petugas
- **Profil** (`/admin/profil`) - Edit profil sekolah

## 📁 Struktur Folder Views

```
resources/views/
├── layouts/
│   ├── app.blade.php          # Layout untuk guest
│   └── admin.blade.php        # Layout untuk admin
├── guest/
│   ├── home.blade.php         # Halaman beranda
│   ├── profil.blade.php       # Halaman profil sekolah
│   └── galeri.blade.php       # Halaman galeri
├── auth/
│   └── login.blade.php        # Halaman login admin
└── admin/
    ├── dashboard.blade.php     # Dashboard admin
    ├── posts/
    │   ├── index.blade.php     # List posts
    │   ├── create.blade.php    # Form buat post
    │   └── edit.blade.php      # Form edit post
    ├── kategori/
    ├── galeri/
    ├── foto/
    ├── petugas/
    └── profil/
```

## 🎨 Tampilan yang Dihasilkan

### **Halaman Beranda (Guest)**
- Header dengan logo dan navigasi
- Hero section dengan background image
- Fitur keunggulan sekolah
- Berita terbaru
- Form kontak

### **Halaman Login Admin**
- Form login dengan username/password
- Validasi input
- Error handling
- Redirect ke dashboard setelah login

### **Dashboard Admin**
- Sidebar navigasi dengan menu lengkap
- Statistik (total posts, galeri, foto, petugas)
- Posts terbaru
- Aktivitas terbaru
- Quick actions untuk buat konten

## 🔐 Sistem Autentikasi

### **Login Admin**
- **Username**: Field dari tabel `petugas`
- **Password**: Field dari tabel `petugas` (di-hash)
- **Model**: `Petugas` (bukan `User`)

### **Middleware**
- **Guest routes**: Bisa diakses semua orang
- **Admin routes**: Harus login dulu (`auth` middleware)

### **Session Management**
- Login menggunakan session Laravel
- Logout dengan invalidate session
- Redirect ke beranda setelah logout

## 🖼️ Folder Gambar

### **Struktur Folder**
```
public/images/
├── logo-smkn4.png          # Logo sekolah
├── hero-bg.jpg             # Background hero
├── hero-students.jpg       # Gambar siswa
└── gallery/                # Foto galeri
    ├── foto1.jpg
    ├── foto2.jpg
    └── ...
```

### **File yang Diperlukan**
1. **Logo sekolah**: `public/images/logo-smkn4.png`
2. **Background hero**: `public/images/hero-bg.jpg`
3. **Gambar hero**: `public/images/hero-students.jpg`
4. **Foto galeri**: `public/images/gallery/` (folder)

## 🚀 Cara Menjalankan

### **1. Setup Database**
```bash
php artisan migrate:fresh --seed
```

### **2. Jalankan Server**
```bash
php artisan serve
```

### **3. Akses Website**
- **Beranda**: `http://localhost:8000/`
- **Login Admin**: `http://localhost:8000/login`
- **Dashboard Admin**: `http://localhost:8000/admin`

### **4. Login Admin**
- **Username**: `admin`
- **Password**: `password123`

## 📋 Fitur yang Tersedia

### **Guest (Public)**
- ✅ Lihat beranda dengan hero section
- ✅ Lihat profil sekolah lengkap
- ✅ Lihat galeri foto kegiatan
- ✅ Form kontak (belum functional)
- ✅ Responsive design

### **Admin (Protected)**
- ✅ Dashboard dengan statistik
- ✅ CRUD Posts (berita/artikel)
- ✅ CRUD Kategori
- ✅ CRUD Galeri
- ✅ CRUD Foto
- ✅ CRUD Petugas
- ✅ Edit profil sekolah
- ✅ Sidebar navigation
- ✅ Session management

## 🔧 Konfigurasi yang Diubah

### **1. Auth Config** (`config/auth.php`)
- Guard `web` menggunakan provider `petugas`
- Model `Petugas` untuk autentikasi

### **2. Routes** (`routes/web.php`)
- Guest routes (public)
- Auth routes (login/logout)
- Admin routes (protected dengan middleware)

### **3. Controllers**
- `GuestController` - Handle halaman public
- `AuthController` - Handle login/logout
- `AdminController` - Handle semua admin pages

## 📱 Responsive Design

- **Bootstrap 5** untuk styling
- **Mobile-first** approach
- **Sidebar collapse** di mobile
- **Flexible grid** system

## 🎯 Tampilan yang Dihasilkan

Website akan terlihat seperti screenshot yang diberikan:
- **Header** dengan logo SMKN 4 BOGOR
- **Navigation** horizontal untuk guest
- **Sidebar** navigation untuk admin
- **Color scheme** biru (#1e3a8a) dan orange (#f59e0b)
- **Modern UI** dengan cards dan shadows

## ⚠️ Catatan Penting

1. **Gambar harus ada** di folder `public/images/`
2. **Database harus di-seed** untuk data testing
3. **Permission folder** harus 755
4. **Server Laravel** harus running
5. **Auth config** sudah diubah untuk model `Petugas`

## 🚀 Next Steps

1. **Upload gambar** sesuai struktur folder
2. **Test semua fitur** guest dan admin
3. **Customize tampilan** sesuai kebutuhan
4. **Add fitur tambahan** seperti search, pagination
5. **Deploy ke server** production
