<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");

$no_surat   = $_POST['no_surat'];
$tgl_surat  = $_POST['tgl_surat'];
$pengirim   = $_POST['pengirim'];
$keterangan = $_POST['keterangan'];
$perihal    = $_POST['perihal'];

$file_name = $_FILES['file_surat']['name'];
$file_tmp  = $_FILES['file_surat']['tmp_name'];
$ekstensi_boleh = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
$x = explode('.', $file_name);
$ekstensi = strtolower(end($x));

if(in_array($ekstensi, $ekstensi_boleh) === true){
    $nama_file_baru = time() . "_" . $file_name;
    
    if(move_uploaded_file($file_tmp, 'uploads/' . $nama_file_baru)){
        
        $query = "INSERT INTO surat (nomor_surat, tgl_surat, pengirim, keterangan, perihal, file_surat) 
                  VALUES ('$no_surat', '$tgl_surat', '$pengirim', '$keterangan', '$perihal', '$nama_file_baru')";
        
        if(mysqli_query($koneksi, $query)){
            header("location:index.php?pesan=berhasil");
        } else {
            echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengunggah file ke folder uploads. Pastikan folder tersebut ada.";
    }
} else {
    echo "Format file tidak didukung! Gunakan PDF, Word, atau Gambar.";
}
?>