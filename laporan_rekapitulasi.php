<?php
session_start(); // Memulai sesi
include 'db_connect.php'; // Menghubungkan ke database

// Periksa apakah pengguna sudah login dan memiliki role 'staff'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    echo "Akses ditolak!";
    exit; // Menghentikan eksekusi
}

// Mengambil data rekapitulasi dari database
$query = "SELECT 
              COUNT(CASE WHEN status = 'diterima' THEN 1 END) AS jumlah_diterima,
              COUNT(CASE WHEN bukti_pembayaran IS NOT NULL AND bukti_pembayaran != '' THEN 1 END) AS jumlah_dibayar 
          FROM judul";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $jumlah_diterima = $row['jumlah_diterima'];
    $jumlah_dibayar = $row['jumlah_dibayar'];
} else {
    echo "Gagal mengambil data: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulasi</title>
    <link rel="stylesheet" href="style.css"> <!-- Tambahkan stylesheet jika perlu -->
</head>

<body>
    <h1>Laporan Rekapitulasi Judul Skripsi</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Total Judul Diterima</th>
                <th>Total Judul dengan Bukti Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $jumlah_diterima; ?></td>
                <td><?php echo $jumlah_dibayar; ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>