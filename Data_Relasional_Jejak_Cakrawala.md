# DATA RELASIONAL SISTEM JEJAK CAKRAWALA

## 1. STRUKTUR DATABASE

### Tabel: admin
```sql
CREATE TABLE admin (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel: gunung
```sql
CREATE TABLE gunung (
    id_gunung INT PRIMARY KEY AUTO_INCREMENT,
    nama_gunung VARCHAR(100) NOT NULL,
    lokasi VARCHAR(200) NOT NULL,
    ketinggian VARCHAR(50) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    status ENUM('Aktif', 'Tidak Aktif') DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel: jadwal
```sql
CREATE TABLE jadwal (
    id_jadwal INT PRIMARY KEY AUTO_INCREMENT,
    id_gunung INT NOT NULL,
    tanggal DATE NOT NULL,
    kuota INT NOT NULL,
    kuota_terisi INT DEFAULT 0,
    status ENUM('Tersedia', 'Penuh', 'Selesai', 'Dibatalkan') DEFAULT 'Tersedia',
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_gunung) REFERENCES gunung(id_gunung) ON DELETE CASCADE
);
```

### Tabel: pendaki
```sql
CREATE TABLE pendaki (
    id_pendaki INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    identitas VARCHAR(255) NOT NULL,
    status ENUM('Terdaftar', 'Sedang Mendaki', 'Selesai', 'Dibatalkan') DEFAULT 'Terdaftar',
    id_jadwal INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_jadwal) REFERENCES jadwal(id_jadwal) ON DELETE SET NULL
);
```

### Tabel: pendaftaran
```sql
CREATE TABLE pendaftaran (
    id_pendaftaran INT PRIMARY KEY AUTO_INCREMENT,
    id_pendaki INT NOT NULL,
    id_jadwal INT NOT NULL,
    tanggal_daftar DATE NOT NULL,
    status_pendaftaran ENUM('Menunggu', 'Diterima', 'Ditolak', 'Dibatalkan') DEFAULT 'Menunggu',
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pendaki) REFERENCES pendaki(id_pendaki) ON DELETE CASCADE,
    FOREIGN KEY (id_jadwal) REFERENCES jadwal(id_jadwal) ON DELETE CASCADE
);
```

## 2. ENTITY RELATIONSHIP DIAGRAM (ERD)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                              ERD SISTEM JEJAK CAKRAWALA                    │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─────────────┐                                                           │
│  │    ADMIN    │                                                           │
│  ├─────────────┤                                                           │
│  │ id_admin    │◄─────────────────────────────────────────────────────────┐ │
│  │ username    │                                                           │ │
│  │ password    │                                                           │ │
│  │ nama        │                                                           │ │
│  │ email       │                                                           │ │
│  │ created_at  │                                                           │ │
│  │ updated_at  │                                                           │ │
│  └─────────────┘                                                           │ │
│                                                                             │ │
│  ┌─────────────┐                                                           │ │
│  │   GUNUNG    │                                                           │ │
│  ├─────────────┤                                                           │ │
│  │ id_gunung   │◄────────┐                                                 │ │
│  │ nama_gunung │         │                                                 │ │
│  │ lokasi      │         │                                                 │ │
│  │ ketinggian  │         │                                                 │ │
│  │ deskripsi   │         │                                                 │ │
│  │ gambar      │         │                                                 │ │
│  │ status      │         │                                                 │ │
│  │ created_at  │         │                                                 │ │
│  │ updated_at  │         │                                                 │ │
│  └─────────────┘         │                                                 │ │
│                          │                                                 │ │
│  ┌─────────────┐         │                                                 │ │
│  │   JADWAL    │         │                                                 │ │
│  ├─────────────┤         │                                                 │ │
│  │ id_jadwal   │◄────────┼────────┐                                        │ │
│  │ id_gunung   │         │        │                                        │ │
│  │ tanggal     │         │        │                                        │ │
│  │ kuota       │         │        │                                        │ │
│  │ kuota_terisi│         │        │                                        │ │
│  │ status      │         │        │                                        │ │
│  │ keterangan  │         │        │                                        │ │
│  │ created_at  │         │        │                                        │ │
│  │ updated_at  │         │        │                                        │ │
│  └─────────────┘         │        │                                        │ │
│                          │        │                                        │ │
│  ┌─────────────┐         │        │                                        │ │
│  │   PENDAKI   │         │        │                                        │ │
│  ├─────────────┤         │        │                                        │ │
│  │ id_pendaki  │◄────────┼────────┼────────┐                               │ │
│  │ nama        │         │        │        │                               │ │
│  │ email       │         │        │        │                               │ │
│  │ no_hp       │         │        │        │                               │ │
│  │ alamat      │         │        │        │                               │ │
│  │ identitas   │         │        │        │                               │ │
│  │ status      │         │        │        │                               │ │
│  │ id_jadwal   │─────────┘        │        │                               │ │
│  │ created_at  │                  │        │                               │ │
│  │ updated_at  │                  │        │                               │ │
│  └─────────────┘                  │        │                               │ │
│                                   │        │                               │ │
│  ┌─────────────┐                  │        │                               │ │
│  │ PENDAFTARAN │                  │        │                               │ │
│  ├─────────────┤                  │        │                               │ │
│  │id_pendaftaran│                  │        │                               │ │
│  │ id_pendaki  │──────────────────┘        │                               │ │
│  │ id_jadwal   │───────────────────────────┘                               │ │
│  │tanggal_daftar│                                                           │ │
│  │status_pendaft│                                                           │ │
│  │ keterangan   │                                                           │ │
│  │ created_at   │                                                           │ │
│  │ updated_at   │                                                           │ │
│  └─────────────┘                                                           │ │
│                                                                             │ │
└─────────────────────────────────────────────────────────────────────────────┘ │
                                                                               │
└─────────────────────────────────────────────────────────────────────────────┘
```

## 3. NORMALISASI DATABASE

### Normalisasi ke 1NF (First Normal Form)
- Setiap atribut hanya memiliki satu nilai
- Tidak ada pengulangan grup data
- Setiap baris memiliki primary key yang unik

**Contoh Normalisasi 1NF:**
```
Tabel Pendaki (Sudah 1NF):
- id_pendaki (Primary Key)
- nama
- email
- no_hp
- alamat
- identitas
- status
- id_jadwal
- created_at
- updated_at
```

### Normalisasi ke 2NF (Second Normal Form)
- Sudah dalam 1NF
- Semua atribut non-key bergantung sepenuhnya pada primary key

**Contoh Normalisasi 2NF:**
```
Tabel Pendaki (Sudah 2NF):
- Semua atribut bergantung pada id_pendaki
- id_jadwal adalah foreign key yang valid
```

### Normalisasi ke 3NF (Third Normal Form)
- Sudah dalam 2NF
- Tidak ada dependensi transitif

**Contoh Normalisasi 3NF:**
```
Tabel Pendaki (Sudah 3NF):
- Tidak ada dependensi transitif
- Semua relasi sudah normal
```

## 4. QUERY CONTOH

### Query untuk Menampilkan Data Pendaki dengan Jadwal
```sql
SELECT 
    p.id_pendaki,
    p.nama,
    p.email,
    p.no_hp,
    p.status as status_pendaki,
    g.nama_gunung,
    j.tanggal,
    j.kuota,
    j.kuota_terisi,
    j.status as status_jadwal
FROM pendaki p
LEFT JOIN jadwal j ON p.id_jadwal = j.id_jadwal
LEFT JOIN gunung g ON j.id_gunung = g.id_gunung
ORDER BY p.created_at DESC;
```

### Query untuk Menampilkan Jadwal dengan Informasi Gunung
```sql
SELECT 
    j.id_jadwal,
    g.nama_gunung,
    g.lokasi,
    g.ketinggian,
    j.tanggal,
    j.kuota,
    j.kuota_terisi,
    (j.kuota - j.kuota_terisi) as sisa_kuota,
    j.status,
    j.keterangan
FROM jadwal j
JOIN gunung g ON j.id_gunung = g.id_gunung
WHERE j.status = 'Tersedia'
ORDER BY j.tanggal ASC;
```

### Query untuk Menampilkan Laporan Pendaftaran
```sql
SELECT 
    pd.id_pendaftaran,
    p.nama as nama_pendaki,
    p.email,
    g.nama_gunung,
    j.tanggal,
    pd.tanggal_daftar,
    pd.status_pendaftaran,
    pd.keterangan
FROM pendaftaran pd
JOIN pendaki p ON pd.id_pendaki = p.id_pendaki
JOIN jadwal j ON pd.id_jadwal = j.id_jadwal
JOIN gunung g ON j.id_gunung = g.id_gunung
ORDER BY pd.tanggal_daftar DESC;
```

### Query untuk Update Status Pendaki
```sql
UPDATE pendaki 
SET status = 'Sedang Mendaki', 
    updated_at = CURRENT_TIMESTAMP 
WHERE id_pendaki = ?;
```

### Query untuk Update Kuota Jadwal
```sql
UPDATE jadwal 
SET kuota_terisi = kuota_terisi + 1,
    status = CASE 
        WHEN (kuota_terisi + 1) >= kuota THEN 'Penuh'
        ELSE status 
    END,
    updated_at = CURRENT_TIMESTAMP 
WHERE id_jadwal = ?;
```

## 5. INDEX OPTIMIZATION

### Index untuk Performance
```sql
-- Index untuk tabel admin
CREATE INDEX idx_admin_username ON admin(username);
CREATE INDEX idx_admin_email ON admin(email);

-- Index untuk tabel gunung
CREATE INDEX idx_gunung_nama ON gunung(nama_gunung);
CREATE INDEX idx_gunung_status ON gunung(status);

-- Index untuk tabel jadwal
CREATE INDEX idx_jadwal_gunung ON jadwal(id_gunung);
CREATE INDEX idx_jadwal_tanggal ON jadwal(tanggal);
CREATE INDEX idx_jadwal_status ON jadwal(status);

-- Index untuk tabel pendaki
CREATE INDEX idx_pendaki_email ON pendaki(email);
CREATE INDEX idx_pendaki_status ON pendaki(status);
CREATE INDEX idx_pendaki_jadwal ON pendaki(id_jadwal);

-- Index untuk tabel pendaftaran
CREATE INDEX idx_pendaftaran_pendaki ON pendaftaran(id_pendaki);
CREATE INDEX idx_pendaftaran_jadwal ON pendaftaran(id_jadwal);
CREATE INDEX idx_pendaftaran_status ON pendaftaran(status_pendaftaran);
```

## 6. CONSTRAINTS DAN VALIDATION

### Constraints Database
```sql
-- Foreign Key Constraints
ALTER TABLE jadwal 
ADD CONSTRAINT fk_jadwal_gunung 
FOREIGN KEY (id_gunung) REFERENCES gunung(id_gunung) ON DELETE CASCADE;

ALTER TABLE pendaki 
ADD CONSTRAINT fk_pendaki_jadwal 
FOREIGN KEY (id_jadwal) REFERENCES jadwal(id_jadwal) ON DELETE SET NULL;

ALTER TABLE pendaftaran 
ADD CONSTRAINT fk_pendaftaran_pendaki 
FOREIGN KEY (id_pendaki) REFERENCES pendaki(id_pendaki) ON DELETE CASCADE;

ALTER TABLE pendaftaran 
ADD CONSTRAINT fk_pendaftaran_jadwal 
FOREIGN KEY (id_jadwal) REFERENCES jadwal(id_jadwal) ON DELETE CASCADE;

-- Check Constraints
ALTER TABLE jadwal 
ADD CONSTRAINT chk_jadwal_kuota 
CHECK (kuota > 0 AND kuota_terisi >= 0);

ALTER TABLE jadwal 
ADD CONSTRAINT chk_jadwal_tanggal 
CHECK (tanggal >= CURDATE());

-- Unique Constraints
ALTER TABLE admin 
ADD CONSTRAINT uk_admin_username 
UNIQUE (username);

ALTER TABLE admin 
ADD CONSTRAINT uk_admin_email 
UNIQUE (email);

ALTER TABLE pendaki 
ADD CONSTRAINT uk_pendaki_email 
UNIQUE (email);
```

## 7. BACKUP DAN RECOVERY

### Script Backup Database
```sql
-- Backup seluruh database
mysqldump -u username -p cakrawala > backup_cakrawala.sql

-- Backup tabel tertentu
mysqldump -u username -p cakrawala admin gunung jadwal pendaki pendaftaran > backup_tables.sql

-- Restore database
mysql -u username -p cakrawala < backup_cakrawala.sql
```

## 8. MAINTENANCE DATABASE

### Script Maintenance
```sql
-- Optimize tabel
OPTIMIZE TABLE admin, gunung, jadwal, pendaki, pendaftaran;

-- Analyze tabel
ANALYZE TABLE admin, gunung, jadwal, pendaki, pendaftaran;

-- Check tabel
CHECK TABLE admin, gunung, jadwal, pendaki, pendaftaran;

-- Repair tabel (jika diperlukan)
REPAIR TABLE admin, gunung, jadwal, pendaki, pendaftaran;
```

## CATATAN PENTING:

1. **Relasi Antar Tabel:**
   - Admin: Independent (tidak bergantung tabel lain)
   - Gunung: Independent (tidak bergantung tabel lain)
   - Jadwal: Bergantung pada Gunung (1:N)
   - Pendaki: Bergantung pada Jadwal (N:1)
   - Pendaftaran: Bergantung pada Pendaki dan Jadwal (N:1)

2. **Integrity Constraints:**
   - Foreign Key untuk menjaga referential integrity
   - Check constraints untuk validasi data
   - Unique constraints untuk mencegah duplikasi

3. **Performance Optimization:**
   - Index pada kolom yang sering digunakan untuk query
   - Composite index untuk query yang kompleks
   - Regular maintenance untuk optimal performance

4. **Security:**
   - Password hashing untuk admin
   - Input validation untuk mencegah SQL injection
   - File upload validation untuk keamanan 