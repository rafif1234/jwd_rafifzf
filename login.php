<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if (isset($_SESSION['username'])) header('Location: index.php');

//mengecek apakah form disubmit atau tidak
if (isset($_POST['submit'])) {

    // menghilangkan backshlases
    $username = $_POST['username'];
    // menghilangkan backshlases
    $password = $_POST['password'];

    //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {

        //select data berdasarkan username dan password dari database
        $query      = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
        $rows       = mysqli_num_rows($query);

        if ($rows != 0) {
            $data = mysqli_fetch_assoc($query);

            if (password_verify($password, $data['password'])) {
                if ($data['level'] == 1) {
                    // buat session login dan username
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $data['id_user'];
                    $_SESSION['nama'] = $data['nama'];

                    // alihkan ke halaman dashboard admin
                    header("location:admin/index.php");

                    // cek jika user login sebagai pegawai
                } else if ($data['level'] == 2) {
                    // buat session login dan username
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $data['id_user'];
                    $_SESSION['nama'] = $data['nama'];
                    // alihkan ke halaman dashboard pengurus
                    header("location:user/home.php");
                } else {
                    $error =  'Username atau Password salah !!';
                }
            } else {
                $error =  'Password salah !!';
            }
            //jika gagal maka akan menampilkan pesan error
        } else {
            $error =  'Username Belum terdaftar !!';
        }
    } else {
        $error =  'Inputan tidak boleh kosong !!';
    }
}

?>

<html>

<head>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <title>Form Login</title>
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="cen py-5 mb-3 mt-4">
            <!-- Registeration Form -->
            <p class="texttitle">LOGIN</p>
            <div class="centur">
                <?php if ($error != '') { ?>
                    <div class="alert alert-danger text-center" role="alert"><?= $error; ?></div>
                <?php } ?>
                <?php if ($validate != '') { ?>
                    <div class="alert alert-danger text-center" role="alert"><?= $validate; ?></div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="input-group col-lg-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                            </div>
                            <input id="username" type="text" name="username" placeholder="Username" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- Password -->
                        <div class="input-group col-lg-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-lock text-muted"></i>
                                </span>
                            </div>
                            <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto mb-0">
                            <button style="width: 100%;" type="submit" name="submit" class="btn btn-primary font-weight-bold">Login</button>
                        </div>

                        <!-- Already Registered -->
                        <div class="text-center w-100 mt-2">
                            <p class="text-muted font-weight-bold">Belum Punya Akun? <a href="register.php" class="text-primary ml-2">Daftar</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // For Demo Purpose [Changing input group text on focus]
        $(function() {
            $('input, select').on('focus', function() {
                $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
            });
            $('input, select').on('blur', function() {
                $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
            });
        });
    </script>
</body>

</html>