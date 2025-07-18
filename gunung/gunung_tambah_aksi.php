<?php
include '../config/koneksi.php';

// Validasi input
$required = ['nama_gunung', 'jalur_gunung', 'lokasi_gunung', 'tinggi_gunung', 'estimasi_waktu', 'biaya_paket', 'kesulitan'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        header("Location: gunung_tambah.php?error=Field $field harus diisi");
        exit;
    }
}

// Ambil data
$nama = $conn->real_escape_string($_POST['nama_gunung']);
$jalur = $conn->real_escape_string($_POST['jalur_gunung']);
$lokasi = $conn->real_escape_string($_POST['lokasi_gunung']);
$tinggi = (int)$_POST['tinggi_gunung'];
$estimasi = $conn->real_escape_string($_POST['estimasi_waktu']);
$biaya = (float)$_POST['biaya_paket'];
$kesulitan = $conn->real_escape_string($_POST['kesulitan']);
$deskripsi = isset($_POST['deskripsi']) ? $conn->real_escape_string($_POST['deskripsi']) : null;

// Handle file upload
$upload_dir = '../assets/images/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$gambar = $_FILES['gambar_gunung']['name'];
$tmp = $_FILES['gambar_gunung']['tmp_name'];
$ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
$nama_file = uniqid() . '.' . $ext;

// Validasi file
$allowed_ext = ['jpg', 'jpeg', 'png'];

if (!in_array($ext, $allowed_ext)) {
    header("Location: gunung_tambah.php?error=Format file harus JPG, JPEG, atau PNG");
    exit;
}

if (move_uploaded_file($tmp, $upload_dir . $nama_file)) {
    $stmt = $conn->prepare("INSERT INTO gunung (
        nama_gunung, 
        jalur_gunung, 
        lokasi_gunung, 
        tinggi_gunung, 
        estimasi_waktu, 
        biaya_paket, 
        gambar_gunung, 
        deskripsi, 
        kesulitan
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param(
        "sssisdsss",
        $nama,
        $jalur,
        $lokasi,
        $tinggi,
        $estimasi,
        $biaya,
        $nama_file,
        $deskripsi,
        $kesulitan
    );
    
    if ($stmt->execute()) {
        header("Location: index.php?success=Gunung berhasil ditambahkan");
    } else {
        // Hapus file yang sudah diupload jika gagal menyimpan ke database
        unlink($upload_dir . $nama_file);
        header("Location: gunung_tambah.php?error=Gagal menyimpan data: " . $conn->error);
    }
} else {
    header("Location: gunung_tambah.php?error=Gagal upload gambar");
}