<?php
include '../config/koneksi.php';

$id = $_POST['id'];
$id_gunung = $_POST['id_gunung'];
$tanggalberangkat = $_POST['tanggal_keberangkatan'];
$tanggalpulang = $_POST['tanggal_pulang'];
$kuota = $_POST['kuota'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE jadwal_pendakian SET id_gunung=?, tanggal_keberangkatan=?, tanggal_pulang=?, kuota=?, status=? WHERE id=?");
$stmt->bind_param("sssssi", $id_gunung, $tanggalberangkat, $tanggalpulang, $kuota, $status, $id);

if ($stmt->execute()) {
    header("Location: index.php?success=Jadwal berhasil diperbarui");
} else {
    header("Location: jadwal_edit.php?id=$id&error=Gagal memperbarui data");
}

$stmt->close();
$conn->close();
?>