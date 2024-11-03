<?php
session_start(); // Memulai sesi
include 'db_connect.php'; // Menghubungkan ke database

// Periksa apakah pengguna sudah login dan memiliki role 'mahasiswa'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    echo "Akses ditolak!";
    exit; // Menghentikan eksekusi
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_id = $_POST['judul_id']; // ID judul yang berhubungan
    $target_dir = "uploads/"; // Folder tujuan untuk menyimpan file
    $target_file = $target_dir . basename($_FILES["bukti"]["name"]); // Path lengkap file
    $uploadOk = 1; // Flag untuk status upload
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Mendapatkan tipe file

    // Validasi tipe file
    $allowed_types = ['jpg', 'png', 'jpeg', 'pdf'];
    if (!in_array($fileType, $allowed_types)) {
        echo "Hanya file JPG, JPEG, PNG & PDF yang diperbolehkan.";
        $uploadOk = 0; // Set uploadOk ke 0 untuk menunjukkan bahwa upload gagal
    }

    // Cek apakah file sudah ada
    if (file_exists($target_file)) {
        echo "File sudah ada.";
        $uploadOk = 0; // Set uploadOk ke 0 untuk menunjukkan bahwa upload gagal
    }

    // Batasi ukuran file maksimum (misalnya 2MB)
    if ($_FILES["bukti"]["size"] > 2000000) {
        echo "Ukuran file terlalu besar. Maksimal 2MB.";
        $uploadOk = 0; // Set uploadOk ke 0 untuk menunjukkan bahwa upload gagal
    }

    // Cek apakah $uploadOk adalah 0, jika ya, maka upload gagal
    if ($uploadOk == 0) {
        echo "File tidak di-upload.";
    } else {
        // Jika semuanya baik-baik saja, coba unggah file
        if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($_FILES["bukti"]["name"])). " berhasil di-upload.";

            // Menyimpan informasi upload ke database
            $query = $conn->prepare("UPDATE judul SET bukti_pembayaran = ? WHERE id = ?");
            $query->bind_param("si", $target_file, $judul_id); // Mengikat parameter

            // Menjalankan query
            if ($query->execute()) {
                echo "Informasi bukti pembayaran berhasil disimpan!";
            } else {
                echo "Gagal menyimpan informasi: " . $query->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat meng-upload file.";
        }
    }
}
?>

