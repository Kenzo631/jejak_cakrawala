<?php
include '../config/koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?error=ID jadwal tidak ditemukan.");
    exit;
}

$id = $_GET['id'];

// PERBAIKAN 1: Periksa di tabel pendaftar_pendakian
$check = $conn->prepare("SELECT COUNT(*) FROM pendaftar_pendakian WHERE id_jadwal = ?");
$check->bind_param("i", $id);
$check->execute();
$check->bind_result($count);
$check->fetch();
$check->close();

// PERBAIKAN 2: Tambahkan pesan debug
error_log("Jumlah pendaftar untuk jadwal $id: $count");

if ($count > 0) {
    header("Location: index.php?error=Tidak bisa menghapus jadwal karena sudah ada $count pendaki terdaftar");
    exit;
}

$delete = $conn->prepare("DELETE FROM jadwal_pendakian WHERE id = ?");
$delete->bind_param("i", $id);

if ($delete->execute()) {
    header("Location: index.php?success=Jadwal berhasil dihapus");
} else {
    error_log("Error deleting schedule: " . $conn->error); // Log error
    header("Location: index.php?error=Gagal menghapus jadwal: " . $conn->error);
}
?>