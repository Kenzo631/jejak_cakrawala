<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include '../dashboard/header.php';
include '../dashboard/sidebar.php';
include '../config/koneksi.php';
?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
    <div class="container bg-white p-4 rounded shadow-sm">

        <!-- Judul Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="fas fa-mountain me-2"></i>Overview Data Pendakian</h2>
        </div>

        <?php
        $totalGunung = $conn->query("SELECT COUNT(*) AS total FROM gunung")->fetch_assoc()['total'];
        $jadwalBuka = $conn->query("SELECT COUNT(*) AS total FROM jadwal_pendakian WHERE status = 'buka'")->fetch_assoc()['total'];
        $jadwalTutup = $conn->query("SELECT COUNT(*) AS total FROM jadwal_pendakian WHERE status = 'tutup'")->fetch_assoc()['total'];
        $jadwalPenuh = $conn->query("SELECT COUNT(*) AS total FROM jadwal_pendakian WHERE status = 'penuh'")->fetch_assoc()['total'];
        $totalPendaki = $conn->query("SELECT COUNT(id) AS total FROM pendaftar_pendakian")->fetch_assoc()['total'];

        $pendakiGunungQuery = $conn->query("
            SELECT p.nama_lengkap, p.status, g.nama_gunung
            FROM pendaftar_pendakian p
            JOIN jadwal_pendakian j ON p.id_jadwal = j.id
            JOIN gunung g ON j.id_gunung = g.id
            ORDER BY p.id DESC
            LIMIT 10
        ");
        ?>

        <!-- Statistik Card -->
        <div class="row g-4 mb-4">
            <!-- KIRI: Statistik Pendakian -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="text-center fw-bold mb-4">
                            <i class="fas fa-chart-bar me-2"></i>Statistik Pendakian
                        </h4>

                        <!-- Total Gunung -->
                        <div class="mb-4">
                            <h6 class="text-muted text-center">
                                <i class="fas fa-mountain me-2"></i>TOTAL GUNUNG
                            </h6>
                            <h2 class="text-center"><?= $totalGunung ?></h2>
                        </div>

                        <!-- Jadwal Buka -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-door-open me-2"></i>BUKA
                            </h6>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" 
                                    style="width: <?= ($jadwalBuka / ($jadwalBuka + $jadwalTutup + $jadwalPenuh)) * 100 ?>%;" 
                                    aria-valuenow="<?= $jadwalBuka ?>" 
                                    aria-valuemin="0" 
                                    aria-valuemax="<?= ($jadwalBuka + $jadwalTutup + $jadwalPenuh) ?>">
                                    <?= $jadwalBuka ?>
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal Penuh -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-users me-2"></i>PENUH
                            </h6>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-warning text-dark" role="progressbar" 
                                    style="width: <?= ($jadwalPenuh / ($jadwalBuka + $jadwalTutup + $jadwalPenuh)) * 100 ?>%;" 
                                    aria-valuenow="<?= $jadwalPenuh ?>" 
                                    aria-valuemin="0" 
                                    aria-valuemax="<?= ($jadwalBuka + $jadwalTutup + $jadwalPenuh) ?>">
                                    <?= $jadwalPenuh ?>
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal Tutup -->
                        <div class="mb-0">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-door-closed me-2"></i>TUTUP
                            </h6>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-danger" role="progressbar" 
                                    style="width: <?= ($jadwalTutup / ($jadwalBuka + $jadwalTutup + $jadwalPenuh)) * 100 ?>%;" 
                                    aria-valuenow="<?= $jadwalTutup ?>" 
                                    aria-valuemin="0" 
                                    aria-valuemax="<?= ($jadwalBuka + $jadwalTutup + $jadwalPenuh) ?>">
                                    <?= $jadwalTutup ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KANAN: Total Pendaki dan Daftar Terbaru -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h6 class="text-muted text-center">
                                <i class="fas fa-user-friends me-2"></i>TOTAL PENDAKI TERDAFTAR
                            </h6>
                            <h2 class="text-center"><?= $totalPendaki ?></h2>
                        </div>

                        <div class="card-header bg-primary text-white rounded-top">
                            <h5 class="mb-0 text-center position-relative">
                                <i class="fas fa-users" style="position: relative; right: -8px;"></i>
                                <span style="margin-left: 12px;">10 Data Pendaki Terbaru</span>
                            </h5>
                        </div>

                        <div class="card-body p-0">
                            <?php if ($pendakiGunungQuery && $pendakiGunungQuery->num_rows > 0): ?>
                                <ul class="list-group list-group-flush rounded-bottom">
                                    <?php while ($row = $pendakiGunungQuery->fetch_assoc()): ?>
                                        <?php
                                            $status = strtolower(trim($row['status']));
                                            $badgeClass = 'bg-secondary';
                                            if ($status === 'diterima') $badgeClass = 'bg-success';
                                            elseif ($status === 'ditolak') $badgeClass = 'bg-danger';
                                            elseif ($status === 'pending') $badgeClass = 'bg-warning text-dark';
                                        ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                            <div>
                                                <strong><?= htmlspecialchars($row['nama_lengkap']) ?></strong><br>
                                                <small class="text-muted">
                                                    <i class="fas fa-mountain me-1"></i><?= htmlspecialchars($row['nama_gunung']) ?>
                                                </small>
                                            </div>
                                            <span class="badge <?= $badgeClass ?> px-3 py-2" style="font-size: 0.875rem;">
                                                <?= ucfirst($status) ?>
                                            </span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted text-center my-3 py-3">Tidak ada data pendaki</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../dashboard/footer.php'; ?>
