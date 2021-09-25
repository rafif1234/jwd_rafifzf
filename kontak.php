<?php
date_default_timezone_set('Asia/Jakarta');

// include('koneksi.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('vendor/phpmailer/phpmailer/src/Exception.php');
include('vendor/phpmailer/phpmailer/src/PHPMailer.php');
include('vendor/phpmailer/phpmailer/src/SMTP.php');

if (isset($_POST['kirim'])) {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $subject = $_POST['subject'];
    $pesan = $_POST['pesan'];

    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'lspkominfo@gmail.com';
    $mail->Password = 'akbar123456';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';

    $mail->setFrom($email, $email);
    $mail->addAddress('lspkominfo@gmail.com', 'Admin');
    // $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $pesan;

    if (!$mail->send()) {
        echo "<script>alert('kirim pesan gagal', $mail->ErrorInfo);window.location='home.php';</script>";
    } else {
        echo "<script>alert('pesan berhasil terkirim!');window.location='kontak.php';</script>";
    }
}

?>

<?php include('layout/header.php'); ?>

<?php include('layout/navbar.php'); ?>

<section class="list-kontak" style="padding: 50px;">
    <div class="container">
        <div class="text-center mb-4">
            <h2 style="font-size: 30px;font-family:monospace;font-weight:bold;color:#1c262f">Kontak Kami</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d987.2878563224834!2d113.68111172936098!3d-8.187497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69768ea220933%3A0x7901ddc292931864!2sVilla%20Tegal%20Besar!5e0!3m2!1sid!2sid!4v1632464570211!5m2!1sid!2sid" width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <form enctype="multipart/form-data" method="POST" action="">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="masukkan email yang valid">
                        </div>
                        <div class="col-lg-6">
                            <label for="nama">nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="masukkan nama anda">
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="masukkan subject">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Pesan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="pesan" rows="3" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="kirim" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('layout/footer.php'); ?>