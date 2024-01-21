<?php
// session_start();
include ('../config/conn.php');
include ('../config/function.php');
?>
<html>

<head>
    <style>
    h2 {
        padding: 0px;
        margin: 0px;
        font-size: 14pt;
    }

    h4 {
        font-size: 12pt;
    }

    text {
        padding: 0px;
    }

    table {
        border-collapse: collapse;
        border: 1px solid #000;
        font-size: 11pt;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 5px;
    }

    table.tab {
        table-layout: auto;
        width: 100%;
    }
    </style>
    <title>Cetak Laporan Laba Rugi </title>
</head>

<?php
// Ambil tanggal hari ini
$now = date('Y-m-d');

// Query to calculate total income (Barang Masuk)
            $query_masuk = mysqli_query($con, "SELECT SUM(hargabeli * jumlah) AS total_masuk FROM barang_masuk WHERE tanggal='$now'") or die(mysqli_error($con));
            $result_masuk = mysqli_fetch_assoc($query_masuk);
            $total_masuk = $result_masuk['total_masuk'];

            // Query to calculate total expenses (Barang Keluar)
            $query_keluar = mysqli_query($con, "SELECT SUM(hargajual * jumlah) AS total_keluar FROM barang_keluar WHERE tanggal='$now'") or die(mysqli_error($con));
            $result_keluar = mysqli_fetch_assoc($query_keluar);
            $total_keluar = $result_keluar['total_keluar'];

// Calculate Laba Rugi
$laba_rugi = $total_masuk - $total_keluar;

// Output laporan laba rugi
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Laba Rugi</title>
    <!-- Tambahkan link stylesheet atau style sesuai kebutuhan Anda -->
</head>

<body>
    <h1>Laporan Laba Rugi Hari Ini</h1>
    <p>Tanggal: <?= date('d-m-Y', strtotime($now)); ?></p>

    <p>Total Pendapatan (Barang Masuk): <?= number_format($total_masuk, 0, ',', '.'); ?></p>
    <p>Total Pengeluaran (Barang Keluar): <?= number_format($total_keluar, 0, ',', '.'); ?></p>
    <h2>Laba Rugi: <?= number_format($laba_rugi, 0, ',', '.'); ?></h2>
</body>

</html>

<script>
window.print();
</script>