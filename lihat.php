<?php
include "koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM surat WHERE id = '$id'");
$data = mysqli_fetch_array($query);

if(!$data) { die("Data tidak ditemukan."); }

$file = $data['file_surat'];
$ekstensi = pathinfo($file, PATHINFO_EXTENSION);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pratinjau Arsip</title>
    <style>
        body { font-family: sans-serif; background: #4e43a0; padding: 20px; text-align: center; }
        .box { background: white; padding: 20px; border-radius: 10px; display: inline-block; width: 90%; max-width: 900px; }
        .btn-kembali { display: inline-block; margin-bottom: 15px; padding: 8px 15px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; }
        .btn-download { display: inline-block; padding: 10px 20px; background: #17a2b8; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="box">
        <a href="index.php" class="btn-kembali">← Kembali</a>
        <h3>Pratinjau Surat: <?php echo $data['nomor_surat']; ?></h3>
        <hr>
        <div style="margin-top: 20px;">
            <?php 
            if(in_array($ekstensi, ['jpg', 'jpeg', 'png'])){
                echo '<img src="uploads/'.$file.'" style="max-width:100%; border: 1px solid #ddd;">';
            } elseif($ekstensi == 'pdf'){
                echo '<embed src="uploads/'.$file.'" type="application/pdf" width="100%" height="700px">';
            } else {
                echo '<div style="padding: 50px; border: 2px dashed #ccc;">';
                echo '<p>File <strong>.'.$ekstensi.'</strong> (Word/Doc) tidak dapat ditampilkan langsung.</p>';
                echo '<a href="uploads/'.$file.'" class="btn-download" download>Download untuk Melihat Isi</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>