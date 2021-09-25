<?php
date_default_timezone_set('Asia/Jakarta');

include('koneksi.php');

$query = mysqli_query($koneksi, "SELECT * FROM tb_file ORDER BY rand()");

if (isset($_GET['download'])) {
    $filename    = $_GET['download'];

    $back_dir    = "assets/file/";
    $file = $back_dir . $_GET['download'];

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);

        exit;
    } else {
        echo "<script>alert('Oops! File - $filename - not found ...');window.location='home.php';</script>";
    }
}

$jumlahDataperhalaman = 8;
$jumlah = mysqli_query($koneksi, "SELECT count(*) AS jmlRecord FROM tb_file");
$jumlahdata = mysqli_fetch_array($jumlah);
$jumlahhalaman = ceil($jumlahdata['jmlRecord'] / $jumlahDataperhalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataperhalaman * $halamanAktif) - $jumlahDataperhalaman;

?>

<?php include('layout/header.php'); ?>

<?php include('layout/navbar.php'); ?>

<section class="main-faq" style="padding: 50px;">
    <div class="container">
        <div class="text-center mb-4">
            <h2 style="font-size: 30px;font-family:monospace;font-weight:bold;color:#1c262f">Download Area</h2>
        </div>
        <?php while ($data = mysqli_fetch_assoc($query)) : ?>
            <div class="card mb-2 p-3" style="box-shadow: 3px 3px 0 0 #eee;">
                <div class="row">

                    <div class="col-lg-10 col-md-10">
                        <div class="ml-2">
                            <i class="fa fa-file" style="font-size: 23px;"> <?= $data['title'] ?> </i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 text-center">
                        <a class="btn btn-outline-primary" href="file.php?download=<?= $data['file'] ?>"><i class="fa fa-download">&nbsp; Download</i></a>
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
</section>

<?php include('layout/footer.php'); ?>