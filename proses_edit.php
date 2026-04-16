<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");

$id          = $_POST['id'];
$nomor_surat = $_POST['nomor_surat'];
$tgl_surat   = $_POST['tgl_surat'];
$pengirim    = $_POST['pengirim'];
$perihal     = $_POST['perihal'];

// Cek apakah user mengupload file baru
if ($_FILES['file_surat']['name'] != "") {
    // 1. Ambil nama file lama untuk dihapus
    $get_file = mysqli_query($koneksi, "SELECT file_surat FROM surat WHERE id='$id'");
    $data_file = mysqli_fetch_array($get_file);
    unlink("uploads/" . $data_file['file_surat']);

    // 2. Upload file baru
    $nama_file = $_FILES['file_surat']['name'];
    $tmp_name  = $_FILES['file_surat']['tmp_name'];
    move_uploaded_file($tmp_name, "uploads/" . $nama_file);

    // 3. Update data dengan file baru
    $query = "UPDATE surat SET nomor_surat='$nomor_surat', tgl_surat='$tgl_surat', pengirim='$pengirim', perihal='$perihal', file_surat='$nama_file' WHERE id='$id'";
} else {
    // Update data tanpa mengganti file
    $query = "UPDATE surat SET nomor_surat='$nomor_surat', tgl_surat='$tgl_surat', pengirim='$pengirim', perihal='$perihal' WHERE id='$id'";
}

$update = mysqli_query($koneksi, $query);

if ($update) {
    echo "<script>alert('Data Berhasil Diperbarui!'); window.location='index.php';</script>";
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>