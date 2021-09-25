<?php
date_default_timezone_set('Asia/Jakarta');

include('koneksi.php');

$query = mysqli_query($koneksi, "SELECT * FROM tb_berita ORDER BY rand() LIMIT 6");

?>

<?php include('layout/header.php'); ?>


<?php include('layout/navbar.php'); ?>

<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-interval="3000">
            <img src="assets/image/1.jpg" class="d-block" style="width: 100%;height:90vh;opacity:3;" alt="gambar">
        </div>
        <div class="carousel-item" data-interval="3000">
            <img src="assets/image/2.jpg" class="d-block" style="width: 100%;height:90vh;opacity:3;" alt="gambar">
        </div>
        <div class="carousel-item" data-interval="3000">
            <img src="assets/image/3.jpg" class="d-block" style="width: 100%;height:90vh;opacity:3;" alt="gambar">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section class="profil-lsps" style="padding: 5rem;">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                <img src="assets/image/office.jpg" style="width:100%;height:500px" alt="">
            </div>

            <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                <h2 style="font-size: 35px;font-family:monospace;font-weight:bold;color:#1c262f">Mengapa Kami ?</h2>
                <p style="text-align: justify;font-size:20px">Karena komitmen kami untuk meningkatkan kebertrimaan Sertifikat Kompetensi oleh industri baik di tingkat nasional maupun internasional.</p>
            </div>
        </div>
    </div>
</section>

<section id="berita" style="padding:50px">
    <div class="container">
        <div class="text-center mb-4">
            <h2 style="font-size: 30px;font-family:monospace;font-weight:bold;color:#1c262f">Berita Terbaru</h2>
        </div>
        <div class="row">
            <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                    <div class="card card-blog">
                        <div class="card-image">
                            <a href="detail-berita.php?id=<?= $data['id_berita'] ?>"> <img class="img" src="assets/image/<?= $data['foto'] ?>"> </a>
                            <div class="ripple-cont"></div>
                        </div>
                        <div class="table">
                            <h6 class="category"><i class="fa fa-calendar"></i> <?= $data['penulis'] ?> | <?= $data['waktu_publish'] ?></h6>
                            <h4 class="card-caption">
                                <a href="detail.php?id=<?= $data['id_berita'] ?>"><?= $data['judul'] ?></a>
                            </h4>
                            <p class="card-description" style="text-align: justify;"><?= substr($data['isi'], 0, 200) ?>...</p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="mt-3 container text-center">
            <a href="berita.php" class="btn btn-outline-primary">Lihat Selengkapnya</a>
        </div>
    </div>
</section>

<?php include('layout/footer.php'); ?>