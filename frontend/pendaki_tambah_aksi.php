<?php
ob_start();
include '../config/koneksi.php';

// Validasi input
$required = ['nama_lengkap', 'email', 'no_telepon', 'alamat', 'id_jadwal', 'jumlah_orang'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        header("Location: pendaki_tambah.php?error=required");
        exit;
    }
}

// Validasi file upload
if (empty($_FILES['identitas']['name'])) {
    header("Location: pendaki_tambah.php?error=no_file");
    exit;
}

// Ambil data
$nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
$email = $conn->real_escape_string($_POST['email']);
$no_telepon = $conn->real_escape_string($_POST['no_telepon']);
$alamat = $conn->real_escape_string($_POST['alamat']);
$id_jadwal = (int)$_POST['id_jadwal'];
$jumlah_orang = (int)$_POST['jumlah_orang'];
$catatan = isset($_POST['catatan']) ? $conn->real_escape_string($_POST['catatan']) : null;

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: pendaki_tambah.php?error=email");
    exit;
}

// Handle file upload
$upload_dir = '../uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$file_name = $_FILES['identitas']['name'];
$file_tmp = $_FILES['identitas']['tmp_name'];
$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
$new_file_name = 'identitas_' . time() . '_' . uniqid() . '.' . $file_ext;
$target_path = $upload_dir . $new_file_name;

// Validasi file
$allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];
$max_size = 2 * 1024 * 1024; // 2MB

if (!in_array($file_ext, $allowed_ext)) {
    header("Location: pendaki_tambah.php?error=invalid_file_type");
    exit;
}

if ($_FILES['identitas']['size'] > $max_size) {
    header("Location: pendaki_tambah.php?error=file_too_large");
    exit;
}

if (!move_uploaded_file($file_tmp, $target_path)) {
    header("Location: pendaki_tambah.php?error=upload_failed");
    exit;
}

// Check ketersediaan jadwal dan kuota
$check_query = "SELECT j.kuota, 
                (SELECT IFNULL(SUM(p.jumlah_orang), 0) 
                 FROM pendaftar_pendakian p 
                 WHERE p.id_jadwal = j.id) as terdaftar,
                j.status
                FROM jadwal_pendakian j
                WHERE j.id = ?";
$check = $conn->prepare($check_query);
$check->bind_param("i", $id_jadwal);
$check->execute();
$result = $check->get_result();

if ($result->num_rows === 0) {
    // Hapus file yang sudah diupload jika jadwal tidak ditemukan
    unlink($target_path);
    header("Location: pendaki_tambah.php?error=schedule_not_found");
    exit;
}

$row = $result->fetch_assoc();
$kuota = $row['kuota'];
$terdaftar = $row['terdaftar'];
$status_jadwal = $row['status'];
$tersedia = $kuota - $terdaftar;

// Validasi status jadwal
if ($status_jadwal !== 'buka') {
    unlink($target_path);
    header("Location: pendaki_tambah.php?error=schedule_closed");
    exit;
}

// Validasi jumlah orang
if ($jumlah_orang <= 0) {
    unlink($target_path);
    header("Location: pendaki_tambah.php?error=invalid_person_count");
    exit;
}

// Validasi kuota
if ($jumlah_orang > $tersedia) {
    unlink($target_path);
    header("Location: pendaki_tambah.php?error=quota_exceeded");
    exit;
}

// Mulai transaksi
$conn->begin_transaction();

try {

// Simpan data ke database
    $insert_query = "INSERT INTO pendaftar_pendakian 
                    (id_jadwal, nama_lengkap, email, no_telepon, alamat, jumlah_orang, catatan, identitas, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insert_query);

    $status = 'pending';

    $stmt->bind_param(
        "issssisss",
        $id_jadwal,
        $nama_lengkap,
        $email,
        $no_telepon,
        $alamat,
        $jumlah_orang,
        $catatan,
        $new_file_name,
        $status
    );


    if (!$stmt->execute()) {
        throw new Exception("Gagal menyimpan data pendaki: " . $stmt->error);
    }

    // Update status jadwal jika kuota penuh
    $new_terdaftar = $terdaftar + $jumlah_orang;
    if ($new_terdaftar >= $kuota) {
        $update_query = "UPDATE jadwal_pendakian SET status = 'penuh' WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $id_jadwal);
        
        if (!$update_stmt->execute()) {
            throw new Exception("Gagal update status jadwal");
        }
        $update_stmt->close();
    }

    $conn->commit();
    header("Location: jadwal.php?success=Pendaki+berhasil+didaftarkan");
    exit;
} catch (Exception $e) {
    $conn->rollback();
    // Hapus file yang sudah diupload jika terjadi error
    if (file_exists($target_path)) {
        unlink($target_path);
    }
    error_log("Error: " . $e->getMessage());
    header("Location: pendaki_tambah.php?error=database_error");
    exit;
} finally {
    $stmt->close();
    $conn->close();
    ob_end_flush();
}
?>