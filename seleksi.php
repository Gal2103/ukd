<!-- Form untuk mengupdate status -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Judul Skripsi</title>
</head>

<body>
    <h1>Update Status Judul Skripsi</h1>
    <form action="update_status.php" method="POST">
        <?php
        include 'db_connect.php';
        $query = $conn->query("SELECT * FROM judul WHERE status = 'menunggu'");
        while ($judul = $query->fetch_assoc()) {
            echo "<p>Judul_Id: {$judul['id']}</p>";
            echo "<p>Judul: {$judul['judul']}</p>";
            echo "<p>Deskripsi: {$judul['deskripsi']}</p>";
            echo "<p>Status: {$judul['status']}</p>";
        }
        ?>
        <label for="judul_id">ID Judul:</label>
        <input type="number" name="judul_id" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="diterima">Diterima</option>
            <option value="ditolak">Ditolak</option>
        </select><br><br>

        <label for="alasan_penolakan">Alasan (hanya jika ditolak):</label>
        <textarea name="alasan"></textarea><br><br>

        <button type="submit">Update Status</button>
    </form>
</body>

</html>