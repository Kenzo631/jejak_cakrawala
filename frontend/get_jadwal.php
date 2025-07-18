<?php
// Pastikan tidak ada whitespace/echo sebelum tag pembuka PHP
header('Content-Type: application/json');

include '../config/koneksi.php';

// Validasi input
if (!isset($_GET['gunung_id']) || !is_numeric($_GET['gunung_id'])) {
    echo json_encode(['error' => 'ID Gunung tidak valid']);
    exit;
}

$gunung_id = (int)$_GET['gunung_id'];

try {
    // Pastikan nama kolom sesuai dengan database Anda
    $query = "SELECT j.id, 
                     j.tanggal_keberangkatan as tanggal, 
                     j.tanggal_pulang,
                     j.kuota
              FROM jadwal_pendakian j
              WHERE j.id_gunung = ? 
              AND j.status = 'buka'
              AND j.kuota > 0
              ORDER BY j.tanggal_keberangkatan ASC";
    
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception('Gagal mempersiapkan query: ' . $conn->error);
    }
    
    $stmt->bind_param("i", $gunung_id);
    if (!$stmt->execute()) {
        throw new Exception('Gagal mengeksekusi query: ' . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $jadwals = [];
    
    while ($row = $result->fetch_assoc()) {
        $jadwals[] = [
            'id' => $row['id'],
            'tanggal' => date('d-m-Y', strtotime($row['tanggal'])),
            'tanggal_pulang' => date('d-m-Y', strtotime($row['tanggal_pulang'])),
            'kuota' => $row['kuota']
        ];
    }
    
    echo json_encode(['data' => $jadwals]);
    
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}
?>