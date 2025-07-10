# Laravel CRUD Product API

## Deskripsi Singkat

Proyek ini adalah sebuah **RESTful API** yang dibuat menggunakan **Laravel**. API ini digunakan untuk mengelola data produk yang mencakup fitur:
- Create produk
- List produk
- Detail produk
- Update produk
- Delete produk

API ini cocok digunakan sebagai dasar aplikasi manajemen produk atau latihan membuat CRUD menggunakan Laravel.

---

## Tahapan Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini secara lokal:

### 1. Clone Repository
Anda bisa mendownload file zip dari repository ini atau menjalankan perintah git berikut:

```bash
git clone https://github.com/RozKoy/laravel-crud-product-test.git
```

### 2. Masuk ke Direktori Proyek

```bash
cd laravel-crud-product-test
```

### 3. Pastikan Anda Memiliki
- PHP versi **8.2 atau lebih baru**
- Local server (seperti XAMPP, Laragon, atau Laravel Valet)
- Composer

### 4. Install Dependencies

```bash
composer install
```

### 5. Menyiapkan File Environment

Buat salinan dari file `.env.example` dan beri nama `.env`:

```bash
cp .env.example .env
```

### 6. Konfigurasi Database

Pastikan konfigurasi koneksi database Anda sudah sesuai dengan yang ada di file `.env`, terutama bagian berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_database_anda
DB_PASSWORD=password_database_anda
```

### 7. Generate App Key

```bash
php artisan key:generate
```

### 8. Jalankan Migrasi dan Seeder

```bash
php artisan migrate --seed
```

### 9. Jalankan Server

```bash
php artisan serve
```

Aplikasi sekarang akan berjalan pada `http://127.0.0.1:8000`

---

## Pengujian API

Untuk mencoba berbagai endpoint yang tersedia, Anda dapat menggunakan file koleksi Postman berikut:

**`mdt_app.postman_collection.json`**

Import file tersebut ke Postman, lalu Anda bisa langsung menguji berbagai fitur API seperti create, list, detail, update, dan delete produk.