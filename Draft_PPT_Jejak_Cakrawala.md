# DRAFT PRESENTASI SISTEM INFORMASI PENDAKIAN GUNUNG
## "JEJAK CAKRAWALA"

---

## SLIDE 1: HALAMAN JUDUL
### SISTEM INFORMASI PENDAKIAN GUNUNG "JEJAK CAKRAWALA"
**Analisis dan Perancangan Sistem**
- UML (Unified Modeling Language)
- Use Case Diagram
- Flowchart
- Data Relasional

**Disusun oleh:** [Nama]
**Mata Kuliah:** Dasar Pemrograman Web
**Program Studi:** [Program Studi]

---

## SLIDE 2: PENDAHULUAN
### Tentang Sistem Jejak Cakrawala
- **Tujuan:** Mengelola informasi pendakian gunung secara digital
- **Fitur Utama:**
  - Pendaftaran pendaki
  - Pengelolaan jadwal pendakian
  - Informasi gunung
  - Status pendakian real-time
- **Teknologi:** PHP, MySQL, HTML, CSS, JavaScript

---

## SLIDE 3: UML (UNIFIED MODELING LANGUAGE)
### Pengertian UML
- **UML** adalah bahasa pemodelan standar untuk pengembangan perangkat lunak
- Digunakan untuk memvisualisasikan, menspesifikasikan, membangun, dan mendokumentasikan sistem

### Jenis Diagram UML yang Digunakan:
1. **Use Case Diagram** - Interaksi aktor dengan sistem
2. **Class Diagram** - Struktur kelas dan relasi
3. **Activity Diagram** - Alur proses bisnis
4. **Sequence Diagram** - Interaksi antar objek

---

## SLIDE 4: USE CASE DIAGRAM
### Aktor dalam Sistem:
- **Admin** - Pengelola sistem
- **Pendaki** - Pengguna yang mendaftar pendakian
- **Guest** - Pengunjung website

### Use Case Utama:
```
┌─────────────────────────────────────────┐
│              SISTEM JEJAK CAKRAWALA     │
├─────────────────────────────────────────┤
│                                         │
│  ┌─────────┐    ┌─────────────────┐     │
│  │  ADMIN  │    │   Pendaftaran   │     │
│  └─────────┘    └─────────────────┘     │
│       │              ▲                  │
│       │              │                  │
│       ▼              │                  │
│  ┌─────────────────┐ │                  │
│  │ Kelola Gunung   │ │                  │
│  └─────────────────┘ │                  │
│       │              │                  │
│       ▼              │                  │
│  ┌─────────────────┐ │                  │
│  │ Kelola Jadwal   │ │                  │
│  └─────────────────┘ │                  │
│       │              │                  │
│       ▼              │                  │
│  ┌─────────────────┐ │                  │
│  │ Kelola Pendaki  │ │                  │
│  └─────────────────┘ │                  │
│                      │                  │
│  ┌─────────┐         │                  │
│  │ PENDaki │─────────┘                  │
│  └─────────┘                            │
│       │                                 │
│       ▼                                 │
│  ┌─────────────────┐                    │
│  │ Lihat Jadwal    │                    │
│  └─────────────────┘                    │
│       │                                 │
│       ▼                                 │
│  ┌─────────────────┐                    │
│  │ Update Status   │                    │
│  └─────────────────┘                    │
└─────────────────────────────────────────┘
```

---

## SLIDE 5: CLASS DIAGRAM
### Entitas Utama dalam Sistem:

```
┌─────────────────┐    ┌─────────────────┐
│     ADMIN       │    │     GUNUNG      │
├─────────────────┤    ├─────────────────┤
│ - id_admin      │    │ - id_gunung     │
│ - username      │    │ - nama_gunung   │
│ - password      │    │ - lokasi        │
│ - nama          │    │ - ketinggian    │
│ - email         │    │ - deskripsi     │
├─────────────────┤    │ - gambar        │
│ + login()       │    ├─────────────────┤
│ + logout()      │    │ + tambah()      │
│ + kelolaGunung()│    │ + edit()        │
│ + kelolaJadwal()│    │ + hapus()       │
└─────────────────┘    └─────────────────┘
         │                       │
         │                       │
         ▼                       ▼
┌─────────────────┐    ┌─────────────────┐
│     PENDaki     │    │     JADWAL      │
├─────────────────┤    ├─────────────────┤
│ - id_pendaki    │    │ - id_jadwal     │
│ - nama          │    │ - id_gunung     │
│ - email         │    │ - tanggal       │
│ - no_hp         │    │ - kuota         │
│ - alamat        │    │ - status        │
│ - identitas     │    ├─────────────────┤
├─────────────────┤    │ + tambah()      │
│ + daftar()      │    │ + edit()        │
│ + updateStatus()│    │ + hapus()       │
│ + lihatJadwal() │    └─────────────────┘
└─────────────────┘
```

---

## SLIDE 6: FLOWCHART - PROSES PENDAFTARAN PENDAKI
```
    [MULAI]
       │
       ▼
┌─────────────┐
│ Buka Website│
└─────────────┘
       │
       ▼
┌─────────────┐
│ Pilih Menu  │
│ Pendaftaran │
└─────────────┘
       │
       ▼
┌─────────────┐
│ Isi Form    │
│ Pendaftaran │
└─────────────┘
       │
       ▼
┌─────────────┐
│ Upload      │
│ Identitas   │
└─────────────┘
       │
       ▼
┌─────────────┐
│ Validasi    │
│ Data        │
└─────────────┘
       │
       ▼
┌─────────────┐
│ Data Valid? │
└─────────────┘
       │
   ┌───┴───┐
   │  YA   │  TIDAK
   ▼       ▼
┌─────────┐ ┌─────────┐
│ Simpan  │ │ Tampilkan│
│ Data    │ │ Error    │
└─────────┘ └─────────┘
   │           │
   ▼           ▼
┌─────────┐ ┌─────────┐
│ Sukses  │ │ Kembali │
│ Daftar  │ │ ke Form │
└─────────┘ └─────────┘
   │           │
   ▼           ▼
    [SELESAI]
```

---

## SLIDE 7: FLOWCHART - PROSES LOGIN ADMIN
```
    [MULAI]
       │
       ▼
┌─────────────┐
│ Buka Halaman│
│ Login Admin │
└─────────────┘
       │
       ▼
┌─────────────┐
│ Input       │
│ Username &  │
│ Password    │
└─────────────┘
       │
       ▼
┌─────────────┐
│ Validasi    │
│ Kredensial  │
└─────────────┘
       │
       ▼
┌─────────────┐
│ Kredensial  │
│ Valid?      │
└─────────────┘
       │
   ┌───┴───┐
   │  YA   │  TIDAK
   ▼       ▼
┌─────────┐ ┌─────────┐
│ Redirect│ │ Tampilkan│
│ ke      │ │ Error    │
│ Dashboard│ │ Message  │
└─────────┘ └─────────┘
       │           │
       ▼           ▼
┌─────────┐ ┌─────────┐
│ Akses   │ │ Kembali │
│ Menu    │ │ ke Form │
│ Admin   │ │ Login   │
└─────────┘ └─────────┘
       │           │
       ▼           ▼
    [SELESAI]
```

---

## SLIDE 8: DATA RELASIONAL
### Struktur Database

**Tabel: admin**
```sql
CREATE TABLE admin (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);
```

**Tabel: gunung**
```sql
CREATE TABLE gunung (
    id_gunung INT PRIMARY KEY AUTO_INCREMENT,
    nama_gunung VARCHAR(100) NOT NULL,
    lokasi VARCHAR(200) NOT NULL,
    ketinggian VARCHAR(50) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255)
);
```

**Tabel: jadwal**
```sql
CREATE TABLE jadwal (
    id_jadwal INT PRIMARY KEY AUTO_INCREMENT,
    id_gunung INT,
    tanggal DATE NOT NULL,
    kuota INT NOT NULL,
    status ENUM('Tersedia', 'Penuh', 'Selesai') DEFAULT 'Tersedia',
    FOREIGN KEY (id_gunung) REFERENCES gunung(id_gunung)
);
```

**Tabel: pendaki**
```sql
CREATE TABLE pendaki (
    id_pendaki INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    identitas VARCHAR(255) NOT NULL,
    status ENUM('Terdaftar', 'Sedang Mendaki', 'Selesai') DEFAULT 'Terdaftar'
);
```

---

## SLIDE 9: RELASI ANTAR TABEL
### Entity Relationship Diagram (ERD)

```
┌─────────────┐         ┌─────────────┐
│    ADMIN    │         │   GUNUNG    │
├─────────────┤         ├─────────────┤
│ id_admin    │◄────────┤ id_gunung   │
│ username    │         │ nama_gunung │
│ password    │         │ lokasi      │
│ nama        │         │ ketinggian  │
│ email       │         │ deskripsi   │
└─────────────┘         │ gambar      │
                        └─────────────┘
                                │
                                │ 1:N
                                ▼
                        ┌─────────────┐
                        │   JADWAL    │
                        ├─────────────┤
                        │ id_jadwal   │
                        │ id_gunung   │
                        │ tanggal     │
                        │ kuota       │
                        │ status      │
                        └─────────────┘
                                │
                                │ 1:N
                                ▼
                        ┌─────────────┐
                        │   PENDAKI   │
                        ├─────────────┤
                        │ id_pendaki  │
                        │ nama        │
                        │ email       │
                        │ no_hp       │
                        │ alamat      │
                        │ identitas   │
                        │ status      │
                        └─────────────┘
```

---

## SLIDE 10: NORMALISASI DATABASE
### Normalisasi ke 1NF (First Normal Form)
- Setiap atribut hanya memiliki satu nilai
- Tidak ada pengulangan grup data
- Setiap baris memiliki primary key yang unik

### Normalisasi ke 2NF (Second Normal Form)
- Sudah dalam 1NF
- Semua atribut non-key bergantung sepenuhnya pada primary key

### Normalisasi ke 3NF (Third Normal Form)
- Sudah dalam 2NF
- Tidak ada dependensi transitif

**Contoh Normalisasi:**
```
Tabel Pendaki (Sudah Normalized):
- id_pendaki (Primary Key)
- nama
- email
- no_hp
- alamat
- identitas
- status
```

---

## SLIDE 11: IMPLEMENTASI SISTEM
### Teknologi yang Digunakan:
- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP Native
- **Database:** MySQL
- **Server:** Apache/XAMPP

### Fitur yang Diimplementasikan:
1. **Sistem Autentikasi**
   - Login/Logout Admin
   - Session Management

2. **CRUD Operations**
   - Create, Read, Update, Delete untuk semua entitas

3. **File Upload**
   - Upload gambar gunung
   - Upload identitas pendaki

4. **Validasi Data**
   - Client-side validation
   - Server-side validation

---

## SLIDE 12: KEAMANAN SISTEM
### Implementasi Keamanan:
1. **Password Hashing**
   - Menggunakan password_hash() untuk enkripsi password

2. **SQL Injection Prevention**
   - Menggunakan prepared statements
   - Validasi input user

3. **File Upload Security**
   - Validasi tipe file
   - Pembatasan ukuran file
   - Rename file untuk keamanan

4. **Session Management**
   - Session timeout
   - Session regeneration

---

## SLIDE 13: TESTING SISTEM
### Jenis Testing yang Dilakukan:
1. **Unit Testing**
   - Testing fungsi individual
   - Testing validasi data

2. **Integration Testing**
   - Testing koneksi database
   - Testing alur proses

3. **User Acceptance Testing**
   - Testing dari perspektif user
   - Testing usability

### Hasil Testing:
- ✅ Sistem berjalan dengan baik
- ✅ Semua fitur berfungsi normal
- ✅ Database terintegrasi dengan baik
- ✅ Keamanan sistem terjamin

---

## SLIDE 14: KESIMPULAN
### Pencapaian Sistem:
1. **Fungsionalitas Lengkap**
   - Semua requirement terpenuhi
   - Sistem dapat digunakan dengan baik

2. **Arsitektur yang Baik**
   - Menggunakan UML untuk perancangan
   - Database terstruktur dengan baik
   - Kode terorganisir rapi

3. **Keamanan Terjamin**
   - Implementasi keamanan yang memadai
   - Data terlindungi dengan baik

4. **User Experience**
   - Interface yang user-friendly
   - Navigasi yang mudah

---

## SLIDE 15: SARAN PENGEMBANGAN
### Pengembangan Selanjutnya:
1. **Fitur Tambahan**
   - Sistem notifikasi
   - Laporan pendakian
   - Integrasi dengan GPS

2. **Teknologi Modern**
   - Framework PHP (Laravel/CodeIgniter)
   - Frontend Framework (React/Vue.js)
   - Mobile Application

3. **Keamanan Lanjutan**
   - Two-factor authentication
   - API security
   - Data encryption

4. **Performance**
   - Caching system
   - Database optimization
   - CDN integration

---

## SLIDE 16: TERIMA KASIH
### Sistem Informasi Pendakian Gunung
## "JEJAK CAKRAWALA"

**Pertanyaan & Diskusi**

**Kontak:**
- Email: [email]
- GitHub: [github_username]

**Referensi:**
- UML Documentation
- MySQL Documentation
- PHP Documentation

---

## CATATAN UNTUK PRESENTASI:
1. **Durasi:** 15-20 menit
2. **Format:** PowerPoint atau Google Slides
3. **Visual:** Tambahkan screenshot sistem
4. **Demo:** Siapkan demo live sistem
5. **Q&A:** Siapkan jawaban untuk pertanyaan umum

## TIPS PRESENTASI:
- Gunakan gambar dan diagram yang jelas
- Jelaskan setiap slide dengan detail
- Siapkan backup jika demo gagal
- Berikan contoh konkret untuk setiap konsep
- Akhiri dengan kesimpulan yang kuat 