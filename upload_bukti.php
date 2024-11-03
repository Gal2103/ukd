<!-- Form untuk meng-upload bukti pembayaran -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran</title>
</head>
<body>
    <h1>Upload Bukti Pembayaran</h1>
    <form action="upload_bukti_process.php" method="POST" enctype="multipart/form-data">
        <label for="judul_id">ID Judul:</label>
        <input type="number" name="judul_id" required>
        
        <label for="bukti">Pilih Bukti Pembayaran:</label>
        <input type="file" name="bukti" required>
        
        <button type="submit">Upload</button>
    </form>
</body>
</html>
