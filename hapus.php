<?php
include "koneksi.php";

$id = $_GET['id'];

$get_file = mysqli_query($koneksi, "SELECT file_surat FROM surat WHERE id='$id'");
$data = mysqli_fetch_array($get_file);
$nama_file = $data['file_surat'];

if (file_exists("uploads/$nama_file")) {
    unlink("uploads/$nama_file");
}

$hapus = mysqli_query($koneksi, "DELETE FROM surat WHERE id='$id'");

if ($hapus) {
    echo "<script>alert('Arsip Berhasil Dihapus!'); window.location='index.php';</script>";
} else {
    echo "Gagal menghapus data.";
}
?>