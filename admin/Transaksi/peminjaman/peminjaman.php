<?php

include('../../../koneksi.php');

session_start();


//mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

$query1 = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi Peminjaman Buku</title>
    <link rel="stylesheet" href="../../../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../../../node_modules/@fortawesome/fontawesome-free/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../../../node_modules/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../../node_modules/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../../node_modules/datatables-buttons/css/buttons.bootstrap4.min.css">


    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="../../../assets/css/app.css">
</head>

<body>
    <div class="loading">
        <img id="load" src="../../../assets/image/loading.gif">
    </div>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="width:100%;margin:auto">
        <div class="container">
            <a class="navbar-brand" style="font-family: sans-serif;font-size:30px" href="../../index.php">SIMPUS</a>
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
                            <a class="dropdown-item" href="../../DataBuku/home.php">Data Buku</a>
                            <a class="dropdown-item" href="../../DataUser/home.php">Data User</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data Transaksi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="">Transaksi Peminjaman</a>
                            <a class="dropdown-item" href="../Transaksi/home.php">Transaksi Pengembalian</a>
                        </div>
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
                            <!-- <a class="dropdown-item" href="../profile.php">Profile</a> -->
                            <a class="dropdown-item" onclick="return confirm('yakin ingin logout?');" href="../../../logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-4" style="margin-top: 10px;">
        <div class="col-md-12">
            <div class="alert alert-primary text-center" role="alert">
                <h2 style="letter-spacing: 3px;">PEMINJAMAN BUKU</h2>
            </div>
        </div>

        <div class="mt-2 col-md-12">
            <div class="tab-wrap">

                <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
                <label for="tab1">Konfirmasi Peminjaman Buku</label>

                <input type="radio" id="tab2" name="tabGroup1" class="tab">
                <label for="tab2">Buku Belum Dikembalikan</label>

                <input type="radio" id="tab3" name="tabGroup1" class="tab">
                <label for="tab3">Konfirmasi Kembali Buku</label>

                <input type="radio" id="tab4" name="tabGroup1" class="tab">
                <label for="tab4">Buku Telah Dikembalikan</label>

                <div class="tab__content">
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku WHERE tb_peminjaman.status=0"); ?>
                    <?php if ($query->num_rows > 0) { ?>
                        <div class="table-responsive">
                            <table id="table-data" class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <td>No.</td>
                                        <td>Nama Peminjam</td>
                                        <td>Judul Buku</td>
                                        <td>Penulis</td>
                                        <td>Tanggal Pinjam</td>
                                        <td>Tanggal Kembali</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['judul'] ?></td>
                                            <td><?= $row['penulis'] ?></td>
                                            <td><?= $row['tanggal_pinjam'] ?></td>
                                            <td><?= $row['tanggal_kembali'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModal<?= $row['id_peminjaman'] ?>">
                                                    Konfirmasi Peminjaman
                                                </button>
                                            </td>
                                            <td>
                                                <a href=" hapus.php?id=<?php echo $row['id_user']; ?>" class="del"><i style="color: red;" class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h2 style="letter-spacing: 3px;">DATA MASIH KOSONG</h2>
                        </div>
                    <?php } ?>
                </div>

                <div class="tab__content">
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku WHERE tb_peminjaman.status=1"); ?>
                    <?php if ($query->num_rows > 0) { ?>
                        <div class="table-responsive">
                            <table id="table-data" class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <td>No.</td>
                                        <td>Nama Peminjam</td>
                                        <td>Judul Buku</td>
                                        <td>Penulis</td>
                                        <td>Tanggal Pinjam</td>
                                        <td>Tanggal Kembali</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['judul'] ?></td>
                                            <td><?= $row['penulis'] ?></td>
                                            <td><?= $row['tanggal_pinjam'] ?></td>
                                            <td><?= $row['tanggal_kembali'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger">
                                                    Buku Belum Dikembalikan
                                                </button>
                                            </td>
                                            <td>
                                                <a href=" hapus.php?id=<?php echo $row['id_user']; ?>" onclick="return confirm('yakin ingin menghapus data ini?');"><i style="color: red;" class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h2 style="letter-spacing: 3px;">DATA MASIH KOSONG</h2>
                        </div>
                    <?php } ?>
                </div>

                <div class="tab__content">
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku WHERE tb_peminjaman.status=2"); ?>
                    <?php if ($query->num_rows > 0) { ?>
                        <div class="table-responsive">
                            <table id="table-data" class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <td>No.</td>
                                        <td>Nama Peminjam</td>
                                        <td>Judul Buku</td>
                                        <td>Penulis</td>
                                        <td>Tanggal Pinjam</td>
                                        <td>Tanggal Kembali</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['judul'] ?></td>
                                            <td><?= $row['penulis'] ?></td>
                                            <td><?= $row['tanggal_pinjam'] ?></td>
                                            <td><?= $row['tanggal_kembali'] ?></td>
                                            <td>
                                                <a href="bukuBack.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-outline-primary" onclick="return confirm('yakin buku ini telah dikembalikan oleh peminjam?');">Approve Buku dikembalikan</a>
                                            </td>
                                            <td>
                                                <a href=" hapus.php?id=<?php echo $row['id_user']; ?>" onclick="return confirm('yakin ingin menghapus data ini?');"><i style="color: red;" class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h2 style="letter-spacing: 3px;">DATA MASIH KOSONG</h2>
                        </div>
                    <?php } ?>
                </div>
                <div class="tab__content">
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku WHERE tb_peminjaman.status=3"); ?>
                    <?php if ($query->num_rows > 0) { ?>
                        <div class="table-responsive">
                            <table id="table-data" class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <td>No.</td>
                                        <td>Nama Peminjam</td>
                                        <td>Judul Buku</td>
                                        <td>Penulis</td>
                                        <td>Tanggal Pinjam</td>
                                        <td>Tanggal Kembali</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['judul'] ?></td>
                                            <td><?= $row['penulis'] ?></td>
                                            <td><?= $row['tanggal_pinjam'] ?></td>
                                            <td><?= $row['tanggal_kembali'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success">
                                                    Buku telah Dikembalikan
                                                </button>
                                            </td>
                                            <td>
                                                <a href=" hapus.php?id=<?php echo $row['id_user']; ?>" onclick="return confirm('yakin ingin menghapus data ini?');"><i style="color: red;" class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h2 style="letter-spacing: 3px;">DATA MASIH KOSONG</h2>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php while ($data = mysqli_fetch_assoc($query1)) : ?>
            <div class="modal fade" id="exampleModal<?= $data['id_peminjaman'] ?>" style="z-index: 99999999;" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="proses_data.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Peminjaman</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $id_peminjaman = $data['id_peminjaman'];
                                $query_add = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman INNER JOIN tb_user ON tb_user.id_user=tb_peminjaman.id_user INNER JOIN tb_buku ON tb_buku.id_buku=tb_peminjaman.id_buku WHERE tb_peminjaman.id_peminjaman = '$id_peminjaman'");
                                while ($row = mysqli_fetch_array($query_add)) {
                                ?>
                                    <input type="hidden" name="id_peminjaman" value="<?php echo $row['id_peminjaman']; ?>">
                                    <input type="hidden" name="penanggung_jawab" value="<?php echo $_SESSION['nama'] ?>">
                                    <div class="row">
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label for="kode">Kode Buku</label>
                                                <input id="kode" type="text" name="kode" value="<?= $row['kode'] ?>" readonly class="form-control border-md">
                                            </div>
                                        </div>

                                        <div class="col-lg-5 mb-4">
                                            <div class="form-group">
                                                <label for="nama">Nama Peminjam</label>
                                                <input id="nama" type="text" name="nama" value="<?= $row['nama'] ?>" readonly class="form-control bg-white border-md">
                                            </div>
                                        </div>

                                        <div class="col-lg-5 mb-4">
                                            <div class="form-group">
                                                <label for="telp">Nomor Telepon Peminjam</label>
                                                <input id="telp" type="text" name="telp" value="<?= $row['telp'] ?>" readonly class="form-control bg-white border-md">
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
                                                <label for="tgl_minjam">Tanggal Meminjam</label>
                                                <input id="tgl_minjam" type="text" name="tgl_minjam" value="<?= date("Y-m-d H:i:s") ?>" readonly class="form-control bg-white border-md">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <label for="tgl_kembali">Tanggal Kembali</label>
                                                <input id="tgl_kembali" type="date" name="tgl_kembali" class="form-control bg-white border-md">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="submit-konfirmasi" class="btn btn-success">Konfirmasi Peminjaman</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>




    <!-- <script src="../../assets/js/app.js"></script> -->
    <script src="../../../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../../../node_modules/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../node_modules/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../node_modules/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../node_modules/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../../node_modules/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../../node_modules/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../../node_modules/jszip/jszip.min.js"></script>
    <script src="../../../node_modules/pdfmake/pdfmake.min.js"></script>
    <script src="../../../node_modules/pdfmake/vfs_fonts.js"></script>
    <script src="../../../node_modules/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../../node_modules/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../../node_modules/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="../../../assets/js/app.js"></script>
    <script src="../../../assets/js/alert.php"></script>


</body>

</html>