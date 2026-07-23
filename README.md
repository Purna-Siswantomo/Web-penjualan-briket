# Briket Desa Makmur

Aplikasi web katalog & promosi produk briket sekam padi desa, dengan pemesanan via WhatsApp dan admin panel berbasis Filament. Dibangun dengan Laravel 13 + Filament 3 + Tailwind CSS.

## Kebutuhan Sistem

- PHP 8.2 atau lebih baru, dengan ekstensi `gd`, `pdo_mysql`
- Composer
- Node.js 20+ dan npm
- MySQL / MariaDB (mis. lewat Laragon, XAMPP, atau server terpisah)

## 1. Install Dependency

```bash
composer install
npm install
```

## 2. Konfigurasi Environment

Salin `.env.example` menjadi `.env` (jika belum ada), lalu generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

Buka `.env` dan sesuaikan koneksi database dengan MySQL di komputer kamu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=briket_desa
DB_USERNAME=root
DB_PASSWORD=
```

Buat database-nya terlebih dahulu (lewat phpMyAdmin/HeidiSQL/CLI):

```sql
CREATE DATABASE briket_desa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 3. Migrasi & Seeder

Jalankan migrasi sekaligus mengisi data contoh (kategori, produk, banner, testimoni, galeri, pengaturan situs, dan 1 akun admin):

```bash
php artisan migrate --seed
```

Lalu buat symlink storage supaya gambar yang diupload bisa diakses publik:

```bash
php artisan storage:link
```

> Jalankan `php artisan migrate:fresh --seed` jika ingin mengulang dari database kosong (semua data lama akan terhapus).

## 4. Menjalankan Aplikasi

Perlu **dua proses** berjalan bersamaan di dua terminal terpisah:

**Terminal 1 — server Laravel:**

```bash
php artisan serve --port=8001
```

**Terminal 2 — Vite (compile CSS/JS, wajib untuk styling Tailwind muncul):**

```bash
npm run dev
```

Setelah keduanya berjalan, buka browser ke:

- Halaman publik: `http://127.0.0.1:8001/`
- Admin panel: `http://127.0.0.1:8001/admin`

## 5. Login Admin

Akun admin default dari seeder:

- **Email:** `admin@briketdesa.test`
- **Password:** `password`

Segera ganti password ini lewat menu profil di admin panel setelah login pertama kali.

## Struktur Fitur

| Halaman | URL |
|---|---|
| Landing page | `/` |
| Katalog produk | `/produk` |
| Detail produk | `/produk/{slug}` |
| Kontak | `/kontak` |
| Admin panel | `/admin` |

Semua konten (produk, kategori, banner, testimoni, galeri, keunggulan, pengaturan situs seperti nomor WhatsApp & template pesan) dikelola lewat admin panel — tidak perlu mengubah kode.

## Catatan

- Gambar hasil seeder adalah ilustrasi placeholder yang dibuat otomatis (bukan foto asli produk). Ganti dengan foto asli lewat admin panel di masing-masing menu (Produk, Banner, Galeri, dll).
- Jika `npm run dev` tidak dijalankan, halaman publik akan tampil tanpa styling Tailwind.
