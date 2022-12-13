-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2022 pada 18.12
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db2022_msglow`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_brand`
--

CREATE TABLE `tb_brand` (
  `id_brand` char(8) NOT NULL,
  `nama_brand` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_brand`
--

INSERT INTO `tb_brand` (`id_brand`, `nama_brand`) VALUES
('IDB-0001', 'ms glow'),
('IDB-0002', 'ms bodycares'),
('IDB-0003', 'ms slim'),
('IDB-0004', 'ms cosmetics');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_order`
--

CREATE TABLE `tb_detail_order` (
  `id_do` int(10) UNSIGNED NOT NULL,
  `id_order` int(10) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `kab` varchar(50) DEFAULT NULL,
  `total_harga` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Belum Dikirim, 1=Barang Dikirim'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_order`
--

INSERT INTO `tb_detail_order` (`id_do`, `id_order`, `id_produk`, `qty`, `telp`, `alamat`, `kec`, `kab`, `total_harga`, `status`) VALUES
(12, 7, 2, 1, '085260562387', 'no 22, jln banda aceh-medan, grong-grong', 'grong-grong', 'pidie', '300000', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_image_produk`
--

CREATE TABLE `tb_image_produk` (
  `id_image` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_image_produk`
--

INSERT INTO `tb_image_produk` (`id_image`, `id_produk`, `image`) VALUES
(1, 1, 'ip-220915-9ef786f6ca.png'),
(2, 1, 'ip-220915-979af6a5d9.png'),
(3, 1, 'ip-220915-9ba5384425.png'),
(4, 2, 'ip-220921-7639b5fe53.png'),
(5, 2, 'ip-220921-eb46ead1d5.png'),
(6, 2, 'ip-220921-dfa5b13a46.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` char(8) NOT NULL,
  `id_brand` char(8) DEFAULT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `id_brand`, `nama_kategori`) VALUES
('IDK-0001', 'IDB-0001', 'cream'),
('IDK-0002', 'IDB-0001', 'skincare set'),
('IDK-0003', 'IDB-0001', 'general'),
('IDK-0004', 'IDB-0002', 'bundling set'),
('IDK-0005', 'IDB-0002', 'general'),
('IDK-0006', 'IDB-0002', 'scrub'),
('IDK-0007', 'IDB-0003', 'general');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(10) NOT NULL,
  `id_pembeli` char(10) DEFAULT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `status_order` int(1) DEFAULT 1,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `grand_total` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `id_pembeli`, `bukti_pembayaran`, `status_order`, `tanggal`, `grand_total`) VALUES
(7, '2208220001', 'struk-221025-925d941b06.jpg', 2, '2022-09-23 15:10:59', '300000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` char(8) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` varchar(10) DEFAULT NULL,
  `stok` char(4) DEFAULT NULL,
  `satuan` varchar(5) DEFAULT NULL,
  `manfaat` text DEFAULT NULL,
  `cara_penggunaan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `produk_status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_kategori`, `judul`, `deskripsi`, `harga`, `stok`, `satuan`, `manfaat`, `cara_penggunaan`, `keterangan`, `produk_status`) VALUES
(1, 'IDK-0001', 'White Cell DNA™ Night Cream', '<p>\r\n\r\nWhiteCellDNA™ Night Cream adalah krim malam yang diformulasikan untuk mengatasi kulit kusam, noda hitam, dan keluhan akibat rusaknya skin barrier. Produk ini telah diuji oleh ahli dan terbukti membantu memperbaiki kondisi kulit dalam 7 hari. Diperkaya kandungan Niacinamide dan Squalane yang melembapkan kulit, formulanya lembutnya membuat MS Glow WhiteCellDNA™ Night Cream dapat digunakan oleh semua jenis kulit, ibu hamil dan menyusui, serta remaja.\r\n\r\n<br></p>', '90000', '20', 'Unit', '<p>\r\n\r\n</p><ul><li>Memperkuat Skin Barrier</li><li>Menyamarkan flek / noda hitam</li><li>Melembabkan Kulit</li></ul>\r\n\r\n<br><p></p>', '<p>Oleskan MS Glow White DNA Night Cream secukupnya pada kulit yang telahh dibersihkan. Gunakan pada malam hari. Hindari kontak dengan mata.<br></p>', 'Harap', 'Baru'),
(2, 'IDK-0002', 'Luminous Whitening Series', '<p>\r\n\r\nVarian paket wajah MS GLOW yang diformulasikan khusus untuk membantu mencerahkan kulit kusam dengan noda hitam atau flek agar tampak lebih cerah, noda hitam tersamarkan dan sehat bercahaya dari hari ke hari.\r\n\r\n<br></p>', '300000', '99', 'Paket', '<p>\r\n\r\n</p><ul><li>Mencerahkan Kulit</li><li>Menyamarkan flek / noda hitam</li><li>Menutrisi Kulit</li></ul>\r\n\r\n<br><p></p>', '<p>Facial Wash: Pump Facial Wash secukupnya ke telapak tangan, lalu usapkan ke wajah secara perlahan dengan gerakan memutar untuk mengangkat sel kulit mati dan kotoran. Kemudian bilas dengan air sampai bersih dan keringkan dengan tissue atau handuk yang lembut. Glowing Toner: Gunakan setelah Facial Wash. Spray Glowing Toner MS GLOW 2-3 kali pada kapas, lalu tepuk ke wajah secara perlahan. Dapat digunakan di pagi dan malah hari.<br></p>', 'Cocok untuk Semua Jenis Kulit,Kulit Kusam', 'Baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` char(10) NOT NULL,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `level` int(1) NOT NULL COMMENT '1=admin,2=penjual,3=pembeli',
  `image` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`, `nama`, `tanggal`, `level`, `image`) VALUES
('2409200002', 'admin@msglow.com', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'Nurul Muthmainnah', '2020-09-28 13:36:44', 1, NULL),
('2208220002', 'anisah@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Anisah', '2022-08-22 14:24:06', 2, NULL),
('2208220001', 'yenianjani@gmail.com', '324be22856948259555d5af20bbf5d92ff935636', 'Yeni Anjani', '2022-08-22 14:20:12', 2, 'image-220825-1bec304ec0.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_brand`
--
ALTER TABLE `tb_brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indeks untuk tabel `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD PRIMARY KEY (`id_do`);

--
-- Indeks untuk tabel `tb_image_produk`
--
ALTER TABLE `tb_image_produk`
  ADD PRIMARY KEY (`id_image`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  MODIFY `id_do` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_image_produk`
--
ALTER TABLE `tb_image_produk`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
