<?php
$host = $_SERVER['HTTP_HOST'];

if ($host == 'localhost') {
    $koneksi = mysqli_connect("localhost", "root", "", "db_arsip_admin");
} else {
    $hostname_online = "sql311.infinityfree.com";
    $username_online = "if0_41877590";
    $password_online = "Sofyan1604";
    $database_online = "if0_41877590_db_arsip_admin";

    $koneksi = mysqli_connect($hostname_online, $username_online, $password_online, $database_online);
}

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>