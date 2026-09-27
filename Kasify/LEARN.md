# Kasify — Panduan Belajar Aplikasi

Dokumen ini dibuat untuk membantu tim memahami bagaimana aplikasi Kasify bekerja, dari routing, autentikasi, hingga operasi CRUD data transaksi dan anggota.

## 1. Struktur aplikasi utama

Folder inti yang sering dipakai:

- `app/Http/Controllers/` : tempat controller yang menangani request dari user atau API
- `app/Models/` : model Eloquent yang mewakili tabel database
- `routes/web.php` : rute halaman web (misalnya halaman login, beranda, riwayat)
- `routes/api.php` : rute API untuk CRUD data via JavaScript
- `resources/views/` : file Blade yang berisi tampilan HTML
- `database/migrations/` : definisi tabel database
- `database/seeders/` : data awal untuk testing atau demo

## 2. Arsitektur dasar

Aplikasi menggunakan Laravel Framework. Secara umum, alurnya seperti ini:

1. User mengakses URL di browser.
2. Laravel mencocokkan URL ke route yang ada di `routes/web.php`.
3. Route akan memanggil controller atau menampilkan view Blade.
4. Controller mengambil data dari database via model Eloquent.
5. View menampilkan hasil dari data tersebut.
6. Saat user melakukan tambah/edit/hapus, JavaScript mengirim request ke route API di `routes/api.php`.
7. Controller API memvalidasi input, menyimpan perubahan ke database, lalu mengembalikan JSON.

## 3. Autentikasi

Autentikasi dibuat dengan sistem bawaan Laravel (`Auth::routes()`). Fitur yang termasuk di dalamnya:

- login
- logout
- redirect otomatis ke halaman yang tepat

Rute web dijaga dengan middleware `auth`, sehingga user yang belum login tidak bisa membuka halaman utama seperti `beranda`, `riwayat`, `laporan`, `anggota`, dan `transaksi`.

### Catatan penting
- Halaman login bisa diakses oleh semua orang.
- Setelah login berhasil, user otomatis diarahkan ke halaman `beranda`.
- Fitur register dinonaktifkan untuk aplikasi ini (`Auth::routes(['register' => false])`).

## 4. Route utama halaman web

Di `routes/web.php`, rute utama dimasukkan di dalam grup:

```php
Route::middleware('auth')->group(function () {
    Route::get('beranda', ...);
    Route::get('riwayat', ...);
    Route::get('transaksi', ...);
    Route::get('laporan', ...);
    Route::get('anggota', ...);
});
```

Penjelasan:
- semua rute di dalam grup ini hanya bisa dipakai kalau user sudah login
- `beranda` adalah halaman utama aplikasi
- halaman lain adalah fitur yang saling terhubung ke data kas kelas

## 5. CRUD transaksi

Data transaksi disimpan di tabel `transactions`.

Model:
- `app/Models/Transaction.php`

Controller:
- `app/Http/Controllers/TransactionController.php`

### Fungsi controller
- `index()` : membaca semua transaksi dan menghitung saldo
- `show()` : membaca satu transaksi tertentu
- `store()` : menambah transaksi baru
- `update()` : mengubah transaksi lama
- `destroy()` : menghapus transaksi

### Input penting
Setiap transaksi memiliki field seperti:
- `description` : keterangan transaksi
- `category` : kategori, misalnya `Iuran anggota`
- `type` : `in` atau `out`
- `amount` : jumlah nominal
- `transaction_date` : tanggal transaksi

### Contoh alur
1. User membuka halaman laporan atau riwayat.
2. JavaScript memanggil endpoint API `/api/transaksi`.
3. Laravel controller mengambil data dari database.
4. JSON dikirim kembali ke frontend.
5. Frontend menampilkan data dalam tabel atau kartu.

## 6. CRUD anggota

Data anggota disimpan di tabel `anggotas`.

Model:
- `app/Models/Anggota.php`

Controller:
- `app/Http/Controllers/AnggotaController.php`

### Input penting
- `nama` : nama anggota
- `status` : `paid` atau `unpaid`

### Fungsi controller
- `index()` : menampilkan semua anggota
- `show()` : menampilkan satu anggota
- `store()` : menambah anggota baru
- `update()` : mengubah nama atau status anggota
- `destroy()` : menghapus anggota

## 7. API resource

File `routes/api.php` berisi endpoint berikut:

```php
Route::apiResource('transaksi', TransactionController::class);
Route::apiResource('anggota', AnggotaController::class);
```

Artinya Laravel otomatis membuat route CRUD standar untuk model terkait, seperti:

- `GET /api/transaksi`
- `POST /api/transaksi`
- `GET /api/transaksi/{id}`
- `PUT/PATCH /api/transaksi/{id}`
- `DELETE /api/transaksi/{id}`

Sama untuk `anggota`.

## 8. Blade view dan tampilan

View utama berada di `resources/views/`.

View yang paling penting:
- `beranda.blade.php` : tampilan dashboard utamanya
- `riwayat.blade.php` : tampilan riwayat transaksi
- `transaksi.blade.php` : form tambah transaksi
- `laporan.blade.php` : laporan akuntansi
- `anggota.blade.php` : daftar anggota dan status iuran
- `login.blade.php` : halaman login

### Prinsip kerja front-end di Blade
- File Blade biasanya berisi HTML + CSS + JavaScript di satu file.
- JavaScript lokal akan membaca data dari backend API lalu merender UI.
- Tampilan lebih mirip aplikasi single-page prototype, namun data tetap berasal dari Laravel API.

## 9. Database dan migrasi

Migrasi berfungsi untuk membuat struktur tabel database.

Contoh:
- `database/migrations/2026_09_23_000001_create_transactions_table.php`
- `database/migrations/2026_09_25_000002_create_anggotas_table.php`

Untuk menjalankan migrasi:

```bash
php artisan migrate
```

Untuk menjalankan seed data awal:

```bash
php artisan db:seed
```

## 10. Cara kerja login secara teknis

Saat user membuka halaman yang dilindungi:

1. Laravel memeriksa apakah user sedang login.
2. Jika belum login, Laravel akan redirect ke `/login`.
3. User mengisi email dan password.
4. Laravel memvalidasi kredensial.
5. Jika valid, session dibuat.
6. Session menyimpan status login user di server.
7. User dapat mengakses halaman yang dilindungi dari dulu.

## 11. Cara menjalankan aplikasi

1. Masuk ke folder project:

```bash
cd c:/laragon/www/Kasify
```

2. Jalankan migrasi database:

```bash
php artisan migrate
```

3. Jalankan database seeder jika ingin data awal:

```bash
php artisan db:seed
```

4. Jalankan server Laravel:

```bash
php artisan serve
```

5. Buka aplikasi di browser:

```text
http://localhost:8000
```

## 12. Tips penting untuk tim

- Jangan mengubah route utama tanpa mempertimbangkan middleware `auth`.
- Jangan menghapus route API karena frontend mengandalkannya.
- Saat menambah field baru, pastikan:
  - field ada di migration
  - field ada di model `$fillable`
  - validasi input ada di controller
- Jika terjadi error saat login, cek:
  - user ada di database
  - password benar
  - `.env` koneksi database benar
  - migration sudah dijalankan

## 13. Ringkasan singkat

Aplikasi Kasify adalah aplikasi manajemen kas kelas yang memadukan:
- Laravel sebagai backend
- Blade sebagai template view
- Eloquent ORM untuk database
- API resource untuk operasi CRUD
- Auth Laravel untuk login dan keamanan route

Semua fitur utama didesain agar mudah ditinjau ulang dan dikembangkan lebih lanjut oleh tim.
