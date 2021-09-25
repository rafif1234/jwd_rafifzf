<?php
// Load file koneksi.php
include "../../koneksi.php";
$id = $_GET["id"];

//jalankan query DELETE untuk menghapus data
$query = "DELETE FROM tb_user WHERE id_user='$id'";
$hasil_query = mysqli_query($koneksi, $query);

//periksa query, apakah ada kesalahan
if (!$hasil_query) {
    die("Gagal menghapus data: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Data berhasil dihapus.');window.location='home.php';</script>";
}
