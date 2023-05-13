-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2023 at 07:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbt`
--

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `kk`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `jumlah_saudara`, `alamat`, `catatan_keluarga`, `created_at`, `updated_at`) VALUES
(1, '0001', 'Abdul Rajjak Ghozali', 'Elli Susanti', 'Karyawan Sipil', 'PNS', '2', 'Gunung Seteleng RT05 RW 02, Ds. Gunung Seleteng, Kec. Penajam, Kab. Penajam Paser Utara, Kode Pos 76141, Prov. Kalimantan Timur', NULL, NULL, NULL),
(2, '3174061601096056', 'Deddy Triarvianto', 'Ririen Oktarina', 'Karyawan Swasta', 'IRT', '1', 'JL. Karang Tengah Raya NO Z/9, RT 007 RW 006, Kel. Pondok Labu, Kec. Cilandak Jakarta Selatan', NULL, NULL, NULL),
(3, '6471051901180009', 'Muhlis ST', 'Siti Hamidah', '-', 'Wirausaha', '4', 'Perusda II BLOK H2 No 16 Rt. 32 Kel. Sepinggan Baru Kec. Balikpapan Selatan Kota Balikpapan', NULL, NULL, NULL),
(4, '3271040403070604', 'Slamet Hartojo', 'Dian Saraswati', 'PNS', 'IRT', '2', 'Bogor Raya Permai Fd 4/29a RT 001 RW 012, Kel. Curug, Kec. Kota Bogor Barat, Bogor', NULL, NULL, NULL),
(5, '3276081001110011', 'Heri Wibowo', 'Neneng Winda', 'Karyawan Swasta', 'IRT', '1', 'Grand Depok City Sektor Melati Blok B4/08 Rt 001/005 Kel. Jatimulya Kec. Cilodong Kota Depok', NULL, NULL, NULL),
(6, '3171031701091442', 'Nur Supriyanto', 'Gantiati', 'PNS', 'PNS', '1', 'Bendungan Jago Rt. 019/002 Kel. Serdang Kec. Kemayoran Jakarta Pusat', NULL, NULL, NULL),
(7, '3271040706071968', 'Iman Harmaen', 'Netty', 'Karyawan Swasta', 'IRT', '2', 'Bogor Raya Permai FM I No 5, Kel. Curug, Kec. Kota Bogor Barat, Kota Bogor', NULL, NULL, NULL),
(8, '0002', 'KOMARUDIN SYAM', 'WENY EWE ( Almh )', 'Karyawan Swasta', '-', '1', 'Jl. Kebon Jahe VIII/36 RT 09 Rw 02 Kel. Petojo Selatan, Kec. Gambir, Kota Jakarta Pusat, Kode Pos. 10160, DKI Jakarta', NULL, NULL, NULL),
(9, '3171032301094140', 'Hery hendarta', 'Deby Triandayani', 'Karyawan Swasta', 'IRT', '2', 'JL. Nilam Raya No 14 RT 001 RW 004, Kel. Sumur Batu, Kec. Kemayoran Jakarta Pusat', NULL, NULL, NULL),
(10, '3175011301098207', 'Ali Wardana', 'Alm. Sri Lestari', 'PNS', 'IRT', '2', 'Griya katulampa Blok BXI No.06 RT 09 RW 10', NULL, NULL, NULL),
(11, '1603091303090009', 'ZULKIFLI', 'EMI TAZKIA', 'POLRI', 'BIDAN', '2', 'Dusun II Ds. Aremantai, Kec. Semende Darat Ulu, Kab. Muara Enim, Sumatera Selatan, Kode Pos. 31356', NULL, NULL, NULL),
(12, '3216072112100277', 'Lalu Deky Mulyanto', 'Dian Cahyani', 'Karyawan Swasta', 'IRT', '3', 'Perum Trias Estate Blok A.5 No.29 RT 06 RW 19, Ds. Wanasari, Kec. Cibitung, Kota Bekasi, Jawa Barat, Kode Pos 17520,', NULL, NULL, NULL),
(13, '3674051305140012', 'Chaidir', 'iis supartini', 'Karyawan Swasta', 'IRT', '1', 'Komp. Nuansa Asri Cinangka Blok G No.1 RT 04 RW 11 Kode Pos. 16516 Des. Cinangka, Kec. Sawangan, Kota Depok, Jawa Barat.', NULL, NULL, NULL),
(14, '3271042205080032', 'Muhamad Husni', 'Kristina', 'Karyawan Swasta', 'IRT', '2', 'Bogor Raya Permai FK  I No 17 RT 002 RW 014, Ds. Curug, Kec. Kota Bogor Barat, Kota Bogor, Jawa Barat', NULL, NULL, NULL),
(15, '1603073112130002', 'Sugianto', 'Sri haryani', 'Karyawan Swasta', 'PNS', '2', 'BTN Pama Karang Asam Blok D2 No 16 RT 01 RW 06 Kode Pos 31715 Des. Tanjung Enim Selatan Kec. Lawang Kidul, Kab. Muara Enim, Sumatera Selatan', NULL, NULL, NULL),
(16, '3174100711190021', 'Yono', 'Nurul Mauluziyah', 'Wiraswasta', 'Guru', '2', 'Jl Mawar 2 Dalam No. 14 RT 7 RW 13, Jaksel Bintaro', NULL, NULL, NULL),
(17, '3201043001080053', 'Siswanto', ' Evi Karmilah', 'PNS', 'PNS', '2', 'CIL. Bumi Pertiwi II Blok FQ-37 RT 009 RW 014, Ds. Cilebut Timur, Kec. Sukaraja, Kab. Bogor, Jawa Barat, Kode Pos 16710', NULL, NULL, NULL),
(18, '3271041309090006', 'TAUFIQUR RAHMAN', 'Anies Roziah', 'Karyawan Swasta', 'IRT', '2', 'Jl. Bambu Kuning II/10 RT 006/ RW 011, Kel. Cilendek Timur, Kec. Bogor Barat, Kab. Bogor Kode Pos 16112, Jawa Barat', NULL, NULL, NULL),
(21, '3173081001090547', 'Yanuar Ihsan', 'Lora Carolina', 'PNS', 'Karyawan Swasta', '3', 'Srengseng RT 007 RW 002 Kode Pos. 11630, Des. Srengseng, Kec. Kembangan, Jakarta Barat, DKI Jakarata.', NULL, NULL, NULL),
(22, '3208162505070007', 'Yanuar ilham', 'Era Erawati', 'Karyawan Swasta', 'IRT', '2', 'Dusun Wage RT 006 RW 001, Ds. Cilowa, Kec. Kramatmulya, Kab. Kuningan,, Jawa Barat, Kode Pos. 45553', NULL, NULL, NULL),
(23, '1603020904070010', 'Hardiansyah', 'Yunita Dwi Alfiana', 'Pengacara', 'PNS', '2', 'Jl. Karet No 55/D RT 01 RW 02, Kel. Air Lintang, Kec. Muara Enim, Kab. Muara Enim', NULL, NULL, NULL),
(24, '0003', 'Arif Rachman Suhandi', 'Filma Hani', 'PNS', 'IRT', '2', 'Perum. Bogor Raya Permai Blok FC 3 No.16, Kel. Curug, Kec. Bogor Barat, Kota Bogor.', NULL, NULL, NULL),
(25, '3201400103100005', 'Subroto', 'Lilis kholisoh', 'Karyawan Swasta', 'Guru', '2', 'Kp. Tapos Udik, Ds. Tapos ll RT 01 RW 08, Kec. Tenjolaya, Kab. Bogor', NULL, NULL, NULL),
(26, '0004', 'ACHMAD SANI SETIAWAN', 'ENDANG SETIYOWATI', 'PNS', 'Karyawan Swasta', '1', 'Jl. Kesehatan Bawah No.8 RT 02 RW 08 Kel. Bintaro, Kec. Pesanggrahan, Kota Jakarta Selatan, Kode Pos. 12330, DKI Jakarta ', NULL, NULL, NULL),
(27, '3603281410140026', 'Priyono', 'Desi dwi saputri', 'Wiraswasta', 'IRT', '2', 'Jalan Gianyar Raya, No.12, Perumnas 3, Kec.Kelapa Dua, Kab. Tangerang Banten', NULL, NULL, NULL),
(28, '3276061411090012', 'Budi Roza', 'Famelia', 'Karyawan Swasta', 'IRT', '2', 'Komplek UI Jl. Raya Sawangan Blok D No.11 RT 6 RW 10, Kel.Pancoran Mas, Kec.Pancoran Mas, Depok', NULL, NULL, NULL),
(29, '3275061609080015', 'Sabar Budiman', 'Yunia Renatasari', 'Karyawan Swasta', 'Guru', '1', 'Perum Taman Harapan Baru , Jl Taman Tulip III B4/44B Rt4 Rw 26, Pejuang,Medan Satria, Kota Bekasi', NULL, NULL, NULL),
(31, '3201402311090010', 'Maman Nuriman ', 'Siti Rohmahtul Ijabah', 'Wiraswasta', '', '3', 'Jalan Abdul Fatah, Kp. Setu RT 03 RW 03, Ds. Tapos 01, Tenjolaya, Kab. Bogor', NULL, NULL, NULL),
(32, '1603071301140004', 'Hari Widiyatmoko', 'Lilis Lestari', 'Karyawan Swasta', 'IRT', '2', 'BTN Mandala Blok E1 No.1', NULL, NULL, NULL),
(33, '3271040403079798', 'Mohammad Ilham Bahrunsjah', 'Khairiyatussyarifah', 'Karyawan Swasta', 'IRT', '4', 'Bogor Raya Permai Blok FJ4 No. 10, Bogor Barat, Kota Bogor, 16113', NULL, NULL, NULL),
(34, '3201291807190008', 'Indra Agus Surya Daroesman', 'Melantika Utami', 'wirausaha', 'IRT', '3', 'Kp. Parakan Mulya, Gg. H. Bashori No. 19 RT 02 RW 07, Ds. Parakan, Kec Ciomas, Kab. Bogor', NULL, NULL, NULL),
(35, '3271030303077298', 'Arif Muhammad Iqbal', 'Dineu Sopia Mukhtar', 'Karyawan Swasta', 'IRT', '2', 'Jalan Tegallega no 35 D rt 02 rw 01 bogor tengah', NULL, NULL, NULL),
(36, '3173050601094221', 'Abdul manap', 'Rihanah', 'Guru', 'IRT', '3', 'Jl. Panjang Kebun Jeruk No.74 RT 001 RW 011', NULL, NULL, NULL),
(37, '3674070106161006', 'Aliyudin', 'Mas\'ah sugiarti', 'Wiraswasta', 'Karyawan Swasta', '2', 'Komplek Panorama Serpong Blok A2/1, Ds.Bakti Jaya, Setu, Tangerang Selatan, Banten', NULL, NULL, NULL),
(38, '3276111306110020', 'Zaenal Aripin ', 'Puji Astutik', 'Karyawan Swasta', 'Karyawan Swasta', '2', 'Komplek  Dumek Sawangan Resident Blok A No.2 RT 04 RW 01, Kp. Desa Duren Mekar,  Bojong Sari, Depok ', NULL, NULL, NULL),
(39, '3171071701094640', 'Danang Wikantiaji', 'Puspita Sari', 'Karyawan Swasta', '', '1', 'Jl. Kebu sayur no 21 RT 07 RW 07, Kec. Kebun Melati, Kel. Tanah Abang, 10230', NULL, NULL, NULL),
(40, '3175081201098135', 'Mohamad Agus', 'Nurul Hidayati', 'Guru', '', '0', 'Jl.Kerja Bakti VII RT 02 RW 07 No.52B, Makasar, Jakarta Timur', NULL, NULL, NULL),
(42, '3216060908170035', 'Tata Atmaja', 'Yati Sariyati', '-', '-', '2', 'Kp.Sasak Tiga RT 001 RW 004 No.36, Ds. Tridaya Sakti, Tambun Selatan, Bekasi', NULL, NULL, NULL),
(43, '3603281312120008', 'Agung Subekti', 'Rohimah', 'Karyawan Swasta', 'PNS', '0', 'Pesona Karawaci B.7 No.18, Bojong Nangka, Kelapa Dua, Tangerang, Banten', NULL, NULL, NULL),
(45, '3201403004150003', 'Deni Farayuda', 'Desi Novianti Mahardika', 'Karyawan Swasta', 'IRT', '2', 'Kp.Cisalada', NULL, NULL, NULL),
(46, '7571041703080124', 'Sumarjo', 'Linda Van Gobel', 'PNS', 'PNS', '2', 'Jl. Jeruk, Perum Griya Persada Lestari Blok C.9, Kel. Huangobotu, Kec. Dungingi, Kota Gorontalo, Prov Gorontalo', NULL, NULL, NULL),
(47, '3172021301090044', 'Komarudin', 'Widiawaty', 'Wirausaha', 'IRT', '2', 'Jl. Jati 6F No. 24 RT 02 RW 09, Kel. Sungai Bambu, Kec. Tanjung, Priok, Jakarta Utara 14330', NULL, NULL, NULL),
(48, '3603031207100038', 'Muhammad zaheri', 'Ida warni', 'Wiraswasta', 'Wirausaha', '0', 'Perumahan Puri Bidara City Park Blok A8 No.1 RT 07 RW 06', NULL, NULL, NULL),
(49, '3173050708190004', 'Taher Hamidi', 'Erni nurdin ', 'TNI AD', '-', '2', 'Jl. Soka No.30 RT 003 RW 04, Kel. Sukabumi Utara, Kebun Jeruk, Jakbar', NULL, NULL, NULL),
(50, '3174090908160007', 'Urip Budiarto', 'Sari Dwi Novandrini', '-', '-', '3', 'Jl. H. Montong No.32 A RT 003 RW 002, Ciganjur, Jagakarsa, Jakarta Selatan', NULL, NULL, NULL),
(51, '3173081001091001', 'Danil handoyo suladi ', 'Chandra dewi', 'Wirausaha', 'Wirausaha', '0', 'Poris Paradise 3 Blok BA12, No.5 RT 10 RW 11, Cipondoh, Tangerang', NULL, NULL, NULL),
(52, '3271040811160033', 'Ahmad Sehu ', 'Cahyarini ', 'Wiraswasta', 'Dokter Spesialis', '2', 'Jalan Selakopi No. 17 Kel. Loji Kec.Bogor barat kota Bogor ', NULL, NULL, NULL),
(54, '3174090701093814', 'Rudy Chandra ', 'Euis Hermawati ', 'Karyawan Swasta', 'IRT', '3', 'Jalan Jeruk gg. Robaya No.33a Rt 13/ Rw 01 Jagakarsa Jakarta Selatan 12620', NULL, NULL, NULL),
(55, '3276020211070153', 'Slamet Supriyanto', 'Ari Nurhayati', 'Wiraswasta', 'Karyawan Swasta', '3', 'Perumahan Griya Telaga Permai Blok D1 No 6 Rt 05/019 Cilangkap Tapos Depok', NULL, NULL, NULL),
(56, '3275022511080008', 'Fachrades basyar', 'Amalia nur', 'PNS', 'Pegawai', '1', 'Jalan kenari 4 no 7 harapan baru 1 bekasi barat', NULL, NULL, NULL),
(57, '0005', 'Lukman Santoso', '	Siti Suharni', '', '', '2', 'Griya Salah Asri, Bogor', NULL, NULL, NULL),
(58, '3275021004130001', 'Bima Anggara', 'Kanu Eltantrie', 'Wiraswasta', 'Karyawan Swasta', '0', 'Perumahan Harapan Baru 1 Blok Bb 5, Jl. Lengkeng I Blok Bb 5 No.20, RT.002/RW.20, Kota Baru, Kec. Bekasi Barat, Kota Bekasi, Jawa Barat 17133', NULL, NULL, NULL),
(59, '3171031208210025', 'Willy Achmad Bachtiar', 'Mia Primasyatie', 'Karyawan Swasta', 'PNS', '1', 'Jl. H. Ung Gang N Blok B No.15 RT 02 RW 03 Utan Panjang Kemayoran Jakarta Pusat  DKI Jakarta.  kode Pos 10650', NULL, NULL, NULL),
(60, '3276092701120009', 'R. Andri Mahendra', 'Yoana Windasari', 'Wirausaha', 'IRT', '4', 'Jl. Abdul Fatah. Desa Tapos 2\n\n. Rt 2. Rw 1. Tenjolaya. Bogor', NULL, NULL, NULL),
(61, '3271040103072173', 'EKO SUWARDIYANTO', 'WINERY NISASUCI', 'Konsultan', 'IRT', '4', 'Jl. Raya Semplak No.19 Semplak, Boogor\n', NULL, NULL, NULL),
(62, '3603172301080037', 'EKA ADI MANTRA', 'EEN MARDIYANTI', 'Wiraswasta', 'Dosen ASN', '4', 'KOMPLEK PERMATA HIJAU KSB, BLOK B 19 RT.03/08 KELURAHAN BANJARAGUNG KECAMATAN CIPOCOK JAYA, KOTA SERANG - BANTEN 42122', NULL, NULL, NULL),
(63, '0006', 'Andi Suhandi ', 'Nova Berra ', '', '', '2', 'Perum Greenland Forest Park Blok A-12', NULL, NULL, NULL),
(64, '0007', 'Budi Harta Mulyana', 'Sofia Elfi', '', '', '1', 'Tangerang, Medang Lestari Blok  II/01', NULL, NULL, NULL),
(65, '0008', 'Joni Hendrik', 'Lies Silvia Nasution', '', '', '0', 'Binong Permai Blok H 12 No.7, RT 04 RW 15, Kel. Binong, Kec. Curug, Kab.Tangerang, Banten 15810', NULL, NULL, NULL),
(66, '0009', 'Haris Dini Muharyanto', 'Priestasari Monika P.', 'Karyawan swasta', 'IRT ', '1', 'Taman Victoria, Jalan Mahkota Putra No.131 Sentul City, Bogor,Jawabarat', NULL, NULL, NULL),
(67, '0010', 'Subhan Umar', 'Nurjannah', 'Wirausaha ', 'IRT ', '4', 'Kp. Kedunghalang Tengah RT 02 RW 016, No. 26, Desa Cilebut Barat, Kec. Sukaraja, Kab. Bogor 16710', NULL, NULL, NULL),
(68, '0011', 'Ramelan Sukawanto', 'Ati Yuniarsih', 'Karyawan swasta', 'Karyawan swasta', '3', 'Jl. Pulo Mawar I No.15 RT 04/04,Kemandoran I, Kel. Grogol Utara, Kec. Kebayoran Lama Jakarta Selatan 12210', NULL, NULL, NULL),
(69, '0012', 'Budi Waluyo', 'Imas Suwarsih', 'Karyawan swasta', 'IRT ', '3', 'Jl. Kelurahan II RT 04 RW 04 No. 27, Kel. Duren Sawit, Kec. Duren Sawit Jakarta Timur', NULL, NULL, NULL),
(70, '0013', 'Vinsensius Us Olin', 'Albertina Maria Wiwid Rostiani', 'Karyawan swasta', 'Karyawan swasta', '1', 'Malang, Kacok, Komp. Pelita Kebonsari No.4B, RT 06 RW 06', NULL, NULL, NULL),
(71, '6371042801080121', 'Abu Bakar', 'Sri Eka Handayani', 'Karyawan swasta', 'IRT ', '1', 'Jl. Sultan Adam Komp. Mandiri Permai RT 34 No. 39, Banjarmasin Kalimantan Selatan', NULL, NULL, NULL),
(72, '3301213103100007', 'Agus Rahmat Jamal', 'Nuraini', 'Karyawan swasta', 'IRT ', '2', 'Cilacap Jala Juanda Komperta Gunung Simping No.193', NULL, NULL, NULL),
(73, '0014', 'Ahmad Sehu', 'Cahyarini', 'Dosen ', 'Dokter ', '3', 'Jl. Selakopi No. 17 RT 01 RW 04, Kel. Loji, Bogor Barat 16117', NULL, NULL, NULL),
(74, '0015', 'Imam Rosidin', 'Ririn Praptiani', 'Karyawan swasta', 'IRT ', '4', 'Dusun Tugu RT 30 RW 14 Ds. Sukorejo, Kec. Gandusari, Kab. Trenggalek Jawa timur', NULL, NULL, NULL),
(75, '0016', 'Lukman Santoso', '	Siti Suharni', 'Wiraswasta', 'guru', '2', 'Griya Salah Asri, Bogor', NULL, NULL, NULL),
(76, '3172021201096409', 'Yayat Hidayatna', 'Agusnawati', 'Pedagang', 'IRT ', '0', 'Jalan Bayangkara, Pondok Jagung, Kota Tangerang Selatan, Banten', NULL, NULL, NULL),
(77, '0017', 'Junaidi Alamsyah', 'Neni Komariah', '', '', '4', 'Pondok Rajeg No.35 RT 01 RW 07, Kab.Bogor, Jawa Barat', NULL, NULL, NULL),
(78, '0018', 'Havid', 'Fatiah', 'Karyawan swasta', 'IRT ', '2', 'Jl. Merak III No 49 Komp. Inkoppol jaka Sampurna, Bekasi Barat', NULL, NULL, NULL),
(79, '0019', 'Arief Budiman', 'Iis Soraya', '', '', '1', 'Jl. Bintara Jaya No. 58 RT 02 RW 08 Kel. Bintara Jaya Kec. Bekasi Barat Kota Bekasi', NULL, NULL, NULL),
(80, '0020', 'Nurhadi', 'Tintin Suharti', 'Wiraswasta', 'Guru ', '4', 'RT 29 RW 14, Dusun Tugu, Ds. Sukorejo, Kec. Gandusari, Kab. Trenggalek Jawa Timur', NULL, NULL, NULL),
(81, '3173010505111049', 'M. Zainudin', 'Yoyok Rakiyah', 'Karyawan swasta', 'Guru ', '3', 'Jl. Raya Duri Kosambi No.114 RT 005 RW 001 Kode Pos. 11750, DKI  										Jakarta', NULL, NULL, NULL),
(82, '3271040103100019', 'Arief Rahman', 'Tuti Handayani', 'PNS', 'Guru ', '2', 'Bogor Raya Permai FF IV No.5 RT 04 RW 13 Kode Pos. 16113, Ds. Curug, Kec. Kota Bogor Barat, Kota bogor, Jawa Barat', NULL, NULL, NULL),
(83, '3173051701099665', 'Nur Syawaludin', 'Nur Jannah', 'Wiraswasta', 'Guru ', '1', 'Jl. Pahlawan Kp. Baru RT 04 RW 05 Kode Pos. 11560, Ds. Suka Bumi Selatan, Kec. Kebon Jeruk, Kota Jakarta Barat, DKI Jakarta', NULL, NULL, NULL),
(84, '3603281407110010', 'Didin Sutandi', 'Sri Winarni', 'Wartawan ', 'Guru ', '0', 'Pesona Karawaci Blok B3/ 27 RT 02 RW 30 Kode Pos. 15812, Ds. Bojong Nangka, Kec. Kelapa Dua, Kota Tangerang, Banten', NULL, NULL, NULL),
(85, '3271041602080010', 'Nana Tasus Maulana', 'Rida Nurul Istiqomah', 'PNS', 'PNS', '1', 'Jl. Pancasan Baru No. 87 RT 01 RW 12, Ds. Pasirjaya, Kec. Kota Bogor Barat, Kota Bogor, Jawa Barat.', NULL, NULL, NULL),
(86, '3214012805077704', 'Didit Ghofar', 'Rika Halida', 'PNS', 'IRT ', '3', 'Jl. Ganesha No.4 Perum Bea 											Cukai Kudus', NULL, NULL, NULL),
(87, '0021', 'Asep Nuryadin', 'Riyatiningsih', 'Wiraswasta', 'IRT ', '3', 'Jl. Ciaruteun, Gardi seri, Kab. Bogor, Cimanggu 1 RT 03 RW 03', NULL, NULL, NULL),
(88, '3173052008111008', 'Abdi nusantara', 'Leni Rizkinta', 'Wiraswasta', 'Karyawan swasta', '2', 'Komp. Bepeka IV/B.19 RT 05 RW 11, Kel. Kebon Jeruk, Kec. Kebon Jeruk, Kota Jakarta Barat, Kode Pos. 11530, DKI Jakarta.', NULL, NULL, NULL),
(90, '3672021908090078', 'Endy Syamhudi', 'Iis Furriyanti', 'Karyawan swasta', 'IRT ', '3', 'Jl. Lingkar Selatan, Curug Katimaha No 115, Kel Bageudung, Kec. Cilegon, Kota Cilegon, Banten.', NULL, NULL, NULL),
(91, '3276041307120003', 'Wawan Setiawan Kusmayadi', 'Allysa Martika', 'Karyawan swasta', 'IRT ', '0', 'Cinere Park View Blok D1 RT 01 RW 03 Des. Grogol, Kec. Limo, Kota Depok, Kode Pos.16512, Jawa Barat.', NULL, NULL, NULL),
(92, '3201292203110617', 'Mohamad Hendra Kurniawan', 'Felly Ferlyanna', 'Pedagang', 'IRT ', '2', 'Taman Pagelaran Blok D6 No 4, Jl.Kenari Ciomas, Bogor, Jawa Barat', NULL, NULL, NULL),
(93, '0022', 'Panji Setia Bangsa', 'Titirismala Dewi', 'Freelancer Desain Grafis', 'pedagang ', '3', 'Jl. Mustika 5 No.9, RT 07 RW 11 Rawamangun Jakarta Timur', NULL, NULL, NULL),
(94, '3173052001100079', 'Afrizal', 'Dahlia', 'Karyawan swasta', 'IRT ', '1', 'Jl. P2 No 46 RW 1 RW 12, Kebun Jeruk, Jakarta Barat. 12870', NULL, NULL, NULL),
(96, '1603020211070011', 'Muhammad Amin', 'Yossi Fresahmanti', 'PNS', 'PNS', '2', 'Muara Enim, Gg Gerojokan Jl. Kol H Burlian Pasar 3, Kec. Muara Enim, Muara Enim', NULL, NULL, NULL),
(97, '6472052304080005', 'Baderi', 'Lilik Farida', 'GURU', 'Guru ', '2', 'Perum. Bengkuring, Jl. Asparagus 2, No 381.Kalimantan Timur', NULL, NULL, NULL),
(98, '6408040908110024', 'Andik siswanto', 'Karyatin', 'Wiraswasta', 'Wiraswasta', '3', 'Gg. Tribata 1, No 3, Teluk Lingga,Sangatta, Kalimantan Timur', NULL, NULL, NULL),
(99, '0023', 'Wempi wamese', 'Rulwati', 'Pelayaran ', 'Guru ', '2', 'Tibantalam Blok E1 No-09 Tiban Baru Skupang', NULL, NULL, NULL),
(100, '3276072611100008', 'Ramon Trisno', 'Betti Sovia', 'Dosen ', 'IRT ', '2', 'Depok, Citayam, Perumahan Permata Depok Sektor Safir M4/14', NULL, NULL, NULL),
(101, '3671131011140005', 'Faisal', '	Ratih Ramadhini', 'Wiraswasta', 'IRT ', '2', 'Taman Asri J 1 No 17 RT 005 RW 012 Ds. Gaga, Kec. Larangan, Kota Tangerang', NULL, NULL, NULL),
(103, '3173082109100056', 'Rian Aviandy', 'Daswati', 'Karyawan swasta', 'IRT ', '1', 'Jl. H. Kasam 1 No 15 RT 2 RW 8 Meruya Selatan, Kembangan, Jakarta Barat.', NULL, NULL, NULL),
(104, '3603282304090022', 'Daniel Agustian', 'Marini Sukmawati', 'Karyawan swasta', 'IRT ', '2', 'Jl. Mawaddah XII, Blok N-5 No. 05, Kelapa Dua, Tangerang, Banten', NULL, NULL, NULL),
(105, '6472052411071144', 'Zainal Afandi', 'Lia Merinda', 'Karyawan swasta', 'IRT ', '2', 'Kom. Villa Tamara Blok O No 10 RT 033, Ds. Gunung Kelua, Kec. Samarinda Ulu, Kota Samarinda', NULL, NULL, NULL),
(107, '3171010901151008', 'Ari Hadi Basuki Wibowo', 'Holly Deviarti', 'Konsultan ', 'Dosen ', '3', 'Jakarta Pusat. Jl.Petojo No.8', NULL, NULL, NULL),
(108, '36740125041170007', 'Ferdinand Thomas', 'Sari Wahyuningsih', 'Wiraswasta', 'Karyawan swasta', '3', 'Bukit Dago, Rawa Kalong, Cluster 										Pasadena', NULL, NULL, NULL),
(109, '0024', 'Endang Kusnad', 'Puji Rahayu', 'Karyawan swasta', 'IRT ', '2', 'Perum. Permata Depok Sektor Safir									Blok M 3A No.1', NULL, NULL, NULL),
(110, '3271060910070018', 'Ari Sulistyo', 'Yuni Purwanti', 'PNS', 'IRT ', '1', 'Perum Bukit Kayu Manis Blok 10/16 									RT 001 RW 012 Ds. Kayu Manis, Kec.', NULL, NULL, NULL),
(111, '3173070604151009', 'Rudi Hadi Suarno', 'Pitria Yeni', 'Wiraswasta', 'Apoteker ', '2', 'Jl. Rawa Belong 2 E No 81 RT 006 RW 010, Ds. Palmerah, Kec. Palmerah, Jakarta Barat.', NULL, NULL, NULL),
(112, '3671032003140005', 'Rijal', 'Dian Sukmayanti', 'Motivator/direktur', 'IRT ', '3', 'Taman Poris Gaga Blok A 6 No 28 RT 003 RW 006, Ds. Poris Gaga, Kec. Matu Ceper, Kota Tangerang', NULL, NULL, NULL),
(113, '3276063006140022', 'Raden Helmy Kurniawan SE', 'Mayasari', 'Karyawan swasta', 'IRT ', '3', 'Jl. Trembesi no 120, RT 04 RW 08, Depok, Jawa Barat', NULL, NULL, NULL),
(114, '317507141099411', 'Dwi Priyanto Widodo', 'Dian Apriana', 'Karyawan swasta', 'IRT ', '2', 'Jl. Bambumas Selatan IV Blok P No 6, Kel. Pondok Bambu, Kec. Duren Sawit, Kota Jakarta Timur, Provinsi DKI Jakarta, Kode Pos 13430', NULL, NULL, NULL),
(116, '3216060108120089', 'Maman Abdul Rohman', 'Ema Hasmayanti', 'Wiraswasta', 'Guru ', '1', 'Jl. Patriot Raya No.6 RT 01 RW 17, Kp. Rawa Aren Setia Mekar Tambun, Selatan Bekasi', NULL, NULL, NULL),
(117, '3173081407111027', 'Herman', 'Budi Indaharini', 'Karyawan swasta', 'IRT ', '2', 'Komplek DPR pribadi joglo  RT 08 RW 01, Gang H. Soleh, Jakarta Barat', NULL, NULL, NULL),
(119, '3271040103071407', 'Syaukani', 'Ela Yatin Nirmalasari', 'PNS', 'IRT ', '4', 'Komplek Bogor Raya Permai Blok FK 2 No. 24, Curug, Bogor 16113', NULL, NULL, NULL),
(120, '3271060712090010', 'Adhie Faizal Rachman', 'Siti Nurjanah', 'Wiraswasta', 'IRT ', '2', 'Jl Poncol, Kp.Parakan Salak/Parakan Jaya RT 02 RW 01, Kec.Kemang, Kab.Bogor', NULL, NULL, NULL),
(121, '6407071303080012', 'Achmad Mualim', 'Mulyati', 'Wiraswasta', 'Guru ', '2', 'Jl.M.Yamin RT 8, Kel.Simpang Raya, Kec.Barong Tongkok, Kab.Kutai Barat, Kalimantan Timur', NULL, NULL, NULL),
(122, '3171072301096791', 'Ricky Dirgantara', 'Widya Kusumadewi', 'PNS', 'IRT ', '3', 'Jl. Wibisana II No.10, Kec. Cibodas, Kota Tangerang, 15138', NULL, NULL, NULL),
(123, '3276011608100040', 'Sari Mulyono', 'Nunung Nurjanah', 'PNS', 'IRT ', '2', 'Perumahan Pesona Alam Residence Blok B No.2, Jl. Kartini, Depok, Jawa Barat ', NULL, NULL, NULL),
(124, '3276011105090091', 'Muhammad Olik Abdul Holik', 'Megasari', 'Karyawan BUMN ', 'IRT ', '3', 'Depok Maharaja BLOK H.1/32 RT 004 RW 014, Rangkapan Jaya, Pancoran Mas, Kota Depok', NULL, NULL, NULL),
(125, '6408040302100038', 'Herry Wibowo', 'Ida Nurfarida', 'Karyawan swasta', 'IRT ', '4', 'Jl.Kerayan No 118 Bumi Etam RT 002, Swarga Bara, Sangatta Utara, Kutai Timur, Kalimanta Timur', NULL, NULL, NULL),
(126, '3276021811210002', 'Ihsan Abdul Rosyid ', 'Nursanah ', 'GURU', 'GURU', '2', 'Jl. Pelangi III Blok.53 No.9 Kel. Mekarsari , Kec. Cimanggis , Kota Depok Jawa Barat ', NULL, NULL, NULL),
(127, '3523131703062614', 'Nuril Huda ', 'Lailatun', 'Karyawan swasta', 'IRT ', '3', 'Dsn Trogowaru RT.003/001 Tuban Jawa Timur', NULL, NULL, NULL),
(128, '3175050801098079', 'Yudi Setiawan', 'Nina Ningsih', 'PNS', 'IRT ', '2', 'Puri Gading Residences 2, Blok E5, Jln Tipar Setu, RT 01, RW 06, Mekarsari, Cimanggis, Depok, Jawa Barat.', NULL, NULL, NULL),
(129, '3173020701098295', 'Rumanto', 'Sartini ', 'Wiraswasta', 'Karyawan swasta', '1', 'Jl.Anggrek Nelimurni blok A no 100 B RT.015/001 Kemanggisan Palmerah Jakarta Barat 11480', NULL, NULL, NULL),
(130, '3271062311100007', 'Haris Sunandar Saputra', 'Evi Nafiatul Arif', 'PNS', 'IRT ', '3', 'Jl. A Yani No.132 Tanah Sereal Kota Bogor, Villa bogor indah 5 cluster garuda ca 11 no 1', NULL, NULL, NULL),
(131, '3271042101090020', 'Brahmantya Adji', 'Fera Nurlaelasari ', 'POLRI ', 'Karyawan swasta', '2', 'Kp.Semplak No 175 Rt 02 Rw 03 Kel.Bubulak Kec.Bogor Barat', NULL, NULL, NULL),
(132, '3275062308100006', 'ILHAMSYAH', 'NUR LAELI', 'Karyawan swasta', 'IRT ', '1', 'BULEVAR HIJAU B5 NO 27, RT 07 RW 09, PEJUANG, MEDAN SATRIA KOTA BEKASI 17131', NULL, NULL, NULL),
(133, '3301232806120002', 'Wiji', 'Hindun Kamsiyah', 'GURU', 'Karyawan swasta', '0', 'Perum.Jembar No.105', NULL, NULL, NULL),
(134, '3276021008110023', 'SUNANDAR', 'RAJIYANTI', 'POLRI ', 'IRT ', '1', 'KAMPUNG PEDURENAN DEPOK GANG SEMPLO NO. 117 RT. 004 RW. 001 KEL. CISALAK PASAR MEC. CIMANGGIS KOTA DEPOK', NULL, NULL, NULL),
(135, '3271041701120039', 'Hermansyah', 'Yuli Yanisari', 'Karyawan swasta', 'IRT ', '3', 'Perum Bogor Raya Permai FE 1 No.2, Curug, Bogor Barat, Kota Bogor', NULL, NULL, NULL),
(137, '3674063112180026', 'Nurhadi', 'Evi susanti', 'PNS', 'IRT ', '3', 'Jl beringin 1, rt04 rw07 no32 pamulang barat', NULL, NULL, NULL),
(138, '3503102406100003', 'Edi Santoso ', 'Indriyani', 'PNS', 'IRT ', '2', 'DSN. POJOK Tlpn. 011/005 Gandusari Trenggalek ', NULL, NULL, NULL),
(140, '3174051502131004', 'Dzaki Sadewa', 'Wahyu Aulizalsini', 'Wiraswasta', 'Dosen ', '1', 'Jl. Gunung Guntur II Blok B 3 No.9 Pondok Aren Tangerang Selatan', NULL, NULL, NULL),
(141, '9171022104080093', 'Sudaryanto', 'Nurbaya ', 'Karyawan swasta', 'Karyawan swasta', '2', 'Kp pancoran mas rt 08 rw 06 no 40 pancoran mas depok jabar ', NULL, NULL, NULL),
(142, '3175080601096687', 'Hazani, ST', 'Indah Tresno Maharsi, SH', 'Wiraswasta', 'Online Shop ', '1', 'Jln. inspeksi tarum barat no. 16 Rt 003 Rw 010, Cipinang Melayu, Makasar, Jakarta Timur', NULL, NULL, NULL),
(143, '3276010611120003', 'Tauchid', 'Atik Mildati Taflichah ', 'Karyawan swasta', 'PNS', '1', 'Kp. Pancoran mas RT.08/06 No 40 pancoran mas depok jawa barat', NULL, NULL, NULL),
(144, '3276080108110020', 'Muh Agus Saebani ', 'Pipit Puspita Sugiharty ', 'Karyawan swasta', 'IRT ', '4', 'Cimanggis Indah Blok O No.6 Sukamaju, Cilonjong, Depok', NULL, NULL, NULL),
(145, '3175062406131006', 'Wahyu Muryanto', 'Dewi Wulandari', 'Karyawan swasta', 'Karyawan swasta', '2', 'Jl. Swadaya Raya No. 20 RT.09/01 Pulogebang Cakung Jakarta Timur', NULL, NULL, NULL),
(146, '3674031301104161', 'Mohamad Ikhlas', 'Siti Syarifah', 'PNS', 'PNS', '4', 'Jl.Liam no.17 Rt:11/07 Duri Kepa, Kebon Jeruk, Jakarta Barat, DKI Jakarta.', NULL, NULL, NULL),
(147, '3272012601150009', 'Endra Surya ', 'Reni Indriani', 'ASN ', 'ASN ', '2', 'Perum Gading Regency Blok D4 No.28 Karang Tengah Kec. Gunung Puyuh Kota Sukabumi', NULL, NULL, NULL),
(148, '3173051201090723', 'Syahlani', 'Lilik Suharti', 'Wiraswasta', 'IRT ', '2', 'Jl.Liam no.17 Rt:11/07 Duri Kepa, Kebon Jeruk, Jakarta Barat, DKI Jakarta.', NULL, NULL, NULL),
(149, '3275021907070006', 'Johan Firdaus', 'Yusra Widya Pahlevi', 'Karyawan swasta', 'IRT ', '3', 'Jl. Pepaya RT.008/005 Kota Baru Bekasi Barat Kota Bekasi', NULL, NULL, NULL),
(150, '3174032008131008', 'Sigit Pramono', 'Maya saridha astri', 'Karyawan swasta', 'IRT ', '2', 'Jl. Pondok Jaya X No. 3 A RT.010/006 Pela Mampang Mampang Prapatan Jakarta Selatan, DKI JAKARTA', NULL, NULL, NULL),
(151, '3174021001096226', 'Hardjito ', 'Lisa Aisiyah ', 'Wartawan ', 'IRT ', '4', 'Jl. Menteng Granit rt.004/009 Pasar Manggis Setia Budi Jakarta Selatan', NULL, NULL, NULL),
(152, '3503071712100007', 'Budi Wijono', 'Kanifiyah', 'PNS', 'IRT ', '2', 'Jalan Wangsa Delima NO .7 ', NULL, NULL, NULL),
(153, '3215030612070006', 'Iswantoro', 'Maria Anna Kristianingsih', 'Karyawan swasta', 'IRT ', '3', 'Perum Karaba Indah Blok DD No 21, RT01 RW09, Ds.Wadas, Kec. Teluk Jambe Timur, Kab Karawang, JAWA BARAT', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
