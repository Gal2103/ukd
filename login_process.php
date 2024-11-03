<?php
session_start(); // Memulai sesi
include 'db_connect.php'; // Menghubungkan ke database

// Mengambil username dan password dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Menyiapkan query untuk mengambil data pengguna berdasarkan username
$query = $conn->prepare("SELECT * FROM users WHERE username = ?");
$query->bind_param("s", $username); // Mengikat parameter
$query->execute(); // Menjalankan query
$result = $query->get_result(); // Mendapatkan hasil query

// Memeriksa apakah pengguna ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Mengambil data pengguna

    // Meng-hash password yang dimasukkan menggunakan MD5
    $hashed_password = md5($password);

    // Memverifikasi apakah password yang di-hash cocok dengan password yang tersimpan
    if ($hashed_password === $user['password']) {
        // Jika password cocok, simpan informasi pengguna di session
        $_SESSION['user_id'] = $user['id']; // Menyimpan ID pengguna
        $_SESSION['role'] = $user['role'];   // Menyimpan role pengguna

        // Arahkan pengguna ke dashboard berdasarkan role
        switch ($user['role']) {
            case 'mahasiswa':
                header("Location: mahasiswa_dashboard.php");
                break;
            case 'prodi':
                header("Location: prodi_dashboard.php");
                break;
            case 'staff':
                header("Location: staff_dashboard.php");
                break;
            default:
                echo "Role tidak dikenal!";
        }
        exit; // Menghentikan eksekusi setelah redirect
    } else {
        // Jika password salah
        echo "Password salah!";
    }
} else {
    // Jika username tidak ditemukan
    echo "Username tidak ditemukan!";
}
?>
