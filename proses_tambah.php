<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_arsip_admin";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nomor_surat = $_POST['nomor_surat'];
$tgl_surat   = $_POST['tgl_surat'];
$pengirim    = $_POST['pengirim'];
$perihal     = $_POST['perihal'];

$nama_file   = $_FILES['file_surat']['name'];
$tmp_name    = $_FILES['file_surat']['tmp_name'];
$lokasi      = "uploads/" . $nama_file;

if (move_uploaded_file($tmp_name, $lokasi)) {
    $query = "INSERT INTO surat (nomor_surat, tgl_surat, pengirim, perihal, file_surat) 
              VALUES ('$nomor_surat', '$tgl_surat', '$pengirim', '$perihal', '$nama_file')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('BERHASIL! Data sudah masuk.'); window.location='index.php';</script>";
    } else {
        echo "Error Database: " . mysqli_error($koneksi);
    }
} else {
    echo "Gagal upload. Pastikan folder 'uploads' ada di folder arsip_admin!";
}
?>