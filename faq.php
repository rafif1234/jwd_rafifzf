<?php
date_default_timezone_set('Asia/Jakarta');

include('koneksi.php');

$query = mysqli_query($koneksi, "SELECT * FROM tb_buku ORDER BY rand() LIMIT 6");

?>

<?php include('layout/header.php'); ?>

<?php include('layout/navbar.php'); ?>

<section class="main-faq" style="padding: 50px;">
    <div class="container">
        <div class="text-center mb-4">
            <h2 style="font-size: 30px;font-family:monospace;font-weight:bold;color:#1c262f">FAQ</h2>
        </div>
        <div class="bs-example">
            <div class="accordion" id="accordionExample">
                <div class="card mb-2">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-angle-right"></i> Lorem ipsum dolor, sit amet consectetur adipisicing elit.</button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda quisquam distinctio nostrum magnam atque. Dolorum aliquam asperiores unde quam possimus earum quasi! Tempore facilis perspiciatis aspernatur corporis quaerat, omnis eligendi et quas accusantium earum perferendis consequatur mollitia optio, iure laborum dolore voluptatum, qui sed nesciunt. Perferendis, ipsa. Modi id commodi iste eos officiis veritatis hic repudiandae perferendis saepe quod! Atque similique doloribus praesentium expedita animi cum quos ex.</a></p>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-angle-right"></i> Lorem ipsum dolor, sit amet consectetur adipisicing.</button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi beatae libero porro, dolores laboriosam soluta, magnam hic ab illo iure aperiam. Repellendus sit inventore voluptates temporibus consectetur necessitatibus debitis ratione accusantium eaque recusandae, minus beatae odit ad ut similique quisquam non, tempora cumque incidunt magnam. Distinctio, voluptatum tenetur alias dolores neque cum ducimus veniam molestias sunt!</p>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-angle-right"></i>Lorem ipsum dolor sit amet.</button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque excepturi pariatur debitis perferendis omnis ea ad veniam voluptas ducimus necessitatibus, vel ipsum totam, quia minima sed, ut dolore corporis. Sint delectus unde odit accusantium sed ipsam, vero non quasi saepe, aspernatur eos ratione assumenda consequatur.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('layout/footer.php'); ?>