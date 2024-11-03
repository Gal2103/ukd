<!-- Form untuk meng-upload surat pengantar -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Surat Pengantar</title>
</head>

<body>
    <h1>Upload Surat Pengantar</h1>
    <form action="upload_surat_process.php" method="POST" enctype="multipart/form-data">
        <label for="judul_id">ID Judul:</label>
        <input type="number" name="judul_id" required>

        <label for="surat">Pilih Surat Pengantar:</label>
        <input type="file" name="surat" required>

        <button type="submit">Upload</button>
    </form>
</body>

</html>