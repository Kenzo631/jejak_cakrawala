<?php include '../dashboard/header.php'; ?>
<?php include '../dashboard/sidebar.php'; ?>
<?php include '../config/koneksi.php'; ?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
<link rel="stylesheet" href="../assets/css/gunung.css">
    <div class="container bg-white p-4 rounded shadow-sm">
        <!-- Judul dan Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Gunung</h2>
            <a href="gunung_tambah.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Gunung
            </a>
        </div>

        <!-- Alert Notifikasi -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <?= htmlspecialchars($_GET['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <?= htmlspecialchars($_GET['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Tabel Data Gunung -->
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-hover table-custom">
                <thead class="thead-custom text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">Nama Gunung</th>
                        <th width="10%">Jalur</th>
                        <th width="12%">Lokasi</th>
                        <th width="8%">Tinggi</th>
                        <th width="10%">Estimasi</th>
                        <th width="8%">Biaya</th>
                        <th width="8%">Kesulitan</th>
                        <th width="15%">Gambar</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = $conn->query("SELECT * FROM gunung ORDER BY nama_gunung ASC");
                    while ($row = $query->fetch_assoc()):
                        // Badge class for kesulitan
                        $kesulitan_class = match($row['kesulitan']) {
                            'mudah' => 'bg-success',
                            'sedang' => 'bg-warning',
                            default => 'bg-danger',
                        };
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['nama_gunung']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['jalur_gunung']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['lokasi_gunung']) ?></td>
                            <td class="text-center"><?= number_format($row['tinggi_gunung']) ?> mdpl</td>
                            <td class="text-center"><?= htmlspecialchars($row['estimasi_waktu']) ?></td>
                            <td class="text-center">Rp<?= number_format($row['biaya_paket'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <span class="badge <?= $kesulitan_class ?> text-capitalize">
                                    <?= htmlspecialchars($row['kesulitan']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($row['gambar_gunung'])): ?>
                                    <img src="../assets/images/<?= htmlspecialchars($row['gambar_gunung']) ?>" 
                                        class="img-thumbnail" 
                                        style="max-width: 100px; max-height: 60px;"
                                        alt="<?= htmlspecialchars($row['nama_gunung']) ?>">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Aksi">
                                    <a href="gunung_edit.php?id=<?= $row['id'] ?>" 
                                    class="btn btn-sm btn-primary" 
                                    data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="gunung_hapus.php?id=<?= $row['id'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <script>
            // Enable Bootstrap tooltips (requires Bootstrap JS)
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </div>
</main>

<?php include '../dashboard/footer.php'; ?>