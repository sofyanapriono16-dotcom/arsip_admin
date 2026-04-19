<?php
// --- 1. KONEKSI DATABASE ---
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Arsip Surat Digital</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 40px; background-color: #090088be; }
        .container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #0a038d; }
        
        /* Baris Atas (Tombol & Form Cari) */
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        
        /* Tombol & Form */
        .btn { padding: 8px 12px; border-radius: 5px; text-decoration: none; font-size: 14px; color: white; border: none; cursor: pointer; }
        .btn-tambah { background: #28a745; }
        .btn-cari { background: #007bff; }
        .btn-edit { background: #ffc107; color: #001a79; }
        .btn-hapus { background: #dc3545; }
        .btn-lihat { background: #17a2b8; }
        
        input[type="text"] { padding: 8px; width: 250px; border: 1px solid #ddd; border-radius: 5px; }

        /* Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; border: 1px solid #eee; text-align: left; }
        th { background-color: #f8f9fa; color: #333; }
        tr:hover { background-color: #f9f9f9; }
    </style>
</head>
<body>

<div class="container">
    <h2>📂 Daftar Arsip Surat Digital</h2>
    
    <div class="top-bar">
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Surat Baru</a>

        <form action="index.php" method="GET">
            <input type="text" name="cari" placeholder="Cari surat..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
            <button type="submit" class="btn btn-cari">Cari</button>
            <a href="index.php" style="font-size: 12px; color: #666; margin-left: 5px;">Reset</a>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th width="200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // --- LOGIKA PENCARIAN ---
            if (isset($_GET['cari']) && $_GET['cari'] != "") {
                $keyword = $_GET['cari'];
                $query = mysqli_query($koneksi, "SELECT * FROM surat WHERE 
                          nomor_surat LIKE '%$keyword%' OR 
                          pengirim LIKE '%$keyword%' OR 
                          perihal LIKE '%$keyword%' 
                          ORDER BY id DESC");
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM surat ORDER BY id DESC");
            }

            $no = 1;
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><strong><?php echo $data['nomor_surat']; ?></strong></td>
                    <td><?php echo $data['tgl_surat']; ?></td>
                    <td><?php echo $data['pengirim']; ?></td>
                    <td><?php echo $data['perihal']; ?></td>
                    <td>
                        <a href="uploads/<?php echo $data['file_surat']; ?>" target="_blank" class="btn btn-lihat">Lihat</a>
                        
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-edit">Edit</a>
                        
                        <a href="hapus.php?id=<?php echo $data['id']; ?>" 
                           class="btn btn-hapus" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus arsip ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>Data tidak ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>