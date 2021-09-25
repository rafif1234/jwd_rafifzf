<?php
date_default_timezone_set('Asia/Jakarta');

include('koneksi.php');

$date = date('Y-m-d H:i:s');

$query = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE waktu_publish ORDER BY waktu_publish DESC LIMIT 5");

$id = $_GET['id'];

mysqli_query($koneksi, "UPDATE tb_berita SET view = (view+1) WHERE id_berita = '$id'");

$detail = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE id_berita='$id'");
$populer = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE view ORDER BY view DESC LIMIT 5");
// var_dump($detail);
// die;

?>

<?php include('layout/header.php'); ?>

<?php include('layout/navbar.php'); ?>

<section class="list-berita mt-4">
    <div class="container">
        <div class="row">
            <?php while ($data = mysqli_fetch_assoc($detail)) : ?>
                <div class="col-lg-8">
                    <h3><?= $data['judul'] ?></h3>
                    <img class="d-block mb-2 mt-4" style="width: 100%;height:500px" src="assets/image/<?= $data['foto'] ?>">
                    <i class="fa fa-calendar">&nbsp; <?= $data['penulis'] ?> | <?= $data['waktu_publish'] ?></i> &nbsp; <i class="fa fa-eye">&nbsp; <?= $data['view'] ?></i>
                    <p style="text-align:justify" class="mt-2"><?= $data['isi'] ?></p>
                </div>
            <?php endwhile; ?>

            <div class="col-lg-4">
                <h4>Berita Terpopuler</h4>
                <hr>
                <div class="row">
                    <?php while ($data = mysqli_fetch_assoc($populer)) : ?>
                        <div class="col-lg-6 mb-1">
                            <img class="d-block" style="width: 150px;height:130px" src="assets/image/<?= $data['foto'] ?>" alt="">
                        </div>
                        <div class="col-lg-6 mb-1">
                            <h6 class="card-title" style="font-weight: bold;"><a href="detail.php?id=<?= $data['id_berita'] ?>"><?= $data['judul'] ?></a></h6>
                            <p><?= $data['penulis'] ?> | <?= $data['waktu_publish'] ?></p>
                            </i> &nbsp; <i class="fa fa-eye">&nbsp; <?= $data['view'] ?></i>
                        </div>
                    <?php endwhile; ?>
                </div>
                <hr>

                <h4 class="mt-3">Berita Terbaru</h4>
                <hr>

                <div class="row">
                    <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                        <div class="col-lg-6 mb-1">
                            <img class="d-block" style="width: 150px;height:130px" src="assets/image/<?= $data['foto'] ?>" alt="">
                        </div>
                        <div class="col-lg-6 mb-1">
                            <h6 class="card-title" style="font-weight: bold;"><a href="detail.php?id=<?= $data['id_berita'] ?>"><?= $data['judul'] ?></a></h6>
                            <p><?= $data['penulis'] ?> | <?= $data['waktu_publish'] ?></p>
                            </i> &nbsp; <i class="fa fa-eye">&nbsp; <?= $data['view'] ?></i>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#212d37" fill-opacity="1" d="M0,160L48,144C96,128,192,96,288,101.3C384,107,480,149,576,144C672,139,768,85,864,90.7C960,96,1056,160,1152,170.7C1248,181,1344,139,1392,117.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg> -->
</section>

<?php include('layout/footer.php'); ?>