<?php
require_once __DIR__ . '/../config/koneksi.php';
// $query = "SELECT * FROM artikel WHERE status = 1 ORDER BY artikel_id
// DESC";
$query = "SELECT * FROM gunung LIMIT 4";
$result = $conn->query($query);
function formatTanggalIndo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $pecah = explode('-', $tanggal); // format: yyyy-MM-dd
    $tahun = $pecah[0];
    $bulanAngka = (int) $pecah[1];
    $hari = $pecah[2];

    return $hari . ' ' . $bulan[$bulanAngka] . ' ' . $tahun;
}
function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Jejak Cakrawala</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="/assets/css/welcome.css?v=7">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS (sebelum </body>) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- Page content -->
    <div class="w3-content w3-padding" style="max-width:1564px;"></div>
    <?php include 'navbar.php' ?>