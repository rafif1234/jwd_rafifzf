<?php
// $koneksi = mysqli_connect("localhost", "tipolij1_halo", "punyanana1", "tipolij1_ratna");
$koneksi = mysqli_connect("localhost", "root", "", "db_lsp");

// Check connection
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
