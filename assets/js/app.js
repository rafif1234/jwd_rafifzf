import Swiper from "https://unpkg.com/swiper@7/swiper-bundle.esm.browser.min.js";

$(window).on("load", function () {
  $("#load").show();
  $("#load").delay(1000).fadeOut("slow");
});

$(document).ready(function () {
  $("#table-data")
    .DataTable({
      dom:
        "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-6'Bi><'col-sm-6'p>>",
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
      pagingType: "full_numbers",
      responsive: true,
      buttons: ["csv", "print", "excel", "pdf"],
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
});

$(document).ready(function () {
  // Ketika halaman sudah siap (sudah selesai di load)
  $("#check-all").click(function () {
    // Ketika user men-cek checkbox all
    if ($(this).is(":checked"))
      // Jika checkbox all diceklis
      $(".check-item").prop("checked", true);
    // ceklis semua checkbox siswa dengan class "check-item"
    // Jika checkbox all tidak diceklis
    else $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
  });
});

function TampilAllBuku() {
  $.getJSON("../user/dataJson.php", function (data) {
    let buku = data.data;
    $.each(buku, function (i, data) {
      $("#data-buku").append(
        `
          <div class="col-md-4 mb-3">
            <div class="card">
              <img src="../assets/image/` +
          data.gambar +
          `" width="200" height="240" class="card-img-top">
                <div class="card-body">
                  <h5 class="card-title">` +
          data.judul +
          `</h5>
                    <h6 class="card-subtitle mb-2 text-muted">` +
          data.tahun_penerbit +
          `</h6>
                    <p class="card-text">Penulis : ` +
          data.penulis +
          ` <br> Penerbit : ` +
          data.penerbit +
          `</p>
                    <div class="justify-content-center text-center">
                      <a href="#" type="button" data-toggle="modal" class="btn btn-outline-primary" data-target="#myModal` +
          data.id_buku +
          `"><i class="fa fa-plus-circle">&nbsp;Pinjam Buku</i></a>
                    </div>
                </div>
            </div>
          </div>
      `
      );
    });
  });
}

TampilAllBuku();

$(document).ready(function () {
  // Add down arrow icon for collapse element which is open by default
  $(".collapse.show").each(function () {
    $(this)
      .prev(".card-header")
      .find(".fa")
      .addClass("fa-angle-down")
      .removeClass("fa-angle-right");
  });

  // Toggle right and down arrow icon on show hide of collapse element
  $(".collapse")
    .on("show.bs.collapse", function () {
      $(this)
        .prev(".card-header")
        .find(".fa")
        .removeClass("fa-angle-right")
        .addClass("fa-angle-down");
    })
    .on("hide.bs.collapse", function () {
      $(this)
        .prev(".card-header")
        .find(".fa")
        .removeClass("fa-angle-down")
        .addClass("fa-angle-right");
    });
});
