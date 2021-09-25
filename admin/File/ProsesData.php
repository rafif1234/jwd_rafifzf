<?php
date_default_timezone_set('Asia/Jakarta');

include('../../koneksi.php');

if (isset($_POST['submit'])) {
    // membuat variabel untuk menampung data dari form
    $title          = $_POST['title'];

    $file = $_FILES['file']['name'];

    $ekstensi_diperbolehkan = array('pdf', 'xls', 'docx', 'csv');
    $x = explode('.', $file);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['file']['tmp_name'];
    // $angka_acak     = rand(1, 999);
    $nama_file_baru = 'Dwn-' . time() . '-' . $file;
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../../assets/file/' . $nama_file_baru);

        $query = "INSERT INTO tb_file (title, file) VALUES ('$title', '$nama_file_baru')";

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
}

if (isset($_GET['download'])) {
    $filename    = $_GET['download'];

    $back_dir    = "../../assets/file/";
    $file = $back_dir . $_GET['download'];

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);

        exit;
    } else {
        echo "<script>alert('Oops! File - $filename - not found ...');window.location='home.php';</script>";
    }
}
