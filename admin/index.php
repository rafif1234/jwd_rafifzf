<?php

include('../koneksi.php');

session_start();


//mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

$id = $_SESSION['id'];

// $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
// $data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a class="navbar-brand" style="font-family: sans-serif;font-size:30px" href="">ADMIN - VSGA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Master Data
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="DataBerita/home.php">Data Berita</a>
                            <a class="dropdown-item" href="DataUser/home.php">Data User</a>
                            <a class="dropdown-item" href="File/home.php">Data Download Area</a>
                        </div>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data Transaksi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="Transaksi/peminjaman/peminjaman.php">Transaksi Peminjaman</a>
                            <a class="dropdown-item" href="Transaksi/home.php">Transaksi Pengambilan</a>
                        </div>
                    </li> -->
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav" style="margin-left: auto;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Selamat datang, <span style="text-transform: uppercase;font-weight:bold"><?php echo $_SESSION['username'] ?></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <!-- <a class="dropdown-item" href="profile.php">Profile</a> -->
                            <a class="dropdown-item" onclick="return confirm('yakin ingin logout?');" href="../logout.php">Logout</a>
                        </div>
                    </li>
                    <li><a class="nav-link" href="../index.php"><i class="fa fa-external-link"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-4" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Data Berita</div>
                    <div class="card-body text-center">
                        <?php

                        $query = mysqli_query($koneksi, "SELECT count(*) AS total FROM tb_berita");
                        $data = mysqli_fetch_assoc($query);

                        ?>
                        <h1><?= $data['total'] ?> Berita</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">Data User</div>
                    <div class="card-body text-center">
                        <?php

                        $query = mysqli_query($koneksi, "SELECT count(*) AS total_user FROM tb_user");
                        $data = mysqli_fetch_assoc($query);

                        ?>
                        <h1><?= $data['total_user'] ?> User</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/app.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>