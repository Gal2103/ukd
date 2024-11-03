<?php
session_start();
include 'db_connect.php';

// Cek apakah pengguna adalah mahasiswa dan telah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    echo "Akses ditolak!";
    exit;
}

// Ambil data dari form pengajuan
$mahasiswa_id = $_SESSION['user_id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

// Validasi input
if (empty($judul) || empty($deskripsi)) {
    echo "Judul dan deskripsi harus diisi!";
    exit;
}

try {
    // Insert data pengajuan judul ke database
    $query = $conn->prepare("INSERT INTO judul (mahasiswa_id, judul, deskripsi, status) VALUES (?, ?, ?, 'menunggu')");
    $query->bind_param("iss", $mahasiswa_id, $judul, $deskripsi);
    $query->execute();

    // Redirect ke halaman dashboard mahasiswa dengan pesan sukses
    header("Location: mahasiswa_dashboard.php?pesan=sukses");
    exit;
} catch (Exception $e) {
    // Tampilkan pesan error jika terjadi kesalahan
    echo "Pengajuan judul gagal: " . $e->getMessage();
}
