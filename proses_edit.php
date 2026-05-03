<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");

$id         = $_POST['id'];
$no_surat   = $_POST['no_surat'];
$tgl_surat  = $_POST['tgl_surat'];
$pengirim   = $_POST['pengirim'];
$keterangan = $_POST['keterangan'];
$perihal    = $_POST['perihal'];

// Cek apakah user mengunggah file baru
$file_name = $_FILES['file_surat']['name'];
$file_tmp  = $_FILES['file_surat']['tmp_name'];

if($file_name != "") {
    // Jika ada file baru yang dipilih
    $ekstensi_boleh = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
    $x = explode('.', $file_name);
    $ekstensi = strtolower(end($x));

    if(in_array($ekstensi, $ekstensi_boleh) === true) {
        // Ambil nama file lama untuk dihapus dari folder
        $data_lama = mysqli_query($koneksi, "SELECT file_surat FROM surat WHERE id='$id'");
        $row = mysqli_fetch_array($data_lama);
        if(file_exists('uploads/'.$row['file_surat'])) {
            unlink('uploads/'.$row['file_surat']); // Hapus file fisik lama
        }

        // Upload file baru
        $nama_file_baru = time() . "_" . $file_name;
        move_uploaded_file($file_tmp, 'uploads/' . $nama_file_baru);

        // Update database dengan file baru
        $query = "UPDATE surat SET 
                  nomor_surat='$no_surat', 
                  tgl_surat='$tgl_surat', 
                  pengirim='$pengirim', 
                  keterangan='$keterangan', 
                  perihal='$perihal',
                  file_surat='$nama_file_baru' 
                  WHERE id='$id'";
    } else {
        die("Format file tidak didukung!");
    }
} else {
    // Jika user TIDAK mengunggah file baru (hanya update teks)
    $query = "UPDATE surat SET 
              nomor_surat='$no_surat', 
              tgl_surat='$tgl_surat', 
              pengirim='$pengirim', 
              keterangan='$keterangan', 
              perihal='$perihal' 
              WHERE id='$id'";
}

if (mysqli_query($koneksi, $query)) {
    header("location:index.php?pesan=update_berhasil");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>