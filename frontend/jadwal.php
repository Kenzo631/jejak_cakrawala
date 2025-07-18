<?php include 'header.php';

$jadwal = $conn->query("SELECT * FROM jadwal_pendakian");

?>
<!-- Project Section -->
<div class="w3-container w3-padding-64" id="projects" data-aos="fade-up" data-aos-delay="300">
    <h2 class="w3-center w3-xxlarge orange-button"><b>Jadwal Pendakian</b></h2>
    <hr style="width:60px; border: 3px solid #C89B4B" class="w3-round w3-margin-bottom">


    <div class="card-container">



    </div>
    <?php
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show mb-4">
                    ' . htmlspecialchars($_GET['success']) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    }
    ?>

    <div class="w3-row-padding w3-padding-32 ">
        <?php if ($jadwal && $jadwal->num_rows > 0): ?>
            <?php while ($row = $jadwal->fetch_assoc()): ?>
                <div class="card-container">
                    <?php
                    $gunung = $conn->query("SELECT * FROM gunung WHERE id = '{$row['id_gunung']}'");
                    $gunung = $gunung->fetch_object();
                    ?>

                    <div class="card">
                        <h3><?= htmlspecialchars($gunung->nama_gunung) . ' via ' . htmlspecialchars($gunung->jalur_gunung) ?>
                        </h3>
                        <img src="../assets/images/<?= htmlspecialchars($gunung->gambar_gunung) ?>"
                            alt="<?= htmlspecialchars($gunung->nama_gunung) ?>"
                            style="width:100%; height: 300px; object-fit:cover;">

                        <p><strong>Berangkat: </strong>
                            <?= htmlspecialchars(formatTanggalIndo($row['tanggal_keberangkatan'])) ?>
                        </p>
                        <p><strong>Pulang: </strong><?= htmlspecialchars(formatTanggalIndo($row['tanggal_pulang'])) ?></p>
                        <p><strong>Kuota: </strong><?= htmlspecialchars($row['kuota']) ?> orang</p>

                        <?php
                        $status = strtolower($row['status']); // pastikan lowercase agar konsisten
                        ?>

                        <p class="status 
    <?= $status == 'buka' ? 'buka' : ($status == 'penuh' ? 'penuh' : 'ditutup') ?>">
                            Status:
                            <?= $status == 'buka' ? 'Buka' : ($status == 'penuh' ? 'Penuh' : 'Ditutup') ?>
                        </p>
                        <div class="btn-container">
                            <?php if ($status === 'penuh'): ?>
                                <a class="btn-daftar disabled"
                                    style="pointer-events: none; opacity: 0.6; cursor: not-allowed;">Penuh</a>
                            <?php else: ?>
                                <a href="daftar_pendakian.php?id_gunung=<?= $gunung->id ?>" class="btn-daftar">Daftar</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="w3-padding">Tidak ada jadwal yang ditemukan.</p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>