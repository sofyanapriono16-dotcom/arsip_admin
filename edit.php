<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM surat WHERE id = '$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Arsip</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 40px; background-color: #f4f7f6; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto; }
        h2 { color: #333; margin-top: 0; }
        .btn-kembali { display: inline-block; padding: 8px 16px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-size: 14px; margin-bottom: 20px; transition: 0.3s; }
        .btn-kembali:hover { background-color: #5a6268; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        textarea { height: 80px; resize: vertical; }
        .file-info { font-size: 13px; color: #666; margin-top: 5px; background: #f9f9f9; padding: 10px; border-radius: 5px; }
        .btn-update { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-update:hover { background-color: #218838; }
        .red-text { color: red; font-size: 12px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Data Arsip</h2>
        <a href="index.php" class="btn-kembali">← Kembali</a>

        <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" name="nomor_surat" value="<?php echo $data['nomor_surat']; ?>" required>
            </div>

            <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="date" name="tgl_surat" value="<?php echo $data['tgl_surat']; ?>" required>
            </div>

            <div class="form-group">
                <label>Pengirim</label>
                <input type="text" name="pengirim" value="<?php echo $data['pengirim']; ?>" required>
            </div>

            <div class="form-group">
                <label>Perihal</label>
                <textarea name="perihal" required><?php echo $data['perihal']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Ganti File (PDF/Gambar)</label>
                <div class="file-info">
                    File Sekarang: <strong><?php echo $data['file_surat']; ?></strong><br>
                    <span class="red-text">*Kosongkan jika tidak ingin ganti file</span>
                </div>
                <input type="file" name="file_arsip" style="margin-top: 10px;">
            </div>

            <button type="submit" class="btn-update">UPDATE DATA</button>
        </form>
    </div>

</body>
</html>