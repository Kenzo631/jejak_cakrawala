<?php include '../dashboard/header.php'; ?>
<?php include '../dashboard/sidebar.php'; ?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
  <div class="container bg-white p-4 rounded shadow-sm">
    <h2 class="mb-4 text-primary">Tambah Jadwal Pendakian</h2>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="jadwal_tambah_aksi.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Gunung</label>
        <select name="id_gunung" class="form-control" required>
          <?php
          include '../config/koneksi.php';
          $gunung = $conn->query("SELECT * FROM gunung");
          while ($row = $gunung->fetch_assoc()) {
              echo "<option value='{$row['id']}'>{$row['nama_gunung']}</option>";
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Keberangkatan</label>
        <input type="date" name="tanggal_keberangkatan" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Pulang</label>
        <input type="date" name="tanggal_pulang" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Kuota Peserta</label>
        <input type="number" name="kuota" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
          <option value="buka">Dibuka</option>
          <option value="tutup">Ditutup</option>
          <option value="penuh">Penuh</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</main>

<?php include '../dashboard/footer.php'; ?>
