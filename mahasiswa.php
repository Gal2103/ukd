<!-- mahasiswa_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
</head>
<body>
    <h2>Pengajuan Judul Skripsi</h2>
    <form action="submit_judul.php" method="post">
        <label>Judul:</label>
        <input type="text" name="judul" required>
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea>
        <button type="submit">Ajukan Judul</button>
    </form>
</body>
</html>
