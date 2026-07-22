# Sistem Informasi Monitoring Kesehatan Pasien
## Rancang Bangun dengan Metodologi Extreme Programming (XP)

Aplikasi web untuk monitoring kesehatan pasien secara real-time dengan fitur notifikasi darurat dan manajemen data kesehatan pasien.

### 📋 Informasi Proyek
- **Bahasa Pemrograman**: PHP, HTML, CSS, JavaScript
- **Database**: MySQL
- **Metodologi**: Extreme Programming (XP)
- **Arsitektur**: MVC (Model-View-Controller)

### ✨ Fitur Utama
1. **Autentikasi & Otorisasi**
   - Login/Registrasi Pasien
   - Login/Registrasi Dokter & Petugas Medis
   - Role-based Access Control (RBAC)

2. **Dashboard Pasien**
   - Monitoring vital signs (Tekanan darah, Detak jantung, Suhu tubuh, dll)
   - Riwayat kesehatan
   - Jadwal kunjungan medis
   - Resep obat

3. **Dashboard Dokter**
   - Daftar pasien
   - Monitoring pasien real-time
   - Input data kesehatan pasien
   - Pembuatan resep dan diagnosis

4. **Sistem Notifikasi**
   - Alert kondisi darurat
   - Reminder jadwal medis
   - Notifikasi hasil lab

5. **Manajemen Data**
   - Riwayat medis lengkap
   - Laporan kesehatan
   - Export data

### 📁 Struktur Folder
```
extreme-programming/
├── config/
│   ├── config.php
│   ├── database.php
│   └── constants.php
├── public/
│   ├── index.php
│   ├── css/
│   │   ├── style.css
│   │   └── responsive.css
│   ├── js/
│   │   ├── main.js
│   │   ├── chart.js
│   │   └── validation.js
│   └── img/
├── app/
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── PatientController.php
│   │   ├── DoctorController.php
│   │   ├── HealthController.php
│   │   └── NotificationController.php
│   ├── models/
│   │   ├── Patient.php
│   │   ├── Doctor.php
│   │   ├── HealthData.php
│   │   ├── User.php
│   │   └── Notification.php
│   └── views/
│       ├── auth/
│       ├── patient/
│       ├── doctor/
│       ├── layout/
│       └── errors/
├── database/
│   └── schema.sql
├── tests/
│   └── unit/
└── .gitignore
```

### 🚀 Tahapan Pengembangan (Extreme Programming - Iterasi)

#### Iterasi 1: Setup & Autentikasi
- [ ] Setup struktur database
- [ ] Implementasi koneksi database
- [ ] Form login & registrasi
- [ ] Session management

#### Iterasi 2: Dashboard Dasar
- [ ] Dashboard pasien
- [ ] Dashboard dokter
- [ ] Menu navigasi
- [ ] User profile

#### Iterasi 3: Input & Monitoring Data Kesehatan
- [ ] Form input vital signs
- [ ] Grafik monitoring
- [ ] Riwayat kesehatan
- [ ] Real-time update

#### Iterasi 4: Sistem Notifikasi
- [ ] Alert kondisi darurat
- [ ] Email notification
- [ ] Dashboard notifikasi

#### Iterasi 5: Manajemen Pasien-Dokter
- [ ] Relasi pasien-dokter
- [ ] Appointment system
- [ ] Resep dan diagnosis

#### Iterasi 6: Testing & Optimization
- [ ] Unit testing
- [ ] Integration testing
- [ ] Performance optimization
- [ ] Security audit

### 🛠️ Cara Setup

1. **Clone Repository**
   ```bash
   git clone https://github.com/iskandardin/extreme-programming.git
   cd extreme-programming
   ```

2. **Setup Database**
   ```bash
   mysql -u root -p < database/schema.sql
   ```

3. **Konfigurasi Database**
   Edit file `config/database.php` dengan kredensial database Anda

4. **Jalankan Aplikasi**
   - Copy ke folder `htdocs` (XAMPP) atau `www` (WAMP)
   - Akses melalui `http://localhost/extreme-programming`

### 📝 Standar Coding (XP Principles)
- **Pair Programming**: Code review minimal 1 orang lain
- **Code Refactoring**: Perbaikan kode setelah setiap fitur
- **Unit Testing**: Test coverage minimal 80%
- **Simple Design**: Desain sesederhana mungkin namun fungsional
- **Collective Code Ownership**: Semua berhak mengubah kode mana pun

### 📚 Dependencies
- PHP >= 7.4
- MySQL >= 5.7
- Chart.js (untuk grafik)
- Bootstrap 5 (optional, untuk styling)

### 🔒 Keamanan
- Password hashing menggunakan `password_hash()`
- SQL Injection prevention dengan prepared statements
- CSRF token protection
- Input validation & sanitization

### 📄 Lisensi
MIT License

### 👨‍💻 Author
Created by iskandardin

---
**Status**: 🚧 Under Development (Iterasi 1)
