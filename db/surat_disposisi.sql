-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2024 pada 15.56
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
-- Database: `surat_disposisi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bagian`
--

CREATE TABLE `tbl_bagian` (
  `id_bagian` int(10) NOT NULL,
  `nama_bagian` text DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_bagian`
--

INSERT INTO `tbl_bagian` (`id_bagian`, `nama_bagian`, `nip`, `id_user`) VALUES
(1, 'Deni Kurniawan, S. Pd.', '198006302003121003', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lampiran`
--

CREATE TABLE `tbl_lampiran` (
  `id_lampiran` int(10) NOT NULL,
  `token_lampiran` varchar(100) NOT NULL,
  `nama_berkas` text DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_lampiran`
--

INSERT INTO `tbl_lampiran` (`id_lampiran`, `token_lampiran`, `nama_berkas`, `ukuran`) VALUES
(1, 'a9c95b71e504c14a62eecaf72285d31d', '2022-08-07_SM_1659884027.pdf', '122.72'),
(2, '8ebe6294441df39b737a0e73213bd82a', '2022-08-15_SK_1660574668.pdf', '100.71'),
(3, 'be1ca52dd58c1f463b1e2ef8d4565e10', '2022-08-17_SM_1660753033.pdf', '100.71'),
(4, 'bfb42068c131555ddac14956ecf4abaf', '2024-06-26_SM_1719396766.pdf', '1236.77');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sekolah`
--

CREATE TABLE `tbl_sekolah` (
  `id` int(2) NOT NULL,
  `nm_kepala` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `sekolah` varchar(100) DEFAULT NULL,
  `npsn` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tapel` varchar(20) DEFAULT NULL,
  `kop_1` text DEFAULT NULL,
  `kop_2` text DEFAULT NULL,
  `telp` text DEFAULT NULL,
  `id_user` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_sekolah`
--

INSERT INTO `tbl_sekolah` (`id`, `nm_kepala`, `nip`, `jabatan`, `sekolah`, `npsn`, `alamat`, `tapel`, `kop_1`, `kop_2`, `telp`, `id_user`) VALUES
(1, 'Drs. Nam Nam, M. Pd. I.', '199909082020101004', 'Kepala Sekolah', 'SMAN 1 Beutong Aceh', '10104680', 'Jl. Nasional KM 1.5 Blang Seumot Kec. Beutong', '2021/2022', 'KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI', 'DINAS PENDIDIKAN PROVINSI ACEH', 'Telepon (0338) 671123 - Email: info@sman1beutong.sch.id', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id` int(4) NOT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `nm_siswa` varchar(255) DEFAULT NULL,
  `ttl` varchar(255) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `jurusan` varchar(10) DEFAULT NULL,
  `nm_ort` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_user` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id`, `nis`, `nisn`, `nm_siswa`, `ttl`, `kelas`, `jurusan`, `nm_ort`, `alamat`, `id_user`) VALUES
(1, '2200001', '5555555555', 'HERWAN PRAYITNO', 'Sungai Selatan, 01 Juli 1999', 'X', 'IPA 1', 'SUTIYA', 'Jl. Solok Utara Gang 7 - Sungai Selatan', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sk`
--

CREATE TABLE `tbl_sk` (
  `id_sk` int(10) NOT NULL,
  `id_surat` varchar(20) DEFAULT NULL,
  `tgl_id_surat` varchar(12) DEFAULT NULL,
  `no_surat` text DEFAULT NULL,
  `tgl_sk` varchar(12) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `token_lampiran` text DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `pelaksana` varchar(255) DEFAULT NULL,
  `bagian` varchar(255) DEFAULT NULL,
  `peringatan` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_sk`
--

INSERT INTO `tbl_sk` (`id_sk`, `id_surat`, `tgl_id_surat`, `no_surat`, `tgl_sk`, `kode`, `perihal`, `tujuan`, `token_lampiran`, `id_user`, `pelaksana`, `bagian`, `peringatan`) VALUES
(1, '001', '2022-08-15', '01.004/SMA-SM/V/2018', '2022-08-15', 'PP.02', 'Pelaksanaan KSM Kabupaten', 'Kemenag Sungsel', '8ebe6294441df39b737a0e73213bd82a', 2, 'Arsip', 'Kepala TU', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ska`
--

CREATE TABLE `tbl_ska` (
  `id_ska` int(10) NOT NULL,
  `id_siswa` int(10) DEFAULT NULL,
  `nomor_ska` varchar(4) DEFAULT NULL,
  `no_ska` varchar(100) DEFAULT NULL,
  `jenis_ska` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_ska` varchar(100) DEFAULT NULL,
  `id_user` int(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `ttd` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_ska`
--

INSERT INTO `tbl_ska` (`id_ska`, `id_siswa`, `nomor_ska`, `no_ska`, `jenis_ska`, `keterangan`, `tgl_ska`, `id_user`, `date`, `ttd`) VALUES
(1, 1, '009', 'MA-SM/V/2022', '1', 'kegiatan paskibraka kabupaten', 'Sungai Selatan, 08 Agustus 2022', 2, '2022-08-17 23:15:23', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sm`
--

CREATE TABLE `tbl_sm` (
  `id_sm` int(10) NOT NULL,
  `no_sm` varchar(12) DEFAULT NULL,
  `no_asal` text DEFAULT NULL,
  `tgl_no_asal` varchar(12) DEFAULT NULL,
  `pengirim` text DEFAULT NULL,
  `penerima` text DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `token_lampiran` varchar(100) DEFAULT NULL,
  `bagian` varchar(255) NOT NULL,
  `disposisi` text DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `tgl_sm` varchar(12) DEFAULT NULL,
  `lampiran` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `sifat` varchar(20) DEFAULT NULL,
  `dibaca` int(1) DEFAULT NULL,
  `tgl_ajuan` varchar(20) DEFAULT NULL,
  `biasa` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tgl_disposisi` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_sm`
--

INSERT INTO `tbl_sm` (`id_sm`, `no_sm`, `no_asal`, `tgl_no_asal`, `pengirim`, `penerima`, `perihal`, `token_lampiran`, `bagian`, `disposisi`, `id_user`, `tgl_sm`, `lampiran`, `status`, `sifat`, `dibaca`, `tgl_ajuan`, `biasa`, `catatan`, `tgl_disposisi`) VALUES
(1, '001', '01.004/SMA-SM/V/2018', '2022-07-01', 'Kemenag Sungsel', 'PP.01', 'Pelaksanaan KSM Kabupaten', 'a9c95b71e504c14a62eecaf72285d31d', '0', 'Deni Kurniawan, S. Pd.', 2, '2022-08-07', '1 Lampiran', 'Asli', 'Segera', 3, '2022-08-07', 'Bicarakan dengan saya', '-', '2022-08-07 21:57:32'),
(2, '002', '01.004/SMA-SM/V/2022', '2022-08-16', 'Perpusda', 'PP.00', 'Pelaksaan Bazar Buku Pendidikan', 'be1ca52dd58c1f463b1e2ef8d4565e10', '0', 'Deni Kurniawan, S. Pd.', 2, '2022-08-17', '1 Lampiran', 'Asli', 'Segera', 3, '2022-08-17', 'Bicarakan dengan saya<br>Bicarakan bersama', 'Menghadap saya dan melakukan koordinasi', '2022-08-17 23:21:41'),
(3, '123345', '123456', '2024-06-26', 'Dinas Pendidikan Aceh', '1324', 'Undangan Rapat', 'bfb42068c131555ddac14956ecf4abaf', '0', 'Deni Kurniawan, S. Pd.', 2, '2024-06-26', '1 Lampiran', 'Asli', 'Segera', 3, '2024-06-26', 'Bicarakan bersama', 'Temui Saya di kantor', '2024-06-26 20:31:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(30) DEFAULT NULL,
  `level` enum('s_admin','admin','user','ktu','kepala') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `alamat`, `telp`, `level`) VALUES
(3, 'user', '21232f297a57a5a743894a0e4a801fc3', 'Suharto, S. Ag.', 'user@gmail.com', 'Jl. Solok Utara Gang 7 - Sungai Selatan', '081444451251', 'user'),
(2, 'petugas', '21232f297a57a5a743894a0e4a801fc3', 'Andreanto, S. H.', 'petugas@gmail.com', 'Jl. Solok Utara Gang 7 - Sungai Selatan', '081444451251', 'admin'),
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', 'Jl. Solok Utara Gang 7 - Sungai Selatan', '081444451251', 's_admin'),
(4, 'ktu', '21232f297a57a5a743894a0e4a801fc3', 'Sutrisno, S. Pd.', 'ktu@gmail.com', 'Jl. Solok Utara Gang 7 - Sungai Selatan', '081444451251', 'ktu'),
(5, 'kepala', '21232f297a57a5a743894a0e4a801fc3', 'Drs. Nam Nam, M. Pd. I.', 'kepala@gmail.com', 'Jl. Solok Utara Gang 7 - Sungai Selatan', '081444451251', 'kepala');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indeks untuk tabel `tbl_lampiran`
--
ALTER TABLE `tbl_lampiran`
  ADD PRIMARY KEY (`id_lampiran`);

--
-- Indeks untuk tabel `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_sk`
--
ALTER TABLE `tbl_sk`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indeks untuk tabel `tbl_ska`
--
ALTER TABLE `tbl_ska`
  ADD PRIMARY KEY (`id_ska`);

--
-- Indeks untuk tabel `tbl_sm`
--
ALTER TABLE `tbl_sm`
  ADD PRIMARY KEY (`id_sm`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  MODIFY `id_bagian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_lampiran`
--
ALTER TABLE `tbl_lampiran`
  MODIFY `id_lampiran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_sk`
--
ALTER TABLE `tbl_sk`
  MODIFY `id_sk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_ska`
--
ALTER TABLE `tbl_ska`
  MODIFY `id_ska` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_sm`
--
ALTER TABLE `tbl_sm`
  MODIFY `id_sm` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
