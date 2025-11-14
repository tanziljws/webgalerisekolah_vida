# Cara Verifikasi Domain di Brevo

## Format Domain yang Benar

**✅ BENAR:**
- `mydomain.com`
- `example.com`
- `subdomain.example.com`
- `my-domain.com`

**❌ SALAH:**
- `http://mydomain.com` (jangan pakai http://)
- `https://mydomain.com` (jangan pakai https://)
- `www.mydomain.com` (jangan pakai www)
- `mydomain.com/` (jangan pakai trailing slash)
- `mydomain.com\` (jangan pakai backslash)

## Langkah Verifikasi Domain di Brevo

1. **Login ke Brevo Dashboard**: https://app.brevo.com/
2. **Pergi ke Senders & IP** → **Domains**
3. **Klik "Add a domain"**
4. **Masukkan domain TANPA http/https/www**:
   ```
   mydomain.com
   ```
   (Bukan `http://mydomain.com` atau `www.mydomain.com`)
5. **Ikuti instruksi untuk menambahkan DNS records**:
   - SPF record
   - DKIM records (biasanya 2-3 records)
   - DMARC record (optional)
6. **Tunggu verifikasi** (biasanya beberapa menit sampai beberapa jam)

## Setelah Domain Terverifikasi

Update `.env` dengan email dari domain yang sudah diverifikasi:

```env
MAIL_FROM_ADDRESS="noreply@mydomain.com"
MAIL_FROM_NAME="SMKN 4 BOGOR"
```

**PENTING:**
- Email di `MAIL_FROM_ADDRESS` harus dari domain yang sudah diverifikasi
- Jika domain belum diverifikasi, gunakan email yang sudah diverifikasi di Brevo

## Troubleshooting

### Error: "Invalid domain"
- Pastikan tidak ada `http://`, `https://`, atau `www`
- Pastikan tidak ada trailing slash `/` atau backslash `\`
- Pastikan format domain benar: `domain.com` atau `subdomain.domain.com`

### Domain tidak terverifikasi
- Pastikan DNS records sudah ditambahkan dengan benar
- Tunggu beberapa saat (DNS propagation bisa memakan waktu)
- Cek di Brevo dashboard apakah semua records sudah terverifikasi

### Email tidak terkirim
- Pastikan `MAIL_FROM_ADDRESS` menggunakan email dari domain yang sudah diverifikasi
- Cek log di `storage/logs/laravel.log` untuk detail error
- Pastikan API key memiliki permission yang benar

## Untuk Testing (Tanpa Domain Sendiri)

Jika belum punya domain sendiri, gunakan email yang sudah diverifikasi di Brevo:

```env
MAIL_FROM_ADDRESS="your-verified-email@example.com"
MAIL_FROM_NAME="SMKN 4 BOGOR"
```

Brevo biasanya mengizinkan beberapa email untuk testing tanpa perlu verifikasi domain.

