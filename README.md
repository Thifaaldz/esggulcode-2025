# ESGULCODE 2025  
**Learning Management System (LMS) & Human Resource Management (HRM) Berbasis Web**  

## 📌 Deskripsi Proyek
Proyek ini merupakan implementasi **Sistem Informasi Terintegrasi** untuk mendukung **pembelajaran digital** (LMS) dan **manajemen sumber daya manusia** (HRM) di **EsgulCode Company**, sebuah perusahaan yang bergerak di bidang **EdTech** dan **HR Tech**.  

Sistem ini dirancang untuk mendigitalisasi proses pendidikan dan manajemen SDM di Indonesia agar lebih **efisien, transparan, dan real-time**.  

## 🚀 Fitur Utama
### 1. Learning Management System (LMS)
- Manajemen materi berupa **video (link YouTube/Drive)** & **dokumen PDF**.  
- Sistem **tugas upload**: siswa wajib mengumpulkan tugas sesuai instruksi.  
- Jika semua syarat terpenuhi → sistem otomatis menghasilkan **sertifikat digital dengan QR code verifikasi**.  
- Sistem mendukung **bootcamp & course hybrid (online/offline)** dengan pembayaran terintegrasi.  

### 2. Human Resource Management (HRM)
- Manajemen data karyawan (multi-cabang, multi-departemen).  
- Absensi digital berbasis **clock-in & clock-out**.  
- Pengajuan & persetujuan cuti online.  
- Payroll otomatis (gaji pokok, tunjangan, potongan, bonus).  
- Generate & distribusi **slip gaji digital**.  
- Event Course untuk pelatihan internal karyawan.  

### 3. Sistem Pendukung
- **Role-Based Access Control (RBAC)**: Admin, HR, Guru, Siswa, Karyawan Non-Guru.  
- **Notifikasi Otomatis** via WhatsApp (Twilio).  
- **Payment Gateway** Midtrans (Bank Transfer, QRIS, E-Wallet, Kartu Kredit).  
- **SMTP Email** (notifikasi sederhana tanpa Mailtrap).  

## 🛠️ Teknologi yang Digunakan
- **Backend**: [Laravel 12](https://laravel.com/)  
- **Admin Panel**: [Filament v3](https://filamentphp.com/)  
- **UI Framework**: TailwindCSS + Livewire  
- **Database**: MySQL / MariaDB  
- **Containerization**: Docker & Docker Compose  
- **Integrasi Pihak Ketiga**:  
  - Midtrans (Payment Gateway)  
  - Twilio (WhatsApp Notification)  
  - SMTP (Email Notifikasi)  

## 📂 Struktur Modul
```
├── LMS
│   ├── Modul Video (link)
│   ├── Materi PDF
│   ├── Tugas Upload
│   └── Sertifikat Otomatis
├── HRM
│   ├── Data Pegawai
│   ├── Absensi & Cuti
│   ├── Payroll & Slip Gaji
│   └── Event Training
├── Integrasi
│   ├── Midtrans (Pembayaran)
│   ├── Twilio (Notifikasi WA)
│   └── SMTP (Email Notifikasi)
```

## ⚙️ Instalasi & Konfigurasi
1. Clone repositori:
   ```bash
   git clone https://github.com/Thifaaldz/esggulcode-2025.git
   cd esggulcode-2025
   ```
2. Jalankan Docker Compose:
   ```bash
   docker-compose up -d
   ```
3. Copy file environment:
   ```bash
   cp .env.example .env
   ```
4. Generate key & migrate database:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
5. Jalankan aplikasi:
   ```bash
   php artisan serve
   ```
   Akses di: `http://localhost:8000`

## 🔑 Role Akses
- **Admin**: akses penuh (LMS + HRM).  
- **HRD**: kelola data karyawan, absensi, cuti, payroll.  
- **Guru**: kelola materi (video/PDF), tugas, dan sertifikat.  
- **Siswa**: akses materi, upload tugas, unduh sertifikat.  
- **Karyawan Non-Guru**: absensi & cuti.  

## 📸 Tampilan Sistem

### 🔑 Dashboard Admin
![Dashboard Admin](docs/images/dashboardadmin.png)

### 👨‍🏫 Dashboard Guru
![Dashboard Guru](docs/images/dashboardguru.png)

### 🎓 Dashboard Siswa
![Dashboard Siswa](docs/images/dashboardstudent.png)

### 🌐 Tampilan Pengguna
![Tampilan Pengguna](docs/images/tampilanpengguna.png)