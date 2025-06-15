Tutorial Instalasi Food Saver App (Development Mode)
Food Saver App adalah aplikasi yang menghubungkan pengguna dengan toko-toko lokal untuk membeli makanan berlebih dengan harga diskon, membantu mengurangi limbah makanan sekaligus menghemat pengeluaran.

Persyaratan Sistem
PHP 8.2 atau lebih tinggi
Composer
Node.js dan NPM
MySQL atau database yang didukung Laravel
Git
Langkah-langkah Instalasi untuk Pengembangan
1. Klon Repositori
2. Instal Dependensi PHP
3. Instal Dependensi JavaScript
4. Konfigurasi Environment
Edit file .env dan sesuaikan konfigurasi database:

Tambahkan konfigurasi Xendit untuk pembayaran:

Juga atur timezone untuk Indonesia:

5. Migrasi dan Seed Database
6. Buat Symlink Storage
7. Menjalankan Aplikasi untuk Development
Untuk development, gunakan perintah berikut dalam terminal terpisah:

Dengan schedule:work, Anda tidak perlu mengatur cron job karena perintah ini akan menjalankan scheduler Laravel secara real-time dalam foreground.

Fitur Utama
Autentikasi Pengguna: Registrasi, login, dan manajemen profil
Sistem Multi-Role: Pengguna biasa dan mitra toko
Geolokasi: Temukan penawaran terdekat dengan lokasi Anda
Katalog Penawaran: Jelajahi penawaran makanan dari berbagai toko
Sistem Pemesanan: Buat pesanan dan lakukan pembayaran melalui Xendit
Konfirmasi Pengambilan: Sistem validasi kode pesanan saat pengambilan
Dashboard Pengguna: Lacak pesanan dan riwayat transaksi
Dashboard Mitra: Kelola toko dan buat penawaran baru
Pengembangan Full Stack
Untuk menggunakan perintah development terintegrasi yang telah diatur dalam composer.json:

Perintah ini akan menjalankan server Laravel, queue listener, logs, dan Vite secara bersamaan dengan concurrently.

Akun Test
Aplikasi menyediakan beberapa akun untuk testing:

Admin: admin@example.com / password
Mitra: partner@example.com / password
Pengguna: user@example.com / password
Integrasi Pembayaran
Untuk development, Anda dapat menggunakan akun test Xendit. Daftar di Xendit untuk mendapatkan API key test.

Troubleshooting
Jika mengalami masalah, coba perintah berikut:

Catatan Penting
Pastikan ekstensi PHP yang diperlukan sudah terinstal (fileinfo, gd, pdo_mysql, dll)
Folder storage dan cache harus memiliki permission yang benar (writable)
Scheduler pada mode development akan tetap berjalan selama php artisan schedule:work aktif
Hapus .env.example dari repo Git Anda jika ingin membagikan kode tanpa kredensial default
Mengakses Aplikasi
Setelah menjalankan server, akses aplikasi di http://localhost:8000
