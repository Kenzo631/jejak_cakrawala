<?php
include '../dashboard/header.php';
include '../dashboard/sidebar.php';
include '../config/koneksi.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM gunung WHERE id = $id")->fetch_assoc();
?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
  <div class="container bg-white p-4 rounded shadow-sm">
    <h2 class="mb-4 text-primary">Edit Gunung</h2>
    <form action="gunung_edit_aksi.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">
      
      <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Nama Gunung <span class="text-danger">*</span></label>
            <input type="text" name="nama_gunung" class="form-control" value="<?= htmlspecialchars($data['nama_gunung']) ?>" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Jalur Pendakian <span class="text-danger">*</span></label>
            <input type="text" name="jalur_gunung" class="form-control" value="<?= htmlspecialchars($data['jalur_gunung']) ?>" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Lokasi <span class="text-danger">*</span></label>
            <input type="text" name="lokasi_gunung" class="form-control" value="<?= htmlspecialchars($data['lokasi_gunung']) ?>" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Tinggi (mdpl) <span class="text-danger">*</span></label>
            <input type="number" name="tinggi_gunung" class="form-control" value="<?= $data['tinggi_gunung'] ?>" required>
          </div>
        </div>
        
        <!-- Kolom Kanan -->
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Estimasi Waktu <span class="text-danger">*</span></label>
            <input type="text" name="estimasi_waktu" class="form-control" value="<?= htmlspecialchars($data['estimasi_waktu']) ?>" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Biaya Paket <span class="text-danger">*</span></label>
            <input type="number" name="biaya_paket" class="form-control" value="<?= $data['biaya_paket'] ?>" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Tingkat Kesulitan <span class="text-danger">*</span></label>
            <select name="kesulitan" class="form-select" required>
              <option value="mudah" <?= $data['kesulitan'] == 'mudah' ? 'selected' : '' ?>>Mudah</option>
              <option value="sedang" <?= $data['kesulitan'] == 'sedang' ? 'selected' : '' ?>>Sedang</option>
              <option value="sulit" <?= $data['kesulitan'] == 'sulit' ? 'selected' : '' ?>>Sulit</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
          </div>
        </div>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Ganti Gambar (kosongkan jika tidak ingin diganti)</label>
        <input type="file" name="gambar_gunung" class="form-control" accept="image/*">
        <?php if (!empty($data['gambar_gunung'])): ?>
          <div class="mt-2">
            <img src="../assets/images/<?= htmlspecialchars($data['gambar_gunung']) ?>" width="200" class="img-thumbnail">
            <p class="text-muted mt-1">Gambar saat ini</p>
          </div>
        <?php endif; ?>
      </div>
      
      <div class="d-flex justify-content-between">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Update Data</button>
      </div>
    </form>
  </div>
</main>

<?php include '../dashboard/footer.php'; ?>