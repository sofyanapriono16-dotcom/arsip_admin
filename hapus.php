<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");

$id = $_GET['id'];

// 1. Ambil nama file dari database agar file fisiknya di folder 'uploads' juga terhapus
$get_file = mysqli_query($koneksi, "SELECT file_surat FROM surat WHERE id='$id'");
$data = mysqli_fetch_array($get_file);
$nama_file = $data['file_surat'];

// 2. Hapus file di folder uploads
if (file_exists("uploads/$nama_file")) {
    unlink("uploads/$nama_file");
}

// 3. Hapus data di database
$hapus = mysqli_query($koneksi, "DELETE FROM surat WHERE id='$id'");

if ($hapus) {
    echo "<script>alert('Arsip Berhasil Dihapus!'); window.location='index.php';</script>";
} else {
    echo "Gagal menghapus data.";
}
?>