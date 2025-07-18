<?php
include 'header.php';

?>

<div class="w3-container w3-padding-64" id="projects" data-aos="fade-up" data-aos-delay="300">
    <h2 class="w3-center w3-xxlarge orange-button"><b>Form Pendaftaran Pendaki</b></h2>
    <hr style="width:60px; border: 3px solid #C89B4B" class="w3-round w3-margin-bottom">



    <?php
    // Display error messages
    if (isset($_GET['error'])) {
        $error_messages = [
            'required' => 'Harap lengkapi semua field!',
            'email' => 'Format email tidak valid!',
            'kuota' => 'Kuota pendakian tidak mencukupi!',
            'database' => 'Terjadi kesalahan database!',
            'system' => 'Terjadi kesalahan sistem!',
            'quota_exceeded' => 'Kuota pendakian tidak mencukupi!',
            'no_file' => 'Harap upload file identitas!',
            'invalid_file_type' => 'Format file harus JPG, PNG, atau PDF',
            'file_too_large' => 'Ukuran file maksimal 2MB',
            'upload_failed' => 'Gagal mengupload file identitas'
        ];

        $error_code = $_GET['error'];
        $message = $error_messages[$error_code] ?? 'Terjadi kesalahan!';

        echo '<div class="alert alert-danger alert-dismissible fade show mb-4">
                ' . htmlspecialchars($message) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    $id_gunung = $_GET['id_gunung'] ?? null;

    ?>

    <form action="pendaki_tambah_aksi.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control" required maxlength="100">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required maxlength="100">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                    <input type="tel" name="no_telepon" class="form-control" required maxlength="20" pattern="[0-9]+">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" required rows="3"></textarea>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Gunung <span class="text-danger">*</span></label>
                    <select name="id_gunung" class="form-select" id="gunungSelect" required>
                        <option value="">Pilih Gunung</option>
                        <?php
                        if ($id_gunung) {
                            $query = "SELECT id, nama_gunung FROM gunung WHERE id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $id_gunung);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}' selected>{$row['nama_gunung']}</option>";
                            }
                            $stmt->close();
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pendakian <span class="text-danger">*</span></label>
                    <select name="id_jadwal" class="form-select" id="jadwalSelect" required>
                        <option value="">Pilih gunung terlebih dahulu</option>
                    </select>
                    <small class="text-muted" id="kuotaInfo"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Orang <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_orang" class="form-control" required min="1" id="jumlahOrang">
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Identitas (KTP/SIM) <span class="text-danger">*</span></label>
                    <input type="file" name="identitas" class="form-control" accept="image/*,.pdf" required>
                    <small class="text-muted">Format: JPG, PNG, PDF (max 2MB)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan Tambahan</label>
                    <textarea name="catatan" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </div>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const gunungSelect = document.getElementById('gunungSelect');
    if (gunungSelect.value) {
        const event = new Event('change');
        gunungSelect.dispatchEvent(event);
    }
});

    document.getElementById('gunungSelect').addEventListener('change', function () {
        const gunungId = this.value;
        const jadwalSelect = document.getElementById('jadwalSelect');

        if (gunungId) {
            jadwalSelect.innerHTML = '<option value="">Memuat jadwal...</option>';

            fetch(`get_jadwal.php?gunung_id=${gunungId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }

                    jadwalSelect.innerHTML = data.data.length > 0
                        ? '<option value="">Pilih Tanggal</option>'
                        : '<option value="">Tidak ada jadwal tersedia</option>';

                    data.data.forEach(jadwal => {
                        const option = new Option(
                            `${jadwal.tanggal} s/d ${jadwal.tanggal_pulang} (Kuota: ${jadwal.kuota})`,
                            jadwal.id
                        );
                        option.dataset.kuota = jadwal.kuota;
                        jadwalSelect.add(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    jadwalSelect.innerHTML = `<option value="">Error: ${error.message}</option>`;
                });
        } else {
            jadwalSelect.innerHTML = '<option value="">Pilih gunung terlebih dahulu</option>';
        }
    });

    // Validasi kuota saat memilih jadwal
    document.getElementById('jadwalSelect').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const kuotaInfo = document.getElementById('kuotaInfo');
        const jumlahOrangInput = document.getElementById('jumlahOrang');

        if (selectedOption.value && selectedOption.dataset.kuota) {
            const kuota = parseInt(selectedOption.dataset.kuota);
            kuotaInfo.textContent = `Kuota tersedia: ${kuota} orang`;
            jumlahOrangInput.max = kuota;

            if (parseInt(jumlahOrangInput.value) > kuota) {
                jumlahOrangInput.value = kuota;
            }
        } else {
            kuotaInfo.textContent = '';
            jumlahOrangInput.removeAttribute('max');
        }
    });
</script>

<?php include 'footer.php'; ?>