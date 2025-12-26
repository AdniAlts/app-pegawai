# Sistem Manajemen Pegawai

Aplikasi manajemen pegawai berbasis web yang dibangun menggunakan Laravel. Sistem ini memudahkan pengelolaan data pegawai, departemen, posisi, presensi, dan penggajian.

## Fitur

- **Manajemen Pegawai** - Kelola data pegawai lengkap
- **Departemen** - Organisasi departemen perusahaan
- **Posisi/Jabatan** - Manajemen posisi dan jabatan
- **Presensi** - Pencatatan kehadiran pegawai
- **Penggajian** - Sistem penggajian pegawai
- **Autentikasi** - Sistem login dan manajemen pengguna

## Teknologi

- Laravel 11
- PHP 8.2+
- MySQL
- Tailwind CSS
- Vite

## Instalasi

1. Clone repository ini
```bash
git clone <repository-url>
cd app-pegawai
```

2. Install dependencies
```bash
composer install
npm install
```

3. Copy file environment
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Konfigurasi database di file `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app_pegawai
DB_USERNAME=root
DB_PASSWORD=
```

6. Jalankan migrasi database
```bash
php artisan migrate
```

7. (Opsional) Jalankan seeder untuk data sample
```bash
php artisan db:seed
```

## Menjalankan Aplikasi

1. Start development server
```bash
php artisan serve
```

2. Compile assets (di terminal terpisah)
```bash
npm run dev
```

3. Buka browser dan akses
```
http://localhost:8000
```

## Struktur Database

- **employees** - Data pegawai
- **departments** - Data departemen
- **positions** - Data posisi/jabatan
- **attendance** - Data presensi
- **salaries** - Data penggajian
- **users** - Data pengguna sistem
