<?php

include('../../../koneksi.php');

session_start();



if (isset($_POST["submit-konfirmasi"])) {
    $id_peminjaman      = $_POST['id_peminjaman'];
    $tgl_kembali        = $_POST['tgl_kembali'];
    $penanggung_jawab   = $_POST['penanggung_jawab'];
    $status             = 1;

    $query = "UPDATE tb_peminjaman SET tanggal_kembali='$tgl_kembali', penanggung_jawab='$penanggung_jawab', status='$status' WHERE id_peminjaman='$id_peminjaman'";

    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Konfirmasi peminjaman berhasil');window.location='peminjaman.php';</script>";
    }
}
