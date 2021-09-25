<?php
date_default_timezone_set('Asia/Jakarta');

include('../../koneksi.php');

session_start();


//mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}

// $id = $_SESSION['id'];
// $jumlahDataperhalaman = 3;
// $jumlah = mysqli_query($koneksi, "SELECT count(*) AS jmlRecord FROM tb_buku");
// $jumlahdata = mysqli_fetch_array($jumlah);
// $jumlahhalaman = ceil($jumlahdata['jmlRecord'] / $jumlahDataperhalaman);
// $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
// $awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;


$result = mysqli_query($koneksi, "SELECT * FROM tb_berita");
// $data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berita</title>
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../../node_modules/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../node_modules/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../node_modules/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js">

    <script type="text/javascript" src="../../node_modules/ckeditor/ckeditor.js"></script>

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
            <a class="navbar-brand" style="font-family: sans-serif;font-size:30px" href="../index.php">SIMPUS</a>
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
                            <a class="dropdown-item" href="">Data Berita</a>
                            <a class="dropdown-item" href="../DataUser/home.php">Data User</a>
                        </div>
                    </li>

                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data Transaksi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../Transaksi/peminjaman/peminjaman.php">Transaksi Peminjaman</a>
                            <a class="dropdown-item" href="../Transaksi/home.php">Transaksi Pengambilan</a>
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
                    <!-- <a class="btn btn-outline-success" id="import"><i style="color: green;margin-left:10px" class="fa fa-upload">&nbsp;Impor Data</i></a> -->
                </div>
                <div id="back"></div>
                <form action="prosesData.php" method="POST" enctype="multipart/form-data">
                    <div id="import-tampil" class="row mt-2" style="display: none;">
                        <div class="col-lg-6">
                            <center class="mb-2">
                                <input class="form-control" type='file' id="data" name="data" required />
                            </center>
                        </div>
                        <!-- Submit Button -->
                        <div class="form-group col-lg-6 mx-auto mb-0">
                            <button style="width: 100%;" type="submit" name="submit-import" class="btn btn-primary font-weight-bold">IMPORT DATA</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <form method="POST" action="prosesData.php" id="form-delete" enctype="multipart/form-data">
                    <div class="table-responsive" id="data">
                        <table id="test" class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr style="color:white" align="center">
                                    <td width="6%"><input type="checkbox" id="check-all"></td>
                                    <td style="background-color: #1a44b6;" width="3%">No.</td>
                                    <td style="background-color: #1a44b6;">Judul</td>
                                    <td style="background-color: #1a44b6;">Isi Berita</td>
                                    <td style="background-color: #1a44b6;">Dilihat sebanyak</td>
                                    <td style="background-color: #1a44b6;">Tanggal Publish</td>
                                    <td style="background-color: #1a44b6;">Author</td>
                                    <td style="background-color: #1a44b6;">Foto</td>
                                    <td style="background-color: #1a44b6;">Action</td>
                                </tr>
                            </thead>
                            <Tbody>
                                <?php
                                $i = 1;
                                while ($data = mysqli_fetch_assoc($result)) : ?>
                                    <tr align="center" style="color: black;">
                                        <td><input type="checkbox" class='check-item' id="id" name="id[]" value="<?= $data['id_berita'] ?>"></td>
                                        <td><?= $i++ ?></td>
                                        <td><?= $data['judul'] ?></td>
                                        <td><?= str_word_count($data['isi']) > 60 ? substr($data['isi'], 0, 100) . ".." : $data['isi'] ?></td>
                                        <td><?= $data['view'] ?></td>
                                        <td><?= $data['created_at'] ?></td>
                                        <td><?= $data['penulis'] ?></td>

                                        <td>
                                            <img src="../../assets/image/<?= $data['foto']; ?>" style="border-radius: 50%;width:100px;height:100px">
                                        </td>
                                        <td>
                                            <!-- Button untuk modal -->
                                            <a href="#" type="button" data-toggle="modal" data-target="#myModal<?php echo $data['id_berita']; ?>"><i style="color: yellow;" class="fa fa-eye"></i></a>
                                            <!-- <a href="" type="button" data-toggle="modal-edit" data-target="#modal-edit<?= $data['id_buku']; ?>"><i style="color: yellow;" class="fa fa-eye"></i></a> -->
                                            <a href=" hapus.php?id=<?php echo $data['id_berita']; ?>" onclick="return confirm('yakin ingin menghapus data ini?');"><i style="color: red;" class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Mahasiswa-->
                                    <div class="modal fade" id="myModal<?php echo $data['id_berita']; ?>" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <form method="POST" action="proses_data.php" enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" style="color: black;" id="exampleModalLabel">Edit Data Berita</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="color: black;">
                                                        <?php
                                                        $id = $data['id_berita'];
                                                        $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE id_berita='$id'");
                                                        while ($row = mysqli_fetch_assoc($query_edit)) {
                                                        ?>

                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="judul">Judul Berita</label>
                                                                        <input type="hidden" name="id_berita" value="<?php echo $row['id_berita']; ?>">
                                                                        <input id="judul" type="text" name="judul" value="<?= $row['judul'] ?>" class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="author">Author</label>
                                                                        <input id="author" readonly type="text" name="author" value="<?php echo $_SESSION['username'] ?>" class="form-control bg-white border-md">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="photo">Foto Berita</label>
                                                                <input id="photo" type="file" name="photo" class="form-control bg-white border-md">
                                                            </div>

                                                            <center>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <img src="../../assets/image/<?= $data['foto']; ?>" id="gambar" width="200" height="200">
                                                                    </div>
                                                                </div>
                                                            </center>

                                                            <div class="form-group">
                                                                <label>Isi Berita => Default [Arial, 16]</label>
                                                                <textarea class="ckeditor" name="isi_berita"><?= $row['isi'] ?></textarea>
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" id="edit-berita" name="edit-berita" class="btn btn-primary">Simpan</button>
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
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="proses_data.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Waktu Publish</label>
                                    <input type="hidden" name="view" value="0" id="view">
                                    <input required="" type="text" name="waktu" class="form-control" placeholder="hh:ii:ss" value="<?= isset($data['waktu']) ? $data['waktu'] : date('Y-m-d H:i:s') ?>" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="judul">Judul Berita</label>
                                    <input id="judul" type="text" name="judul" placeholder="Judul Buku..." class="form-control bg-white border-md">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input id="author" readonly type="text" name="author" value="<?php echo $_SESSION['username'] ?>" class="form-control bg-white border-md">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="photo">Foto Berita</label>
                            <input id="photo" type="file" name="photo" class="form-control bg-white border-md">
                        </div>

                        <div class="form-group">
                            <label>Isi Berita => Default [Arial, 16]</label>
                            <textarea class="ckeditor" name="isi_berita"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(function() {
            CKEDITOR.replace('.ckeditor');
        });

        $(function() {
            $("#test")
                .DataTable({
                    dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-6'Bi><'col-sm-6'p>>",
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"],
                    ],
                    pagingType: "full_numbers",
                    responsive: true,
                    buttons: ["excel", "pdf", "csv", "print"],
                    language: {
                        sProcessing: "Sedang memproses...",
                        sLengthMenu: "Tampilkan _MENU_ baris",
                        sZeroRecords: "Tidak ditemukan data yang sesuai",
                        sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                        sInfoPostFix: "",
                        sSearch: "Cari:",
                        sUrl: "",
                        oPaginate: {
                            sFirst: "&laquo;",
                            sPrevious: "&lsaquo;",
                            sNext: "&rsaquo;",
                            sLast: "&raquo;",
                        },
                    },
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");
        })
    </script>

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