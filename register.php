<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';
//mengecek apakah form registrasi di submit atau tidak
if (isset($_POST['submit'])) {
    $nama              = $_POST['nama_lengkap'];
    $username          = $_POST['username'];
    $email             = $_POST['email'];
    $telp              = $_POST['telp'];
    $jk                = $_POST['jk'];
    $alamat            = $_POST['alamat'];
    $level             = 2;
    $foto              = 'user.png';
    $password          = $_POST['password'];
    $passwordConfirm   = $_POST['passwordConfirm'];
    //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty(trim($nama)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($telp)) && !empty(trim($jk)) && !empty(trim($alamat)) && !empty(trim($password)) && !empty(trim($passwordConfirm))) {
        //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
        if ($password == $passwordConfirm) {
            //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
            if (cek_username($koneksi) == 0) {
                if (cek_email($koneksi) == 0) {
                    //hashing password sebelum disimpan didatabase
                    $pass  = password_hash($password, PASSWORD_DEFAULT);
                    //insert data ke database
                    $query = "INSERT INTO tb_user (nama, username,email,telp, jenis_kelamin , alamat, password, foto, level ) VALUES ('$nama','$username','$email','$telp', '$jk' ,'$alamat','$pass', '$foto', '$level')";
                    $result   = mysqli_query($koneksi, $query);

                    // var_dump($result);
                    // die;
                    //jika insert data berhasil maka akan diredirect ke halaman login.php serta menyimpan data username ke session
                    if ($result) {
                        // $_SESSION['username'] = $username;
                        // $_SESSION['nama'] = $nama;
                        echo "<script>alert('Selamat anda berhasil registrasi. silahkan login!!!.');window.location='index.php';</script>";
                        // header('Location: login.php');
                        //jika gagal maka akan menampilkan pesan error
                    } else {
                        $error =  'Registrasi Gagal !!';
                    }
                } else {
                    $error =  'Email sudah terdaftar !!';
                }
            } else {
                $error =  'Username sudah terdaftar !!';
            }
        } else {
            $validate = 'Password tidak sama !!';
        }
    } else {
        $error =  'Data tidak boleh kosong !!';
    }
}
//fungsi untuk mengecek username apakah sudah terdaftar atau belum
function cek_username($koneksi)
{
    $username = stripslashes($_POST['username']);
    $query = "SELECT * FROM tb_user WHERE username = '$username'";
    // var_dump($query);
    // die;
    if ($result = mysqli_query($koneksi, $query)) return mysqli_num_rows($result);
}

function cek_email($koneksi)
{
    $email = stripslashes($_POST['email']);
    $query = "SELECT * FROM tb_user WHERE email = '$email'";
    if ($result = mysqli_query($koneksi, $query)) return mysqli_num_rows($result);
}

?>

<html>

<head>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="cen py-5 mb-3 mt-4">
            <!-- Registeration Form -->
            <p class="texttitle">REGISTRASI</p>
            <div class="centur">
                <?php if ($error != '') { ?>
                    <div class="alert alert-danger text-center" role="alert"><?= $error; ?></div>
                <?php } ?>
                <?php if ($validate != '') { ?>
                    <div class="alert alert-danger text-center" role="alert"><?= $validate; ?></div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="row">
                        <!-- nama lengkap -->
                        <div class="input-group col-md-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                            </div>
                            <input id="nama_lengkap" type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" class="form-control bg-white border-left-0 border-md">
                        </div>
                        <!-- username -->
                        <div class="input-group col-md-6 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                            </div>
                            <input id="username" type="text" name="username" placeholder="Masukkan username" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- Email Address -->
                        <div class="input-group col-md-6 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                            </div>
                            <input id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- Phone Number -->
                        <div class="input-group col-md-6 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-phone-square text-muted"></i>
                                </span>
                            </div>
                            <input id="telp" type="number" name="telp" placeholder="Masukkan no HP" class="form-control bg-white border-md border-left-0 pl-3">
                        </div>

                        <!-- Phone Number -->
                        <div class="input-group col-md-6 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-venus-mars text-muted"></i>
                                </span>
                            </div>
                            <select class="form-control" id="jk" name="jk">
                                <option value="0">Laki - Laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>

                        <!-- alamat -->
                        <div class="input-group col-md-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-map-marker text-muted"></i>
                                </span>
                            </div>
                            <textarea name="alamat" id="alamat" cols="3" placeholder="Alamat anda..." rows="3" class="form-control bg-white border-md border-left-0 pl-3"></textarea>
                        </div>

                        <!-- Password -->
                        <div class="input-group col-md-6 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-lock text-muted"></i>
                                </span>
                            </div>
                            <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- Password Confirmation -->
                        <div class="input-group col-md-6 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-lock text-muted"></i>
                                </span>
                            </div>
                            <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto mb-0">
                            <button style="width: 100%;" type="submit" name="submit" class="btn btn-primary font-weight-bold">Buat Akun</button>
                        </div>

                        <!-- Already Registered -->
                        <div class="text-center w-100 mt-2">
                            <p class="text-muted font-weight-bold">Sudah Punya Akun? <a href="index.php" class="text-primary ml-2">Login</a></p>
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