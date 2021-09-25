<?php

include('../koneksi.php');

$query = mysqli_query($koneksi, "SELECT * FROM tb_buku");

if (mysqli_num_rows($query) > 0) {
    $response = array();
    $response["data"] = array();
    while ($x = mysqli_fetch_array($query)) {
        $h['id_buku'] = $x["id_buku"];
        $h['kode'] = $x["kode"];
        $h['judul'] = $x["judul"];
        $h['penulis'] = $x["penulis"];
        $h['penerbit'] = $x["penerbit"];
        $h['tahun_penerbit'] = $x["tahun_penerbit"];
        $h['stok'] = $x["stok"];
        $h['gambar'] = $x["gambar"];
        array_push($response["data"], $h);
    }
    echo json_encode($response);
} else {
    $response["message"] = "tidak ada data";
    echo json_encode($response);
}


// $output = '';

// $query = '';

// if (isset($_GET["keywoard"])) {
//     $search = str_replace(",", "|", $_GET["keywoard"]);
//     $query = "SELECT * FROM tbl_buku WHERE judul REGEXP '" . $search . "' OR penulis REGEXP '" . $search . "' OR penerbit REGEXP '" . $search . "' OR tahun_penerbit REGEXP '" . $search . "'";
// } else {
//     $query = "SELECT * FROM tb_buku ORDER BY judul";
// }

// $statement = mysqli_query($koneksi, $query);
// if (mysqli_num_rows($statement) > 0) {
//     $response = array();
//     $response["data"] = array();
//     while ($x = mysqli_fetch_array($statement)) {
//         $h['id_buku'] = $x["id_buku"];
//         $h['kode'] = $x["kode"];
//         $h['judul'] = $x["judul"];
//         $h['penulis'] = $x["penulis"];
//         $h['penerbit'] = $x["penerbit"];
//         $h['tahun_penerbit'] = $x["tahun_penerbit"];
//         $h['stok'] = $x["stok"];
//         $h['gambar'] = $x["gambar"];
//         array_push($response["data"], $h);
//     }
//     echo json_encode($response);
// } else {
//     $response["message"] = "tidak ada data";
//     echo json_encode($response);
// }

// while ($row = mysqli_fetch_assoc($statement)) {
//     $data[] = $row;
// }

// echo json_encode($data);

// if (isset($_GET['keywoard'])) {
//     $cari = $_GET['keywoard'];
//     $query = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE judul LIKE '%$cari%' OR penulis '%$cari%' OR penerbit '%$cari%' OR tahun_penerbit '%$cari%'");
//     // var_dump($query);
//     // die;

//     if (mysqli_num_rows($query) > 0) {
//         $response = array();
//         $response["data"] = array();
//         while ($x = mysqli_fetch_array($query)) {
//             $h['id_buku'] = $x["id_buku"];
//             $h['kode'] = $x["kode"];
//             $h['judul'] = $x["judul"];
//             $h['penulis'] = $x["penulis"];
//             $h['penerbit'] = $x["penerbit"];
//             $h['tahun_penerbit'] = $x["tahun_penerbit"];
//             $h['stok'] = $x["stok"];
//             $h['gambar'] = $x["gambar"];
//             array_push($response["data"], $h);
//         }
//         echo json_encode($response);
//     } else {
//         $response["message"] = "tidak ada data";
//         echo json_encode($response);
//     }
// } else {
//     $query = mysqli_query($koneksi, "SELECT * FROM tb_buku");
//     while ($x = mysqli_fetch_array($query)) {
//         $h['id_buku'] = $x["id_buku"];
//         $h['kode'] = $x["kode"];
//         $h['judul'] = $x["judul"];
//         $h['penulis'] = $x["penulis"];
//         $h['penerbit'] = $x["penerbit"];
//         $h['tahun_penerbit'] = $x["tahun_penerbit"];
//         $h['stok'] = $x["stok"];
//         $h['gambar'] = $x["gambar"];
//         array_push($response["data"], $h);
//     }
//     echo json_encode($response);
// }
