# UAS Back-End Web Development

### Nama  : VINCENT ALFIAN ARTHA
### NIM   : 230010009
### Kelas : DI231
### Mata Kuliah : Back-end Webdev

## Penjelasan mengenai konfigurasi sistem ##

### Struktur Direktori ###

#### **`Direktori controllers`**:
- `UsersController.php`
  UsersController.php adalah file yang bertanggung jawab atas semua permintaan terkait data pengguna (users). Tugasnya mencakup menampilkan daftar pengguna, menambahkan pengguna baru, memperbarui data pengguna, dan menghapus data pengguna. Controller ini berinteraksi dengan Model `UsersModel.php` untuk mengambil atau memanipulasi data pengguna di database.

#### **`Direktori models`**:
- `UsersModel.php`
  Bertanggung jawab untuk berinteraksi dengan tabel `users` di database. Model ini berisi fungsi-fungsi untuk melakukan operasi CRUD (Create, Read, Update, Delete) pada data pengguna, seperti:
  - Mengambil daftar semua pengguna
  - Mengambil data pengguna berdasarkan ID
  - Menambahkan data pengguna baru
  - Memperbarui data pengguna
  - Menghapus data pengguna

#### **`Direktori services`**:
- `UsersService.php`
  Bertanggung jawab untuk menangani logika bisnis terkait data pengguna. Service ini menggunakan `UsersModel.php` untuk berinteraksi dengan database dan melakukan operasi CRUD pada data pengguna.

#### **`Direktori middleware`**:
- `Cors.php`
  Bertanggung jawab untuk mengatur kebijakan CORS (Cross-Origin Resource Sharing) sehingga API dapat diakses dari berbagai asal yang berbeda. File ini memastikan bahwa aplikasi mengizinkan permintaan dari berbagai metode HTTP seperti GET, POST, PUT, dan DELETE.
- `Router.php`
  Bertanggung jawab untuk menangani registrasi dan pengiriman rute. Router ini menentukan bagaimana permintaan HTTP diarahkan ke Controller yang sesuai berdasarkan metode dan URI.

#### **`Direktori config`**:
- `database.php`
  Berisi konfigurasi untuk koneksi database. Di sini, informasi seperti host, nama pengguna, kata sandi, dan nama basis data (database) disertakan untuk mengizinkan koneksi ke server database.

#### **`Direktori curl`**:
- `script.php`
  Berisi fungsi untuk mengirim permintaan HTTP ke API menggunakan cURL. Skrip ini dapat digunakan untuk mengirim permintaan GET dan POST untuk menguji endpoint API.

#### **File lainnya**:
- `.env`
  Berisi konfigurasi environment untuk koneksi database, seperti host, nama database, nama pengguna, dan kata sandi.

- `.htaccess`
  Berisi konfigurasi Apache untuk mengarahkan semua permintaan ke `app.php` untuk diproses lebih lanjut.

- `app.php`
  Berfungsi sebagai entry point utama untuk aplikasi. File ini menginisialisasi koneksi database, mengatur router, dan mengirimkan permintaan ke Controller yang sesuai berdasarkan metode HTTP dan URI.

### Contoh Isi .env ###
```ini
DB_HOST=localhost
DB_NAME=simple_api
DB_USERNAME=rest_api_demo
DB_PASSWORD=rest_api_demo
```

### Contoh Isi .htaccess ###
```htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ app.php [QSA,L]
```

### Contoh Isi app.php ###
```php
<?php
include_once 'config/database.php';
include_once 'middleware/Router.php';
include_once 'controllers/UsersController.php';

$database = new Database();
$db = $database->getConnection();

$router = new Router();
$router->register('GET', '/api/users', [New UsersController($db), 'readUsers']);
$router->register('GET', '/api/users/(\d+)', [New UsersController($db), 'readUserById']);
$router->register('POST', '/api/users', [New UsersController($db), 'addUser']);
$router->register('DELETE', '/api/users/(\d+)', [New UsersController($db), 'deleteUser']);
$router->register('PUT', '/api/users/(\d+)', [New UsersController($db), 'updateUser']);

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
```
Penjelasan mengenai proyek
Proyek ini adalah aplikasi Buku Tamu dimana tamu dapat melakukan hal-hal berikut:

1.Menambahkan Data Tamu Baru: Tamu dapat menulis nama depan, nama belakang, alamat, email, nomor HP, dan catatan.
2.Mengedit Data Tamu: Tamu dapat memperbarui informasi yang sudah ditambahkan sebelumnya.
3.Menghapus Data Tamu: Tamu dapat menghapus informasi yang tidak diperlukan lagi.
4.Melihat Data Tamu: Tamu dapat melihat semua data yang telah ditambahkan.

## Penjelasan mengenai refleksi diri terhadap projek yang dikerjakan ##
Menghadapi tantangan dalam pemahaman konsep-konsep kompleks seperti pemrosesan data dari database, manajemen koneksi, dan penggunaan PDO merupakan bagian yang menantang dari proyek UAS Back-End ini. Sebagai proyek back-end kedua, saya masih agak merasa kesusahan saat membuat function. Untuk mengatasi ini, perlu memperdalam pemahaman dengan membaca dokumentasi, menonton tutorial online, dan mencari sumber belajar lainnya seperti platform YouTube. Selain itu, mengatur waktu dengan efisien antara pekerjaan lain, tugas kuliah, dan proyek juga menjadi tantangan tersendiri. Membuat jadwal yang jelas, alokasikan waktu secara proporsional, dan prioritaskan tugas penting. Selesaikan proyek secara bertahap agar tidak menumpuk di akhir. Dengan kesabaran, ketekunan, dan kemauan untuk terus belajar, dapat mengatasi tantangan dan kesulitan yang dihadapi dalam proyek ini.
