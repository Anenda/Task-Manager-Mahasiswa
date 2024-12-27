# Manajemen tugas mahasiswa

![Logo](public/assets/img/logo-circle-horizontal.png)

## Deskripsi
Laravel Manajemen tugas adalah sebuah aplikasi web berbasis framework Laravel yang menyediakan fitur lengkap untuk mengelola tugas. Aplikasi ini dirancang untuk mengingatkan para mahasiswa agar tidak telat mengumpulkan tugas.

## Fitur Utama
- Tambah tugas baru dengan deadline
- Daftar tugas berdasarkan kategori (kuliah, proyek, dll.)
- Notifikasi sederhana untuk tugas mendekati deadline
- Login pengguna

## Persyaratan system
- PHP >= 8.1
- Composer
- Laravel >= 10
- MySQL atau database kompatibel lainnya

## Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/Anenda/Task-Manager-Mahasiswa.git
   ```
   atau jika menggunakan github cli:
   ```bash
   gh repo clone Anenda/Task-Manager-Mahasiswa
   ```

2. Masuk ke direktori proyek:
   ```bash
   cd e_commerce
   ```

3. Install dependensi menggunakan Composer:
   ```bash
   composer install
   ```

4. Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Konfigurasikan file `.env` sesuai dengan database dan pengaturan lainnya:
    ```.env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task
    DB_USERNAME=root
    DB_PASSWORD={password-mysql}
    ```
    Kosongkan jika tidak menggunakan password

7. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

8. Ambil data yang sudah di setup dengan menjalankan perintah berikut:
   ```bash
   php artisan db:seed
   ```

9.  Jalankan server aplikasi:
    ```bash
    php artisan serve
    ```

## Struktur Proyek
- **app/**: Berisi file backend aplikasi Laravel.
- **resources/**: Berisi file frontend (blade templates, CSS, JS).
- **routes/**: Berisi definisi rute aplikasi.
- **database/**: Berisi migrasi dan seeder database.

## Kontributor
- FADLY DIFAK AL FATAH 
- CAHAYA JIWA ANENDA 
- MUHAMAD ANGGARA RAMADHAN
- FADLY DIFAK AL FATAH 
- ANDREW HARRIS ERIANTO

<!-- ## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE). -->
