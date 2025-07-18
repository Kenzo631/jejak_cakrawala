# DIAGRAM UML SISTEM JEJAK CAKRAWALA

## 1. USE CASE DIAGRAM (DETAIL)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                        SISTEM INFORMASI JEJAK CAKRAWALA                    │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─────────────┐                                                           │
│  │    ADMIN    │                                                           │
│  └─────────────┘                                                           │
│       │                                                                     │
│       ├─── Login                                                           │
│       ├─── Logout                                                          │
│       ├─── Kelola Data Gunung                                             │
│       │    ├─── Tambah Gunung                                             │
│       │    ├─── Edit Gunung                                               │
│       │    └─── Hapus Gunung                                              │
│       ├─── Kelola Jadwal Pendakian                                        │
│       │    ├─── Tambah Jadwal                                             │
│       │    ├─── Edit Jadwal                                               │
│       │    └─── Hapus Jadwal                                              │
│       ├─── Kelola Data Pendaki                                            │
│       │    ├─── Lihat Daftar Pendaki                                      │
│       │    ├─── Edit Data Pendaki                                         │
│       │    └─── Hapus Data Pendaki                                        │
│       └─── Lihat Laporan                                                  │
│                                                                             │
│  ┌─────────────┐                                                           │
│  │   PENDAKI   │                                                           │
│  └─────────────┘                                                           │
│       │                                                                     │
│       ├─── Daftar Pendakian                                               │
│       ├─── Lihat Informasi Gunung                                         │
│       ├─── Lihat Jadwal Pendakian                                         │
│       ├─── Update Status Pendakian                                        │
│       └─── Lihat Status Pendaftaran                                       │
│                                                                             │
│  ┌─────────────┐                                                           │
│  │    GUEST    │                                                           │
│  └─────────────┘                                                           │
│       │                                                                     │
│       ├─── Lihat Informasi Gunung                                         │
│       ├─── Lihat Jadwal Pendakian                                         │
│       └─── Kontak                                                          │
│                                                                             │
└─────────────────────────────────────────────────────────────────────────────┘
```

## 2. CLASS DIAGRAM (DETAIL)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                                    SISTEM                                  │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─────────────────────────────────────────────────────────────────────────┐ │
│  │                              ADMIN                                     │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ - id_admin: int                                                        │ │
│  │ - username: string                                                     │ │
│  │ - password: string                                                     │ │
│  │ - nama: string                                                         │ │
│  │ - email: string                                                        │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ + login(username, password): boolean                                   │ │
│  │ + logout(): void                                                       │ │
│  │ + tambahGunung(data): boolean                                          │ │
│  │ + editGunung(id, data): boolean                                        │ │
│  │ + hapusGunung(id): boolean                                             │ │
│  │ + tambahJadwal(data): boolean                                          │ │
│  │ + editJadwal(id, data): boolean                                        │ │
│  │ + hapusJadwal(id): boolean                                             │ │
│  │ + lihatPendaki(): array                                                │ │
│  │ + editPendaki(id, data): boolean                                       │ │
│  │ + hapusPendaki(id): boolean                                            │ │
│  └─────────────────────────────────────────────────────────────────────────┘ │
│                                    │                                       │
│                                    │ 1                                     │
│                                    ▼                                       │
│  ┌─────────────────────────────────────────────────────────────────────────┐ │
│  │                              GUNUNG                                    │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ - id_gunung: int                                                       │ │
│  │ - nama_gunung: string                                                  │ │
│  │ - lokasi: string                                                       │ │
│  │ - ketinggian: string                                                   │ │
│  │ - deskripsi: text                                                      │ │
│  │ - gambar: string                                                       │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ + getInfo(): array                                                     │ │
│  │ + updateInfo(data): boolean                                            │ │
│  │ + deleteInfo(): boolean                                                │ │
│  └─────────────────────────────────────────────────────────────────────────┘ │
│                                    │                                       │
│                                    │ 1                                     │
│                                    ▼                                       │
│  ┌─────────────────────────────────────────────────────────────────────────┐ │
│  │                              JADWAL                                    │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ - id_jadwal: int                                                       │ │
│  │ - id_gunung: int                                                       │ │
│  │ - tanggal: date                                                        │ │
│  │ - kuota: int                                                           │ │
│  │ - status: enum                                                         │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ + getJadwal(): array                                                   │ │
│  │ + tambahJadwal(data): boolean                                          │ │
│  │ + editJadwal(id, data): boolean                                        │ │
│  │ + hapusJadwal(id): boolean                                             │ │
│  │ + cekKuota(): int                                                      │ │
│  └─────────────────────────────────────────────────────────────────────────┘ │
│                                    │                                       │
│                                    │ 1                                     │
│                                    ▼                                       │
│  ┌─────────────────────────────────────────────────────────────────────────┐ │
│  │                              PENDAKI                                   │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ - id_pendaki: int                                                      │ │
│  │ - nama: string                                                         │ │
│  │ - email: string                                                        │ │
│  │ - no_hp: string                                                        │ │
│  │ - alamat: text                                                         │ │
│  │ - identitas: string                                                    │ │
│  │ - status: enum                                                         │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │ + daftar(data): boolean                                                │ │
│  │ + updateStatus(status): boolean                                        │ │
│  │ + lihatJadwal(): array                                                 │ │
│  │ + getInfo(): array                                                     │ │
│  └─────────────────────────────────────────────────────────────────────────┘ │
│                                                                             │
└─────────────────────────────────────────────────────────────────────────────┘
```

## 3. ACTIVITY DIAGRAM - PROSES PENDAFTARAN

```
[MULAI] ──→ [Buka Website] ──→ [Pilih Menu Pendaftaran] ──→ [Isi Form Data]
    │
    ▼
[Upload Identitas] ──→ [Validasi Data] ──→ [Data Valid?]
    │                                    │
    │                                    ▼
    │                                ┌───┴───┐
    │                                │  YA   │  TIDAK
    │                                ▼       ▼
    │                            [Simpan] [Tampilkan Error]
    │                            [Data]   [Message]
    │                                │       │
    │                                ▼       ▼
    │                            [Sukses] [Kembali ke Form]
    │                            [Daftar]   │
    │                                │       │
    │                                ▼       ▼
    └─────────────────────────────── [SELESAI] ←────────────┘
```

## 4. ACTIVITY DIAGRAM - PROSES LOGIN ADMIN

```
[MULAI] ──→ [Buka Halaman Login] ──→ [Input Username & Password] ──→ [Validasi Kredensial]
    │
    ▼
[Kredensial Valid?] ──→ ┌───┴───┐
    │                   │  YA   │  TIDAK
    │                   ▼       ▼
    │               [Redirect] [Tampilkan Error]
    │               [Dashboard] [Message]
    │                   │       │
    │                   ▼       ▼
    │               [Akses Menu] [Kembali ke Form]
    │               [Admin]      [Login]
    │                   │       │
    │                   ▼       ▼
    └───────────────── [SELESAI] ←────────────┘
```

## 5. SEQUENCE DIAGRAM - PROSES PENDAFTARAN

```
┌─────────┐    ┌─────────┐    ┌─────────┐    ┌─────────┐
│ PENDaki │    │ WEBSITE │    │  PHP    │    │ DATABASE│
└─────────┘    └─────────┘    └─────────┘    └─────────┘
    │              │              │              │
    │─── Buka ────→│              │              │
    │   Website    │              │              │
    │              │              │              │
    │─── Pilih ───→│              │              │
    │  Pendaftaran │              │              │
    │              │              │              │
    │─── Isi ─────→│              │              │
    │   Form       │              │              │
    │              │              │              │
    │─── Upload ──→│              │              │
    │  Identitas   │              │              │
    │              │              │              │
    │─── Submit ──→│              │              │
    │              │              │              │
    │              │─── Proses ──→│              │
    │              │   Data       │              │
    │              │              │              │
    │              │              │─── Simpan ──→│
    │              │              │   Data       │
    │              │              │              │
    │              │              │←── Success ──│
    │              │              │              │
    │              │←── Response ─│              │
    │              │              │              │
    │←── Sukses ───│              │              │
    │   Daftar     │              │              │
```

## 6. SEQUENCE DIAGRAM - PROSES LOGIN ADMIN

```
┌─────────┐    ┌─────────┐    ┌─────────┐    ┌─────────┐
│  ADMIN  │    │ WEBSITE │    │  PHP    │    │ DATABASE│
└─────────┘    └─────────┘    └─────────┘    └─────────┘
    │              │              │              │
    │─── Buka ────→│              │              │
    │   Login      │              │              │
    │              │              │              │
    │─── Input ───→│              │              │
    │Credentials   │              │              │
    │              │              │              │
    │─── Submit ──→│              │              │
    │              │              │              │
    │              │─── Validasi ─→│              │
    │              │   Login      │              │
    │              │              │              │
    │              │              │─── Cek ─────→│
    │              │              │   User       │
    │              │              │              │
    │              │              │←── Data ─────│
    │              │              │   User       │
    │              │              │              │
    │              │←── Session ──│              │
    │              │   Created    │              │
    │              │              │              │
    │←── Redirect ─│              │              │
    │  Dashboard   │              │              │
```

## 7. STATE DIAGRAM - STATUS PENDAKI

```
┌─────────────┐
│  TERDAFTAR  │
└─────────────┘
       │
       ▼
┌─────────────┐
│ SEDANG      │
│ MENDAKI     │
└─────────────┘
       │
       ▼
┌─────────────┐
│   SELESAI   │
└─────────────┘
```

## 8. STATE DIAGRAM - STATUS JADWAL

```
┌─────────────┐
│  TERSEDIA   │
└─────────────┘
       │
       ▼
┌─────────────┐
│    PENUH    │
└─────────────┘
       │
       ▼
┌─────────────┐
│   SELESAI   │
└─────────────┘
```

## 9. COMPONENT DIAGRAM

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                        SISTEM JEJAK CAKRAWALA                              │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐         │
│  │   FRONTEND      │    │    BACKEND      │    │   DATABASE      │         │
│  │                 │    │                 │    │                 │         │
│  │ ┌─────────────┐ │    │ ┌─────────────┐ │    │ ┌─────────────┐ │         │
│  │ │    HTML     │ │    │ │     PHP     │ │    │ │    MySQL    │ │         │
│  │ └─────────────┘ │    │ └─────────────┘ │    │ └─────────────┘ │         │
│  │                 │    │                 │    │                 │         │
│  │ ┌─────────────┐ │    │ ┌─────────────┐ │    │ ┌─────────────┐ │         │
│  │ │     CSS     │ │    │ │  Session    │ │    │ │   Tables    │ │         │
│  │ └─────────────┘ │    │ │ Management  │ │    │ └─────────────┘ │         │
│  │                 │    │ └─────────────┘ │    │                 │         │
│  │ ┌─────────────┐ │    │ ┌─────────────┐ │    │ ┌─────────────┐ │         │
│  │ │ JavaScript  │ │    │ │ File Upload │ │    │ │   Queries   │ │         │
│  │ └─────────────┘ │    │ └─────────────┘ │    │ └─────────────┘ │         │
│  └─────────────────┘    └─────────────────┘    └─────────────────┘         │
│           │                       │                       │                 │
│           └───────────────────────┼───────────────────────┘                 │
│                                   │                                         │
│  ┌─────────────────────────────────┼─────────────────────────────────────────┐ │
│  │                    WEB SERVER (Apache/XAMPP)                            │ │
│  └─────────────────────────────────┴─────────────────────────────────────────┘ │
│                                                                             │
└─────────────────────────────────────────────────────────────────────────────┘
```

## 10. DEPLOYMENT DIAGRAM

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                              CLIENT DEVICE                                 │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐         │
│  │   WEB BROWSER   │    │   MOBILE APP    │    │   TABLET APP    │         │
│  │                 │    │                 │    │                 │         │
│  │ - Chrome        │    │ - Android       │    │ - iPad          │         │
│  │ - Firefox       │    │ - iOS           │    │ - Android Tab   │         │
│  │ - Safari        │    │ - Web View      │    │ - Web Browser   │         │
│  │ - Edge          │    │                 │    │                 │         │
│  └─────────────────┘    └─────────────────┘    └─────────────────┘         │
│           │                       │                       │                 │
│           └───────────────────────┼───────────────────────┘                 │
│                                   │                                         │
│                                   ▼                                         │
│  ┌─────────────────────────────────────────────────────────────────────────┐ │
│  │                              INTERNET                                   │ │
│  └─────────────────────────────────────────────────────────────────────────┘ │
│                                   │                                         │
│                                   ▼                                         │
│  ┌─────────────────────────────────────────────────────────────────────────┐ │
│  │                              SERVER                                    │ │
│  ├─────────────────────────────────────────────────────────────────────────┤ │
│  │                                                                         │ │
│  │  ┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐     │ │
│  │  │   WEB SERVER    │    │  APPLICATION    │    │   DATABASE      │     │ │
│  │  │                 │    │    SERVER       │    │    SERVER       │     │ │
│  │  │ - Apache        │    │ - PHP Engine    │    │ - MySQL         │     │ │
│  │  │ - XAMPP         │    │ - File System   │    │ - Data Storage  │     │ │
│  │  │ - SSL/TLS       │    │ - Upload Dir    │    │ - Backup        │     │ │
│  │  └─────────────────┘    └─────────────────┘    └─────────────────┘     │ │
│  │                                                                         │ │
│  └─────────────────────────────────────────────────────────────────────────┘ │
│                                                                             │
└─────────────────────────────────────────────────────────────────────────────┘
```

## CATATAN PENTING:

1. **Use Case Diagram** menunjukkan interaksi antara aktor dan sistem
2. **Class Diagram** menunjukkan struktur kelas dan relasi antar entitas
3. **Activity Diagram** menunjukkan alur proses bisnis
4. **Sequence Diagram** menunjukkan interaksi antar objek dalam waktu
5. **State Diagram** menunjukkan perubahan status entitas
6. **Component Diagram** menunjukkan arsitektur sistem
7. **Deployment Diagram** menunjukkan deployment sistem

## PENGGUNAAN DIAGRAM:

- **Presentasi:** Gunakan diagram yang relevan sesuai topik
- **Dokumentasi:** Simpan sebagai referensi pengembangan
- **Maintenance:** Gunakan untuk memahami sistem
- **Training:** Gunakan untuk melatih pengguna baru 