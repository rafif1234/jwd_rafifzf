<?php
// Load file koneksi.php
include "../../../koneksi.php";
$id = $_GET["id"];

//jalankan query DELETE untuk menghapus data
$query = "UPDATE tb_peminjaman SET status=1 WHERE id_peminjaman='$id'";
$hasil_query = mysqli_query($koneksi, $query);

//periksa query, apakah ada kesalahan
if (!$hasil_query) {
    die("Gagal konfirmasi peminjaman: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Konfirmasi peminjaman buku berhasil');window.location='peminjaman.php';</script>";
}
