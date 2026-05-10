<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Arsip Surat</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background-color: #4e43a0; }
        .container { background: white; padding: 20px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; }
        
        .search-box { margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .search-box input[type="text"] { padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 5px; }
        .search-box button { padding: 10px 15px; background: #4e43a0; color: white; border: none; border-radius: 5px; cursor: pointer; }
        
        .btn-tambah { background: #28a745; color: white; padding: 10px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; color: white; }
        .bg-masuk { background: #28a745; }
        .bg-keluar { background: #ff0019; }
        .btn-aksi { padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 12px; color: white; margin-right: 2px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Arsip Surat Digital</h2>
        
        <div class="search-box">
            <a href="tambah.php" class="btn-tambah">+ Tambah Surat Baru</a>
            
            <form action="index.php" method="GET">
                <input type="text" name="cari" placeholder="Cari Surat" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                <button type="submit">Cari</button>
                <?php if(isset($_GET['cari'])): ?>
                    <a href="index.php" style="margin-left: 10px; text-decoration: none; color: red; font-size: 13px;">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal</th>
                    <th>Pengirim/Penerima</th>
                    <th>Keterangan</th>
                    <th>Perihal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                
                if(isset($_GET['cari'])){
                    $cari = $_GET['cari'];
                    $query = mysqli_query($koneksi, "SELECT * FROM surat WHERE 
                        nomor_surat LIKE '%$cari%' OR 
                        tgl_surat LIKE '%$cari%' OR 
                        pengirim LIKE '%$cari%' OR 
                        keterangan LIKE '%$cari%' OR 
                        perihal LIKE '%$cari%'");
                } else {
                    $query = mysqli_query($koneksi, "SELECT * FROM surat");
                }

                if(mysqli_num_rows($query) == 0){
                    echo "<tr><td colspan='7' style='text-align:center;'>Data tidak ditemukan.</td></tr>";
                }

                while($row = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><strong><?php echo $row['nomor_surat']; ?></strong></td>
                    <td><?php echo $row['tgl_surat']; ?></td>
                    <td><?php echo $row['pengirim']; ?></td>
                    <td>
                        <span class="badge <?php echo ($row['keterangan'] == 'Surat Masuk') ? 'bg-masuk' : 'bg-keluar'; ?>">
                            <?php echo $row['keterangan']; ?>
                        </span>
                    </td>
                    <td><?php echo $row['perihal']; ?></td>
                    <td>
                        <a href="lihat.php?id=<?php echo $row['id']; ?>" class="btn-aksi" style="background:#17a2b8;">Lihat</a>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-aksi" style="background:#ffc107; color: black;">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-aksi" style="background:#dc3545;" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>