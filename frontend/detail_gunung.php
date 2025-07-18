<?php
include 'header.php';
$id_gunung = $_GET['id'] ?? null;

if ($id_gunung && is_numeric($id_gunung)) {
    $query = "SELECT * FROM gunung WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_gunung);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <!-- Button Kembali -->


    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="w3-container w3-padding-64" id="detail-gunung" data-aos="fade-up" data-aos-delay="300">

                <!-- Header Judul -->
                <h1 class="w3-center w3-xxlarge orange-button w3-margin-bottom">
                    <b><?= htmlspecialchars($row['nama_gunung']) ?></b>
                </h1>
                <hr style="width:60px; border: 3px solid #C89B4B" class="w3-round w3-margin-bottom w3-center">

                <!-- Gambar Gunung -->
                <div class="w3-row w3-margin-bottom">
                    <div class="w3-col l12 m12 s12">
                        <div class="w3-card-4 w3-round">
                            <?php if (!empty($row['gambar_gunung'])): ?>
                                <img src="../assets/images/<?= htmlspecialchars($row['gambar_gunung']) ?>"
                                    alt="<?= htmlspecialchars($row['nama_gunung']) ?>" class="w3-image w3-round-top"
                                    style="width:100%; height:400px; object-fit:cover;">
                            <?php else: ?>
                                <img src="assets/img/default-mountain.jpg" alt="Default Mountain" class="w3-image w3-round-top"
                                    style="width:100%; height:400px; object-fit:cover;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Informasi Utama -->
                <div class="w3-row w3-margin-bottom" style="display: flex; align-items: stretch;">
                    <div class="w3-col l8 m8 s12 w3-padding-right" style="display: flex;">
                        <div class="w3-card w3-white w3-round w3-padding" style="flex: 1; display: flex; flex-direction: column;">
                            <h3 class="w3-text-orange"><b>Deskripsi Gunung</b></h3>
                            <p class="w3-text-grey w3-justify">
                                <?= !empty($row['deskripsi']) ? nl2br(htmlspecialchars($row['deskripsi'])) : 'Deskripsi belum tersedia.' ?>
                            </p>

                            <h3 class="w3-text-orange w3-margin-top"><b>Jalur Pendakian</b></h3>
                            <p class="w3-text-grey">
                                <i class="fa fa-route w3-text-orange"></i>
                                <?= !empty($row['jalur_gunung']) ? htmlspecialchars($row['jalur_gunung']) : 'Jalur belum tersedia' ?>
                            </p>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="w3-col l4 m4 s12">
                        <div class="w3-card w3-white w3-round w3-padding">
                            <h3 class="w3-text-orange w3-center"><b>Informasi Detail</b></h3>

                            <div class="w3-margin-bottom">
                                <p><i class="fa fa-map-marker w3-text-orange"></i> <b>Lokasi:</b></p>
                                <p class="w3-text-grey w3-small">
                                    <?php if (!empty($row['lokasi_gunung'])): ?>
                                        <?= htmlspecialchars($row['lokasi_gunung']) ?>
                                        <br>
                                        <a href="https://www.google.com/maps/search/<?= urlencode($row['nama_gunung'] . ' ' . $row['lokasi_gunung']) ?>"
                                            target="_blank" class="w3-text-blue w3-hover-text-orange" style="text-decoration: none;">
                                            <i class="fa fa-external-link"></i> Lihat di Google Maps
                                        </a>
                                    <?php else: ?>
                                        Lokasi belum tersedia
                                    <?php endif; ?>
                                </p>
                            </div>

                            <div class="w3-margin-bottom">
                                <p><i class="fa fa-mountain w3-text-orange"></i> <b>Tinggi:</b></p>
                                <p class="w3-text-grey w3-large">
                                    <?= !empty($row['tinggi_gunung']) ? number_format($row['tinggi_gunung']) . ' mdpl' : 'Tinggi belum tersedia' ?>
                                </p>
                            </div>

                            <div class="w3-margin-bottom">
                                <p><i class="fa fa-clock w3-text-orange"></i> <b>Estimasi Waktu:</b></p>
                                <p class="w3-text-grey">
                                    <?= !empty($row['estimasi_waktu']) ? htmlspecialchars($row['estimasi_waktu']) : 'Estimasi waktu belum tersedia' ?>
                                </p>
                            </div>

                            <div class="w3-margin-bottom">
                                <p><i class="fa fa-money w3-text-orange"></i> <b>Biaya Paket:</b></p>
                                <p class="w3-text-green w3-large">
                                    <?php if (!empty($row['biaya_paket']) && $row['biaya_paket'] > 0): ?>
                                        Rp <?= number_format($row['biaya_paket'], 0, ',', '.') ?>
                                    <?php else: ?>
                                        <span class="w3-text-grey">Biaya belum tersedia</span>
                                    <?php endif; ?>
                                </p>
                            </div>

                            <div class="w3-margin-bottom">
                                <p><i class="fa fa-exclamation-triangle w3-text-orange"></i> <b>Tingkat Kesulitan:</b></p>
                                <div class="w3-margin-top">
                                    <?php
                                    $kesulitan = $row['kesulitan'] ?? '';
                                    $difficulty_class = '';
                                    $difficulty_text = '';

                                    switch (strtolower($kesulitan)) {
                                        case 'mudah':
                                            $difficulty_class = 'w3-green';
                                            $difficulty_text = 'MUDAH';
                                            break;
                                        case 'sedang':
                                            $difficulty_class = 'w3-yellow';
                                            $difficulty_text = 'SEDANG';
                                            break;
                                        case 'sulit':
                                            $difficulty_class = 'w3-orange';
                                            $difficulty_text = 'SULIT';
                                            break;
                                        case 'sangat sulit':
                                            $difficulty_class = 'w3-red';
                                            $difficulty_text = 'SANGAT SULIT';
                                            break;
                                        default:
                                            $difficulty_class = 'w3-grey';
                                            $difficulty_text = 'TIDAK DIKETAHUI';
                                    }
                                    ?>
                                    <span class="w3-tag <?= $difficulty_class ?> w3-round w3-small">
                                        <?= $difficulty_text ?>
                                    </span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="w3-row w3-margin-top">
                    <div class="w3-col l12">
                        <div class="w3-card w3-white w3-round w3-padding">
                            <h3 class="w3-text-orange"><b>Tips Pendakian</b></h3>
                            <div class="w3-row">
                                <div class="w3-col l6 m6 s12 w3-padding-right">
                                    <h4 class="w3-text-grey"><b>Persiapan Fisik</b></h4>
                                    <ul class="w3-text-grey">
                                        <li>Latihan kardio minimal 2 minggu sebelum pendakian</li>
                                        <li>Latihan hiking dengan beban</li>
                                        <li>Istirahat cukup sebelum pendakian</li>
                                    </ul>
                                </div>
                                <div class="w3-col l6 m6 s12">
                                    <h4 class="w3-text-grey"><b>Perlengkapan Wajib</b></h4>
                                    <ul class="w3-text-grey">
                                        <li>Sepatu gunung yang nyaman</li>
                                        <li>Jaket dan pakaian hangat</li>
                                        <li>Headlamp dan senter cadangan</li>
                                        <li>Sleeping bag dan matras</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Update -->
                <div class="w3-row w3-margin-top">
                    <div class="w3-col l12">
                        <div class="w3-panel w3-pale-yellow w3-border-yellow w3-round">
                            <p class="w3-small w3-text-grey">
                                <i class="fa fa-info-circle"></i>
                                <b>Dibuat:</b>
                                <?= !empty($row['created_at']) ? date('d F Y H:i', strtotime($row['created_at'])) : 'Tanggal tidak tersedia' ?>
                                |
                                <b>Terakhir diupdate:</b>
                                <?= !empty($row['updated_at']) ? date('d F Y H:i', strtotime($row['updated_at'])) : 'Belum pernah diupdate' ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="w3-container w3-center w3-padding-64">
            <div class="w3-card w3-white w3-round w3-padding">
                <i class="fa fa-exclamation-triangle w3-text-orange w3-jumbo"></i>
                <h3 class="w3-text-orange">Gunung Tidak Ditemukan</h3>
                <p class="w3-text-grey">Maaf, data gunung yang Anda cari tidak tersedia.</p>
                <a href="javascript:history.back()" class="w3-btn w3-orange w3-round w3-margin-top">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $stmt->close();
    $conn->close();
} else {
    ?>
    <div class="w3-container w3-center w3-padding-64">
        <div class="w3-card w3-white w3-round w3-padding">
            <i class="fa fa-exclamation-triangle w3-text-red w3-jumbo"></i>
            <h3 class="w3-text-red">ID Tidak Valid</h3>
            <p class="w3-text-grey">ID gunung tidak valid atau tidak diberikan.</p>
            <a href="javascript:history.back()" class="w3-btn w3-orange w3-round w3-margin-top">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>