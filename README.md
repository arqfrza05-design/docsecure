# DocSecure

Sistem manajemen dokumen terenkripsi berbasis Laravel.

## Fitur Utama
- Upload, download, dan enkripsi dokumen
- Manajemen user (admin & staff)
- Manajemen kunci dokumen
- Pencarian dokumen & staff
- Role-based access (admin & user)

## Cara Menjalankan

### 1. Persiapan
- Pastikan sudah terinstall PHP >= 8.1, Composer, dan database (MySQL/SQLite)
- Clone repo ini ke komputer Anda

### 2. Instalasi Dependency
```bash
composer install
npm install && npm run build
```

### 3. Konfigurasi Environment
- Copy file `.env.example` menjadi `.env`
- Atur koneksi database di file `.env`
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

- Setelah menjalankan `php artisan serve`, klik link berikut untuk membuka aplikasi di browser:
	- [http://127.0.0.1:8000](http://127.0.0.1:8000)

Jika menggunakan Laragon, biasanya juga bisa klik [http://localhost:8000](http://localhost:8000)

## Akun Default
- Admin: 
	- email: admintetap@gmail.com
	- password: admin123
- User/Staff: 
	- email: staff2@gmail.com
    - email: staff1@gmail.com 
	- password: staff123

## Catatan
- Tidak wajib menggunakan VS Code, bisa pakai terminal/cmd biasa.
- Untuk testing, cukup jalankan perintah di atas dari folder project.
- Jika ada error permission di folder `storage` atau `bootstrap/cache`, jalankan:
	```bash
	chmod -R 775 storage bootstrap/cache
	```

## Testing
Untuk menjalankan test otomatis:
```bash
php artisan test
```
