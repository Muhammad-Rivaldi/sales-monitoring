🌶️ Sales Monitoring System
Aplikasi monitoring penjualan harian yang dirancang khusus untuk bisnis kuliner (Sambal Bakar). Dibangun dengan TALL Stack (Tailwind, Alpine.js, Laravel, Livewire) untuk memberikan pengalaman pengguna yang responsif, interaktif, dan real-time.

🚀 Fitur Utama
Interactive Dashboard: Visualisasi tren penjualan bulanan menggunakan Chart.js yang terintegrasi langsung dengan database.

Advanced DataTable: Fitur pencarian (real-time search), pengurutan (sorting), dan paginasi data tanpa reload halaman menggunakan Livewire 4.

Full CRUD Operations: Manajemen data transaksi penjualan dengan antarmuka modal yang modern.

Mobile Responsive: Tampilan dioptimasi untuk berbagai perangkat menggunakan Tailwind CSS.

Production Ready: Konfigurasi otomatis HTTPS dan optimasi performa untuk deployment di cloud.

🛠️ Tech Stack
Framework: Laravel 12 (PHP 8.2+).

Frontend: Livewire 4 & Tailwind CSS.

Database: MySQL.

Charts: Chart.js.

Deployment: Railway (Platform-as-a-Service).

💻 Instalasi Lokal
Clone Repository

Bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
Install Dependensi

Bash
composer install
npm install && npm run build
Konfigurasi Environment
Salin file .env.example menjadi .env dan sesuaikan pengaturan database kamu.

Bash
cp .env.example .env
php artisan key:generate
Migrasi Database

Bash
php artisan migrate
Jalankan Server

Bash
php artisan serve
🌐 Deployment (Railway)
Proyek ini telah dikonfigurasi untuk berjalan di Railway.app. Beberapa penyesuaian penting yang telah diterapkan:

Penggunaan Environment Variables untuk koneksi database dinamis.

Penerapan Pre-deploy step (php artisan migrate --force) untuk pembaruan skema otomatis.

Optimasi Mixed Content dengan memaksa skema HTTPS pada lingkungan produksi.