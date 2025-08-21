-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 03:39 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u868657420_db_dealer_hino`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$tAZTqi4cLP8azveVDK77yeaKdNIC6FgFU9fKwbmiwv1dXkYGAPqqu');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `kategori_id`) VALUES
(12, 'Penawaran Terbaik Truk Hino Telah Hadir Khusus untuk Anda Bulan Ini', 'Bulan ini adalah waktu yang tepat bagi Anda yang sedang mencari kendaraan niaga handal untuk mendukung kelancaran operasional bisnis. Sales Hino Indonesia menghadirkan penawaran spesial yang dirancang khusus bagi para pelaku usaha yang membutuhkan truk dengan kualitas tinggi, daya tahan luar biasa, serta harga yang lebih hemat dari biasanya\r\n\r\nTruk Hino dikenal sebagai kendaraan komersial yang telah terbukti unggul di berbagai sektor industri. Dari pengangkutan logistik hingga operasional proyek konstruksi, Hino selalu menjadi pilihan utama karena keandalannya, konsumsi bahan bakar yang efisien, dan kemudahan dalam perawatan. Promo ini memberikan kesempatan bagi Anda untuk memiliki unit truk Hino dengan harga yang lebih kompetitif dan sejumlah keuntungan tambahan yang sayang untuk dilewatkan\r\n\r\nDalam masa promo ini, setiap pembelian truk Hino akan disertai dengan berbagai keuntungan eksklusif yang hanya tersedia dalam periode terbatas. Anda berkesempatan untuk mendapatkan potongan harga menarik, bonus perlengkapan truk, hingga layanan servis awal tanpa biaya tambahan. Tim kami juga siap membantu Anda dengan proses pembiayaan yang mudah dan ringan agar Anda tidak terbebani di awal pembelian\r\n\r\nKami memahami bahwa setiap bisnis memiliki kebutuhan yang berbeda. Oleh karena itu kami menyediakan berbagai tipe dan varian truk Hino yang bisa disesuaikan dengan kebutuhan usaha Anda. Mulai dari truk ringan yang lincah untuk distribusi dalam kota, hingga truk besar yang kokoh untuk mengangkut muatan berat jarak jauh, semuanya tersedia dengan layanan konsultasi yang ramah dan profesional\r\n\r\nSeluruh proses pemesanan dapat dilakukan dengan cepat dan mudah. Anda bisa langsung menghubungi tim Sales Hino Indonesia untuk mendapatkan penawaran harga resmi, informasi ketersediaan unit, serta panduan pembelian yang transparan. Promo ini hanya berlaku dalam periode terbatas sehingga semakin cepat Anda bertindak, semakin besar peluang Anda untuk mendapatkan unit terbaik dengan harga yang lebih hemat\r\n\r\nJika Anda menginginkan kendaraan niaga yang dapat diandalkan untuk jangka panjang, kini saatnya Anda memilih Hino. Dapatkan keunggulan performa, efisiensi operasional, serta layanan purna jual yang tersebar luas di seluruh Indonesia. Dengan memilih Hino, Anda tidak hanya membeli truk, tetapi juga berinvestasi untuk kelangsungan dan pertumbuhan bisnis Anda ke depan\r\n\r\nHubungi kami hari ini dan nikmati penawaran terbaik yang hanya tersedia di Sales Hino Indonesia. Wujudkan solusi transportasi bisnis Anda bersama Hino, pilihan pasti untuk masa depan usaha yang lebih kuat\r\n\r\nHubungi Nathan Hino\r\nWhatsapp : 0859-7528-7684\r\nWebsite : www.saleshinoindonesia.com', '1753789167_promohino1.jpg', '2025-07-29 11:39:27', 2),
(13, 'Promo Spesial Truk Hino Bulan Ini: Solusi Hemat untuk Kebutuhan Bisnis Anda', 'Sales Hino Indonesia kembali menghadirkan promo menarik khusus di bulan ini. Penawaran ini ditujukan bagi para pelaku usaha yang sedang mencari kendaraan niaga tangguh dengan harga lebih terjangkau. Promo ini berlaku untuk berbagai tipe truk Hino, mulai dari truk ringan hingga truk medium dan heavy duty, yang semuanya sudah terbukti handal di berbagai sektor industri.\r\n\r\nSelama masa promo, Anda berkesempatan untuk mendapatkan potongan harga khusus untuk pembelian unit truk Hino. Harga yang ditawarkan jauh lebih kompetitif dibandingkan harga reguler, dan promo ini hanya berlaku dalam periode terbatas. Selain potongan harga, setiap pembelian unit juga disertai dengan bonus menarik yang dapat langsung Anda nikmati. Beberapa di antaranya berupa gratis servis awal termasuk oli dan filter, karoseri khusus untuk tipe tertentu, hingga perlengkapan tambahan yang dapat menunjang operasional bisnis Anda.\r\n\r\nTidak hanya menawarkan harga dan bonus, Sales Hino Indonesia juga memberikan kemudahan dari sisi pembiayaan. Kami menyediakan program kredit ringan dengan syarat yang mudah dan proses yang cepat. Anda dapat memiliki truk Hino impian tanpa harus terbebani dengan angsuran besar di awal. Seluruh proses pembelian dibantu oleh tim kami yang profesional dan berpengalaman, sehingga Anda dapat fokus pada pengembangan bisnis tanpa perlu khawatir dengan urusan administrasi.\r\n\r\nHino telah lama dikenal sebagai merek truk yang tangguh, efisien, dan mudah dalam perawatan. Didukung oleh jaringan layanan purna jual yang tersebar luas di seluruh Indonesia, Anda akan mendapatkan jaminan servis serta ketersediaan suku cadang kapan pun dibutuhkan. Truk Hino juga memiliki daya tahan tinggi dan nilai jual kembali yang baik, menjadikannya pilihan ideal untuk investasi jangka panjang dalam bisnis Anda.\r\n\r\nJika Anda tertarik dengan promo ini, kami sarankan untuk segera menghubungi tim Sales Hino Indonesia. Promo hanya berlaku selama bulan ini atau hingga unit tersedia. Untuk informasi lebih lanjut, Anda bisa mengunjungi website resmi kami di saleshinoindonesia.com atau langsung menghubungi melalui WhatsApp untuk mendapatkan penawaran resmi dan konsultasi kebutuhan unit sesuai sektor bisnis Anda.\r\n\r\nJangan lewatkan kesempatan langka ini. Segera manfaatkan promo spesial dari Sales Hino Indonesia dan wujudkan efisiensi operasional bisnis Anda dengan truk berkualitas, harga hemat, dan pelayanan terbaik.\r\n\r\nHubungi Nathan Hino\r\nWhatsapp : 0859-7528-7684\r\nWebsite : www.saleshinoindonesia.com', '1753789349_WhatsApp_Image_2025-07-29_at_18_40_21.jpeg', '2025-07-29 11:42:29', 2),
(14, 'Truk Hino Harga Hemat! Promo Terbatas Hanya di Sales Hino Indonesia', 'Bagi Anda yang sedang mencari truk berkualitas dengan harga terbaik, kini saatnya memanfaatkan promo terbatas dari Sales Hino Indonesia. Kami menawarkan berbagai unit truk Hino dengan harga hemat, bonus menarik, dan skema kredit ringan yang dirancang khusus untuk mendukung kebutuhan bisnis Anda.\r\n\r\nPromo ini berlaku untuk berbagai tipe truk Hino, mulai dari kategori ringan hingga heavy duty, seperti Hino Dutro, Hino 500 Series, hingga Hino 700 Series.\r\n\r\nPromo Menarik Khusus Bulan Ini\r\nBerikut beberapa keuntungan yang bisa Anda dapatkan melalui promo ini:\r\n\r\nPotongan Harga Hingga Puluhan Juta\r\nNikmati diskon khusus untuk pembelian unit baru dengan potongan harga yang kompetitif. Berlaku untuk tipe-tipe tertentu dengan jumlah unit terbatas.\r\n\r\nBonus Langsung\r\nSetiap pembelian unit truk dalam masa promo berhak mendapatkan berbagai bonus menarik, seperti:\r\n\r\n- Free Service selama 2 tahun atau setara dengan 40.000km\r\n- Gratis Hino Connect GPS selama 5 Tahun\r\n- Dapatkan Souvenir menarik dari Nathan Hino\r\n\r\nAksesoris resmi Hino\r\n\r\nProgram Kredit Ringan\r\nKami bekerja sama dengan berbagai perusahaan leasing terpercaya untuk menawarkan:\r\n\r\n- DP mulai dari 20%\r\n- Cicilan ringan hingga 60 bulan\r\n- Proses pengajuan cepat dan transparan\r\n\r\nMengapa Memilih Hino?\r\nTruk Hino dikenal sebagai salah satu merk truk terkemuka di Indonesia. Dengan mesin yang tangguh, efisiensi bahan bakar yang tinggi, serta layanan purna jual yang luas, Hino menjadi pilihan utama bagi pengusaha di sektor transportasi, logistik, konstruksi, dan distribusi.\r\n\r\nKeunggulan truk Hino antara lain:\r\n\r\n- Performa mesin yang kuat dan handal di segala medan\r\n- Ketersediaan suku cadang di seluruh Indonesia\r\n- Jaringan bengkel resmi dan mobile service\r\n- Nilai jual kembali yang tinggi\r\n\r\nSegera Hubungi Kami\r\nUntuk informasi lebih lanjut, penawaran harga resmi, atau konsultasi pemilihan tipe truk, silakan hubungi Nathan Hino\r\n\r\nWhatsApp : 0859-7528-7684\r\nWebsite: www.saleshinoindonesia.com\r\n\r\nJangan lewatkan kesempatan untuk mendapatkan truk Hino dengan harga hemat dan berbagai keuntungan lainnya. Dapatkan unit terbaik untuk mendukung operasional bisnis Anda hanya di Sales Hino Indonesia.\r\nPesan sekarang sebelum kehabisan!', '1753789655_WhatsApp_Image_2025-07-29_at_18_45_14.jpeg', '2025-07-29 11:47:35', 2),
(15, 'CARI TRUK ANDAL, BELI DI NATHAN HINO SOLUSINYA!!!', '🚛Cari Armada Andal yang Siap Kerja Keras?\r\n\r\nSudah waktunya upgrade ke kendaraan niaga yang:\r\n\r\n✅Tangguh di segala medan\r\n\r\n✅Irit bahan bakar\r\n\r\n✅Didukung layanan purna jual terbaik\r\n\r\n✅Siap antar muatan tanpa drama\r\n\r\n\r\n🔧Sparepart mudah\r\n\r\n✅Mesin bertenaga\r\n\r\n✅Garansi jelas \r\n\r\nLangsung hubungi: Nathan\r\n\r\n📞0859-7528-7684\r\n\r\n📍Jangkauan luas - layanan cepat dan responsif\r\n\r\nKarena setiap perjalanan bisnis butuh yang bisa diandalkan.', '1754669390_IMG-20250802-WA0011.jpg', '2025-08-08 16:09:50', 2),
(16, 'PROMO SPESIAL HINO AKHIR BULAN INI‼️', 'AKHIR BULAN SAATNYA NGEGAS USAHA PAKAI HINO‼️\r\n\r\nButuh truk tangguh buat logistik, konstruksi, atau niaga?\r\n\r\nHino siap bantu armada bisnis Anda makin kencang! \r\n\r\n✅Spesial Promo Akhir Bulan:\r\n✅DP Mulai 20%\r\n✅Angsuran Super Ringan\r\n✅Diskon Hingga Puluhan Juta\r\n✅Proses Cepat Dibantu Sampai Approve!\r\n✅Garansi & After Sales Terbaik di Kelasnya\r\n\r\nUnit Ready: Dutro - Ranger - Profia\r\n\r\nSiap kerja keras. Siap hadapi medan berat. Siap dorong pertumbuhan bisnis Anda\r\n\r\n📞 Beli di Nathan Aja!\r\n\r\nHubungi sekarang untuk info lengkap & penawaran terbaik\r\n\r\n📲 0859-7528-7684\r\n🌐 saleshinoindonesia.com', '1754669693_IMG-20250802-WA0008.jpg', '2025-08-08 16:14:53', 2),
(17, 'Gebrakan Hino di GIIAS 2025: Promo Truk Hebat, Harga Bersahabat!', 'Hino hadir jadi partner andalan untuk segala kebutuhan usaha-dari logistik, konstruksi, sampai distribusi.\r\n\r\n✅Mesin bandel\r\n✅Irit bahan bakar\r\n✅Perawatan mudah\r\n✅Suku cadang tersedia luas\r\n\r\nBangun bisnis tanpa hambatan, bareng Hino!\r\n\r\nDM kami untuk penawaran spesial hari ini!\r\nWhatsapp: 0859-7528-7684\r\nWebsite: www.saleshinoindonesia.com', '1754670019_Trifold_Brochure_Rental_Kendaraan_Modern_Hitam_dan_Oranye_20250724_185913_0000.png', '2025-08-08 16:20:19', 2),
(18, 'READY STOK HINO 300 CARGO ALL SERIES! SIAP KIRIM, SIAP UNTUNG!', 'Ready Stok Hino 300 Cargo Series! Siap Kirim, Siap Untung!\r\n\r\nButuh truk ringan tangguh untuk distribusi harian?\r\n\r\nHino 300 Cargo Series hadir dengan:\r\n\r\n✅Performa mesin kuat & hemat BBM\r\n✅Cocok untuk logistik, ekspedisi, dan usaha niaga\r\n✅Ready stok - langsung kirim ke lokasi Anda!\r\n✅Tersedia berbagai tipe & karoseri\r\nJangan tunggu kehabisan!\r\n\r\n📞Hubungi kami sekarang untuk info unit & penawaran spesial\r\n\r\nWhatsApp: 0859-7528-7674\r\nWebsite: www.saleshinoindonesia.com', '1754882181_WhatsApp Image 2025-08-11 at 10.15.37.jpeg', '2025-08-08 16:22:40', 2),
(19, 'SPECIAL PROMO HINO DUMP SERIES - HARGA TERBAIK, SIAP ANGKUT UNTUNG!!', 'SPECIAL PROMO ALL HINO DUMP SERIES!\r\n\r\nSaatnya punya truk dump tangguh dengan penawaran terbaik dari kami:\r\n\r\n✅Harga spesial langsung dari dealer resmi\r\n✅DP super ringan & cicilan fleksibel\r\n✅Siap kirim unit ke seluruh Indonesia\r\n✅Garansi & servis resmi Hino\r\n\r\nHubungi kami sekarang: 0859-7528-7684\r\n\r\nKunjungi website: www.saleshinoindonesia.com\r\n\r\nJangan tunggu proyek lewat, Hino Dump Series siap bantu usaha Anda melaju!', '1754670373_1000104868.jpg', '2025-08-08 16:26:13', 2),
(20, 'SPESIAL PROMO BULAN KEMERDEKAAN BERSAMA HINO !!', 'Rayakan Agustus Merdeka Bersama Hino Promo Hebat Untuk Anda!\r\n\r\nSPESIAL PROMO BULAN KEMERDEKAAN BERSAMA HINO!\r\n\r\nPromo khusus Agustus:\r\n\r\n✅Potongan harga spesial\r\n✅DP mulai ringan\r\n✅Hadiah langsung & cashback\r\n✅Ready stock unit siap pakai\r\n\r\nCocok untuk usaha logistik, tambang, konstruksi, distribusi, dan niaga!\r\n\r\n📞Hubungi kami sekarang via WhatsApp: 0859-7528-7684\r\n\r\nKunjungi website: www.saleshinoindonesia.com\r\n\r\nJangan tunggu sampai stok habis, saatnya MERDEKA BERSAMA HINO!', '1754670516_1000105210.png', '2025-08-08 16:28:36', 2),
(21, 'SPESIAL AGUSTUS! PROMO MERDEKA HINO 300 SERIES!', 'SPESIAL AGUSTUS! PROMO MERDEKA HINO 300 SERIES\r\n\r\nBulan kemerdekaan, saatnya bisnis kamu juga merdeka dari biaya operasional tinggi!\r\n\r\nHino 300 Series hadir untuk mendukung usaha logistik, niaga, dan distribusi dengan:\r\n\r\n✅Mesin bandel & irit BBM\r\n✅Kabin nyaman & desain modern\r\n✅Muatan maksimal, perawatan minimal\r\n✅Cocok untuk segala jenis usaha\r\n\r\nPromo Agustus:\r\n\r\nDiskon spesial\r\nDP ringan\r\nHadiah langsung\r\n\r\n📞WhatsApp: 0859-7528-7684\r\n\r\nWebsite: www.saleshinoindonesia.com\r\n\r\nTruknya siap, promonya dahsyat! Buruan sebelum kehabisan!', '1754882204_WhatsApp Image 2025-08-11 at 10.15.38.jpeg', '2025-08-08 16:30:19', 2),
(22, 'Hino Luncurkan Produk Baru Yaitu Hino 300 Series MDLR : Solusi Truk Andal untuk Bisnis Anda', 'Hino kembali menghadirkan inovasi bagi pelaku bisnis dengan peluncuran Hino 300 Series MDLR terbaru. Truk ini dirancang untuk memenuhi kebutuhan transportasi modern, dengan kombinasi keandalan, efisiensi bahan bakar, dan kenyamanan berkendara.\r\n\r\nDesain Modern dan Nyaman\r\nHino 300 Series MDLR terbaru hadir dengan kabin ergonomis yang mendukung kenyamanan pengemudi dalam perjalanan panjang. Kursi dapat disesuaikan, ruang kaki lebih lega, dan kaca depan yang lebar memberikan visibilitas optimal.\r\n\r\nMesin Andal dan Efisien\r\nDitenagai mesin berkinerja tinggi, truk ini mampu menghadapi berbagai kondisi jalan dengan stabil. Mesin terbaru juga hemat bahan bakar tanpa mengurangi tenaga, menjadikannya investasi tepat bagi bisnis Anda.\r\n\r\nFitur Keamanan Lengkap\r\nKeselamatan selalu menjadi prioritas Hino. Truk ini dilengkapi sistem pengereman responsif, lampu LED untuk visibilitas maksimal, serta rangka kokoh yang melindungi pengemudi dan muatan.\r\n\r\nLayanan Purna Jual Terpercaya\r\nDengan jaringan bengkel resmi yang luas, pemilik Hino 300 Series MDLR dapat menikmati kemudahan perawatan rutin dan ketersediaan suku cadang secara cepat.\r\n\r\nSiap Tingkatkan Bisnis Anda?\r\nJangan lewatkan kesempatan untuk mendapatkan Hino 300 Series MDLR terbaru sekarang juga. Hubungi tim sales kami untuk informasi lebih lanjut dan promo spesial melalui WhatsApp di 0859-7528-7684. Konsultasi cepat, mudah, dan langsung mendapatkan solusi terbaik untuk bisnis transportasi Anda!', '1755073875_136mdlr.jpeg', '2025-08-13 08:31:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `phone`, `message`, `created_at`) VALUES
(5, 'Farrel', '087713771138', 'Saya ingin menanyakan tentang hino dutro', '2025-08-14 04:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Berita Dealer'),
(2, 'Promo Truk Hino'),
(3, 'Tips Perawatan');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `specifications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specifications`)),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori` (`kategori_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
