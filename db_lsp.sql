-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2021 pada 06.09
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lsp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `waktu_publish` datetime NOT NULL,
  `foto` text NOT NULL,
  `view` int(11) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul`, `isi`, `waktu_publish`, `foto`, `view`, `penulis`, `created_at`, `updated_at`) VALUES
(5, 'Digital Talent Scholarship', '<p><strong>Lorem Ipsum</strong>&nbsp;adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>\r\n', '2021-09-25 10:24:59', 'Berita1632540385-Buku1629849646-90262923.png', 0, 'akbar', '2021-09-25 10:26:25', NULL),
(6, 'SAR menyelamatkan anak di gunung guntur', '<p><strong>Lorem Ipsum</strong>&nbsp;adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>\r\n\r\n<p>Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah &quot;de Finibus Bonorum et Malorum&quot; (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, berasal dari sebuah baris di bagian 1.10.32.</p>\r\n', '2021-09-25 10:26:27', 'Berita1632540440-tim-penyelamat-bocah-pendaki-di-garut-1_169.jpeg', 0, 'akbar', '2021-09-25 10:27:20', NULL),
(7, 'Pelayanan bank BNI', '<p>Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah &quot;de Finibus Bonorum et Malorum&quot; (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, berasal dari sebuah baris di bagian 1.10.32.</p>\r\n', '2021-09-25 10:27:22', 'Berita1632540467-berita2.jpg', 0, 'akbar', '2021-09-25 10:27:47', NULL),
(8, 'Awalnya berteman, lama lama jadi sayang', '<p>Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah &quot;de Finibus Bonorum et Malorum&quot; (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, berasal dari sebuah baris di bagian 1.10.32.</p>\r\n', '2021-09-25 10:27:49', 'Berita1632540522-berita1.jpg', 1, 'akbar', '2021-09-25 10:28:42', '2021-09-25 10:46:06'),
(9, 'Debut Cr Ronaldo di MU mencetak gol', '<p>Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah &quot;de Finibus Bonorum et Malorum&quot; (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, berasal dari sebuah baris di bagian 1.10.32.</p>\r\n', '2021-09-25 10:28:44', 'Berita1632540627-berita3.jpg', 0, 'akbar', '2021-09-25 10:30:27', NULL),
(10, 'Moh Salah berhasil menggocek pemain bertahan Arsenal', '<p>Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah &quot;de Finibus Bonorum et Malorum&quot; (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, berasal dari sebuah baris di bagian 1.10.32.</p>\r\n', '2021-09-25 10:30:29', 'Berita1632540663-berita4.jpg', 0, 'akbar', '2021-09-25 10:31:03', NULL),
(11, 'Witan berhasil mencetak gol dan membawa kemenangan bagi Indonesia atas Malaysia', '<p>Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah &quot;de Finibus Bonorum et Malorum&quot; (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, berasal dari sebuah baris di bagian 1.10.32.</p>\r\n', '2021-09-25 10:31:05', 'Berita1632540703-berita5.jpg', 1, 'akbar', '2021-09-25 10:31:43', '2021-09-25 10:40:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_penerbit` date NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `kode`, `judul`, `penulis`, `penerbit`, `tahun_penerbit`, `stok`, `gambar`) VALUES
(17, 'BKU0002', 'Aplikasi Sistem Informasi Perpustakaan', 'Akbar Imawan Dwi Cahya', 'POLIJE', '2021-08-11', 1, 'Buku1629849752-1.PNG'),
(18, 'BKU0003', 'Sistem Informasi Perkutut', 'Akbar Imawan Dwi Cahya', 'MIF', '2021-08-19', 2, 'Buku1629849857-Capture12.PNG'),
(19, 'BKU0004', 'Perancangan Basis Data ', 'Akbar Imawan Dwi Cahya', 'MIF', '2021-08-27', 1, 'Buku1629849506-pengertian-basis-data.jpg'),
(20, 'BKU0005', 'Wisata And Tour Jember', 'Akbar Imawan Dwi Cahya', 'POLIJE', '2021-08-20', 2, 'Buku1629849905-paket-tour-murah-jember-bali-4-hari-1-malam-630x380.jpg'),
(21, 'BKU0006', 'Point Of Sale Toko', 'Akbar Imawan Dwi Cahya', 'MIF', '2021-08-17', 2, 'Buku1629849955-download.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_file`
--

CREATE TABLE `tb_file` (
  `id_file` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_file`
--

INSERT INTO `tb_file` (`id_file`, `title`, `file`) VALUES
(1, 'Freelancer Web Developer', 'Dwn1632518257-Data Berita.csv'),
(2, 'User Interface LSP', 'Dwn-1632519543-UI-Akbar Imawan Dwi Cahya-25 september 2021.docx'),
(3, 'CV', 'Dwn-1632519628-CV_Akbar Imawan Dwi Cahya.pdf'),
(4, 'Form komitmen VSGA', 'Dwn-1632519738-Form Komitmen Program DTS 2021.pdf'),
(5, 'Bukti VSGA', 'Dwn-1632520111-bukti vsga.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pinjam` datetime NOT NULL,
  `tanggal_kembali` datetime NOT NULL,
  `penanggung_jawab` varchar(50) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `penanggung_jawab`, `id_buku`, `id_user`, `status`) VALUES
(4, '2021-08-25 04:10:49', '2021-09-01 00:00:00', '', 7, 7, 0),
(6, '2021-08-27 16:09:23', '2021-08-28 00:00:00', 'Akbar Imawan Dwi Cahya', 18, 7, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` int(2) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `foto` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `email`, `password`, `alamat`, `jenis_kelamin`, `telp`, `foto`, `level`) VALUES
(6, 'Akbar Imawan Dwi Cahya', 'akbar', 'akbarimawan18@gmail.com', '$2y$10$.NmrByAbOAPmCD.mHB.N8uuxG849ZGqbIp9stYNeknEHVqY4sKhci', 'Jln Blater no 88 Curah Rejo Cangkring Jenggawah', 0, '083111693720', 'user.png', 1),
(7, 'Aisyah Nora Kurniawati', 'aisyah', 'aisyah@gmail.com', '$2y$10$76NobUQwlabjbmrDLeiZ9ePeSSZhloQ/juRPZpopPQvI.kBXJ4rs2', ' Wuluhan Kepel ', 1, '088233767652', 'user.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tb_file`
--
ALTER TABLE `tb_file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_file`
--
ALTER TABLE `tb_file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
