<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Arsip Surat</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 40px; background-color: #f4f7f6; }
        .container { background: white; width: 450px; border: 1px solid #ddd; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin: auto; }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; display: block; margin-top: 10px; color: #555; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { background: #28a745; color: white; padding: 12px; border: none; cursor: pointer; width: 100%; border-radius: 5px; font-size: 16px; margin-top: 20px; }
        button:hover { background: #218838; }
        .back-link { display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Arsip Surat</h2>
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            <label>Nomor Surat</label>
            <input type="text" name="nomor_surat" placeholder="Contoh: 001/ADM/2026" required>

            <label>Tanggal Surat</label>
            <input type="date" name="tgl_surat" required>

            <label>Pengirim / Penerima</label>
            <input type="text" name="pengirim" placeholder="Nama Pengirim atau Penerima" required>

            <label>Perihal</label>
            <textarea name="perihal" rows="3" placeholder="Isi ringkas surat" required></textarea>

            <label>Upload Dokumen (PDF)</label>
            <input type="file" name="file_surat" accept=".pdf,image/*" required>

            <button type="submit">Simpan ke Database</button>
            <a href="index.php" class="back-link">← Kembali ke Daftar</a>
        </form>
    </div>
</body>
</html>