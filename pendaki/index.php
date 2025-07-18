<?php include '../dashboard/header.php'; ?>
<?php include '../dashboard/sidebar.php'; ?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
<link rel="stylesheet" href="../assets/css/pendaki.css">
    <div class="container bg-white p-4 rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Pendaki Terdaftar</h2>
            <a href="pendaki_tambah.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>

        <?php
        // Database connection
        $db = new mysqli('localhost', 'root', '', 'cakrawala');
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // Tampilkan pesan sukses/error
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show mb-4">
                    '.htmlspecialchars($_GET['success']).'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show mb-4">
                    '.htmlspecialchars($_GET['error']).'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-hover table-custom">
                <thead class="thead-custom text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">Nama</th>
                        <th width="15%">Email</th>
                        <th width="10%">No HP</th>
                        <th width="15%">Alamat</th>
                        <th width="10%">Gunung</th>
                        <th width="15%">Tanggal</th>
                        <th width="5%">Jumlah</th>
                        <th width="8%">Identitas</th>
                        <th width="8%">Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT p.*, j.tanggal_keberangkatan, j.tanggal_pulang, g.nama_gunung 
                            FROM pendaftar_pendakian p 
                            LEFT JOIN jadwal_pendakian j ON p.id_jadwal = j.id
                            LEFT JOIN gunung g ON j.id_gunung = g.id
                            ORDER BY p.id DESC";
                    $result = $db->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $identitas = $row['identitas'] ? 
                                '<a href="../uploads/' . htmlspecialchars($row['identitas']) . '" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>' : 
                                '<span class="text-muted">-</span>';
                            
                            // Shorten email display
                            $email = $row['email'];
                            if (strlen($email) > 15) {
                                $email = htmlspecialchars(substr($email, 0, 12)) . '...';
                            } else {
                                $email = htmlspecialchars($email);
                            }

                            $alamat_short = htmlspecialchars(substr($row['alamat'], 0, 20)) . (strlen($row['alamat']) > 20 ? '...' : '');

                            // Status badge classes
                            $status_class = match($row['status']) {
                                'diterima' => 'bg-success',
                                'ditolak' => 'bg-danger',
                                default => 'bg-warning',
                            };
                            ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                <td class="text-center" title="<?= htmlspecialchars($row['email']) ?>"><?= $email ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['no_telepon']) ?></td>
                                <td class="text-center" title="<?= htmlspecialchars($row['alamat']) ?>"><?= $alamat_short ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['nama_gunung'] ?? '-') ?></td>
                                <td class="text-center">
                                    <?= date('d/m/Y', strtotime($row['tanggal_keberangkatan'])) ?><br>
                                    <small class="text-muted">s/d <?= date('d/m/Y', strtotime($row['tanggal_pulang'])) ?></small>
                                </td>
                                <td class="text-center"><?= (int)$row['jumlah_orang'] ?></td>
                                <td class="text-center"><?= $identitas ?></td>
                                <td class="text-center">
                                    <span class="badge <?= $status_class ?> text-uppercase"><?= htmlspecialchars($row['status']) ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="pendaki_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary mb-1" data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="pendaki_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus?')" data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <?php if ($row['status'] != 'diterima' && $row['status'] != 'ditolak') : ?>
                                        <div class="btn-group" role="group" aria-label="Status update">
                                            <a href="status_update.php?id=<?= $row['id'] ?>&status=diterima" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Terima">
                                                ✓
                                            </a>
                                            <a href="status_update.php?id=<?= $row['id'] ?>&status=ditolak" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Tolak">
                                                ✗
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    } else {
                        echo '<tr><td colspan="11" class="text-center text-muted fst-italic">Tidak ada data pendaki</td></tr>';
                    }
                    $db->close();
                    ?>
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