<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Instalasi Food Saver App (Development Mode)</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        h2 {
            color: #2980b9;
            margin-top: 30px;
        }
        h3 {
            color: #3498db;
        }
        code {
            font-family: 'Courier New', Courier, monospace;
        }
        pre {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            border: 1px solid #ddd;
        }
        ul {
            padding-left: 20px;
        }
        li {
            margin-bottom: 5px;
        }
        .note {
            background-color: #f8f9fa;
            border-left: 4px solid #ffc107;
            padding: 10px 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Tutorial Instalasi Food Saver App (Development Mode)</h1>
    
    <p>Food Saver App adalah aplikasi yang menghubungkan pengguna dengan toko-toko lokal untuk membeli makanan berlebih dengan harga diskon, membantu mengurangi limbah makanan sekaligus menghemat pengeluaran.</p>
    
    <h2>Persyaratan Sistem</h2>
    <ul>
        <li>PHP 8.2 atau lebih tinggi</li>
        <li>Composer</li>
        <li>Node.js dan NPM</li>
        <li>MySQL atau database yang didukung Laravel</li>
        <li>Git</li>
    </ul>
    
    <h2>Langkah-langkah Instalasi untuk Pengembangan</h2>
    
    <h3>1. Klon Repositori</h3>
    <pre><code>git clone https://github.com/username/food-saver-app.git
cd food-saver-app</code></pre>
    
    <h3>2. Instal Dependensi PHP</h3>
    <pre><code>composer install</code></pre>
    
    <h3>3. Instal Dependensi JavaScript</h3>
    <pre><code>npm install</code></pre>
    
    <h3>4. Konfigurasi Environment</h3>
    <pre><code>cp .env.example .env
php artisan key:generate</code></pre>
    
    <p>Edit file <code>.env</code> dan sesuaikan konfigurasi database:</p>
    <pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=food_saver_app
DB_USERNAME=root
DB_PASSWORD=</code></pre>
    
    <p>Tambahkan konfigurasi Xendit untuk pembayaran:</p>
    <pre><code>XENDIT_SECRET_KEY=your_xendit_secret_key</code></pre>
    
    <p>Juga atur timezone untuk Indonesia:</p>
    <pre><code>APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id</code></pre>
    
    <h3>5. Migrasi dan Seed Database</h3>
    <pre><code>php artisan migrate
php artisan db:seed</code></pre>
    
    <h3>6. Buat Symlink Storage</h3>
    <pre><code>php artisan storage:link</code></pre>
    
    <h3>7. Menjalankan Aplikasi untuk Development</h3>
    <p>Untuk development, gunakan perintah berikut dalam terminal terpisah:</p>
    <pre><code># Terminal 1: Run Laravel server
php artisan serve

# Terminal 2: Run scheduler (menggantikan cron job)
php artisan schedule:work

# Terminal 3: Run Vite development server
npm run dev</code></pre>
    
    <p>Dengan <code>schedule:work</code>, Anda tidak perlu mengatur cron job karena perintah ini akan menjalankan scheduler Laravel secara real-time dalam foreground.</p>
    
    <h2>Fitur Utama</h2>
    <ul>
        <li><strong>Autentikasi Pengguna</strong>: Registrasi, login, dan manajemen profil</li>
        <li><strong>Sistem Multi-Role</strong>: Pengguna biasa dan mitra toko</li>
        <li><strong>Geolokasi</strong>: Temukan penawaran terdekat dengan lokasi Anda</li>
        <li><strong>Katalog Penawaran</strong>: Jelajahi penawaran makanan dari berbagai toko</li>
        <li><strong>Sistem Pemesanan</strong>: Buat pesanan dan lakukan pembayaran melalui Xendit</li>
        <li><strong>Konfirmasi Pengambilan</strong>: Sistem validasi kode pesanan saat pengambilan</li>
        <li><strong>Dashboard Pengguna</strong>: Lacak pesanan dan riwayat transaksi</li>
        <li><strong>Dashboard Mitra</strong>: Kelola toko dan buat penawaran baru</li>
    </ul>
    
    <h2>Pengembangan Full Stack</h2>
    <p>Untuk menggunakan perintah development terintegrasi yang telah diatur dalam composer.json:</p>
    <pre><code>composer run dev</code></pre>
    <p>Perintah ini akan menjalankan server Laravel, queue listener, logs, dan Vite secara bersamaan dengan concurrently.</p>
    
    <h2>Akun Test</h2>
    <p>Aplikasi menyediakan beberapa akun untuk testing:</p>
    <ul>
        <li><strong>Admin</strong>: admin@example.com / password</li>
        <li><strong>Mitra</strong>: partner@example.com / password</li>
        <li><strong>Pengguna</strong>: user@example.com / password</li>
    </ul>
    
    <h2>Integrasi Pembayaran</h2>
    <p>Untuk development, Anda dapat menggunakan akun test Xendit. Daftar di <a href="https://www.xendit.co">Xendit</a> untuk mendapatkan API key test.</p>
    
    <h2>Troubleshooting</h2>
    <p>Jika mengalami masalah, coba perintah berikut:</p>
    <pre><code>php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear</code></pre>
    
    <h2>Catatan Penting</h2>
    <ul>
        <li>Pastikan ekstensi PHP yang diperlukan sudah terinstal (fileinfo, gd, pdo_mysql, dll)</li>
        <li>Folder <code>storage</code> dan <code>bootstrap/cache</code> harus memiliki permission yang benar (writable)</li>
        <li>Scheduler pada mode development akan tetap berjalan selama <code>php artisan schedule:work</code> aktif</li>
        <li>Hapus <code>.env.example</code> dari repo Git Anda jika ingin membagikan kode tanpa kredensial default</li>
    </ul>
    
    <h2>Mengakses Aplikasi</h2>
    <p>Setelah menjalankan server, akses aplikasi di <a href=
