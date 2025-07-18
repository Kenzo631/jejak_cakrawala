<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi field
    if (!isset($_POST['id_gunung'], $_POST['tanggal_keberangkatan'], $_POST['tanggal_pulang'], $_POST['kuota'], $_POST['status'])) {
        header("Location: jadwal_tambah.php?error=Semua field harus diisi");
        exit();
    }

    $id_gunung = $_POST['id_gunung'];
    $tanggalberangkat = $_POST['tanggal_keberangkatan'];
    $tanggalpulang = $_POST['tanggal_pulang'];
    $kuota = $_POST['kuota'];
    $status = $_POST['status'];

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO jadwal_pendakian (id_gunung, tanggal_keberangkatan, tanggal_pulang, kuota, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id_gunung, $tanggalberangkat, $tanggalpulang, $kuota, $status);

    if ($stmt->execute()) {
        header("Location: index.php?success=Jadwal berhasil ditambahkan");
    } else {
        header("Location: jadwal_tambah.php?error=Gagal menyimpan data: " . $conn->error);
    }

    $stmt->close();
    $conn->close();
}
?>
