<?php

include('../../koneksi.php');

session_start();


//mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}

$id = $_SESSION['id'];
// $jumlahDataperhalaman = 3;
// $jumlah = mysqli_query($koneksi, "SELECT count(*) AS jmlRecord FROM tb_buku");
// $jumlahdata = mysqli_fetch_array($jumlah);
// $jumlahhalaman = ceil($jumlahdata['jmlRecord'] / $jumlahDataperhalaman);
// $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
// $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;


$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user !='$id'");
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
            <a class="navbar-brand" style="font-family: sans-serif;font-size:30px" href="../index.php">ADMIN - LSPS</a>
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
                            <a class="dropdown-item" href="../DataBerita/home.php">Data Berita</a>
                            <a class="dropdown-item" href="">Data User</a>
                        </div>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data Transaksi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../Transaksi/peminjaman/peminjaman.php">Transaksi Peminjaman</a>
                            <a class="dropdown-item" href="../Transaksi/home.php">Transaksi Pengembalian</a>
                        </div>
                    </li> -->
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
                            <a class="dropdown-item" onclick="return confirm('yakin ingin logout?');" href="../../logout.php">Logout</a>
                        </div>
                    </li>

                    <li><a class="nav-link" href="../../index.php"><i class="fa fa-external-link"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-4" style="margin-top: 10px;">
        <div class="card">
            <div class="card-header">
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary" id="tambah-data" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus">&nbsp;Tambah Data</i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="proses_data.php" id="form-delete" enctype="multipart/form-data">
                    <div class="table-responsive" id="data">
                        <table id="table-data" class="table table-striped">
                            <thead>
                                <tr style="color:white" align="center">
                                    <td width="6%"><input type="checkbox" id="check-all"></td>
                                    <td style="background-color: #1a44b6;" width="3%">No.</td>
                                    <td style="background-color: #1a44b6;">Nama</td>
                                    <td style="background-color: #1a44b6;">Username</td>
                                    <td style="background-color: #1a44b6;">email</td>
                                    <td style="background-color: #1a44b6;">Alamat</td>
                                    <td style="background-color: #1a44b6;">Jenis Kelamin</td>
                                    <td style="background-color: #1a44b6;">Telepon</td>
                                    <td style="background-color: #1a44b6;">Foto</td>
                                    <td style="background-color: #1a44b6;">Level</td>
                                    <td style="background-color: #1a44b6;">Action</td>
                                </tr>
                            </thead>
                            <Tbody>
                                <?php
                                $i = 1;
                                while ($data = mysqli_fetch_assoc($result)) : ?>
                                    <tr align="center" style="color: black;">
                                        <td><input type="checkbox" class='check-item' id="id" name="id[]" value="<?= $data['id_user'] ?>"></td>
                                        <td><?= $i++ ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td><?php if ($data['jenis_kelamin'] == 0) {
                                                echo 'Laki - Laki';
                                            } else {
                                                echo 'Perempuan';
                                            } ?></td>
                                        <td><?= $data['telp'] ?></td>
                                        <td>
                                            <img src="../../assets/image/<?= $data['foto']; ?>" style="border-radius: 50%;" width="100" height="100">
                                        </td>
                                        <td>
                                            <?php if ($data['level'] == 1) {
                                                echo '<button disable type="button" class="btn btn-primary">PETUGAS</button>';
                                            } else {
                                                echo '<button disable type="button" class="btn btn-warning">PENGGUNA</button>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <!-- Button untuk modal -->
                                            <a href="#" type="button" data-toggle="modal" data-target="#myModal<?php echo $data['id_user']; ?>"><i style="color: yellow;" class="fa fa-eye"></i></a>
                                            <a href=" hapus.php?id=<?php echo $data['id_user']; ?>" onclick="return confirm('yakin ingin menghapus data ini?');"><i style="color: red;" class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Mahasiswa-->
                                    <div class="modal fade" id="myModal<?php echo $data['id_user']; ?>" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <form role="form" action="proses_data.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Edit Data User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php
                                                        $id = $data['id_user'];
                                                        $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$id'");
                                                        while ($row = mysqli_fetch_array($query_edit)) {
                                                        ?>
                                                            <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                                                            <input type="hidden" name="password" id="password" value="<?= $row['password'] ?>">
                                                            <div class="row">
                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama Lengkap</label>
                                                                        <input id="nama" type="text" name="nama" value="<?= $row['nama'] ?>" class="form-control border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="email">Email</label>
                                                                        <input id="email" type="email" name="email" value="<?= $row['email'] ?>" class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="telp">Telepon</label>
                                                                        <input id="telp" type="number" name="telp" value="<?= $row['telp'] ?>" class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="username">Username</label>
                                                                        <input id="username" type="text" name="username" value="<?= $row['username'] ?>" class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-8 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat</label>
                                                                        <textarea name="alamat" id="alamat" class="form-control bg-white border-md" cols="3" rows="3"> <?= $row['alamat'] ?> </textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-4">
                                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                                    <select class="form-control bg-white border-md" id="jenis_kelamin" name="jenis_kelamin">
                                                                        <option value="<?= $row['jenis_kelamin'] ?>">
                                                                            <?php if ($row['jenis_kelamin'] == 0) {
                                                                                echo 'Laki - Laki';
                                                                            } else {
                                                                                echo 'Perempuan';
                                                                            } ?></option>
                                                                        <option value="0">Laki - Laki</option>
                                                                        <option value="1">Perempuan</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-3 mb-4">
                                                                    <label for="level">Level</label>
                                                                    <select class="form-control bg-white border-md" id="level" name="level">
                                                                        <option <?= $row['level'] ?>>
                                                                            <?php if ($row['level'] == 1) {
                                                                                echo 'Petugas';
                                                                            } else {
                                                                                echo 'Pengguna';
                                                                            } ?></option>
                                                                        <option value="0">Petugas</option>
                                                                        <option value="1">Pengguna</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-6 mb-4">
                                                                    <div class="form-group">
                                                                        <label for="photo">Foto</label>
                                                                        <input id="photo" type="file" name="photo" class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <center>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <img src="../../assets/image/<?= $row['foto']; ?>" id="gambar" width="200" height="200">
                                                                    </div>
                                                                </div>
                                                            </center>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit-edit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </Tbody>
                            <tfoot>
                                <tr style="color:white">
                                    <td width="6%" colspan="9">
                                        <button type="submit" id="deletemulti" onclick="return confirm('yakin ingin menghapus data ini?');" class="btn btn-outline-danger" name="deletemulti"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- <center>
                        <?php if ($halamanAktif > 1) : ?>
                            <a href="?page=<?= $halamanAktif - 1; ?>"><i class="fa fa-arrow-left"></i></a>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <a href="?page=<?= $i ?>" class="btn btn-primary active"><?= $i; ?></a>
                            <?php else : ?>
                                <a href="?page=<?= $i ?>" class="btn btn-primary"><?= $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if ($halamanAktif < $jumlahhalaman) : ?>
                            <a href="?page=<?= $halamanAktif + 1; ?>"><i class="fa fa-arrow-right"></i></a>
                        <?php endif; ?>
                    </center> -->
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="proses_data.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input id="nama" type="text" name="nama" placeholder="Masukkan Nama lengkap" class="form-control border-md">
                                </div>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" placeholder="Masukkan email valid..." class="form-control bg-white border-md">
                                </div>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <div class="form-group">
                                    <label for="telp">Telepon</label>
                                    <input id="telp" type="number" name="telp" placeholder="Masukkan no telepon..." class="form-control bg-white border-md">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" name="username" placeholder="Masukkan Username..." class="form-control bg-white border-md">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" placeholder="Masukkan password..." class="form-control bg-white border-md">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control bg-white border-md" placeholder="Masukkan alamat" cols="3" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-3 mb-4">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control bg-white border-md" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="0">Laki - Laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mb-4">
                                <label for="level">Level</label>
                                <select class="form-control bg-white border-md" id="level" name="level">
                                    <option value="1">Petugas</option>
                                    <option value="2">Pengguna</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="form-group">
                                    <label for="photo">Foto</label>
                                    <input id="photo" type="file" name="photo" class="form-control bg-white border-md">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit-add" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
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