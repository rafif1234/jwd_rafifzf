<?php
require("../../koneksi.php");


//inisialisasi session
session_start();

if (isset($_POST['submit'])) {
    // membuat variabel untuk menampung data dari form
    $waktu          = $_POST['waktu'];
    $judul         = $_POST['judul'];
    $author       = $_POST['author'];
    $isi         = $_POST['isi_berita'];
    $view       = $_POST['view'];

    $foto = $_FILES['photo']['name'];

    //cek dulu jika ada gambar produk jalankan coding ini
    if ($foto != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['photo']['tmp_name'];
        // $angka_acak     = rand(1, 999);
        $nama_gambar_baru = 'Berita' . time() . '-' . $foto;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../../assets/image/' . $nama_gambar_baru);

            $query = "INSERT INTO tb_berita (judul, isi, waktu_publish, foto, view, penulis) VALUES ('$judul', '$isi', '$waktu', '$nama_gambar_baru', '$view', '$author')";

            // var_dump($query);
            // die;

            $result = mysqli_query($koneksi, $query);
            // periska query apakah ada error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Data berhasil ditambah.');window.location='home.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png dan jpeg.');window.location='home.php';</script>";
        }
    } else {
        $foto_kosong = 'no-image.png';
        $query = "INSERT INTO tb_berita (judul, isi, waktu_publish, foto, view, penulis) VALUES ('$judul', '$isi', '$waktu', '$foto_kosong', '$view', '$author')";
        // var_dump($query);
        // die;
        $result = mysqli_query($koneksi, $query);
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil ditambah.');window.location='home.php';</script>";
        }
    }
}


if (isset($_POST['edit-berita'])) {

    $id_berita       = $_POST['id_berita'];
    $judul         = $_POST['judul'];
    $author       = $_POST['author'];
    $isi         = $_POST['isi_berita'];

    $foto = $_FILES['photo']['name'];

    //cek dulu jika ada gambar produk jalankan coding ini
    if ($foto != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['photo']['tmp_name'];
        $nama_gambar_baru = 'Buku' . time() . '-' . $foto;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../../assets/image/' . $nama_gambar_baru);

            $query = "UPDATE tb_berita SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_penerbit='$thn_penerbit', stok='$stok', gambar='$nama_gambar_baru' WHERE id_buku='$id_buku'";

            $result = mysqli_query($koneksi, $query);
            // periska query apakah ada error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Data berhasil diedit.');window.location='home.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png dan jpeg.');window.location='home.php';</script>";
        }
    } else {
        $query = "UPDATE tb_buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_penerbit='$thn_penerbit', stok='$stok' WHERE id_buku='$id_buku'";
        var_dump($query);
        die;
        $result = mysqli_query($koneksi, $query);
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil diedit.');window.location='home.php';</script>";
        }
    }
} elseif (isset($_POST['deletemulti'])) {
    $id = $_POST["id"];

    $jml_pilih    = count($id);

    for ($x = 0; $x < $jml_pilih; $x++) {
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_berita WHERE id_berita='$id[$x]'");
    }

    if (!$hapus) {
        die("Gagal menghapus data: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='home.php';</script>";
    }
}
