<?php

include('../../../koneksi.php');

$id = $_GET['id'];
// $w = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN user ON user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku WHERE tb_peminjam.status = 3 WHERE tb_peminjaman.id_peminjaman = '$id'");
// $qw = mysqli_fetch_assoc($w);

// var_dump($w);
// die;

$result = mysqli_query($koneksi, "UPDATE tb_peminjaman SET status = 3 WHERE id_peminjaman='$id'");
// if ($qw->num_rows > 0) {
//     $result = mysqli_fetch_assoc($qw);
//     $tanggal_pengembalian = $result['tanggal_kembali'];
//     $id_buku = $result['id_buku'];
//     $id_user = $result['id_user'];
//     $result = mysqli_query($koneksi, "INSERT INTO tb_pengembalian (tanggal_pengembalian, id_buku, id_user) VALUES ('$tanggal_pengembalian', '$id_buku', '$id_user')");
// }
// periska query apakah ada error
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Buku telah dikembalikan tepat waktu');window.location='peminjaman.php';</script>";
}
