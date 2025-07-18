<?php
include '../config/koneksi.php';

// Validasi input
$required = ['id', 'nama_gunung', 'jalur_gunung', 'lokasi_gunung', 'tinggi_gunung', 'estimasi_waktu', 'biaya_paket', 'kesulitan'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        header("Location: index.php?error=Field $field harus diisi");
        exit;
    }
}

// Ambil data
$id = (int)$_POST['id'];
$nama = $conn->real_escape_string($_POST['nama_gunung']);
$jalur = $conn->real_escape_string($_POST['jalur_gunung']);
$lokasi = $conn->real_escape_string($_POST['lokasi_gunung']);
$tinggi = (int)$_POST['tinggi_gunung'];
$estimasi = $conn->real_escape_string($_POST['estimasi_waktu']);
$biaya = (float)$_POST['biaya_paket'];
$kesulitan = $conn->real_escape_string($_POST['kesulitan']);
$deskripsi = isset($_POST['deskripsi']) ? $conn->real_escape_string($_POST['deskripsi']) : null;

// Ambil data lama
$result = $conn->query("SELECT gambar_gunung FROM gunung WHERE id=$id");
$old_file = $result->fetch_assoc()['gambar_gunung'];

// Handle file upload jika ada file baru
if (!empty($_FILES['gambar_gunung']['name'])) {
    $gambar = $_FILES['gambar_gunung']['name'];
    $tmp = $_FILES['gambar_gunung']['tmp_name'];
    $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
    $nama_file = uniqid() . '.' . $ext;

    // Validasi ekstensi file saja (tanpa batasan ukuran)
    $allowed_ext = ['jpg', 'jpeg', 'png'];
    if (!in_array($ext, $allowed_ext)) {
        header("Location: gunung_edit.php?id=$id&error=Format file harus JPG, JPEG, atau PNG");
        exit;
    }

    // Upload file baru
    if (move_uploaded_file($tmp, "../assets/images/$nama_file")) {
        // Hapus file lama jika ada
        if (!empty($old_file) && file_exists("../assets/images/$old_file")) {
            unlink("../assets/images/$old_file");
        }
    } else {
        header("Location: gunung_edit.php?id=$id&error=Gagal mengupload gambar");
        exit;
    }
} else {
    $nama_file = $old_file; // Gunakan file lama jika tidak ada upload baru
}

// Update data
$stmt = $conn->prepare("UPDATE gunung SET 
    nama_gunung = ?, 
    jalur_gunung = ?, 
    lokasi_gunung = ?, 
    tinggi_gunung = ?, 
    estimasi_waktu = ?, 
    biaya_paket = ?, 
    gambar_gunung = ?, 
    deskripsi = ?, 
    kesulitan = ?,
    updated_at = NOW()
    WHERE id = ?");

$stmt->bind_param(
    "sssisdsssi",
    $nama,
    $jalur,
    $lokasi,
    $tinggi,
    $estimasi,
    $biaya,
    $nama_file,
    $deskripsi,
    $kesulitan,
    $id
);

if ($stmt->execute()) {
    header("Location: index.php?success=Data gunung berhasil diperbarui");
} else {
    // Hapus file baru jika gagal update database
    if (!empty($_FILES['gambar_gunung']['name']) && file_exists("../uploads/$nama_file")) {
        unlink("../uploads/$nama_file");
    }
    header("Location: gunung_edit.php?id=$id&error=Gagal memperbarui data: " . $conn->error);
}

$stmt->close();
$conn->close();
?>