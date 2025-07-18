<?php
include '../dashboard/header.php';
include '../dashboard/sidebar.php';
include '../config/koneksi.php';

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?error=invalid_id");
    exit;
}

$id = (int)$_GET['id'];

// Gunakan prepared statement untuk keamanan
$query = "SELECT p.*, j.id_gunung, j.tanggal_keberangkatan, j.tanggal_pulang, g.nama_gunung 
          FROM pendaftar_pendakian p 
          JOIN jadwal_pendakian j ON p.id_jadwal = j.id
          JOIN gunung g ON j.id_gunung = g.id
          WHERE p.id = ?";
          
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("<div class='alert alert-danger'>Error preparing query: " . $conn->error . "</div>");
}

$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("<div class='alert alert-danger'>Error executing query: " . $stmt->error . "</div>");
}

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    header("Location: index.php?error=data_not_found");
    exit;
}
?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
  <div class="container bg-white p-4 rounded shadow-sm">
    <h2 class="mb-4 text-primary">Edit Data Pendaki</h2>
    
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show mb-4">
        <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    
    <form action="pendaki_edit_aksi.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
      
      <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nama_lengkap" class="form-control" 
                   value="<?= htmlspecialchars($data['nama_lengkap'] ?? '') ?>" required maxlength="100">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" 
                   value="<?= htmlspecialchars($data['email'] ?? '') ?>" required maxlength="100">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
            <input type="tel" name="no_telepon" class="form-control" 
                   value="<?= htmlspecialchars($data['no_telepon'] ?? '') ?>" required maxlength="20" pattern="[0-9]+">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Alamat <span class="text-danger">*</span></label>
            <textarea name="alamat" class="form-control" required rows="3"><?= 
              htmlspecialchars($data['alamat'] ?? '') ?></textarea>
          </div>
        </div>
        
        <!-- Kolom Kanan -->
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Gunung <span class="text-danger">*</span></label>
            <select name="id_gunung" class="form-select" id="gunungSelect" required>
              <option value="">Pilih Gunung</option>
              <?php
              $gunung_query = "SELECT * FROM gunung ORDER BY nama_gunung";
              $gunung_result = $conn->query($gunung_query);
              
              while ($row = $gunung_result->fetch_assoc()) {
                $selected = ($row['id'] == $data['id_gunung']) ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['nama_gunung']}</option>";
              }
              ?>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Tanggal Pendakian <span class="text-danger">*</span></label>
            <select name="id_jadwal" class="form-select" id="jadwalSelect" required>
              <option value="<?= $data['id_jadwal'] ?>" selected>
                <?= date('d-m-Y', strtotime($data['tanggal_keberangkatan'])) ?> s/d 
                <?= date('d-m-Y', strtotime($data['tanggal_pulang'])) ?>
              </option>
            </select>
            <small class="text-muted" id="kuotaInfo"></small>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Jumlah Orang <span class="text-danger">*</span></label>
            <input type="number" name="jumlah_orang" class="form-control" 
                   value="<?= htmlspecialchars($data['jumlah_orang'] ?? '') ?>" required min="1" id="jumlahOrang">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="pending" <?= ($data['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
              <option value="diterima" <?= ($data['status'] == 'diterima') ? 'selected' : '' ?>>Diterima</option>
              <option value="ditolak" <?= ($data['status'] == 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Catatan Tambahan</label>
            <textarea name="catatan" class="form-control" rows="2"><?= 
              htmlspecialchars($data['catatan'] ?? '') ?></textarea>
          </div>
        </div>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Identitas Saat Ini</label>
        <div>
          <?php if (!empty($data['identitas'])): ?>
            <a href="../uploads/<?= htmlspecialchars($data['identitas']) ?>" target="_blank" class="btn btn-sm btn-info">
              Lihat Dokumen
            </a>
            <span class="ms-2"><?= htmlspecialchars($data['identitas']) ?></span>
          <?php else: ?>
            <span class="text-muted">Tidak ada file identitas</span>
          <?php endif; ?>
        </div>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Ubah Identitas (KTP/SIM)</label>
        <input type="file" name="identitas" class="form-control" accept="image/*,.pdf">
        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah. Format: JPG, PNG, PDF (max 2MB)</small>
      </div>
      
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="index.php" class="btn btn-secondary me-md-2">Kembali</a>
        <button type="submit" class="btn btn-primary">Update Data</button>
      </div>
    </form>
  </div>
</main>

<script>
document.getElementById('gunungSelect').addEventListener('change', function() {
  const gunungId = this.value;
  const jadwalSelect = document.getElementById('jadwalSelect');
  const kuotaInfo = document.getElementById('kuotaInfo');
  
  if (gunungId) {
    jadwalSelect.innerHTML = '<option value="">Memuat jadwal...</option>';
    
    fetch(`get_jadwal.php?gunung_id=${gunungId}`)
      .then(response => {
        if (!response.ok) throw new Error('Gagal memuat jadwal');
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
        kuotaInfo.textContent = '';
      });
  } else {
    jadwalSelect.innerHTML = '<option value="">Pilih gunung terlebih dahulu</option>';
    kuotaInfo.textContent = '';
  }
});

// Validasi kuota saat memilih jadwal
document.getElementById('jadwalSelect').addEventListener('change', function() {
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

<?php include '../dashboard/footer.php'; ?>

<?php
// Tutup koneksi
$stmt->close();
$conn->close();
?>