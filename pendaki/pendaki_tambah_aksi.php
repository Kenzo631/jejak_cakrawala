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

// Ambil data dan escape
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

// Mulai transaksi agar aman
$conn->begin_transaction();

try {
    // Cek kuota tersisa langsung dari kolom kuota (bukan hitung terdaftar)
    $stmt = $conn->prepare("SELECT kuota, status FROM jadwal_pendakian WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $stmt->bind_result($kuota, $status_jadwal);
    if (!$stmt->fetch()) {
        throw new Exception("schedule_not_found");
    }
    $stmt->close();

    // Validasi status jadwal
    if ($status_jadwal !== 'buka') {
        throw new Exception("schedule_closed");
    }

    // Validasi jumlah orang dan kuota
    if ($jumlah_orang <= 0) {
        throw new Exception("invalid_person_count");
    }
    if ($jumlah_orang > $kuota) {
        throw new Exception("quota_exceeded");
    }

    // Upload file identitas
    if (!move_uploaded_file($file_tmp, $target_path)) {
        throw new Exception("upload_failed");
    }

    // Simpan data pendaftar
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
        throw new Exception("database_error");
    }
    $stmt->close();

    // Kurangi kuota di jadwal_pendakian
    $update_query = "UPDATE jadwal_pendakian SET kuota = kuota - ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ii", $jumlah_orang, $id_jadwal);

    if (!$stmt->execute()) {
        throw new Exception("database_error");
    }
    $stmt->close();

    // Jika kuota sudah habis setelah update, set status jadi penuh
    $stmt = $conn->prepare("SELECT kuota FROM jadwal_pendakian WHERE id = ?");
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $stmt->bind_result($sisa_kuota);
    $stmt->fetch();
    $stmt->close();

    if ($sisa_kuota <= 0) {
        $stmt = $conn->prepare("UPDATE jadwal_pendakian SET status = 'penuh' WHERE id = ?");
        $stmt->bind_param("i", $id_jadwal);
        $stmt->execute();
        $stmt->close();
    }

    $conn->commit();

    header("Location: index.php?success=Pendaki+berhasil+didaftarkan");
    exit;
} catch (Exception $e) {
    $conn->rollback();

    // Hapus file yang sudah diupload jika terjadi error
    if (file_exists($target_path)) {
        unlink($target_path);
    }

    $error = $e->getMessage();
    header("Location: pendaki_tambah.php?error=" . $error);
    exit;
} finally {
    $conn->close();
    ob_end_flush();
}
