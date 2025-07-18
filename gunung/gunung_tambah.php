<?php include '../dashboard/header.php'; ?>
<?php include '../dashboard/sidebar.php'; ?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
  <div class="container bg-white p-4 rounded shadow-sm">
    <h2 class="mb-4 text-primary">Tambah Gunung</h2>
    <form action="gunung_tambah_aksi.php" method="POST" enctype="multipart/form-data">
      <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Nama Gunung <span class="text-danger">*</span></label>
            <input type="text" name="nama_gunung" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Jalur Pendakian <span class="text-danger">*</span></label>
            <input type="text" name="jalur_gunung" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Lokasi <span class="text-danger">*</span></label>
            <input type="text" name="lokasi_gunung" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Tinggi (mdpl) <span class="text-danger">*</span></label>
            <input type="number" name="tinggi_gunung" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Estimasi Waktu <span class="text-danger">*</span></label>
            <input type="text" name="estimasi_waktu" class="form-control" placeholder="Contoh: 2 hari 1 malam" required>
          </div>
        </div>
        
        <!-- Kolom Kanan -->
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Biaya Paket (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="biaya_paket" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Tingkat Kesulitan <span class="text-danger">*</span></label>
            <select name="kesulitan" class="form-select" required>
              <option value="mudah">Mudah</option>
              <option value="sedang" selected>Sedang</option>
              <option value="sulit">Sulit</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Gambar <span class="text-danger">*</span></label>
            <input type="file" name="gambar_gunung" class="form-control" accept="image/*" required>
            <small class="text-muted">Format: JPG, PNG </small>
          </div>
        </div>
      </div>
      
      <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
        <a href="index.php" class="btn btn-secondary me-md-2">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</main>

<?php include '../dashboard/footer.php'; ?>