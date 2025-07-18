<?php
include '../dashboard/header.php';
include '../dashboard/sidebar.php';
include '../config/koneksi.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM jadwal_pendakian WHERE id = $id")->fetch_assoc();
?>

<main class="p-4 w-100 bg-light" style="min-height: 100vh;">
  <div class="container bg-white p-4 rounded shadow-sm">
    <h2 class="mb-4 text-primary">Edit Jadwal Pendakian</h2>
    <form action="jadwal_edit_aksi.php" method="POST">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">
      <div class="mb-3">
        <label class="form-label">Gunung</label>
        <select name="id_gunung" class="form-control" required>
          <?php
          $gunung = $conn->query("SELECT * FROM gunung");
          while ($row = $gunung->fetch_assoc()) {
            $selected = ($row['id'] == $data['id_gunung']) ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>{$row['nama_gunung']}</option>";
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Keberangkatan</label>
        <input type="date" name="tanggal_keberangkatan" class="form-control" value="<?= $data['tanggal_keberangkatan'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Pulang</label>
        <input type="date" name="tanggal_pulang" class="form-control" value="<?= $data['tanggal_pulang'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Kuota Peserta</label>
        <input type="number" name="kuota" class="form-control" value="<?= $data['kuota'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
          <option value="buka" <?= ($data['status'] == 'buka') ? 'selected' : '' ?>>Dibuka</option>
          <option value="tutup" <?= ($data['status'] == 'tutup') ? 'selected' : '' ?>>Ditutup</option>
          <option value="penuh" <?= ($data['status'] == 'penuh') ? 'selected' : '' ?>>Penuh</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</main>

<?php include '../dashboard/footer.php'; ?>