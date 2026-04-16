<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM surat WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Arsip Surat</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        form { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; width: 400px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; box-sizing: border-box; }
    </style>
</head>
<body>
    <h2>Edit Data Arsip</h2>
    <a href="index.php"> Kembali</a>
    <br><br>

    <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <label>Nomor Surat</label>
        <input type="text" name="nomor_surat" value="<?php echo $data['nomor_surat']; ?>" required>

        <label>Tanggal Surat</label>
        <input type="date" name="tgl_surat" value="<?php echo $data['tgl_surat']; ?>" required>

        <label>Pengirim</label>
        <input type="text" name="pengirim" value="<?php echo $data['pengirim']; ?>" required>

        <label>Perihal</label>
        <textarea name="perihal" required><?php echo $data['perihal']; ?></textarea>

        <label>File Sekarang: <?php echo $data['file_surat']; ?></label><br>
        <small style="color:red;">*Kosongkan jika tidak ingin ganti file</small>
        <input type="file" name="file_surat">

        <button type="submit" style="background:orange; color:white; padding:10px; border:none; width:100%; cursor:pointer;">UPDATE DATA</button>
    </form>
</body>
</html>