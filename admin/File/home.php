<?php
date_default_timezone_set('Asia/Jakarta');

include('../../koneksi.php');

session_start();


//mengecek username pada session
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}

$result = mysqli_query($koneksi, "SELECT * FROM tb_file");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Download Area</title>
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
                            <a class="dropdown-item" href="../DataBerita/home.php">Data Berita</a>
                            <a class="dropdown-item" href="../DataUser/home.php">Data User</a>
                            <a class="dropdown-item" href="">Data Download Area</a>
                        </div>
                    </li>
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
            </div>

            <div class="card-body">
                <form method="POST" action="prosesData.php" id="form-delete" enctype="multipart/form-data">
                    <div class="table-responsive" id="data">
                        <table id="cok" class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr style="color:white" align="center">
                                    <td width="6%"><input type="checkbox" id="check-all"></td>
                                    <td style="background-color: #1a44b6;">Title</td>
                                    <td style="background-color: #1a44b6;">Action</td>
                                </tr>
                            </thead>
                            <Tbody>
                                <?php
                                while ($data = mysqli_fetch_assoc($result)) : ?>
                                    <tr align="center" style="color: black;">
                                        <td><input type="checkbox" class='check-item' id="id" name="id[]" value="<?= $data['id_file'] ?>"></td>
                                        <td><a href="ProsesData.php?download=<?= $data['file'] ?>"><?= $data['title'] ?></a></td>
                                        <td>
                                            <a href="hapus.php?id=<?php echo $data['id_file']; ?>" onclick="return confirm('yakin ingin menghapus data ini?');"><i style="color: red;" class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
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
            <form action="ProsesData.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Download Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title File</label>
                            <input type="text" name="title" class="form-control bg-white border-md" placeholder="Masukkan title file" required>
                        </div>
                        <div class="form-group">
                            <label for="file">File <span style="font-size: 10px;color:red">*Ekstensi file pdf, xls, docx, csv</span></label>
                            <input id="file" type="file" name="file" class="form-control bg-white border-md" required>
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
            $("#cok")
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