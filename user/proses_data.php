<?php
require("../koneksi.php");


//inisialisasi session
session_start();


if (isset($_POST['submit-add'])) {
    // membuat variabel untuk menampung data dari form
    $tgl_minjam     = $_POST['tgl_minjam'];
    $id_buku        = $_POST['id_buku'];
    $id_user        = $_POST['id_user'];
    $status         = 0;

    $query = "INSERT INTO tb_peminjaman (tanggal_pinjam, id_buku, id_user, status) VALUES ('$tgl_minjam', '$id_buku', '$id_user', '$status')";

    // var_dump($query);
    // die;

    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Pinjam buku berhasil, Tunggu konfirmasi dari admin 1x24 jam');window.location='index.php';</script>";
    }
} elseif (isset($_POST['submit-balik'])) {

    $id_peminjaman      = $_POST['id_peminjaman'];
    $status             = 2;

    $query = "UPDATE tb_peminjaman SET status='$status' WHERE id_peminjaman='$id_peminjaman'";

    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Buku berhasl dikembalikan');window.location='DataPinjaman/home.php';</script>";
    }
}
