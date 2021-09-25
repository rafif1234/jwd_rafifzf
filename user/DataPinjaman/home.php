<?php

include('../../koneksi.php');

session_start();


//mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}


$query = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku");

// $data = mysqli_fetch_array($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../../node_modules/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../node_modules/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../node_modules/datatables-buttons/css/buttons.bootstrap4.min.css">

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="../../assets/css/app.css">
</head>

<body>
    <div class="loading">
        <img id="load" src="../../assets/image/loading.gif">
    </div>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="width:100%;margin:auto">
        <div class="container">
            <a class="navbar-brand" style="font-family: sans-serif;font-size:30px;letter-spacing:3px" href="../index.php">SIMPUS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="">Data Pinjaman Buku</a>
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
                            <a class="dropdown-item" onclick="return confirm('yakin ingin logout?');" href="../../logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-4" style="margin-top: 10px;">
        <div class="col-md-12">
            <div class="alert alert-primary text-center" role="alert">
                <h2 style="letter-spacing: 3px;">DATA PINJAMAN BUKU ANDA</h2>
            </div>
        </div>

        <div class="mt-2 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-data" class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <td>No.</td>
                                    <td>Judul Buku</td>
                                    <td>Penulis</td>
                                    <td>Tanggal Pinjam</td>
                                    <td>Tanggal Kembali</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($row = mysqli_fetch_assoc($query)) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['judul'] ?></td>
                                        <td><?= $row['penulis'] ?></td>
                                        <td><?= $row['tanggal_pinjam'] ?></td>
                                        <td><?= $row['tanggal_kembali'] ?></td>
                                        <td>
                                            <?php if ($row['status'] == 0) { ?>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning">
                                                    Tunggu Konfirmasi Dari Admin
                                                </button>
                                            <?php } elseif ($row['status'] == 1) { ?>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal<?= $row['id_peminjaman'] ?>">
                                                    Kembalikan Buku
                                                </button>
                                            <?php } elseif ($row['status'] == 2) { ?>
                                                <button type="button" class="btn btn-primary">
                                                    Buku dicek oleh admin terlebih dahulu!!
                                                </button>
                                            <?php } else { ?>
                                                <button type="button" disabled class="btn btn-success">
                                                    Buku telah dikembalikan dan disetujui oleh admin
                                                </button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $row['id_peminjaman'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="../prosesData.php" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Kembalikan Peminjaman Buku</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        $id_peminjaman = $row['id_peminjaman'];
                                                        $query_add = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku WHERE tb_peminjaman.id_peminjaman = '$id_peminjaman'");
                                                        while ($row = mysqli_fetch_array($query_add)) {
                                                        ?>
                                                            <input type="hidden" name="id_peminjaman" value="<?php echo $row['id_peminjaman']; ?>">
                                                            <div class="row">
                                                                <div class="col-lg-2 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="kode">Kode Buku</label>
                                                                        <input id="kode" type="text" name="kode" value="<?= $row['kode'] ?>" readonly class="form-control border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="judul">Judul Buku</label>
                                                                        <input id="judul" type="text" name="judul" value="<?= $row['judul'] ?>" readonly class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="penulis">Penulis</label>
                                                                        <input id="penulis" type="text" name="penulis" value="<?= $row['penulis'] ?>" readonly class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="penerbit">Penerbit</label>
                                                                        <input id="penerbit" type="text" name="penerbit" value="<?= $row['penerbit'] ?>" readonly class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="penerbit">Tanggal Penerbit</label>
                                                                        <input id="penerbit" type="text" name="penerbit" value="<?= $row['tahun_penerbit'] ?>" readonly class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="tgl_minjam">Tanggal Meminjam</label>
                                                                        <input id="tgl_minjam" type="datetime" name="tgl_minjam" value="<?= $row['tanggal_pinjam'] ?>" readonly class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="tgl_kembali">Tanggal Kembali</label>
                                                                        <input id="tgl_kembali" type="datetime" value="<?= $row['tanggal_kembali'] ?>" name="tgl_kembali" readonly class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="submit-balik" class="btn btn-success">Konfirmasi Pembalikan Buku</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="../../assets/js/app.js"></script> -->
    <script src="../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <!-- DataTables  & Plugins -->
    <script src="../../node_modules/datatables/jquery.dataTables.min.js"></script>
    <script src="../../node_modules/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../node_modules/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../node_modules/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../node_modules/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../node_modules/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../node_modules/jszip/jszip.min.js"></script>
    <script src="../../node_modules/pdfmake/pdfmake.min.js"></script>
    <script src="../../node_modules/pdfmake/vfs_fonts.js"></script>
    <script src="../../node_modules/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../node_modules/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../node_modules/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="../../assets/js/app.js"></script>
</body>

</html>