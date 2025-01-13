-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Nov 2024 pada 16.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dd`
--

CREATE TABLE `dd` (
  `dd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_user` int(200) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `judul_buku`, `foto`, `id_user`, `nama`) VALUES
(13, 'prabowo sang pemersatu bangsa', '672b09899b4fa.jpg', 9, 'neymar'),
(14, 'jokowi pemimpin rakyat ', '6729b90606047.jpg', 9, 'neymar'),
(15, 'prabowo sang pemersatu bangsa', '672b09899b4fa.jpg', 9, 'neymar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `prodi` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nim`, `nama_anggota`, `tempat_lahir`, `tgl_lahir`, `jk`, `prodi`) VALUES
(2, 323432111, 'watiq', 'bandung', '1998-01-01', 'P', 'Teknik Management'),
(3, 3432123, 'Rudi Tabuti', 'Palembang', '1998-07-02', 'L', 'Sistem Operasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `pengarang_buku` varchar(100) NOT NULL,
  `penerbit_buku` varchar(150) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `jumlah_buku` int(3) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `lokasi` enum('Rak 1','Rak 2','Rak 3') NOT NULL,
  `tgl_input` date NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `pengarang_buku`, `penerbit_buku`, `tahun_terbit`, `isbn`, `jumlah_buku`, `kategori`, `lokasi`, `tgl_input`, `foto`) VALUES
(10, 'biografi soeharto', 'amien rais', 'erlangga', '2008', '', 5, '', 'Rak 1', '2024-11-04', '672872096a5dc.jpg'),
(13, '10 dosa besar soeharto', 'megawati', 'dpr', '2007', '', 6, '', 'Rak 2', '2024-11-05', '67297f1cd8fcd.jpg'),
(18, 'memahami china', 'ahok', 'erlangga', '2008', 'dawawawawawawawawawawawaw', 4, 'Cerpen', 'Rak 1', '2024-11-05', '672986e807b21.jpeg'),
(19, 'jokowi pemimpin rakyat ', 'prabowo', 'kabinet merah putih', '1995', 'h;unjbbbbbbbbbbbbbbbbb', 5, 'Biografi', 'Rak 1', '2024-11-05', '6729b90606047.jpg'),
(20, 'prabowo sang pemersatu bangsa', 'prabowo', 'kabinet merah putih', '2024', 'wdadadadadadadadadadadada', 5, 'Biografi', 'Rak 1', '2024-11-06', '672b09899b4fa.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `nim_transaksi` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_buku`, `nim_transaksi`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(7, 4, 2, 2, '01-07-2020', '23-07-2020', 'kembali'),
(8, 6, 3, 3, '01-07-2020', '5-07-2020', 'pinjam'),
(11, 4, 3, 3, '13-07-2020', '20-07-2020', 'pinjam'),
(12, 13, 3, 3, '06-11-2024', '13-11-2024', 'pinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(2, 'harun', '$2y$10$0ytYJF98cGtxAe88cu4B3ekzNYHA1ViwnKGXSDWp00gDwykd.og8.', 'harun', ''),
(4, 'ronaldo07', '$2y$10$g/dc238vxatCSdw/7T.8Rekiq9qFAlcKIIwTFIfWEHoRtUnyhoZDq', 'ronaldo', 'admin'),
(9, 'neymar77', '$2y$10$YQ6fp0d6fNnX3ywEOA28puUBVxFTxZ6qhGzUQi.nP9ZIfGhY3/ANC', 'neymar', 'peminjam'),
(10, 'petugas1', '$2y$10$LsKuAnw.p9ELS2jhIF0jIeAa29A3PIIeRptPuS4TC2KCzioxrxzWy', 'petugas1', 'petugas'),
(11, 'petugas2', '$2y$10$/rzVQ2q2Bj..7BWAlykGsuZpGHjIDKsdDAe6Y/T9lj8XOFzd4/nI6', 'petugas2', 'petugas'),
(13, 'messi10', '$2y$10$HSbkS3aT29fGf/Xu.fx5AuFrCAxA7Im1Z/KaILD6w2cJAtxPRtsq.', 'messi', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
