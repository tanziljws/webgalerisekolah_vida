# Folder Gambar untuk Website SMKN 4 BOGOR

## Struktur Folder

```
public/images/
├── logo-smkn4.png          # Logo sekolah utama
├── hero-bg.jpg             # Background hero section
├── hero-students.jpg       # Gambar siswa di hero section
└── gallery/                # Folder untuk foto galeri
    ├── foto1.jpg
    ├── foto2.jpg
    └── ...
```

## File yang Diperlukan

### 1. Logo Sekolah
- **File**: `logo-smkn4.png`
- **Ukuran**: Minimal 200x200px (akan di-resize otomatis)
- **Format**: PNG dengan background transparan
- **Lokasi**: `public/images/logo-smkn4.png`

### 2. Background Hero
- **File**: `hero-bg.jpg`
- **Ukuran**: Minimal 1920x1080px
- **Format**: JPG/JPEG
- **Lokasi**: `public/images/hero-bg.jpg`

### 3. Gambar Hero
- **File**: `hero-students.jpg`
- **Ukuran**: Minimal 800x600px
- **Format**: JPG/JPEG
- **Lokasi**: `public/images/hero-students.jpg`

### 4. Foto Galeri
- **Folder**: `public/images/gallery/`
- **Ukuran**: Minimal 800x600px
- **Format**: JPG/JPEG
- **Nama**: Bebas (akan diambil dari database)

## Cara Upload Gambar

1. **Buat folder** `public/images/` jika belum ada
2. **Buat subfolder** `gallery/` untuk foto galeri
3. **Upload gambar** sesuai struktur di atas
4. **Pastikan permission** folder bisa diakses web

## Kode yang Menggunakan Gambar

### Layout Guest (`resources/views/layouts/app.blade.php`)
```html
<img src="/images/logo-smkn4.png" alt="SMKN 4 BOGOR">
```

### Layout Admin (`resources/views/layouts/admin.blade.php`)
```html
<img src="/images/logo-smkn4.png" alt="SMKN 4 BOGOR">
```

### Halaman Beranda (`resources/views/guest/home.blade.php`)
```html
<img src="/images/hero-students.jpg" alt="Siswa SMKN 4 BOGOR">
```

### Halaman Galeri (`resources/views/guest/galeri.blade.php`)
```html
<img src="/images/gallery/{{ $foto->file }}" alt="{{ $foto->judul }}">
```

## Catatan Penting

- **Logo sekolah** harus ada di `public/images/logo-smkn4.png`
- **Background hero** harus ada di `public/images/hero-bg.jpg`
- **Foto galeri** akan diambil dari database dengan field `file`
- **Permission folder** harus 755 agar bisa diakses web
- **Ukuran gambar** akan di-resize otomatis oleh CSS
