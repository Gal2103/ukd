<?php
session_start(); // Memulai sesi
include 'db_connect.php'; // Menghubungkan ke database

// Periksa apakah pengguna sudah login dan memiliki role 'prodi'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'prodi') {
    echo "Akses ditolak!";
    exit; // Menghentikan eksekusi
}

// Mengambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_id = $_POST['judul_id']; // ID judul yang statusnya akan diubah
    $status = $_POST['status']; // Status baru (diterima atau ditolak)
    $alasan = $_POST['alasan']; // Alasan (jika ditolak)

    // Memastikan status dan alasan sesuai jika status ditolak
    if ($status === 'ditolak' && empty($alasan)) {
        echo "Alasan harus diisi jika status ditolak!";
        exit; // Menghentikan eksekusi
    }

    // Menyiapkan query untuk mengupdate status judul
    $query = $conn->prepare("UPDATE judul SET status = ?, alasan_penolakan = ? WHERE id = ?");
    
    // Jika status diterima, set alasan ke NULL
    $alasan_to_bind = ($status === 'ditolak') ? $alasan : null; // Menyimpan alasan dalam variabel terpisah
    $query->bind_param("ssi", $status, $alasan_to_bind, $judul_id); // Mengikat parameter

    // Menjalankan query
    if ($query->execute()) {
        echo "Status judul skripsi berhasil diperbarui!";
    } else {
        echo "Gagal memperbarui status: " . $query->error;
    }
}
?>

