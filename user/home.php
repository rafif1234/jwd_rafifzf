<?php
date_default_timezone_set('Asia/Jakarta');

include('../koneksi.php');

session_start();


//mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

$id_user = $_SESSION['id'];



$query = mysqli_query($koneksi, "SELECT * FROM tb_buku");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Perpustakaan</title>
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/font-awesome.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="../assets/css/app.css">
</head>

<body>
    <div class="loading">
        <img id="load" src="../assets/image/loading.gif">
    </div>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="width:100%;margin:auto">
        <div class="container">
            <a class="navbar-brand" style="font-family: sans-serif;font-size:30px;letter-spacing:3px" href="">SIMPUS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="DataPinjaman/home.php">Data Pinjaman Buku <span class="badge badge-primary badge-pill">1</span></a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav" style="margin-left: auto;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Selamat datang, <span style="text-transform: uppercase;font-weight:bold"><?php echo $_SESSION['nama'] ?></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <!-- <a class="dropdown-item" href="profile.php">Profile</a> -->
                            <a class="dropdown-item" onclick="return confirm('yakin ingin logout?');" href="../logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mb-4" style="margin-top: 10px;">

        <div class="row" id="data-buku">

        </div>
    </div>

    <script src="../assets/js/app.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>