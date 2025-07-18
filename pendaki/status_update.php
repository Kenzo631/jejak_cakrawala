<?php
require '../config/koneksi.php';

// Validasi parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?error=ID tidak valid");
    exit;
}

if (!isset($_GET['status']) || !in_array($_GET['status'], ['diterima', 'ditolak'])) {
    header("Location: index.php?error=Status tidak valid");
    exit;
}

$id = (int)$_GET['id'];
$status_baru = $_GET['status'];

$conn->begin_transaction();

try {
    // Ambil status lama, id_jadwal, dan jumlah_orang
    $stmt = $conn->prepare("SELECT status, id_jadwal, jumlah_orang FROM pendaftar_pendakian WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($status_lama, $id_jadwal, $jumlah_orang);

    if (!$stmt->fetch()) {
        throw new Exception("Data pendaki tidak ditemukan");
    }
    $stmt->close();

    // Jika status diubah menjadi ditolak dan sebelumnya bukan ditolak, kembalikan kuota
    if ($status_baru == 'ditolak' && $status_lama != 'ditolak') {
        $stmt = $conn->prepare("UPDATE jadwal_pendakian SET kuota = kuota + ? WHERE id = ?");
        $stmt->bind_param("ii", $jumlah_orang, $id_jadwal);
        if (!$stmt->execute()) {
            throw new Exception("Gagal mengupdate kuota: " . $stmt->error);
        }
        $stmt->close();

        // Jika setelah ditambah kuota > 0 dan status jadwal 'penuh', ubah jadi 'buka'
        $stmt = $conn->prepare("SELECT kuota, status FROM jadwal_pendakian WHERE id = ?");
        $stmt->bind_param("i", $id_jadwal);
        $stmt->execute();
        $stmt->bind_result($sisa_kuota, $status_jadwal);
        $stmt->fetch();
        $stmt->close();

        if ($sisa_kuota > 0 && $status_jadwal == 'penuh') {
            $stmt = $conn->prepare("UPDATE jadwal_pendakian SET status = 'buka' WHERE id = ?");
            $stmt->bind_param("i", $id_jadwal);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Update status pendaki
    $stmt = $conn->prepare("UPDATE pendaftar_pendakian SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status_baru, $id);
    if (!$stmt->execute()) {
        throw new Exception("Gagal mengupdate status pendaki: " . $stmt->error);
    }
    $stmt->close();

    $conn->commit();
    header("Location: index.php?success=Status berhasil diupdate");
    exit;

} catch (Exception $e) {
    $conn->rollback();
    header("Location: index.php?error=" . $e->getMessage());
    exit;
} finally {
    $conn->close();
}
?>
