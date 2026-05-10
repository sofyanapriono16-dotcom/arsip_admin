<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Surat Baru</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background-color: #4e43a0; }
        .container { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-simpan { width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-kembali { display: inline-block; margin-bottom: 20px; color: #4e43a0; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-kembali">← Kembali ke Daftar</a>
        <h2>Tambah Arsip Surat Baru</h2>
        <!-- PENTING: enctype="multipart/form-data" wajib ada untuk upload file -->
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" name="no_surat" placeholder="Contoh: 001/ADM/2026" required>
            </div>
            <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="date" name="tgl_surat" required>
            </div>
            <div class="form-group">
                <label>Pengirim/Penerima</label>
                <input type="text" name="pengirim" placeholder="Nama Pengirim/Penerima" required>
            </div>
            <div class="form-group">
                <label>Keterangan Surat</label>
                <select name="keterangan" required>
                    <option value="">-- Pilih Keterangan --</option>
                    <option value="Surat Masuk">Surat Masuk</option>
                    <option value="Surat Keluar">Surat Keluar</option>
                </select>
            </div>
            <div class="form-group">
                <label>Perihal</label>
                <textarea name="perihal" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Upload File Surat (PDF/Word/Foto)</label>
                <input type="file" name="file_surat" required>
                <small style="color: red;">*Format dibolehkan: pdf, doc, docx, jpg, png, jpeg</small>
            </div>
            <button type="submit" class="btn-simpan">SIMPAN ARSIP</button>
        </form>
    </div>
</body>
</html>