<?php
date_default_timezone_set('Asia/Jakarta');

include('koneksi.php');

// $id = $_SESSION['id'];
$jumlahDataperhalaman = 8;
$jumlah = mysqli_query($koneksi, "SELECT count(*) AS jmlRecord FROM tb_berita");
$jumlahdata = mysqli_fetch_array($jumlah);
$jumlahhalaman = ceil($jumlahdata['jmlRecord'] / $jumlahDataperhalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

$query = mysqli_query($koneksi, "SELECT * FROM tb_berita ORDER BY rand()");

$populer = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE view ORDER BY view DESC LIMIT 5");

?>

<?php include('layout/header.php'); ?>

<?php include('layout/navbar.php'); ?>

<section class="list-berita" style="padding: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-lg-5">
                                <img class="d-block" style="height: 100%;width:100%" src="assets/image/<?= $data['foto'] ?>" alt="">
                            </div>
                            <div class="col-lg-7">
                                <div class="card-block">
                                    <a href="detail.php?id=<?= $data['id_berita'] ?>" style="color: black;font-size:23px" class="card-title"><?= $data['judul'] ?></a>
                                    <p><?= substr($data['isi'], 0, 100) ?>...</p>
                                    <a href="detail.php?id=<?= $data['id_berita'] ?>" class="btn btn-primary btn-sm float-right mb-2">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="mt-3 text-center">
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
                </div>
            </div>

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
            </div>
        </div>
    </div>
</section>

<?php include('layout/footer.php'); ?>