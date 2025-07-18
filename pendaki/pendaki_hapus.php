<?php
// Memulai session
session_start();

// Koneksi ke database
$db = new mysqli('localhost', 'root', '', 'cakrawala');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Cek apakah parameter ID ada
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Mulai transaksi
    $db->begin_transaction();

    try {
        // Ambil data jumlah_orang, id_jadwal, identitas file, dan status
        $query = "SELECT id_jadwal, jumlah_orang, identitas, status FROM pendaftar_pendakian WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Data pendaki tidak ditemukan");
        }

        $row = $result->fetch_assoc();
        $id_jadwal = $row['id_jadwal'];
        $jumlah_orang = $row['jumlah_orang'];
        $identitas_file = $row['identitas'];
        $status_pendaki = $row['status'];
        $stmt->close();

        // Kembalikan kuota HANYA jika status pendaki bukan 'ditolak'
        if ($status_pendaki != 'ditolak') {
            $update_kuota = "UPDATE jadwal_pendakian SET kuota = kuota + ? WHERE id = ?";
            $stmt = $db->prepare($update_kuota);
            $stmt->bind_param("ii", $jumlah_orang, $id_jadwal);
            if (!$stmt->execute()) {
                throw new Exception("Gagal mengupdate kuota: " . $stmt->error);
            }
            $stmt->close();

            // Jika setelah ditambah kuota > 0 dan status jadwal 'penuh', ubah jadi 'buka'
            $stmt = $db->prepare("SELECT kuota, status FROM jadwal_pendakian WHERE id = ?");
            $stmt->bind_param("i", $id_jadwal);
            $stmt->execute();
            $stmt->bind_result($sisa_kuota, $status_jadwal);
            $stmt->fetch();
            $stmt->close();

            if ($sisa_kuota > 0 && $status_jadwal == 'penuh') {
                $stmt = $db->prepare("UPDATE jadwal_pendakian SET status = 'buka' WHERE id = ?");
                $stmt->bind_param("i", $id_jadwal);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Hapus file identitas jika ada
        if (!empty($identitas_file)) {
            $file_path = "../uploads/" . $identitas_file;
            if (file_exists($file_path)) {
                if (!unlink($file_path)) {
                    error_log("Gagal menghapus file $file_path");
                }
            }
        }

        // Hapus data dari pendaftar_pendakian
        $delete_query = "DELETE FROM pendaftar_pendakian WHERE id = ?";
        $stmt = $db->prepare($delete_query);
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            throw new Exception("Gagal menghapus data pendaki: " . $stmt->error);
        }
        $stmt->close();

        // Commit transaksi
        $db->commit();

        $_SESSION['success'] = "Data pendaki berhasil dihapus";
    } catch (Exception $e) {
        $db->rollback();
        $_SESSION['error'] = $e->getMessage();
    }
} else {
    $_SESSION['error'] = "ID tidak valid";
}

$db->close();

// Redirect kembali ke halaman data pendaki
header("Location: index.php");
exit();
?>
