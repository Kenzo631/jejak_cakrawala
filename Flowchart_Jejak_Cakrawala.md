# FLOWCHART SISTEM JEJAK CAKRAWALA

## 1. FLOWCHART UTAMA SISTEM

```
[MULAI]
    │
    ▼
┌─────────────┐
│ Buka Website│
│ Jejak       │
│ Cakrawala   │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Pilih Menu  │
│ Utama       │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Menu yang   │
│ Dipilih?    │
└─────────────┘
    │
┌───┴───┬───┬───┐
│       │   │   │
▼       ▼   ▼   ▼
┌─────┐ ┌─┐ ┌─┐ ┌─┐
│ADMIN│ │ │ │ │ │ │
└─────┘ │ │ │ │ │ │
        ▼ ▼ ▼ ▼ ▼ ▼
    ┌─┐ ┌─┐ ┌─┐ ┌─┐
    │ │ │ │ │ │ │ │
    └─┘ └─┘ └─┘ └─┘
    │
    ▼
[SELESAI]
```

## 2. FLOWCHART PENDAFTARAN PENDAKI

```
[MULAI]
    │
    ▼
┌─────────────┐
│ Buka Website│
│ Jejak       │
│ Cakrawala   │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Klik Menu   │
│ Pendaftaran │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Form        │
│ Pendaftaran │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Isi Data    │
│ Pendaki     │
│ - Nama      │
│ - Email     │
│ - No HP     │
│ - Alamat    │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Upload      │
│ Identitas   │
│ (KTP/SIM)   │
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
│ Data ke │ │ Error    │
│ Database│ │ Message  │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Tampilkan│ │ Kembali │
│ Sukses  │ │ ke Form │
│ Message │ │ Login   │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
    [SELESAI]
```

## 3. FLOWCHART LOGIN ADMIN

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
│ Username    │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Input       │
│ Password    │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Klik Tombol │
│ Login       │
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
│ Buat    │ │ Tampilkan│
│ Session │ │ Error    │
│ Admin   │ │ Message  │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Redirect│ │ Kembali │
│ ke      │ │ ke Form │
│ Dashboard│ │ Login   │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Akses   │ │ Input   │
│ Menu    │ │ Ulang   │
│ Admin   │ │ Data    │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
    [SELESAI]
```

## 4. FLOWCHART TAMBAH DATA GUNUNG

```
[MULAI]
    │
    ▼
┌─────────────┐
│ Login Admin │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Akses Menu  │
│ Kelola      │
│ Gunung      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Klik        │
│ Tambah      │
│ Gunung      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Form        │
│ Tambah      │
│ Gunung      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Isi Data    │
│ Gunung      │
│ - Nama      │
│ - Lokasi    │
│ - Ketinggian│
│ - Deskripsi │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Upload      │
│ Gambar      │
│ Gunung      │
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
│ Data ke │ │ Error    │
│ Database│ │ Message  │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Tampilkan│ │ Kembali │
│ Sukses  │ │ ke Form │
│ Message │ │         │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Redirect│ │ Input   │
│ ke      │ │ Ulang   │
│ List    │ │ Data    │
│ Gunung  │ │         │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
    [SELESAI]
```

## 5. FLOWCHART TAMBAH JADWAL PENDAKIAN

```
[MULAI]
    │
    ▼
┌─────────────┐
│ Login Admin │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Akses Menu  │
│ Kelola      │
│ Jadwal      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Klik        │
│ Tambah      │
│ Jadwal      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Form        │
│ Tambah      │
│ Jadwal      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Pilih       │
│ Gunung      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Input Data  │
│ Jadwal      │
│ - Tanggal   │
│ - Kuota     │
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
│ Data ke │ │ Error    │
│ Database│ │ Message  │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Tampilkan│ │ Kembali │
│ Sukses  │ │ ke Form │
│ Message │ │         │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Redirect│ │ Input   │
│ ke      │ │ Ulang   │
│ List    │ │ Data    │
│ Jadwal  │ │         │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
    [SELESAI]
```

## 6. FLOWCHART UPDATE STATUS PENDAKI

```
[MULAI]
    │
    ▼
┌─────────────┐
│ Login Admin │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Akses Menu  │
│ Kelola      │
│ Pendaki     │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Lihat       │
│ Daftar      │
│ Pendaki     │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Pilih       │
│ Pendaki     │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Klik        │
│ Update      │
│ Status      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Pilih       │
│ Status      │
│ Baru        │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Konfirmasi  │
│ Update      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Update      │
│ Database    │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Tampilkan   │
│ Sukses      │
│ Message     │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Redirect    │
│ ke List     │
│ Pendaki     │
└─────────────┘
    │
    ▼
    [SELESAI]
```

## 7. FLOWCHART LOGOUT ADMIN

```
[MULAI]
    │
    ▼
┌─────────────┐
│ Admin       │
│ Login       │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Akses       │
│ Dashboard   │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Klik        │
│ Logout      │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Hapus       │
│ Session     │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Redirect    │
│ ke Halaman  │
│ Login       │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Tampilkan   │
│ Message     │
│ Logout      │
│ Berhasil    │
└─────────────┘
    │
    ▼
    [SELESAI]
```

## 8. FLOWCHART PENCARIAN DATA

```
[MULAI]
    │
    ▼
┌─────────────┐
│ Buka        │
│ Halaman     │
│ Pencarian   │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Input       │
│ Keyword     │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Pilih       │
│ Kategori    │
│ Pencarian   │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Klik        │
│ Cari        │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Query       │
│ Database    │
└─────────────┘
    │
    ▼
┌─────────────┐
│ Data        │
│ Ditemukan?  │
└─────────────┘
    │
┌───┴───┐
│  YA   │  TIDAK
▼       ▼
┌─────────┐ ┌─────────┐
│ Tampilkan│ │ Tampilkan│
│ Hasil   │ │ Message │
│ Pencarian│ │ Tidak   │
│         │ │ Ditemukan│
└─────────┘ └─────────┘
    │           │
    ▼           ▼
┌─────────┐ ┌─────────┐
│ Pilih   │ │ Kembali │
│ Data    │ │ ke Form │
│ untuk   │ │ Pencarian│
│ Detail  │ │         │
└─────────┘ └─────────┘
    │           │
    ▼           ▼
    [SELESAI]
```

## CATATAN PENTING:

1. **Simbol Flowchart:**
   - Oval: Start/End
   - Rectangle: Process
   - Diamond: Decision
   - Parallelogram: Input/Output

2. **Penggunaan:**
   - Dokumentasi sistem
   - Training pengguna
   - Troubleshooting
   - Pengembangan fitur baru

3. **Tips Membuat Flowchart:**
   - Gunakan simbol yang konsisten
   - Alur harus jelas dan logis
   - Tambahkan komentar jika perlu
   - Test alur dengan data nyata 