<?php
require("../../koneksi.php");

//inisialisasi session
session_start();

// @$sess = $_SESSION['username'];


$error = '';
$validate = '';
if (isset($_POST['submit-add'])) {
    // membuat variabel untuk menampung data dari form
    $nama              = $_POST['nama'];
    $email             = $_POST['email'];
    $telp              = $_POST['telp'];
    $username          = $_POST['username'];
    $password          = $_POST['password'];
    $alamat            = $_POST['alamat'];
    $jk                = $_POST['jenis_kelamin'];
    $level             = $_POST['level'];
    $foto              = $_FILES['photo']['name'];
    // echo json_encode($_FILES);
    if ($foto == '') {
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if (!empty(trim($nama))  && !empty(trim($email)) && !empty(trim($telp)) && !empty(trim($username)) && !empty(trim($password)) && !empty(trim($alamat)) && !empty(trim($jk)) && !empty(trim($level))) {
            //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
            //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
            if (cek_username($koneksi) == 0) {
                if (cek_email($koneksi) == 0) {
                    $foto_kosong = 'user.png';
                    //hashing password sebelum disimpan didatabase
                    $pass  = password_hash($password, PASSWORD_DEFAULT);
                    //insert data ke database
                    $query = "INSERT INTO tb_user (nama, username, email, password, alamat, jenis_kelamin, telp, foto, level) VALUES ('$nama', '$username', '$email', '$pass', '$alamat', '$jk', '$telp', '$foto_kosong', '$level')";
                    $result   = mysqli_query($koneksi, $query);

                    // var_dump($result);
                    // die;
                    //jika insert data berhasil maka akan diredirect ke halaman login.php serta menyimpan data username ke session
                    if ($result) {
                        // $_SESSION['username'] = $username;
                        // $_SESSION['nama'] = $nama;
                        echo "<script>alert('Data user berhasil ditambah.');window.location='home.php';</script>";
                        // header('Location: login.php');
                        //jika gagal maka akan menampilkan pesan error
                    } else {
                        $error =  'Tambah Data user gagal !!';
                    }
                } else {
                    $error =  'Email sudah terdaftar !!';
                }
            } else {
                $error =  'Username sudah terdaftar !!';
            }
        } else {
            $error =  'Data tidak boleh kosong !!';
        }
    } else {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['photo']['tmp_name'];
        $nama_gambar_baru = 'user' . time() . '-' . $foto;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../../assets/image/' . $nama_gambar_baru);

            $query = "INSERT INTO tb_user (nama, username, email, password, alamat, jenis_kelamin, telp, foto, level) VALUES ('$nama', '$username', '$email', '$pass', '$alamat', '$jk', '$telp', '$nama_gambar_baru', '$level')";
            $result   = mysqli_query($koneksi, $query);

            // var_dump($result);
            // die;
            // periska query apakah ada error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Tambah data user berhasill.');window.location='home.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png dan jpeg.');window.location='home.php';</script>";
        }
    }
} elseif (isset($_POST['submit-edit'])) {
    // membuat variabel untuk menampung data dari form
    $id_user           = $_POST['id_user'];
    $nama              = $_POST['nama'];
    $email             = $_POST['email'];
    $telp              = $_POST['telp'];
    $username          = $_POST['username'];
    $password          = $_POST['password'];
    $alamat            = $_POST['alamat'];
    $jk                = $_POST['jenis_kelamin'];
    $level             = $_POST['level'];
    $foto              = $_FILES['photo']['name'];

    if ($foto == '') {
        //insert data ke database
        $query = "UPDATE tb_user SET nama='$nama', username='$username', email='$email', password='$password', alamat='$alamat', jenis_kelamin='$jk', telp='$telp', level='$level' WHERE id_user='$id_user'";
        $result   = mysqli_query($koneksi, $query);
        if ($result) {
            echo "<script>alert('Data user berhasil diedit.');window.location='home.php';</script>";
        } else {
            echo "<script>alert('Tambah Data user gagal !!');window.location='home.php';</script>";
        }
    } else {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['photo']['tmp_name'];
        $nama_gambar_baru = 'user' . time() . '-' . $foto;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../../assets/image/' . $nama_gambar_baru);

            $query = "UPDATE tb_user SET nama='$nama', username='$username', email='$email', password='$password',  alamat='$alamat', jenis_kelamin='$jk', telp='$telp', foto='$nama_gambar_baru', level='$level' WHERE id_user='$id_user'";
            $result   = mysqli_query($koneksi, $query);

            // var_dump($result);
            // die;
            // periska query apakah ada error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Edit data user berhasil.');window.location='home.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png dan jpeg.');window.location='home.php';</script>";
        }
    }
} elseif (isset($_POST['deletemulti'])) {
    $id = $_POST["id"];

    $jml_pilih    = count($id);

    for ($x = 0; $x < $jml_pilih; $x++) {
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user='$id[$x]'");
    }

    if (!$hapus) {
        die("Gagal menghapus data: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='home.php';</script>";
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
