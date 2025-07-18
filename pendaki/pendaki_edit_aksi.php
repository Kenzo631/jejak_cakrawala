<?php
ob_start();
session_start();
require '../config/koneksi.php';

// Fungsi untuk redirect dengan pesan error
function redirectWithError($id, $message) {
    header("Location: pendaki_edit.php?id=$id&error=" . urlencode($message));
    exit;
}

// Validasi ID
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    redirectWithError('', 'ID tidak valid');
}

$id = (int)$_POST['id'];

// Daftar field required
$required = [
    'nama_lengkap' => 'Nama Lengkap',
    'email' => 'Email',
    'no_telepon' => 'Nomor Telepon',
    'alamat' => 'Alamat',
    'id_jadwal' => 'Jadwal Pendakian',
    'jumlah_orang' => 'Jumlah Orang'
];

// Validasi field required
foreach ($required as $field => $label) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        redirectWithError($id, "$label harus diisi");
    }
}

// Sanitasi input
$nama_lengkap = trim($conn->real_escape_string($_POST['nama_lengkap']));
$email = trim($conn->real_escape_string($_POST['email']));
$no_telepon = trim($conn->real_escape_string($_POST['no_telepon']));
$alamat = trim($conn->real_escape_string($_POST['alamat']));
$id_jadwal = (int)$_POST['id_jadwal'];
$jumlah_orang = (int)$_POST['jumlah_orang'];
$status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : 'pending';
$catatan = isset($_POST['catatan']) ? trim($conn->real_escape_string($_POST['catatan'])) : null;

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithError($id, 'Format email tidak valid');
}

// Validasi nomor telepon
if (!preg_match('/^[0-9]{10,13}$/', $no_telepon)) {
    redirectWithError($id, 'Nomor telepon harus 10-13 digit angka');
}

// Validasi jumlah orang
if ($jumlah_orang <= 0) {
    redirectWithError($id, 'Jumlah orang harus lebih dari 0');
}

// Check kuota tersedia dengan prepared statement
try {
    $check_query = "SELECT j.kuota, 
                    (SELECT COALESCE(SUM(jumlah_orang), 0) 
                     FROM pendaftar_pendakian 
                     WHERE id_jadwal = ? AND id != ?) as terdaftar
                    FROM jadwal_pendakian j
                    WHERE j.id = ?";

    $check = $conn->prepare($check_query);
    if (!$check) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $check->bind_param("iii", $id_jadwal, $id, $id_jadwal);
    if (!$check->execute()) {
        throw new Exception("Execute failed: " . $check->error);
    }
    
    $check_result = $check->get_result();
    
    if ($check_result->num_rows === 0) {
        redirectWithError($id, 'Jadwal tidak ditemukan');
    }

    $row = $check_result->fetch_assoc();
    $kuota = $row['kuota'];
    $terdaftar = $row['terdaftar'];
    $tersedia = $kuota - $terdaftar;

    if ($jumlah_orang > $tersedia) {
        redirectWithError($id, "Kuota tidak mencukupi. Tersedia: $tersedia");
    }
} catch (Exception $e) {
    error_log("Error checking quota: " . $e->getMessage());
    redirectWithError($id, 'Terjadi kesalahan saat memeriksa kuota');
}

// Handle file upload
$identitas = null;
if (isset($_FILES['identitas']) && $_FILES['identitas']['error'] == UPLOAD_ERR_OK) {
    try {
        $target_dir = "../uploads/";
        
        // Buat folder jika belum ada
        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                throw new Exception("Gagal membuat folder upload");
            }
        }
        
        // Validasi ekstensi file
        $file_name = $_FILES['identitas']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];
        
        if (!in_array($file_ext, $allowed_ext)) {
            redirectWithError($id, 'Format file harus JPG, PNG, atau PDF');
        }
        
        // Validasi ukuran file (max 2MB)
        if ($_FILES['identitas']['size'] > 2097152) {
            redirectWithError($id, 'Ukuran file maksimal 2MB');
        }
        
        // Generate nama file unik
        $new_filename = "identitas_" . $id . "_" . bin2hex(random_bytes(8)) . "." . $file_ext;
        $target_file = $target_dir . $new_filename;
        
        // Coba upload file
        if (!move_uploaded_file($_FILES['identitas']['tmp_name'], $target_file)) {
            throw new Exception("Gagal memindahkan file yang diupload");
        }
        
        $identitas = $new_filename;
        
        // Hapus file lama jika ada
        $query_old = "SELECT identitas FROM pendaftar_pendakian WHERE id = ?";
        $stmt_old = $conn->prepare($query_old);
        $stmt_old->bind_param("i", $id);
        $stmt_old->execute();
        $result_old = $stmt_old->get_result();
        $old_file = $result_old->fetch_assoc()['identitas'];
        
        if ($old_file && file_exists($target_dir . $old_file)) {
            if (!unlink($target_dir . $old_file)) {
                error_log("Gagal menghapus file lama: " . $target_dir . $old_file);
            }
        }
    } catch (Exception $e) {
        error_log("File upload error: " . $e->getMessage());
        redirectWithError($id, 'Gagal mengupload file: ' . $e->getMessage());
    }
}

// Update data pendaki
try {
    $update_query = "UPDATE pendaftar_pendakian SET 
                    nama_lengkap = ?,
                    email = ?,
                    no_telepon = ?,
                    alamat = ?,
                    id_jadwal = ?,
                    jumlah_orang = ?,
                    status = ?,
                    catatan = ?";
                    
    if ($identitas) {
        $update_query .= ", identitas = ?";
    }
    
    $update_query .= " WHERE id = ?";
    
    $stmt = $conn->prepare($update_query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    if ($identitas) {
        $stmt->bind_param("ssssiisssi", 
            $nama_lengkap,
            $email,
            $no_telepon,
            $alamat,
            $id_jadwal,
            $jumlah_orang,
            $status,
            $catatan,
            $identitas,
            $id
        );
    } else {
        $stmt->bind_param("ssssiissi", 
            $nama_lengkap,
            $email,
            $no_telepon,
            $alamat,
            $id_jadwal,
            $jumlah_orang,
            $status,
            $catatan,
            $id
        );
    }
    
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    // Update status jadwal
    $update_jadwal = "UPDATE jadwal_pendakian 
                     SET status = CASE 
                         WHEN (SELECT SUM(jumlah_orang) FROM pendaftar_pendakian WHERE id_jadwal = ?) >= kuota 
                         THEN 'penuh' 
                         ELSE 'buka' 
                     END
                     WHERE id = ?";
    
    $stmt_jadwal = $conn->prepare($update_jadwal);
    if (!$stmt_jadwal) {
        throw new Exception("Prepare jadwal failed: " . $conn->error);
    }
    
    $stmt_jadwal->bind_param("ii", $id_jadwal, $id_jadwal);
    if (!$stmt_jadwal->execute()) {
        throw new Exception("Execute jadwal failed: " . $stmt_jadwal->error);
    }
    
    header("Location: index.php?success=Data pendaki berhasil diperbarui");
    exit;
    
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    redirectWithError($id, 'Gagal memperbarui data: ' . $e->getMessage());
} finally {
    if (isset($stmt)) $stmt->close();
    if (isset($stmt_jadwal)) $stmt_jadwal->close();
    if (isset($stmt_old)) $stmt_old->close();
    $conn->close();
    ob_end_flush();
}
?>