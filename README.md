<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Sistem Kegiatan Pemerintah

Aplikasi web untuk manajemen program dan kegiatan pemerintah yang transparan dan akuntabel.

## 🚀 Fitur Utama

### 👥 Manajemen Pengguna
- **Multi-role system**: Super Admin, Admin, dan User
- **Profile management**: Edit profil, ubah password
- **User management**: CRUD pengguna dengan authorization

### 📋 Manajemen Program
- **CRUD Program**: Create, Read, Update, Delete program kegiatan
- **Kategorisasi**: Program dapat dikategorikan untuk organisasi yang lebih baik
- **Status tracking**: Planning, Ongoing, Completed, Cancelled
- **Public/Private**: Program dapat dipublikasikan untuk masyarakat
- **Advanced filtering**: Filter berdasarkan status, kategori, dan pencarian

### 🏷️ Manajemen Kategori
- **Custom categories**: Buat kategori sesuai kebutuhan
- **Color coding**: Setiap kategori memiliki warna untuk identifikasi visual
- **Many-to-many relationship**: Satu program dapat memiliki multiple kategori

### 🌐 Halaman Publik
- **Homepage**: Landing page dengan informasi umum
- **Public programs**: Daftar program yang dapat diakses masyarakat
- **Program details**: Detail lengkap program dengan informasi budget, lokasi, timeline
- **Responsive design**: Optimized untuk desktop dan mobile

## 🛠️ Teknologi

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Icons**: Heroicons
- **Build Tools**: Vite

## 📦 Instalasi

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/sistem-kegiatan-pemerintah.git
   cd sistem-kegiatan-pemerintah
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistem_kegiatan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Database migration & seeding**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

   Aplikasi akan berjalan di `http://localhost:8000`

## 👤 Default Users

Setelah seeding, tersedia akun default:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | kadis.kominfo@pemda.go.id | password |
| Admin | sekda@pemda.go.id | password |

## 📁 Struktur Project

```
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   ├── Policies/            # Authorization Policies
│   └── Providers/           # Service Providers
├── database/
│   ├── migrations/          # Database Migrations
│   ├── seeders/            # Database Seeders
│   └── factories/          # Model Factories
├── resources/
│   ├── views/              # Blade Templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript
├── routes/
│   ├── web.php             # Web Routes
│   └── auth.php            # Authentication Routes
└── public/                 # Public Assets
```

## 🔐 Authorization

Aplikasi menggunakan Laravel Policies untuk authorization:

- **Super Admin**: Full access ke semua fitur
- **Admin**: Dapat mengelola users dan programs
- **User**: Hanya dapat mengelola data milik sendiri

## 🎨 UI/UX

- **Design System**: Konsisten menggunakan Tailwind CSS
- **Responsive**: Mobile-first approach
- **Accessibility**: Semantic HTML dan proper ARIA labels
- **Color Scheme**: Professional government theme

## 🚀 Deployment

### Production Setup

1. **Server Requirements**
   - PHP >= 8.2
   - MySQL >= 8.0
   - Nginx/Apache
   - SSL Certificate

2. **Environment Variables**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

3. **Optimization**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

Untuk pertanyaan atau dukungan, silakan hubungi:
- Email: info@kegiatan-pemerintah.go.id
- Phone: (021) 1234-5678

---

**Sistem Kegiatan Pemerintah** - Transparansi dan Akuntabilitas dalam Setiap Program Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
