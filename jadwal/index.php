<?php include '../dashboard/header.php'; ?>
<?php include '../dashboard/sidebar.php'; ?>

<?php
$db = new mysqli('localhost', 'root', '', 'cakrawala');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
<link rel="stylesheet" href="../assets/css/jadwal.css">
    <div class="container bg-white p-4 rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Jadwal Pendakian</h2>
            <a href="jadwal_tambah.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-hover table-custom">
                <thead class="thead-custom text-center">
                        <th>No</th>
                        <th>Gunung</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Tanggal Pulang</th>
                        <th>Kuota Peserta</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT j.*, g.nama_gunung 
                            FROM jadwal_pendakian j 
                            JOIN gunung g ON j.id_gunung = g.id 
                            ORDER BY j.tanggal_keberangkatan ASC";
                    $result = $db->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $status = ucfirst(strtolower(trim($row['status'])));

                            // Badge class based on status
                            $badgeClass = match ($status) {
                                'Buka' => 'bg-success',
                                'Tutup' => 'bg-danger',
                                'Penuh' => 'bg-warning text-dark',
                                default => 'bg-secondary',
                            };
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['nama_gunung']) ?></td>
                                <td class="text-center"><?= date('d/m/Y', strtotime($row['tanggal_keberangkatan'])) ?></td>
                                <td class="text-center"><?= date('d/m/Y', strtotime($row['tanggal_pulang'])) ?></td>
                                <td class="text-center"><?= (int)$row['kuota'] ?></td>
                                <td class="text-center">
                                    <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Aksi">
                                        <a href="jadwal_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="jadwal_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center text-muted fst-italic">Tidak ada data jadwal pendakian</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Enable Bootstrap tooltips (requires Bootstrap JS)
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</main>

<?php include '../dashboard/footer.php'; ?>
