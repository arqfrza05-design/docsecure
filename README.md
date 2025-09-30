# DocSecure

Sistem manajemen dokumen terenkripsi berbasis Laravel.

## Fitur Utama
- Upload, download, dan enkripsi dokumen
- Manajemen user (admin & staff)
- Manajemen kunci dokumen
- Pencarian dokumen & staff
- Role-based access (admin & user)
- Status dokumen: Umum & Rahasia
- Download dokumen umum tanpa kunci

## Cara Menjalankan

### 1. Persiapan
- Pastikan sudah terinstall PHP >= 8.1, Composer, Node.js, dan database (MySQL/SQLite)
- Clone repo ini ke komputer Anda

### 2. Instalasi Dependency
Jika folder `vendor` atau `node_modules` hilang, jalankan:
```bash
composer install
npm install && npm run build
```

### 3. Konfigurasi Environment
- Copy file `.env.example` menjadi `.env`
- Atur koneksi database di file `.env` (MySQL/SQLite)
- Generate app key:
```bash
php artisan key:generate
```

### 4. Migrasi & Seed Database
```bash
php artisan migrate --seed
```

### 5. Menjalankan Server
```bash
php artisan serve
```
Lalu akses di browser: [http://127.0.0.1:8000](http://127.0.0.1:8000)

### 6. Akses Aplikasi
- Setelah menjalankan `php artisan serve`, buka aplikasi di browser:
  - [http://127.0.0.1:8000](http://127.0.0.1:8000)
- Jika menggunakan Laragon, bisa juga [http://localhost:8000](http://localhost:8000)

## Akun Default
- Admin: 
  - email: admintetap@gmail.com
  - password: admin123
- User/Staff: 
  - email: stafflayanan@gmail.com
  - email: staffpsdm@gmail.com
  - email: staffvip@gmail.com 
  - password: staff123

## Troubleshooting
- Jika error database: pastikan MySQL/SQLite aktif dan konfigurasi `.env` sudah benar.
- Jika error permission di folder `storage` atau `bootstrap/cache`, jalankan:
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```
- Jika error dependency, jalankan ulang:
  ```bash
  composer install
  npm install
  ```
- Jika ingin membersihkan dependency:
  - Hapus folder `vendor` dan `node_modules`, lalu install ulang seperti langkah di atas.

## Testing
Untuk menjalankan test otomatis:
```bash
php artisan test
```

## Catatan
- Tidak wajib menggunakan VS Code, bisa pakai terminal/cmd biasa.
- Untuk testing, cukup jalankan perintah di atas dari folder project.
- Sistem mendukung upload dokumen dengan/atau tanpa enkripsi, status dokumen, dan download langsung untuk dokumen umum.
