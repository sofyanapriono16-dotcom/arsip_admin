<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM surat WHERE id = '$id'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Arsip</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background-color: #f4f7f6; }
        .container { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-update { width: 100%; padding: 12px; background: #218838; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-kembali { display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; }
        .file-info { font-size: 12px; color: #555; margin-top: 5px; background: #e9ecef; padding: 5px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-kembali">← Kembali</a>
        <h2>Edit Data Arsip</h2>
        
        <!-- PENTING: Tambahkan enctype agar bisa kirim file -->
        <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            
            <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" name="no_surat" value="<?php echo $data['nomor_surat']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="date" name="tgl_surat" value="<?php echo $data['tgl_surat']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Pengirim/Penerima</label>
                <input type="text" name="pengirim" value="<?php echo $data['pengirim']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Keterangan Surat</label>
                <select name="keterangan" required>
                    <option value="Surat Masuk" <?php if($data['keterangan'] == 'Surat Masuk') echo 'selected'; ?>>Surat Masuk</option>
                    <option value="Surat Keluar" <?php if($data['keterangan'] == 'Surat Keluar') echo 'selected'; ?>>Surat Keluar</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Perihal</label>
                <textarea name="perihal" rows="3" required><?php echo $data['perihal']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Ganti File Surat (Kosongkan jika tidak ingin diganti)</label>
                <input type="file" name="file_surat">
                <div class="file-info">
                    <strong>File saat ini:</strong> <?php echo $data['file_surat']; ?>
                </div>
            </div>
            
            <button type="submit" class="btn-update">UPDATE DATA</button>
        </form>
    </div>
</body>
</html>