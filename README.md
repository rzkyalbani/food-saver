# 🥘 Food Saver App

<div align="center">
  <img src="https://via.placeholder.com/200x200/34D399/ffffff?text=Food+Saver" alt="Food Saver Logo" width="200" height="200"/>
  
  [![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
  [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![Filament](https://img.shields.io/badge/Filament-3.x-F59E0B?style=for-the-badge&logo=laravel&logoColor=white)](https://filamentphp.com)
  [![SQLite](https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)
  
  **Selamatkan Makanan, Hemat Uang, Lindungi Lingkungan** 🌍
  
  *Platform yang menghubungkan toko/restoran dengan konsumen untuk mengurangi limbah makanan melalui penjualan makanan berlebih dengan harga diskon.*
</div>

## 📖 Deskripsi

Food Saver App adalah sebuah platform web yang dikembangkan dengan Laravel yang bertujuan untuk mengurangi pemborosan makanan dengan menghubungkan bisnis makanan (restoran, toko, kafe) yang memiliki surplus makanan berkualitas dengan konsumen yang ingin membeli makanan tersebut dengan harga diskon.

### 🎯 Tujuan Proyek
- **Mengurangi Limbah Makanan**: Membantu bisnis menjual makanan berlebih daripada membuangnya
- **Hemat Biaya**: Konsumen mendapat makanan berkualitas dengan harga lebih murah (diskon hingga 70%)
- **Ramah Lingkungan**: Berkontribusi pada pengurangan sampah makanan dan dampak lingkungan
- **Mendukung UMKM**: Membantu bisnis lokal mendapatkan revenue tambahan dari makanan yang akan terbuang

## ✨ Fitur Utama

### 👥 Multi-Role System
- **Konsumen**: Mencari dan membeli penawaran makanan diskon
- **Mitra (Store Owner)**: Mengelola toko dan membuat penawaran makanan
- **Admin**: Mengelola seluruh sistem melalui admin panel

### 🛒 Untuk Konsumen
- **Katalog Penawaran**: Browse makanan dengan filter kategori dan lokasi
- **Pencarian Lokasi**: Temukan penawaran terdekat dengan GPS integration
- **Sistem Pemesanan**: Order makanan dengan pembayaran online (Xendit integration)
- **Rating & Review**: Berikan feedback untuk mitra
- **Riwayat Pesanan**: Tracking status pesanan dari pembayaran hingga pickup
- **Customer Support**: AI-powered chatbot dengan Gemini AI

### 🏪 Untuk Mitra
- **Dashboard Mitra**: Overview performa toko dan statistik penjualan
- **Manajemen Toko**: Setup profil toko dengan lokasi dan kategori
- **Pengelolaan Penawaran**: CRUD penawaran makanan dengan detail pickup time
- **AI Description Generator**: Auto-generate deskripsi menarik dengan Gemini AI
- **Konfirmasi Pesanan**: Verifikasi pickup pesanan dari konsumen
- **Analisis Reviews**: Melihat feedback dari konsumen

### 🔧 Untuk Admin
- **Admin Panel (Filament)**: Interface lengkap untuk mengelola sistem
- **User Management**: Kelola pengguna dan role
- **Store Verification**: Approve/reject pendaftaran mitra
- **Analytics Dashboard**: Statistik platform dan insights
- **Content Management**: Kelola kategori dan konten sistem

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 11.x
- **PHP**: 8.2+
- **Database**: SQLite (development), dapat diganti MySQL/PostgreSQL untuk production
- **Authentication**: Laravel Breeze
- **API Integration**: Xendit (Payment), Gemini AI (Chatbot & Description Generator)

### Frontend
- **CSS Framework**: Tailwind CSS
- **JavaScript**: Alpine.js, Vanilla JS
- **Build Tool**: Vite
- **Icons**: Font Awesome, Heroicons

### Admin Panel
- **Framework**: Filament 3.x
- **Features**: CRUD operations, Statistics widgets, User management

### Third-Party Services
- **Payment Gateway**: Xendit
- **AI Services**: Google Gemini AI
- **Maps**: Leaflet.js for location features
- **File Storage**: Laravel Storage (local/cloud ready)

## 📋 Prerequisites

Pastikan sistem Anda memiliki:

- **PHP**: >= 8.2
- **Composer**: >= 2.0
- **Node.js**: >= 16.x
- **NPM/Yarn**: Latest version
- **Git**: Latest version

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/your-username/food-saver-app.git
cd food-saver-app
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Environment
Edit file `.env` dan sesuaikan konfigurasi berikut:

```env
# Database (SQLite default)
DB_CONNECTION=sqlite
# DB_DATABASE=/path/to/database.sqlite (otomatis akan dibuat)

# Gemini AI Configuration
GEMINI_API_KEY=your_gemini_api_key_here
GEMINI_MODEL=gemini-2.0-flash

# Xendit Payment Gateway
XENDIT_SECRET_KEY=your_xendit_secret_key
XENDIT_PUBLIC_KEY=your_xendit_public_key

# App Configuration
APP_NAME="Food Saver"
APP_URL=http://localhost:8000
APP_ENV=local
APP_DEBUG=true
```

### 6. Database Setup
```bash
# Create database file (untuk SQLite)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed initial data
php artisan db:seed
```

### 7. Storage Link
```bash
php artisan storage:link
```

### 8. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Start Development Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📱 Akses Aplikasi

### Web Application
- **Homepage**: `http://localhost:8000`
- **Login/Register**: `http://localhost:8000/login`
- **Katalog**: `http://localhost:8000/offers`
- **Customer Support**: `http://localhost:8000/support`

### Admin Panel
- **URL**: `http://localhost:8000/admin`
- **Default Admin**:
  - Email: `admin@food-saver.app`
  - Password: `password123`

### Test Accounts
```
Mitra Test Account:
Email: partner@test.com
Password: password123

Konsumen Test Account:
Email: user@test.com
Password: password123
```

## 🗄️ Database Schema

### Core Tables
- `users` - Data pengguna (konsumen, mitra, admin)
- `stores` - Data toko/restoran mitra
- `categories` - Kategori makanan
- `offers` - Penawaran makanan dari mitra
- `orders` - Pesanan dari konsumen
- `reviews` - Rating dan review
- `chat_messages` - Riwayat chatbot customer support

### Key Relationships
- User → Store (One to Many)
- Store → Offer (One to Many) 
- User → Order (One to Many)
- Offer → Order (One to Many)
- Order → Review (One to One)

## 🎨 Screenshots

<div align="center">
  <img src="https://via.placeholder.com/800x400/34D399/ffffff?text=Homepage" alt="Homepage" width="400"/>
  <img src="https://via.placeholder.com/800x400/3B82F6/ffffff?text=Katalog" alt="Katalog" width="400"/>
  <img src="https://via.placeholder.com/800x400/F59E0B/ffffff?text=Dashboard+Mitra" alt="Dashboard Mitra" width="400"/>
  <img src="https://via.placeholder.com/800x400/EF4444/ffffff?text=Admin+Panel" alt="Admin Panel" width="400"/>
</div>

## 📁 Struktur Proyek

```
food-saver-app/
├── app/
│   ├── Filament/           # Admin panel components
│   ├── Http/Controllers/   # Controllers
│   │   ├── Auth/          # Authentication controllers
│   │   ├── Partner/       # Mitra-specific controllers
│   │   └── User/          # User-specific controllers
│   ├── Models/            # Eloquent models
│   ├── Services/          # Business logic services
│   └── View/Components/   # Blade components
├── database/
│   ├── migrations/        # Database schema
│   └── seeders/          # Database seeders
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── routes/
│   ├── web.php           # Web routes
│   └── auth.php          # Authentication routes
└── public/               # Public assets
```

## 🧪 Testing

### Manual Testing
```bash
# Start test server
php artisan serve

# Test different user roles
# Visit /register to create accounts
# Test payment flow with Xendit sandbox
# Test AI features with valid Gemini API key
```

### Automated Testing (Future)
```bash
# Run feature tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 🚀 Deployment

### Production Setup

1. **Server Requirements**
   - PHP 8.2+ with required extensions
   - Web server (Apache/Nginx)
   - Database (MySQL/PostgreSQL recommended)
   - SSL Certificate

2. **Environment Configuration**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Production database
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=food_saver_production
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# Production API keys
GEMINI_API_KEY=your-production-gemini-key
XENDIT_SECRET_KEY=your-production-xendit-key
```

3. **Deployment Steps**
```bash
# Optimize for production
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### Docker Deployment (Optional)
```dockerfile
# Dockerfile example
FROM php:8.2-fpm
# ... Docker configuration
```

## 🔧 API Documentation

### Available Endpoints

#### Public Routes
- `GET /` - Homepage
- `GET /offers` - Katalog penawaran
- `GET /offers/{id}` - Detail penawaran

#### Authenticated Routes
- `POST /order/create/{offer}` - Buat pesanan
- `GET /dashboard` - Dashboard pengguna
- `POST /support/send` - Kirim pesan chatbot

#### Partner Routes
- `GET /partner/dashboard` - Dashboard mitra
- `POST /partner/offers` - Buat penawaran
- `POST /partner/confirm-order` - Konfirmasi pickup

#### Admin Routes
- `GET /admin` - Admin panel (Filament)

## 🤝 Contributing

Kami menerima kontribusi! Berikut cara berkontribusi:

1. **Fork** repository ini
2. **Create** feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Open** Pull Request

### Development Guidelines
- Ikuti PSR-12 coding standards
- Tulis tests untuk fitur baru
- Update dokumentasi jika diperlukan
- Gunakan commit message yang deskriptif

## 🐛 Issues & Support

Jika menemukan bug atau butuh bantuan:

1. **Check** existing issues di GitHub
2. **Create** new issue dengan template yang sesuai
3. **Provide** informasi detail tentang masalah
4. **Include** steps to reproduce (jika bug)

## 📊 Roadmap

### Version 2.0 (Future)
- [ ] Mobile app (React Native/Flutter)
- [ ] Real-time notifications
- [ ] Advanced analytics dashboard
- [ ] Subscription plans untuk mitra
- [ ] Inventory management system
- [ ] Multi-language support
- [ ] API untuk third-party integrations

### Version 1.1 (Next Release)
- [ ] Enhanced AI chatbot
- [ ] Better mobile responsiveness
- [ ] Email notifications
- [ ] Advanced filtering di katalog
- [ ] Loyalty program

## 📝 License

Project ini menggunakan [MIT License](LICENSE).

```
MIT License

Copyright (c) 2025 Food Saver App

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 👥 Team

### Development Team
- **[Your Name]** - *Full Stack Developer* - [GitHub](https://github.com/your-username)

### Special Thanks
- Laravel Community
- Filament Team
- Tailwind CSS Team
- OpenAI & Google Gemini for AI capabilities

## 📧 Contact

- **Website**: [https://food-saver-app.com](https://food-saver-app.com)
- **Email**: contact@food-saver-app.com
- **GitHub**: [https://github.com/your-username/food-saver-app](https://github.com/your-username/food-saver-app)
- **LinkedIn**: [Your LinkedIn Profile](https://linkedin.com/in/your-profile)

---

<div align="center">
  <p><strong>💚 Bersama-sama kita selamatkan makanan dan lingkungan! 🌍</strong></p>
  
  <p>Made with ❤️ using Laravel & Tailwind CSS</p>
  
  ⭐ **Star this repo if you like it!** ⭐
</div>
