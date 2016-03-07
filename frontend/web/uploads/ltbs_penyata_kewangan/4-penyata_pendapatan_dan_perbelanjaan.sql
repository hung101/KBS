/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.6.21 : Database - kbs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_akademi_akk` */

DROP TABLE IF EXISTS `tbl_akademi_akk`;

CREATE TABLE `tbl_akademi_akk` (
  `akademi_akk_id` int(11) NOT NULL AUTO_INCREMENT,
  `senarai_nama_peserta` varchar(255) DEFAULT NULL,
  `nama` varchar(80) NOT NULL,
  `muatnaik_gambar` varchar(100) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `no_passport` varchar(15) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `tempat_lahir` varchar(90) NOT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `nama_majikan` varchar(80) NOT NULL,
  `alamat_majikan_1` varchar(90) NOT NULL,
  `alamat_majikan_2` varchar(90) DEFAULT NULL,
  `alamat_majikan_3` varchar(90) DEFAULT NULL,
  `alamat_majikan_negeri` varchar(30) NOT NULL,
  `alamat_majikan_bandar` varchar(40) NOT NULL,
  `alamat_majikan_poskod` varchar(5) NOT NULL,
  `no_telefon_pejabat` varchar(14) NOT NULL,
  `kategori_pensijilan` varchar(30) NOT NULL,
  PRIMARY KEY (`akademi_akk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_akademi_akk` */

/*Table structure for table `tbl_akk_program_jurulatih` */

DROP TABLE IF EXISTS `tbl_akk_program_jurulatih`;

CREATE TABLE `tbl_akk_program_jurulatih` (
  `akk_program_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `peningkatan_kerjaya_jurulatih_id` int(11) NOT NULL,
  `jurulatih` varchar(80) NOT NULL,
  `penganjur` varchar(80) NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `tarikh_program` date NOT NULL,
  `tempat_program` varchar(90) NOT NULL,
  `kod_kursus` varchar(30) NOT NULL,
  `tahap` varchar(30) NOT NULL,
  PRIMARY KEY (`akk_program_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_akk_program_jurulatih` */

/*Table structure for table `tbl_anugerah_pelaksaan_majlis` */

DROP TABLE IF EXISTS `tbl_anugerah_pelaksaan_majlis`;

CREATE TABLE `tbl_anugerah_pelaksaan_majlis` (
  `anugerah_pelaksaan_majlis_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_majlis_anugerah` date NOT NULL,
  `nama_ahli_jawatan_kuasa` varchar(80) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `tarikh_pelantikan` date NOT NULL,
  `tempoh` varchar(30) NOT NULL,
  `nama_tugas` varchar(80) DEFAULT NULL,
  `status_tugas` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`anugerah_pelaksaan_majlis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_anugerah_pelaksaan_majlis` */

/*Table structure for table `tbl_anugerah_pencalonan_atlet` */

DROP TABLE IF EXISTS `tbl_anugerah_pencalonan_atlet`;

CREATE TABLE `tbl_anugerah_pencalonan_atlet` (
  `anugerah_pencalonan_atlet` int(11) NOT NULL AUTO_INCREMENT,
  `nama_atlet` varchar(80) NOT NULL,
  `tahun_pencalonan` year(4) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `status_pencalonan` varchar(30) NOT NULL,
  `kejayaan` varchar(255) NOT NULL,
  `ulasan_kejayaan` varchar(255) NOT NULL,
  `susan_ranking_kebangsaan` varchar(80) DEFAULT NULL,
  `susan_ranking_asia` varchar(80) DEFAULT NULL,
  `susan_ranking_asia_tenggara` varchar(80) DEFAULT NULL,
  `susan_ranking_dunia` varchar(80) DEFAULT NULL,
  `sifat_kepimpinan_ketua_pasukan` tinyint(1) NOT NULL,
  `sifat_kepimpinan_jurulatih` tinyint(1) NOT NULL,
  `sifat_kepimpinan_asia_tenggara` tinyint(1) NOT NULL,
  `sifat_kepimpinan_penolong_jurulatih` tinyint(1) NOT NULL,
  `sifat_kepimpinan_pegawai_teknikal` tinyint(1) NOT NULL,
  `nama_sukan_sebelum_dicalon` varchar(80) NOT NULL,
  `mewakili` varchar(80) DEFAULT NULL,
  `pencalonan_olahragawan_tahun` varchar(80) DEFAULT NULL,
  `pencalonan_olahragawati_tahun` varchar(80) DEFAULT NULL,
  `pencalonan_pasukan_lelaki_kebangsaan_tahun` varchar(80) DEFAULT NULL,
  `pencalonan_pasukan_wanita_kebangsaan_tahun` varchar(80) DEFAULT NULL,
  `pencalonan_olahragawan_harapan_tahun` varchar(80) DEFAULT NULL,
  `pencalonan_olahragawati_harapan_tahun` varchar(80) DEFAULT NULL,
  `memenangi_kategori_dalam_anugerah_sukan` tinyint(1) NOT NULL,
  `nama_kategori` varchar(80) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`anugerah_pencalonan_atlet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_anugerah_pencalonan_atlet` */

/*Table structure for table `tbl_atlet` */

DROP TABLE IF EXISTS `tbl_atlet`;

CREATE TABLE `tbl_atlet` (
  `atlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) NOT NULL,
  `tahap` varchar(30) NOT NULL,
  `tid` tinyint(1) NOT NULL,
  `cawangan` varchar(80) NOT NULL,
  `name_penuh` varchar(80) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `umur` int(3) NOT NULL,
  `tempat_lahir_bandar` varchar(30) NOT NULL,
  `tempat_lahir_negeri` varchar(40) NOT NULL,
  `bangsa` varchar(25) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `taraf_perkahwinan` varchar(15) NOT NULL,
  `tinggi` decimal(5,2) NOT NULL,
  `berat` decimal(5,2) NOT NULL,
  `bahasa_ibu` varchar(25) NOT NULL,
  `no_sijil_lahir` varchar(15) NOT NULL,
  `ic_no` varchar(12) DEFAULT NULL,
  `ic_no_lama` varchar(8) DEFAULT NULL,
  `ic_tentera` varchar(12) DEFAULT NULL,
  `passport_no` varchar(15) DEFAULT NULL,
  `passport_tempat_dikeluarkan` varchar(40) DEFAULT NULL,
  `passport_tamat_tempoh` date DEFAULT NULL,
  `lesen_memandu_no` varchar(20) DEFAULT NULL,
  `lesen_tamat_tempoh` date DEFAULT NULL,
  `jenis_lesen` varchar(100) DEFAULT NULL,
  `tel_bimbit_no_1` varchar(14) NOT NULL,
  `tel_bimbit_no_2` varchar(14) DEFAULT NULL,
  `tel_no` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `alamat_rumah_1` varchar(90) NOT NULL,
  `alamat_rumah_2` varchar(90) DEFAULT NULL,
  `alamat_rumah_3` varchar(90) DEFAULT NULL,
  `alamat_rumah_negeri` varchar(30) NOT NULL,
  `alamat_rumah_bandar` varchar(40) NOT NULL,
  `alamat_rumah_poskod` varchar(5) NOT NULL,
  `alamat_surat_menyurat_1` varchar(90) NOT NULL,
  `alamat_surat_menyurat_2` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_3` varchar(90) DEFAULT NULL,
  `alamat_surat_negeri` varchar(30) NOT NULL,
  `alamat_surat_bandar` varchar(40) NOT NULL,
  `alamat_surat_poskod` varchar(5) NOT NULL,
  `kumpulan` varchar(30) NOT NULL,
  `dari_bahagian` varchar(20) DEFAULT NULL,
  `sumber` varchar(20) DEFAULT NULL,
  `negeri_diwakili` varchar(40) DEFAULT NULL,
  `nama_kecemasan` varchar(80) NOT NULL,
  `pertalian_kecemasan` varchar(20) NOT NULL,
  `tel_no_kecemasan` varchar(14) NOT NULL,
  `tel_bimbit_no_kecemasan` varchar(14) NOT NULL,
  `tawaran` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`atlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet` */

insert  into `tbl_atlet`(`atlet_id`,`gambar`,`tahap`,`tid`,`cawangan`,`name_penuh`,`tarikh_lahir`,`umur`,`tempat_lahir_bandar`,`tempat_lahir_negeri`,`bangsa`,`agama`,`jantina`,`taraf_perkahwinan`,`tinggi`,`berat`,`bahasa_ibu`,`no_sijil_lahir`,`ic_no`,`ic_no_lama`,`ic_tentera`,`passport_no`,`passport_tempat_dikeluarkan`,`passport_tamat_tempoh`,`lesen_memandu_no`,`lesen_tamat_tempoh`,`jenis_lesen`,`tel_bimbit_no_1`,`tel_bimbit_no_2`,`tel_no`,`emel`,`facebook`,`twitter`,`alamat_rumah_1`,`alamat_rumah_2`,`alamat_rumah_3`,`alamat_rumah_negeri`,`alamat_rumah_bandar`,`alamat_rumah_poskod`,`alamat_surat_menyurat_1`,`alamat_surat_menyurat_2`,`alamat_surat_menyurat_3`,`alamat_surat_negeri`,`alamat_surat_bandar`,`alamat_surat_poskod`,`kumpulan`,`dari_bahagian`,`sumber`,`negeri_diwakili`,`nama_kecemasan`,`pertalian_kecemasan`,`tel_no_kecemasan`,`tel_bimbit_no_kecemasan`,`tawaran`,`created_by`,`updated_by`,`created`,`updated`) values (1,'uploads/atlet/1.jpg','2',0,'2','Kelvin Yong','1987-01-30',27,'2','10','2','2','1','3','180.00','65.00','','AL34768687','870130034775','','','AK43567868','',NULL,'','2015-08-12','','0123887478','','0388089487','','','','12, Jalan Lalang 12/1','Taman Jaya','','10','3','47000','12, Jalan Lalang 12/1','Taman Jaya','','10','1','47000','0',NULL,NULL,NULL,'John','Bapa','0192883748','045776987',0,NULL,NULL,NULL,NULL),(2,'uploads/atlet/Desert.jpg','2',0,'2','Mohd Shad','1989-04-06',25,'1','10','2','2','2','2','175.00','60.00','1','387467834','873002748782','47737644','NT2039884','32479678686455','Kuala Lumpur','2015-10-08','27687398747687','2015-10-21','3','0165667748','01933445554','0380801345','tzunhung@hotmail.com','url::/faceoorkjke','https://twistter/dsfhhwer','1, Kampung 12','Jalan Langit 12/1','Bandar Puchong','10','2','43000','1, Kampung 12','Jalan Langit 12/1','Bandar Puchong','10','1','43000','0',NULL,NULL,NULL,'Mohd Ahli','Bapa','0388776884','0127789478',0,NULL,NULL,NULL,NULL),(3,'uploads/atlet/Koala.jpg','1',0,'1','Edward Tan','1985-07-02',24,'2','10','2','3','1','2','170.00','55.00','2','387467834','873002748782','','','32479678686455','Kuala Lumpur',NULL,'27687398747687','2021-08-12','1','165667748','','380801345','tzunhung@hotmail.com','url::/faceoorkjke','https://twistter/dsfhhwer','03-04, Villamas Jawa, ','Jalan kasa 1','Bandar Puchong','10','2','47100','03-04, Villamas Jawa, ','Jalan kasa 1','Bandar Puchong','10','2','47100','',NULL,NULL,NULL,'Jun Na','Ibu','13767734','1937665467',0,NULL,NULL,NULL,NULL),(4,'uploads/atlet/Chrysanthemum.jpg','3',1,'2','Alvin','2014-10-02',23,'4','10','3','3','2','4','170.00','55.00','3','','','','','','Kuala Lumpur',NULL,'','2015-08-12','','165667748','','380801345','','','','03-04, Villamas Jawa,','','','10','1','47100','03-04, Villamas Jawa,','','','10','3','47100','',NULL,NULL,NULL,'Jun Na','Ibu','13767734','1937665467',0,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_atlet_aset` */

DROP TABLE IF EXISTS `tbl_atlet_aset`;

CREATE TABLE `tbl_atlet_aset` (
  `aset_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis_aset` varchar(30) NOT NULL,
  `daftar_no_pengangkutan` varchar(10) DEFAULT NULL,
  `jenis_harta_pengangkutan_perniagaan` varchar(30) NOT NULL,
  `nilai_harta_pengangkutan` decimal(10,2) NOT NULL,
  `daftar_alamat_1` varchar(30) DEFAULT NULL,
  `daftar_alamat_2` varchar(30) DEFAULT NULL,
  `daftar_alamat_3` varchar(30) DEFAULT NULL,
  `daftar_alamat_negeri` varchar(30) DEFAULT NULL,
  `daftar_alamat_bandar` varchar(40) DEFAULT NULL,
  `daftar_alamat_poskod` varchar(5) DEFAULT NULL,
  `nama_syarikat_perniagaan` varchar(100) DEFAULT NULL,
  `produk_perkhidmatan_perniagaan` varchar(100) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `jenis_pinjaman` varchar(30) DEFAULT NULL,
  `no_akaun` varchar(20) DEFAULT NULL,
  `nilai_pinjaman` decimal(10,2) DEFAULT NULL,
  `tarikh_mula` date DEFAULT NULL,
  `tarikh_tamat` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`aset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_aset` */

insert  into `tbl_atlet_aset`(`aset_id`,`atlet_id`,`jenis_aset`,`daftar_no_pengangkutan`,`jenis_harta_pengangkutan_perniagaan`,`nilai_harta_pengangkutan`,`daftar_alamat_1`,`daftar_alamat_2`,`daftar_alamat_3`,`daftar_alamat_negeri`,`daftar_alamat_bandar`,`daftar_alamat_poskod`,`nama_syarikat_perniagaan`,`produk_perkhidmatan_perniagaan`,`nama_bank`,`jenis_pinjaman`,`no_akaun`,`nilai_pinjaman`,`tarikh_mula`,`tarikh_tamat`,`created_by`,`updated_by`,`created`,`updated`) values (1,1,'3','','6','500000.00','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'2','','3','56000.00','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'2','','4','70000.00','','','',NULL,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,'2','','4','50000.00','','','',NULL,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,2,'1','NDP8238732','1','45000.00','10, Jalan 10/1','Taman Besar 1','Bandar Besar','10','2','47200','JS Sdn Bhd','CCTV','2','1','1788399844','40000.00','2010-06-08','2015-09-24',NULL,NULL,NULL,NULL),(7,2,'2','','4','80000.00','','','','','','','','','2','2','1788399844',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_atlet_karier` */

DROP TABLE IF EXISTS `tbl_atlet_karier`;

CREATE TABLE `tbl_atlet_karier` (
  `karier_atlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` varchar(20) NOT NULL,
  `syarikat` varchar(100) NOT NULL,
  `alamat_1` varchar(30) NOT NULL,
  `alamat_2` varchar(30) DEFAULT NULL,
  `alamat_3` varchar(30) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varbinary(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `laman_web` varchar(120) DEFAULT NULL,
  `tel_no` varchar(14) NOT NULL,
  `faks_no` varchar(14) DEFAULT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `jawatan_kerja` varchar(30) NOT NULL,
  `pendapatan` decimal(10,2) NOT NULL,
  `tahun_mula` date NOT NULL,
  `tahun_tamat` date NOT NULL,
  `socso_no` varchar(20) DEFAULT NULL,
  `kwsp_no` varchar(10) DEFAULT NULL,
  `income_tax_no` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`karier_atlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_karier` */

insert  into `tbl_atlet_karier`(`karier_atlet_id`,`atlet_id`,`syarikat`,`alamat_1`,`alamat_2`,`alamat_3`,`alamat_negeri`,`alamat_bandar`,`alamat_poskod`,`laman_web`,`tel_no`,`faks_no`,`emel`,`jawatan_kerja`,`pendapatan`,`tahun_mula`,`tahun_tamat`,`socso_no`,`kwsp_no`,`income_tax_no`,`created_by`,`updated_by`,`created`,`updated`) values (1,'1','Kenson Sdn Bhd','12, Jalan Angsa 12/1','','','4','10','57100','www.kenson.com.my','349857874','','','Marketing Executive','3500.00','2015-09-22','2015-09-22','','','',NULL,NULL,NULL,NULL),(2,'4','Wonderland Sdn Bhd','19, Jalan Besar 11/12','Taman Kenangan Besar 2','','10','3','48000','','0378334455',NULL,'','Kerani','2500.00','2010-07-14','2015-09-30','PEKS1883774','EPF0093884','TAX1003332',NULL,NULL,NULL,NULL),(3,'2','Kenara Sdn Bhd','No 1, Block A, ','Jalan Kelana 19/1','Taman Kelana 1','10','2','47300','www.kenara.com.my','0388889999',NULL,'kenaraadmin@ke','Admin','2900.00','2014-04-01','2015-09-30','PEKS1883555','EPF0093822','TAX1003331',NULL,NULL,NULL,NULL),(4,'2','Kenara Sdn Bhd','No 1, Block A,','','','10','3','48000','','0378334455',NULL,'','Engineer','4500.00','2014-09-16','2015-09-24','','','',NULL,NULL,NULL,NULL),(5,'1','Denso Sdn Bhd','1, Jalan Kecil 12','Jalan Kelana 19/1','','10','3','49000','','0378334455',NULL,'','Sales Man','2000.00','2015-02-02','2015-09-30','PEKS1883555','EPF0093884','TAX1003331',NULL,NULL,NULL,NULL),(6,'1','Sysma Bhd','1, Jalan Kasang 1/13','','','10','2','45000','www.sysma.com.my','0378334455',NULL,'admin@sysma.com.my','Foreman','1500.00','2010-06-15','2015-09-30','PEK4666637744','EPF3324555','TAX112555555',NULL,NULL,NULL,NULL),(7,'1','Sysma Bhd','1, Jalan Kasang 1/13','Jalan Kelana 19/1','Taman Kelana 1','10','3','45000','','0388889999',NULL,'','Engineer','2000.00','2015-09-01','2015-09-30','PEKS1883555','EPF0093822','TAX112555555',NULL,NULL,NULL,NULL),(8,'1','Yuri Sdn Bhd','No 1, Block A,','','','10','2','48000','www.yuri.com.my','0378334455',NULL,'admin@yuri.com.my','Kerani','1500.00','2015-09-08','2015-09-30','PEK4666637744','EPF0093822','TAX1003331',NULL,NULL,NULL,NULL),(9,'1','Kenara Sdn Bhd','1, Jalan Kasang 1/13','','','10','3','45000','','0378334455',NULL,'','Foreman','2000.00','2015-08-01','2015-09-30','','EPF0093822','',NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_atlet_keluarga` */

DROP TABLE IF EXISTS `tbl_atlet_keluarga`;

CREATE TABLE `tbl_atlet_keluarga` (
  `keluarga_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `hubungan` varchar(20) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `pekerjaan` varchar(80) DEFAULT NULL,
  `bangsa` varchar(25) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `no_tel` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`keluarga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_keluarga` */

/*Table structure for table `tbl_atlet_kewangan_akaun` */

DROP TABLE IF EXISTS `tbl_atlet_kewangan_akaun`;

CREATE TABLE `tbl_atlet_kewangan_akaun` (
  `akaun_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `cawangan` varchar(100) DEFAULT NULL,
  `no_akaun` varchar(20) NOT NULL,
  `jenis_akaun` varchar(30) NOT NULL,
  PRIMARY KEY (`akaun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_kewangan_akaun` */

insert  into `tbl_atlet_kewangan_akaun`(`akaun_id`,`atlet_id`,`nama_bank`,`cawangan`,`no_akaun`,`jenis_akaun`) values (1,1,'Maybank','Sri Petaling','148767838846','Saving');

/*Table structure for table `tbl_atlet_kewangan_elaun` */

DROP TABLE IF EXISTS `tbl_atlet_kewangan_elaun`;

CREATE TABLE `tbl_atlet_kewangan_elaun` (
  `elaun_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis_elaun` varchar(30) NOT NULL,
  `jumlah_elaun` decimal(10,2) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  PRIMARY KEY (`elaun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_kewangan_elaun` */

insert  into `tbl_atlet_kewangan_elaun`(`elaun_id`,`atlet_id`,`jenis_elaun`,`jumlah_elaun`,`tarikh_mula`,`tarikh_tamat`) values (1,1,'Kejohanan','500.00','2013-02-19','0000-00-00'),(2,1,'Pingat Emas','2500.00','2014-02-11','0000-00-00'),(3,1,'Pingat Perak','600.00','2014-12-17','0000-00-00');

/*Table structure for table `tbl_atlet_kewangan_insentif` */

DROP TABLE IF EXISTS `tbl_atlet_kewangan_insentif`;

CREATE TABLE `tbl_atlet_kewangan_insentif` (
  `insentif_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `jenis_insentif` varchar(30) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `kejohanan` varchar(60) NOT NULL,
  `pencapaian` varchar(30) NOT NULL,
  `rekods` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`insentif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_kewangan_insentif` */

insert  into `tbl_atlet_kewangan_insentif`(`insentif_id`,`atlet_id`,`tarikh_mula`,`tarikh_tamat`,`jenis_insentif`,`jumlah`,`kejohanan`,`pencapaian`,`rekods`) values (1,1,'2014-11-13','0000-00-00','Pencapaian','10000.00','400 M','Kejohanan',NULL);

/*Table structure for table `tbl_atlet_kewangan_pinjaman` */

DROP TABLE IF EXISTS `tbl_atlet_kewangan_pinjaman`;

CREATE TABLE `tbl_atlet_kewangan_pinjaman` (
  `pinjaman_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `jenis_pinjaman` varchar(30) NOT NULL,
  `no_akaun` varchar(20) NOT NULL,
  `nilai_pinjaman` decimal(10,2) NOT NULL,
  `tahun_permulaan` date NOT NULL,
  `tahun_tamat` date NOT NULL,
  PRIMARY KEY (`pinjaman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_kewangan_pinjaman` */

insert  into `tbl_atlet_kewangan_pinjaman`(`pinjaman_id`,`atlet_id`,`nama_bank`,`jenis_pinjaman`,`no_akaun`,`nilai_pinjaman`,`tahun_permulaan`,`tahun_tamat`) values (1,1,'CIMB','Housing','7746625534','200000.00','0000-00-00','0000-00-00'),(2,1,'CIMB','Car','7497759894','40000.00','0000-00-00','0000-00-00');

/*Table structure for table `tbl_atlet_oku` */

DROP TABLE IF EXISTS `tbl_atlet_oku`;

CREATE TABLE `tbl_atlet_oku` (
  `oku_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis_kurang_upaya` varchar(50) NOT NULL,
  `jenis_kurang_upaya_pendengaran` varchar(50) DEFAULT NULL,
  `negara` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`oku_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_oku` */

insert  into `tbl_atlet_oku`(`oku_id`,`atlet_id`,`jenis_kurang_upaya`,`jenis_kurang_upaya_pendengaran`,`negara`,`tahun`,`status`) values (1,1,'Kurang Upaya Fizikal',NULL,'',0000,'');

/*Table structure for table `tbl_atlet_pakaian` */

DROP TABLE IF EXISTS `tbl_atlet_pakaian`;

CREATE TABLE `tbl_atlet_pakaian` (
  `pakaian_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `sukan` varchar(100) NOT NULL,
  `jenis_pakaian` varchar(30) NOT NULL,
  `saiz_pakaian` varchar(10) NOT NULL,
  `kuantiti` int(5) NOT NULL,
  `jenama` varchar(80) DEFAULT NULL,
  `tarikh_serahan` date NOT NULL,
  PRIMARY KEY (`pakaian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pakaian` */

insert  into `tbl_atlet_pakaian`(`pakaian_id`,`atlet_id`,`sukan`,`jenis_pakaian`,`saiz_pakaian`,`kuantiti`,`jenama`,`tarikh_serahan`) values (1,1,'','T-Shirt Golf','M',0,NULL,'0000-00-00'),(2,1,'','Seluar Golf','M',0,NULL,'0000-00-00');

/*Table structure for table `tbl_atlet_pakaian_peralatan` */

DROP TABLE IF EXISTS `tbl_atlet_pakaian_peralatan`;

CREATE TABLE `tbl_atlet_pakaian_peralatan` (
  `peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis_sukan` varchar(30) DEFAULT NULL,
  `peralatan` varchar(80) DEFAULT NULL,
  `saiz` varchar(10) DEFAULT NULL,
  `jenama` varchar(30) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `warna` varchar(10) DEFAULT NULL,
  `tarikh_serahan` date NOT NULL,
  PRIMARY KEY (`peralatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pakaian_peralatan` */

insert  into `tbl_atlet_pakaian_peralatan`(`peralatan_id`,`atlet_id`,`jenis_sukan`,`peralatan`,`saiz`,`jenama`,`model`,`warna`,`tarikh_serahan`) values (1,1,'Racket Badminton',NULL,'Standard','Yonex','YN013','Merah','0000-00-00'),(2,1,'Shuttlecock Badminton',NULL,'Standard','Yonex','YN200SP','Putih','0000-00-00');

/*Table structure for table `tbl_atlet_pembangunan_kaunseling` */

DROP TABLE IF EXISTS `tbl_atlet_pembangunan_kaunseling`;

CREATE TABLE `tbl_atlet_pembangunan_kaunseling` (
  `kaunseling_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `susulan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`kaunseling_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pembangunan_kaunseling` */

insert  into `tbl_atlet_pembangunan_kaunseling`(`kaunseling_id`,`atlet_id`,`tarikh`,`tujuan`,`susulan`) values (1,1,'2013-07-31','Ingin tahu mengapa tiada keyakinan','- Masalah Keluarga');

/*Table structure for table `tbl_atlet_pembangunan_kemahiran` */

DROP TABLE IF EXISTS `tbl_atlet_pembangunan_kemahiran`;

CREATE TABLE `tbl_atlet_pembangunan_kemahiran` (
  `kemahiran_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis_kemahiran` varchar(30) NOT NULL,
  `nama_kemahiran` varchar(100) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `penganjur` varchar(80) NOT NULL,
  `lokasi` varchar(90) NOT NULL,
  PRIMARY KEY (`kemahiran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pembangunan_kemahiran` */

insert  into `tbl_atlet_pembangunan_kemahiran`(`kemahiran_id`,`atlet_id`,`jenis_kemahiran`,`nama_kemahiran`,`tarikh_mula`,`tarikh_tamat`,`penganjur`,`lokasi`) values (1,1,'Computer Skill','MS.Word, MS.Excel','0000-00-00','0000-00-00','',''),(2,1,'Langauge Skill','Chinese, Malay, Tamil, English','0000-00-00','0000-00-00','',''),(3,1,'Writing Skill','Malay, English','0000-00-00','0000-00-00','',''),(4,1,'Professional Skill','Internet Marketing','0000-00-00','0000-00-00','','');

/*Table structure for table `tbl_atlet_pembangunan_kursuskem` */

DROP TABLE IF EXISTS `tbl_atlet_pembangunan_kursuskem`;

CREATE TABLE `tbl_atlet_pembangunan_kursuskem` (
  `kursus_kem_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `lokasi` varchar(90) DEFAULT NULL,
  `nama_kursus_kem` varchar(40) NOT NULL,
  `penganjur` varchar(80) NOT NULL,
  PRIMARY KEY (`kursus_kem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pembangunan_kursuskem` */

insert  into `tbl_atlet_pembangunan_kursuskem`(`kursus_kem_id`,`atlet_id`,`jenis`,`tarikh_mula`,`tarikh_tamat`,`lokasi`,`nama_kursus_kem`,`penganjur`) values (1,1,'Kem','2014-12-18','0000-00-00','Kem Bukit Jalil Forest','Motivasi Diri',''),(2,1,'Kursus','2014-07-17','0000-00-00','KLCC','Kursus Psikologi','');

/*Table structure for table `tbl_atlet_penajaansokongan` */

DROP TABLE IF EXISTS `tbl_atlet_penajaansokongan`;

CREATE TABLE `tbl_atlet_penajaansokongan` (
  `penajaan_sokongan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_syarikat` varchar(100) NOT NULL,
  `alamat_1` varchar(90) DEFAULT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) DEFAULT NULL,
  `alamat_bandar` varchar(40) DEFAULT NULL,
  `alamat_poskod` varchar(5) DEFAULT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `peribadi_yang_bertanggungjawab` varchar(80) NOT NULL,
  `jenis_kontrak` varchar(30) NOT NULL,
  `nilai_kontrak` decimal(10,2) NOT NULL,
  `tahun_permulaan` year(4) NOT NULL,
  `tahun_akhir` year(4) DEFAULT NULL,
  `barang_yang_penyokong` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`penajaan_sokongan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_penajaansokongan` */

/*Table structure for table `tbl_atlet_pencapaian` */

DROP TABLE IF EXISTS `tbl_atlet_pencapaian`;

CREATE TABLE `tbl_atlet_pencapaian` (
  `pencapaian_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_kejohanan_temasya` varchar(80) NOT NULL,
  `peringkat_kejohanan` varchar(30) NOT NULL,
  `tarikh_mula_kejohanan` date NOT NULL,
  `tarikh_tamat_kejohanan` date NOT NULL,
  `nama_sukan` varchar(30) NOT NULL,
  `nama_acara` varchar(100) NOT NULL,
  `lokasi_kejohanan` varchar(90) NOT NULL,
  `pencapaian` varchar(80) NOT NULL,
  `insentif_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pencapaian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pencapaian` */

insert  into `tbl_atlet_pencapaian`(`pencapaian_id`,`atlet_id`,`nama_kejohanan_temasya`,`peringkat_kejohanan`,`tarikh_mula_kejohanan`,`tarikh_tamat_kejohanan`,`nama_sukan`,`nama_acara`,`lokasi_kejohanan`,`pencapaian`,`insentif_id`) values (1,1,'2010','Olahraga','2014-08-01','2014-08-09','','400M','Bukit Jalil Stadium','Pingat Gangsa',NULL);

/*Table structure for table `tbl_atlet_pencapaian_anugerah` */

DROP TABLE IF EXISTS `tbl_atlet_pencapaian_anugerah`;

CREATE TABLE `tbl_atlet_pencapaian_anugerah` (
  `anugerah_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nama_acara` varchar(100) NOT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `insentif_id` int(11) NOT NULL,
  PRIMARY KEY (`anugerah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pencapaian_anugerah` */

insert  into `tbl_atlet_pencapaian_anugerah`(`anugerah_id`,`atlet_id`,`tahun`,`nama_acara`,`kategori`,`remark`,`insentif_id`) values (1,1,2011,'200M','Olahraga',NULL,0);

/*Table structure for table `tbl_atlet_pencapaian_rekods` */

DROP TABLE IF EXISTS `tbl_atlet_pencapaian_rekods`;

CREATE TABLE `tbl_atlet_pencapaian_rekods` (
  `pencapaian_rekods_id` int(11) NOT NULL AUTO_INCREMENT,
  `pencapaian_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `peringkat` varchar(30) NOT NULL,
  `opponent` varchar(80) NOT NULL,
  `jenis_rekod` varchar(30) NOT NULL,
  `result` varchar(100) NOT NULL,
  `venue` varchar(90) DEFAULT NULL,
  `personal_best` varchar(100) DEFAULT NULL,
  `season_best` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pencapaian_rekods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pencapaian_rekods` */

/*Table structure for table `tbl_atlet_pendidikan` */

DROP TABLE IF EXISTS `tbl_atlet_pendidikan`;

CREATE TABLE `tbl_atlet_pendidikan` (
  `pendidikan_atlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` varchar(20) NOT NULL,
  `jenis_peringkatan_pendidikan` varchar(20) NOT NULL,
  `kursus` varchar(40) DEFAULT NULL,
  `fakulti` varchar(40) DEFAULT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_telefon` varchar(14) DEFAULT NULL,
  `no_faks` varchar(14) DEFAULT NULL,
  `tahun_mula` date NOT NULL,
  `tahun_tamat` date NOT NULL,
  `pelajar_id_no` varchar(15) DEFAULT NULL,
  `keputusan_cgpa` varchar(100) DEFAULT NULL,
  `biasiswa_tajaan` varchar(2) DEFAULT NULL,
  `jenis_biasiswa` varchar(30) DEFAULT NULL,
  `jumlah_biasiswa` decimal(10,2) DEFAULT NULL,
  `tahun_mula_biasiswa` date DEFAULT NULL,
  `tahun_tamat_biasiswa` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pendidikan_atlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_pendidikan` */

insert  into `tbl_atlet_pendidikan`(`pendidikan_atlet_id`,`atlet_id`,`jenis_peringkatan_pendidikan`,`kursus`,`fakulti`,`nama`,`alamat_1`,`alamat_2`,`alamat_3`,`alamat_negeri`,`alamat_bandar`,`alamat_poskod`,`no_telefon`,`no_faks`,`tahun_mula`,`tahun_tamat`,`pelajar_id_no`,`keputusan_cgpa`,`biasiswa_tajaan`,`jenis_biasiswa`,`jumlah_biasiswa`,`tahun_mula_biasiswa`,`tahun_tamat_biasiswa`,`created_by`,`updated_by`,`created`,`updated`) values (2,'1','3','IT','Web Designer','TARC','18, Jalan Stadium 12/10','Taman jaya','','10','1','48000','','','2012-02-14','2014-12-16',NULL,'3.2','FE','1','60000.00','2014-04-01','2015-08-19',NULL,NULL,NULL,NULL),(8,'2','2','STPM','Fizik','Sekolah Menengah St. Peter','12, Jalan MainRoad 12','Taman jaya','','10','3','48000','','','2015-03-03','2015-12-22',NULL,'','','1','80000.00','2015-04-01','2015-08-28',NULL,NULL,NULL,NULL),(10,'3','1','IT','Web Designer','International Secondary School','10, Jalan Kepinpin 12/10','','','10','1','48000','','','2015-08-05','2015-08-31',NULL,'','FE','2','80000.00',NULL,NULL,NULL,NULL,NULL,NULL),(13,'4','1','IT','Web Designer','Sekolah Menengah St John Peter','10, Jalan Kepinpin 12/10','','','10','1','47100','','','2015-08-01','2015-08-25',NULL,'','TT','1','90000.00',NULL,NULL,NULL,NULL,NULL,NULL),(14,'4','1','','','Sekolah Menengah St. Peter','10, Jalan Kepinpin 12/10','','','10','2','47100','','','2015-08-11','2015-08-26',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'1','4','','','APU','10, Jalan Kepinpin 12/10','','','10','2','48000','','','2015-08-01','2015-08-31',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'1','4','IT','Web Designer','KDU','18, Jalan Stadium 12/10','Taman Kelana 12','','10','2','48000','','','2015-08-01','2015-09-30',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'3','2','STPM','IT','Sekolah Menengah Hd Musafa','1, Jalan Kilang 12','Taman Sari Jaya','','10','3','48000','','','2015-03-01','2015-09-30',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'4','4','Business','Admin','UCSI','10, Jalan Kelama 12/1','Bandar Kerangan 10','','10','3','47200','0377778888','0377779999','2015-05-06','2015-09-30',NULL,'4.0','JI','2','20000.00','2015-05-12','2016-03-03',NULL,NULL,NULL,NULL),(19,'4','4','Business','Admin','UCSI','10, Jalan Kelama 12/1','Bandar Kerangan 10','','10','3','47200','0377778888','0377779999','2015-05-06','2015-09-30',NULL,'4.0','JI','2','20000.00','2015-05-12','2016-03-03',NULL,NULL,NULL,NULL),(20,'1','3','IT','Web Designer','KDU','12, Jalan MainRoad 12','Bandar Kerangan 10','Kampung Gajah','10','2','48000','','','2014-11-04','2015-09-30',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'1','1','SPM','Art','Sekolah Menengah Jasmin','12, Jalan MainRoad 12','Bandar Kerangan 10','','10','2','57100','','','2015-05-12','2015-09-30',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'1','4','Business','E-Commerce','APU','12, Jalan MainRoad 12','Taman jaya','Kampung Gajah','10','2','48000','','','2015-09-08','2015-09-23',NULL,'4.0','','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_atlet_perubatan` */

DROP TABLE IF EXISTS `tbl_atlet_perubatan`;

CREATE TABLE `tbl_atlet_perubatan` (
  `perubatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `kumpulan_darah` varchar(60) NOT NULL,
  `alergi_makanan` varchar(255) DEFAULT NULL,
  `alergi_perubatan` varchar(255) DEFAULT NULL,
  `alergi_jenis_lain` varchar(255) DEFAULT NULL,
  `penyakit_semula_jadi` varchar(255) DEFAULT NULL,
  `penyakit_lain_lain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`perubatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_atlet_perubatan` */

insert  into `tbl_atlet_perubatan`(`perubatan_id`,`atlet_id`,`kumpulan_darah`,`alergi_makanan`,`alergi_perubatan`,`alergi_jenis_lain`,`penyakit_semula_jadi`,`penyakit_lain_lain`) values (1,1,'2','Makanan Laut','Stepmetil','Lain-Lain','2','Tiada'),(2,2,'3','Test','Alahan','','2',NULL),(4,4,'3','Ikan','Ubat','Lain','2','Tiada'),(5,3,'4','Makanan Laut','Stepmetil','N/A','2','Tiada');

/*Table structure for table `tbl_atlet_perubatan_doktor` */

DROP TABLE IF EXISTS `tbl_atlet_perubatan_doktor`;

CREATE TABLE `tbl_atlet_perubatan_doktor` (
  `doktor_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_doktor` varchar(80) NOT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `hospital_klinik` varchar(100) NOT NULL,
  PRIMARY KEY (`doktor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_atlet_perubatan_doktor` */

insert  into `tbl_atlet_perubatan_doktor`(`doktor_id`,`atlet_id`,`nama_doktor`,`no_telefon`,`hospital_klinik`) values (1,1,'Wilson Lim Wan Xin','0126554778','Klinik Selvi'),(2,1,'Kapal Javi','0134877554','Hopital Seri Kembangan');

/*Table structure for table `tbl_atlet_perubatan_donator` */

DROP TABLE IF EXISTS `tbl_atlet_perubatan_donator`;

CREATE TABLE `tbl_atlet_perubatan_donator` (
  `donator_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `no_donator_dokumen` varchar(20) NOT NULL,
  `jenis_organ` varchar(30) NOT NULL,
  PRIMARY KEY (`donator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_perubatan_donator` */

insert  into `tbl_atlet_perubatan_donator`(`donator_id`,`atlet_id`,`no_donator_dokumen`,`jenis_organ`) values (1,1,'DOD3874676284','Lungs');

/*Table structure for table `tbl_atlet_perubatan_insurans` */

DROP TABLE IF EXISTS `tbl_atlet_perubatan_insurans`;

CREATE TABLE `tbl_atlet_perubatan_insurans` (
  `insurans_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `syarikat_insurans` varchar(100) NOT NULL,
  `no_polisi_hayat` varchar(20) DEFAULT NULL,
  `no_polisi_kad_perubatan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`insurans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_atlet_perubatan_insurans` */

insert  into `tbl_atlet_perubatan_insurans`(`insurans_id`,`atlet_id`,`syarikat_insurans`,`no_polisi_hayat`,`no_polisi_kad_perubatan`) values (1,1,'AIA','AIA2187389749','A58739647686'),(2,0,'Zurich','ZR456783678645','ZU2848878787875');

/*Table structure for table `tbl_atlet_perubatan_sejarah` */

DROP TABLE IF EXISTS `tbl_atlet_perubatan_sejarah`;

CREATE TABLE `tbl_atlet_perubatan_sejarah` (
  `sejarah_perubatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis` varchar(60) DEFAULT NULL,
  `jenis_sejarah_perubatan` varchar(20) NOT NULL,
  `bila` datetime DEFAULT NULL,
  `mana` varchar(90) DEFAULT NULL,
  `bagaimana` varchar(255) DEFAULT NULL,
  `siapa_yang_merawat` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`sejarah_perubatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_atlet_perubatan_sejarah` */

insert  into `tbl_atlet_perubatan_sejarah`(`sejarah_perubatan_id`,`atlet_id`,`jenis`,`jenis_sejarah_perubatan`,`bila`,`mana`,`bagaimana`,`siapa_yang_merawat`) values (2,1,'1','3','2013-07-25 11:14:00','Bangsa Hospital','','Gan Singh'),(3,1,'2','1','2013-07-25 11:15:00','Bukit Jalil Stadium','Kaki','Dr. Tan'),(4,2,'2','3','2015-09-01 05:30:47','Stadium Merdeka','N/A','Dr Karma'),(5,1,'1','1','2015-09-14 06:30:41','Stadium Tun Fatimah','Jatuh','Dr. Kenny Leong'),(7,4,'1','2','2015-09-01 05:05:00','Stadium Kelana Jaya','','Dr. Admad');

/*Table structure for table `tbl_atlet_sukan` */

DROP TABLE IF EXISTS `tbl_atlet_sukan`;

CREATE TABLE `tbl_atlet_sukan` (
  `sukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jurulatih_id` int(11) NOT NULL,
  `nama_sukan` varchar(100) NOT NULL,
  `acara` varchar(100) NOT NULL,
  `tahun_umur_permulaan` year(4) DEFAULT NULL,
  `tarikh_mula_menyertai_program_msn` date DEFAULT NULL,
  `tarikh_tamat_menyertai_program_msn` date DEFAULT NULL,
  `cawangan` varchar(50) DEFAULT NULL,
  `program_semasa` varchar(100) DEFAULT NULL,
  `no_lesen_sukan` varchar(20) DEFAULT NULL,
  `atlet_persekutuan_dunia_id` varchar(20) DEFAULT NULL,
  `negeri_diwakili` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`sukan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_sukan` */

insert  into `tbl_atlet_sukan`(`sukan_id`,`atlet_id`,`jurulatih_id`,`nama_sukan`,`acara`,`tahun_umur_permulaan`,`tarikh_mula_menyertai_program_msn`,`tarikh_tamat_menyertai_program_msn`,`cawangan`,`program_semasa`,`no_lesen_sukan`,`atlet_persekutuan_dunia_id`,`negeri_diwakili`,`status`) values (1,1,0,'Badminton','Lelaki perseorangan',2009,NULL,NULL,NULL,'Asia Sport',NULL,NULL,'','');

/*Table structure for table `tbl_atlet_sukan_persatuanpersekutuandunia` */

DROP TABLE IF EXISTS `tbl_atlet_sukan_persatuanpersekutuandunia`;

CREATE TABLE `tbl_atlet_sukan_persatuanpersekutuandunia` (
  `persatuan_persekutuan_dunia_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `name_persatuan_persekutuan_dunia` varchar(100) NOT NULL,
  `alamat` varchar(90) NOT NULL,
  `no_telefon` varchar(14) DEFAULT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `laman_web` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`persatuan_persekutuan_dunia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_atlet_sukan_persatuanpersekutuandunia` */

insert  into `tbl_atlet_sukan_persatuanpersekutuandunia`(`persatuan_persekutuan_dunia_id`,`atlet_id`,`jenis`,`name_persatuan_persekutuan_dunia`,`alamat`,`no_telefon`,`emel`,`laman_web`) values (1,1,'Persatuan','Persatuan Harimau Malaysia','Lot 1229, Kaw Perindustrian Wangsa','03-90048334','admin@phm.com','www.phm.com.my'),(2,1,'Persekutuan Dunia','Global Malaysia','13, Jalan Sukan 1/1, Taman Jasa','03-98477885','admin@globalm.com','www.globalm.com.my');

/*Table structure for table `tbl_bajet_penyelidikan` */

DROP TABLE IF EXISTS `tbl_bajet_penyelidikan`;

CREATE TABLE `tbl_bajet_penyelidikan` (
  `bajet_penyelidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonana_penyelidikan_id` int(11) NOT NULL,
  `jenis_bajet` varchar(80) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  PRIMARY KEY (`bajet_penyelidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bajet_penyelidikan` */

/*Table structure for table `tbl_bantuan_elaun` */

DROP TABLE IF EXISTS `tbl_bantuan_elaun`;

CREATE TABLE `tbl_bantuan_elaun` (
  `bantuan_elaun_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_bantuan` varchar(30) NOT NULL,
  `nama_pemohon` varchar(80) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `persatuan` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  `nama_persatuan` varchar(80) NOT NULL,
  `tarikh_mula_dilantik` date NOT NULL,
  `tarikh_tamat_dilantik` date NOT NULL,
  `nama` varchar(80) NOT NULL,
  `muatnaik_gambar` varchar(100) DEFAULT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `umur` int(11) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `kewarganegara` varchar(30) NOT NULL,
  `bangsa` varchar(25) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `kelayakan_akademi` varchar(80) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `no_tel_persatuan_pejabat` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `kontrak` varchar(90) NOT NULL,
  `jumlah_elaun` decimal(10,2) NOT NULL,
  `muatnaik_dokumen` varchar(100) NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bantuan_elaun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bantuan_elaun` */

/*Table structure for table `tbl_bantuan_pentadbiran_pejabat` */

DROP TABLE IF EXISTS `tbl_bantuan_pentadbiran_pejabat`;

CREATE TABLE `tbl_bantuan_pentadbiran_pejabat` (
  `bantuan_pentadbiran_pejabat_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `jawatan` varchar(80) DEFAULT NULL,
  `persatuan` varchar(80) DEFAULT NULL,
  `tarikh` date DEFAULT NULL,
  `nama_sue` varchar(80) DEFAULT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `no_faks` varchar(14) DEFAULT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `jumlah_dipohon` decimal(10,2) DEFAULT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bantuan_pentadbiran_pejabat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bantuan_pentadbiran_pejabat` */

/*Table structure for table `tbl_biomekanik_anthropometrics` */

DROP TABLE IF EXISTS `tbl_biomekanik_anthropometrics`;

CREATE TABLE `tbl_biomekanik_anthropometrics` (
  `biomekanik_anthropometrics_id` int(11) NOT NULL AUTO_INCREMENT,
  `perkhidmatan_analisa_perlawanan_biomekanik_id` int(11) NOT NULL,
  `anthropometrics` varchar(80) NOT NULL,
  `cm_kg` decimal(10,2) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`biomekanik_anthropometrics_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_biomekanik_anthropometrics` */

/*Table structure for table `tbl_biomekanik_ujian` */

DROP TABLE IF EXISTS `tbl_biomekanik_ujian`;

CREATE TABLE `tbl_biomekanik_ujian` (
  `biomekanik_ujian_id` int(11) NOT NULL AUTO_INCREMENT,
  `perkhidmatan_analisa_perlawanan_biomekanik_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `biomekanik_ujian` varchar(80) NOT NULL,
  PRIMARY KEY (`biomekanik_ujian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_biomekanik_ujian` */

/*Table structure for table `tbl_borang_aduan_kaunseling` */

DROP TABLE IF EXISTS `tbl_borang_aduan_kaunseling`;

CREATE TABLE `tbl_borang_aduan_kaunseling` (
  `borang_aduan_kaunseling_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengadu` varchar(80) NOT NULL,
  `tarikh_aduan` date NOT NULL,
  `no_aduan` varchar(30) NOT NULL,
  `status_aduan` varchar(30) NOT NULL,
  `aduan_kategori` varchar(30) NOT NULL,
  `penyataan_aduan` varchar(255) DEFAULT NULL,
  `tindakan_yang_telah_diambil` varchar(255) DEFAULT NULL,
  `dokumen_berkaitan_yang_dilampirkan` varchar(255) DEFAULT NULL,
  `bantuan_yang_anda_perlukan` varchar(255) DEFAULT NULL,
  `rujukan_aduan_kepada_cawangan_yang_berkaitan` varchar(255) DEFAULT NULL,
  `rujuk_aduan_kepada_atlet` varchar(255) DEFAULT NULL,
  `tiada_sebarang_tindakan` varchar(255) DEFAULT NULL,
  `maklumbalas_kepada_pengadu` varchar(255) DEFAULT NULL,
  `tindakan_susulan` varchar(255) DEFAULT NULL,
  `aduan_dimajukan_kepada_agensi_lain` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`borang_aduan_kaunseling_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_borang_aduan_kaunseling` */

/*Table structure for table `tbl_borang_penilaian` */

DROP TABLE IF EXISTS `tbl_borang_penilaian`;

CREATE TABLE `tbl_borang_penilaian` (
  `borang_penilaian_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(80) NOT NULL,
  `tarikh_program` date NOT NULL,
  `tempat` varchar(90) NOT NULL,
  PRIMARY KEY (`borang_penilaian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_borang_penilaian` */

/*Table structure for table `tbl_borang_penilaian_kaunseling` */

DROP TABLE IF EXISTS `tbl_borang_penilaian_kaunseling`;

CREATE TABLE `tbl_borang_penilaian_kaunseling` (
  `borang_penilaian_kaunseling_id` int(11) NOT NULL AUTO_INCREMENT,
  `profil_konsultan_id` int(11) NOT NULL,
  `atlet` varchar(80) NOT NULL,
  `diagnosis` varchar(80) NOT NULL,
  `preskripsi` varchar(80) DEFAULT NULL,
  `cadangan` varchar(80) DEFAULT NULL,
  `rujukan` varchar(80) DEFAULT NULL,
  `tindakan_selanjutnya` varchar(80) DEFAULT NULL,
  `kategori_permasalahan` varchar(80) NOT NULL,
  `tarikh_temujanji` date NOT NULL,
  PRIMARY KEY (`borang_penilaian_kaunseling_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_borang_penilaian_kaunseling` */

/*Table structure for table `tbl_borang_penyertaan_atlet` */

DROP TABLE IF EXISTS `tbl_borang_penyertaan_atlet`;

CREATE TABLE `tbl_borang_penyertaan_atlet` (
  `borang_penyertaan_atlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `tarikh_program` date NOT NULL,
  PRIMARY KEY (`borang_penyertaan_atlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_borang_penyertaan_atlet` */

insert  into `tbl_borang_penyertaan_atlet`(`borang_penyertaan_atlet_id`,`atlet_id`,`nama_program`,`tarikh_program`) values (1,2,'2','2015-10-05'),(2,3,'2','2015-10-14'),(3,1,'1','2015-08-01');

/*Table structure for table `tbl_borang_permohonan_kem` */

DROP TABLE IF EXISTS `tbl_borang_permohonan_kem`;

CREATE TABLE `tbl_borang_permohonan_kem` (
  `borang_permohonan_kem_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(80) NOT NULL,
  `tarikh_program` date NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `objektif` varchar(255) NOT NULL,
  `cadangan` varchar(255) NOT NULL,
  PRIMARY KEY (`borang_permohonan_kem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_borang_permohonan_kem` */

/*Table structure for table `tbl_bsp` */

DROP TABLE IF EXISTS `tbl_bsp`;

CREATE TABLE `tbl_bsp` (
  `bsp_pemohon_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_penerima` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `peringkat_pengajian` varchar(30) NOT NULL,
  `bidang_pengajian` varchar(80) NOT NULL,
  `falkuti_pengajian` varchar(80) NOT NULL,
  `ipt` varchar(80) NOT NULL,
  `tahun_mula_pengajian` date NOT NULL,
  `tahun_tamat_pengajian` date NOT NULL,
  `tahun_ditawarkan_biasiswa` date NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  `temuduga_tarikh` datetime DEFAULT NULL,
  PRIMARY KEY (`bsp_pemohon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp` */

/*Table structure for table `tbl_bsp_bendahari_ipt` */

DROP TABLE IF EXISTS `tbl_bsp_bendahari_ipt`;

CREATE TABLE `tbl_bsp_bendahari_ipt` (
  `bsp_bendahari_ipt_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelajar` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `no_uni_matrix` varchar(20) DEFAULT NULL,
  `yuran_pengajian` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`bsp_bendahari_ipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_bendahari_ipt` */

/*Table structure for table `tbl_bsp_dokumen_sokongan` */

DROP TABLE IF EXISTS `tbl_bsp_dokumen_sokongan`;

CREATE TABLE `tbl_bsp_dokumen_sokongan` (
  `bsp_dokumen_sokongan_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `nama_dokumen` varchar(80) NOT NULL,
  `upload` varchar(100) NOT NULL,
  PRIMARY KEY (`bsp_dokumen_sokongan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_dokumen_sokongan` */

/*Table structure for table `tbl_bsp_elaun_latihan_praktikal` */

DROP TABLE IF EXISTS `tbl_bsp_elaun_latihan_praktikal`;

CREATE TABLE `tbl_bsp_elaun_latihan_praktikal` (
  `bsp_elaun_latihan_praktikal_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `jenis_latihan_amali` varchar(30) NOT NULL,
  `tempat_latihan_praktikal` varchar(90) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bsp_elaun_latihan_praktikal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_elaun_latihan_praktikal` */

/*Table structure for table `tbl_bsp_elaun_latihan_praktikal_month` */

DROP TABLE IF EXISTS `tbl_bsp_elaun_latihan_praktikal_month`;

CREATE TABLE `tbl_bsp_elaun_latihan_praktikal_month` (
  `bsp_elaun_latihan_praktikal_month_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_elaun_latihan_praktikal_id` int(11) NOT NULL,
  `bulan` date NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  PRIMARY KEY (`bsp_elaun_latihan_praktikal_month_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_elaun_latihan_praktikal_month` */

/*Table structure for table `tbl_bsp_elaun_perjalanan_udara` */

DROP TABLE IF EXISTS `tbl_bsp_elaun_perjalanan_udara`;

CREATE TABLE `tbl_bsp_elaun_perjalanan_udara` (
  `bsp_elaun_perjalanan_udara_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `destinasi_pergi` varchar(90) NOT NULL,
  `tarikh_pergi` date NOT NULL,
  `destinasi_balik` varchar(90) NOT NULL,
  `tarikh_balik` date NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bsp_elaun_perjalanan_udara_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_elaun_perjalanan_udara` */

/*Table structure for table `tbl_bsp_kedudukan_kewangan_penjamin` */

DROP TABLE IF EXISTS `tbl_bsp_kedudukan_kewangan_penjamin`;

CREATE TABLE `tbl_bsp_kedudukan_kewangan_penjamin` (
  `bsp_kedudukan_kewangan_penjamin_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_penjamin_id` int(11) NOT NULL,
  `pendapatan_bulanan` decimal(10,2) NOT NULL,
  `pinjaman_perumahan_baki_terkini` decimal(10,2) DEFAULT NULL,
  `sebagai_penjamin_siberhutang` decimal(10,2) DEFAULT NULL,
  `lain_lain_pinjaman_tanggungan` decimal(10,2) DEFAULT NULL,
  `perkerjaan` varchar(90) NOT NULL,
  `nama_alamat_majikan` varchar(255) DEFAULT NULL,
  `nama_isteri_suami` varchar(80) DEFAULT NULL,
  `no_kp_isteri_suami` varchar(12) DEFAULT NULL,
  `jumlah_anak` int(11) DEFAULT NULL,
  `pertalian_keluarga_dengan_pelajar` varchar(90) DEFAULT NULL,
  `pelajar_lain_selain_daripada_penerima_di_atas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bsp_kedudukan_kewangan_penjamin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_kedudukan_kewangan_penjamin` */

/*Table structure for table `tbl_bsp_kedudukan_kewangan_penjamin_jenis_harta` */

DROP TABLE IF EXISTS `tbl_bsp_kedudukan_kewangan_penjamin_jenis_harta`;

CREATE TABLE `tbl_bsp_kedudukan_kewangan_penjamin_jenis_harta` (
  `bsp_kedudukan_kewangan_penjamin_jenis_harta_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_kedudukan_kewangan_penjamin_id` int(11) NOT NULL,
  `jenis_harta` varchar(30) NOT NULL,
  `jumlah_ekar_kaki_persegi` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  PRIMARY KEY (`bsp_kedudukan_kewangan_penjamin_jenis_harta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_kedudukan_kewangan_penjamin_jenis_harta` */

/*Table structure for table `tbl_bsp_pembayaran` */

DROP TABLE IF EXISTS `tbl_bsp_pembayaran`;

CREATE TABLE `tbl_bsp_pembayaran` (
  `bsp_pembayaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `bayaran` decimal(10,2) NOT NULL,
  `semester` varchar(80) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bsp_pembayaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_pembayaran` */

/*Table structure for table `tbl_bsp_penjamin` */

DROP TABLE IF EXISTS `tbl_bsp_penjamin`;

CREATE TABLE `tbl_bsp_penjamin` (
  `bsp_penjamin_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `alamat_tetap_1` varchar(90) NOT NULL,
  `alamat_tetap_2` varchar(90) DEFAULT NULL,
  `alamat_tetap_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `alamat_surat_menyurat_1` varchar(90) NOT NULL,
  `alamat_surat_menyurat_2` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_3` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_negeri` varchar(30) NOT NULL,
  `alamat_surat_menyurat_bandar` varchar(40) NOT NULL,
  `alamat_surat_menyurat_poskod` varchar(5) NOT NULL,
  `no_telefon_rumah` varchar(14) DEFAULT NULL,
  `no_telefon_pejabat` varchar(14) DEFAULT NULL,
  `no_telefon_bimbit` varchar(14) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat_pejabat_1` varchar(90) DEFAULT NULL,
  `alamat_pejabat_2` varchar(90) DEFAULT NULL,
  `alamat_pejabat_3` varchar(90) DEFAULT NULL,
  `alamat_pejabat_negeri` varchar(30) DEFAULT NULL,
  `alamat_pejabat_bandar` varchar(40) DEFAULT NULL,
  `alamat_pejabat_poskod` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`bsp_penjamin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_penjamin` */

/*Table structure for table `tbl_bsp_perlanjutan` */

DROP TABLE IF EXISTS `tbl_bsp_perlanjutan`;

CREATE TABLE `tbl_bsp_perlanjutan` (
  `bsp_perlanjutan_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `tempoh_mohon_perlanjutan` varchar(30) NOT NULL,
  `permohonan_pelanjutan` varchar(30) NOT NULL,
  PRIMARY KEY (`bsp_perlanjutan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_perlanjutan` */

/*Table structure for table `tbl_bsp_perlanjutan_dokumen` */

DROP TABLE IF EXISTS `tbl_bsp_perlanjutan_dokumen`;

CREATE TABLE `tbl_bsp_perlanjutan_dokumen` (
  `bsp_perlanjutan_dokumen_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_perlanjutan_id` int(11) NOT NULL,
  `nama_dokumen` varchar(90) NOT NULL,
  `upload` varchar(100) NOT NULL,
  PRIMARY KEY (`bsp_perlanjutan_dokumen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_perlanjutan_dokumen` */

/*Table structure for table `tbl_bsp_perlanjutan_sebab` */

DROP TABLE IF EXISTS `tbl_bsp_perlanjutan_sebab`;

CREATE TABLE `tbl_bsp_perlanjutan_sebab` (
  `bsp_perlanjutan_sebab_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_perlanjutan_id` int(11) NOT NULL,
  `sebab` varchar(255) NOT NULL,
  PRIMARY KEY (`bsp_perlanjutan_sebab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_perlanjutan_sebab` */

/*Table structure for table `tbl_bsp_pertukaran_program_pengajian` */

DROP TABLE IF EXISTS `tbl_bsp_pertukaran_program_pengajian`;

CREATE TABLE `tbl_bsp_pertukaran_program_pengajian` (
  `bsp_pertukaran_program_pengajian_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `bidang_pengajian_kursus` varchar(80) NOT NULL,
  `fakulti` varchar(80) NOT NULL,
  `tarikh_mula_pengajian` date NOT NULL,
  `tarikh_tamat_pengajian` date NOT NULL,
  `tempoh_perlanjutan_semester` int(11) NOT NULL,
  PRIMARY KEY (`bsp_pertukaran_program_pengajian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_pertukaran_program_pengajian` */

/*Table structure for table `tbl_bsp_pertukaran_program_pengajian_dokumen` */

DROP TABLE IF EXISTS `tbl_bsp_pertukaran_program_pengajian_dokumen`;

CREATE TABLE `tbl_bsp_pertukaran_program_pengajian_dokumen` (
  `bsp_pertukaran_program_pengajian_dokumen_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pertukaran_program_pengajian_id` int(11) NOT NULL,
  `nama_dokumen` varchar(80) NOT NULL,
  `upload` varchar(100) NOT NULL,
  PRIMARY KEY (`bsp_pertukaran_program_pengajian_dokumen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_pertukaran_program_pengajian_dokumen` */

/*Table structure for table `tbl_bsp_pertukaran_program_pengajian_sebab` */

DROP TABLE IF EXISTS `tbl_bsp_pertukaran_program_pengajian_sebab`;

CREATE TABLE `tbl_bsp_pertukaran_program_pengajian_sebab` (
  `bsp_pertukaran_program_pengajian_sebab_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pertukaran_program_pengajian_id` int(11) NOT NULL,
  `sebab` varchar(255) NOT NULL,
  PRIMARY KEY (`bsp_pertukaran_program_pengajian_sebab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_pertukaran_program_pengajian_sebab` */

/*Table structure for table `tbl_bsp_prestasi` */

DROP TABLE IF EXISTS `tbl_bsp_prestasi`;

CREATE TABLE `tbl_bsp_prestasi` (
  `bsp_prestasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `laporan_ulasan` varchar(255) DEFAULT NULL,
  `nyatakan_sebab_sebab_tidak_menyertai_kejohanan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bsp_prestasi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_prestasi` */

/*Table structure for table `tbl_bsp_prestasi_akademik` */

DROP TABLE IF EXISTS `tbl_bsp_prestasi_akademik`;

CREATE TABLE `tbl_bsp_prestasi_akademik` (
  `bsp_prestasi_akademik_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_prestasi_id` int(11) NOT NULL,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `png` varchar(30) NOT NULL,
  `pngk` varchar(30) NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bsp_prestasi_akademik_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_prestasi_akademik` */

/*Table structure for table `tbl_bsp_prestasi_sukan` */

DROP TABLE IF EXISTS `tbl_bsp_prestasi_sukan`;

CREATE TABLE `tbl_bsp_prestasi_sukan` (
  `bsp_prestasi_sukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_prestasi_id` int(11) NOT NULL,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `kejohanan_yang_disertai` varchar(80) NOT NULL,
  `lokasi_kejohanan` varchar(90) NOT NULL,
  `pencapaian` varchar(30) NOT NULL,
  PRIMARY KEY (`bsp_prestasi_sukan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_prestasi_sukan` */

/*Table structure for table `tbl_bsp_tamat_pengesahan_pengajian` */

DROP TABLE IF EXISTS `tbl_bsp_tamat_pengesahan_pengajian`;

CREATE TABLE `tbl_bsp_tamat_pengesahan_pengajian` (
  `bsp_tamat_pengesahan_pengajian_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ipts` varchar(80) NOT NULL,
  `pengajian` varchar(80) NOT NULL,
  `bidang` varchar(80) NOT NULL,
  `cgpa_pngk` varchar(30) DEFAULT NULL,
  `tarikh_tamat` date DEFAULT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bsp_tamat_pengesahan_pengajian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_tamat_pengesahan_pengajian` */

/*Table structure for table `tbl_bsp_tuntutan_elaun_tesis` */

DROP TABLE IF EXISTS `tbl_bsp_tuntutan_elaun_tesis`;

CREATE TABLE `tbl_bsp_tuntutan_elaun_tesis` (
  `bsp_tuntutan_elaun_tesis_od` int(11) NOT NULL AUTO_INCREMENT,
  `bsp_pemohon_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `tajuk_tesis` varchar(90) NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bsp_tuntutan_elaun_tesis_od`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bsp_tuntutan_elaun_tesis` */

/*Table structure for table `tbl_cadangan_elaun` */

DROP TABLE IF EXISTS `tbl_cadangan_elaun`;

CREATE TABLE `tbl_cadangan_elaun` (
  `cadangan_elaun_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet` int(11) NOT NULL,
  `elaun_semasa` decimal(10,2) NOT NULL,
  `elaun_cadangan` decimal(10,2) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `ulasan` varchar(255) DEFAULT NULL,
  `jenis_kelulusan` varchar(30) NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cadangan_elaun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_cadangan_elaun` */

/*Table structure for table `tbl_dokumen_penyelidikan` */

DROP TABLE IF EXISTS `tbl_dokumen_penyelidikan`;

CREATE TABLE `tbl_dokumen_penyelidikan` (
  `dokumen_penyelidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonana_penyelidikan_id` int(11) NOT NULL,
  `nama_dokumen` varchar(80) NOT NULL,
  `muat_naik` varchar(100) NOT NULL,
  PRIMARY KEY (`dokumen_penyelidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_dokumen_penyelidikan` */

/*Table structure for table `tbl_ekemudahan` */

DROP TABLE IF EXISTS `tbl_ekemudahan`;

CREATE TABLE `tbl_ekemudahan` (
  `ekemudahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(30) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `lokasi` varchar(90) NOT NULL,
  `dihubungi` varchar(100) DEFAULT NULL,
  `kadar_sewa` decimal(10,2) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `nama_perniagaan_perkhidmatan_organisasi` varchar(100) NOT NULL,
  `kapasiti_penggunaan` varchar(50) NOT NULL,
  `no_lesen_pendaftaran` varchar(30) NOT NULL,
  PRIMARY KEY (`ekemudahan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ekemudahan` */

insert  into `tbl_ekemudahan`(`ekemudahan_id`,`kategori`,`jenis`,`gambar`,`lokasi`,`dihubungi`,`kadar_sewa`,`url`,`nama_perniagaan_perkhidmatan_organisasi`,`kapasiti_penggunaan`,`no_lesen_pendaftaran`) values (1,'Kompleks','Kompleks Sukan Komuniti',NULL,'Taman Pertanian','Jason Yong','3000.00',NULL,'','','');

/*Table structure for table `tbl_elaporan_dokumen_sokongan` */

DROP TABLE IF EXISTS `tbl_elaporan_dokumen_sokongan`;

CREATE TABLE `tbl_elaporan_dokumen_sokongan` (
  `elaporan_dokumen_sokongan_id` int(11) NOT NULL AUTO_INCREMENT,
  `elaporan_pelaksaan_id` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `muat_nail` varchar(100) NOT NULL,
  PRIMARY KEY (`elaporan_dokumen_sokongan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaporan_dokumen_sokongan` */

/*Table structure for table `tbl_elaporan_kewangan_dan_perbelanjaan` */

DROP TABLE IF EXISTS `tbl_elaporan_kewangan_dan_perbelanjaan`;

CREATE TABLE `tbl_elaporan_kewangan_dan_perbelanjaan` (
  `elaporan_kewangan_dan_perbelanjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `elaporan_pelaksaan_id` int(11) NOT NULL,
  `program_aktiviti_butir` varchar(80) NOT NULL,
  `jenis_kewangan` varchar(30) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  PRIMARY KEY (`elaporan_kewangan_dan_perbelanjaan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaporan_kewangan_dan_perbelanjaan` */

/*Table structure for table `tbl_elaporan_komposisi_penyertaan` */

DROP TABLE IF EXISTS `tbl_elaporan_komposisi_penyertaan`;

CREATE TABLE `tbl_elaporan_komposisi_penyertaan` (
  `elaporan_komposisi_penyertaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `elaporan_pelaksaan_id` int(11) NOT NULL,
  `kumpulan_penyertaan` varchar(80) NOT NULL,
  `jenis_komposisi` varchar(30) NOT NULL,
  `bilangan` int(11) NOT NULL,
  PRIMARY KEY (`elaporan_komposisi_penyertaan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaporan_komposisi_penyertaan` */

/*Table structure for table `tbl_elaporan_pelaksanaan` */

DROP TABLE IF EXISTS `tbl_elaporan_pelaksanaan`;

CREATE TABLE `tbl_elaporan_pelaksanaan` (
  `elaporan_pelaksaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_elaporan` varchar(30) NOT NULL,
  `nama_projek_program_aktiviti_kejohanan` varchar(80) NOT NULL,
  `peringkat` varchar(30) NOT NULL,
  `nama_penganjur_persatuan_kerjasama` varchar(80) NOT NULL,
  `jumlah_bantuan_peruntukan` decimal(10,2) NOT NULL,
  `jumlah_perbelanjaan` decimal(10,2) DEFAULT NULL,
  `no_cek_eft` varchar(50) NOT NULL,
  `tarikh_cek_eft` date NOT NULL,
  `tarikh_pelaksanaan_mula` date NOT NULL,
  `tarikh_pelaksanaan_akhir` date NOT NULL,
  `objektif_pelaksaan` varchar(255) NOT NULL,
  `tempat_pelaksanaan` varchar(90) DEFAULT NULL,
  `dirasmikan_oleh` varchar(80) NOT NULL,
  `lelaki` int(11) NOT NULL,
  `wanita` int(11) NOT NULL,
  `melayu` int(11) NOT NULL,
  `cina` int(11) NOT NULL,
  `india` int(11) NOT NULL,
  `lain_lain` int(11) NOT NULL,
  `jumlah_penyertaan` int(11) NOT NULL,
  `rumusan_program` varchar(30) NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`elaporan_pelaksaan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaporan_pelaksanaan` */

/*Table structure for table `tbl_elaporan_pelaksanaan_gambar` */

DROP TABLE IF EXISTS `tbl_elaporan_pelaksanaan_gambar`;

CREATE TABLE `tbl_elaporan_pelaksanaan_gambar` (
  `elaporan_pelaksanaan_gambar_id` int(11) NOT NULL AUTO_INCREMENT,
  `elaporan_pelaksaan_id` int(11) NOT NULL,
  `muat_naik_gambar` varchar(100) NOT NULL,
  `tajuk` varchar(100) NOT NULL,
  PRIMARY KEY (`elaporan_pelaksanaan_gambar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaporan_pelaksanaan_gambar` */

/*Table structure for table `tbl_elaporan_pelaksanaan_kerjasama` */

DROP TABLE IF EXISTS `tbl_elaporan_pelaksanaan_kerjasama`;

CREATE TABLE `tbl_elaporan_pelaksanaan_kerjasama` (
  `elaporan_pelaksanaan_kerjasama_id` int(11) NOT NULL AUTO_INCREMENT,
  `elaporan_pelaksaan_id` int(11) NOT NULL,
  `nama_kerjasama` varchar(80) NOT NULL,
  PRIMARY KEY (`elaporan_pelaksanaan_kerjasama_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaporan_pelaksanaan_kerjasama` */

/*Table structure for table `tbl_elaporan_pelaksanaan_objektif` */

DROP TABLE IF EXISTS `tbl_elaporan_pelaksanaan_objektif`;

CREATE TABLE `tbl_elaporan_pelaksanaan_objektif` (
  `elaporan_pelaksanaan_objektif_id` int(11) NOT NULL AUTO_INCREMENT,
  `elaporan_pelaksaan_id` int(11) NOT NULL,
  `objektif_pelaksanaan` varchar(255) NOT NULL,
  PRIMARY KEY (`elaporan_pelaksanaan_objektif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaporan_pelaksanaan_objektif` */

/*Table structure for table `tbl_elaun_jurulatih` */

DROP TABLE IF EXISTS `tbl_elaun_jurulatih`;

CREATE TABLE `tbl_elaun_jurulatih` (
  `elaun_jurulatih_id` int(11) NOT NULL,
  `gaji_dan_elaun_jurulatih_id` int(11) NOT NULL,
  `jenis_elaun` varchar(80) NOT NULL,
  `jumlah_elaun` decimal(10,2) NOT NULL,
  PRIMARY KEY (`elaun_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_elaun_jurulatih` */

/*Table structure for table `tbl_farmasi_pengurusan_stok` */

DROP TABLE IF EXISTS `tbl_farmasi_pengurusan_stok`;

CREATE TABLE `tbl_farmasi_pengurusan_stok` (
  `farmasi_pengurusan_stok` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ubat` varchar(80) NOT NULL,
  `dos` varchar(30) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `kuantiti` int(11) NOT NULL,
  `jumlah_harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`farmasi_pengurusan_stok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_farmasi_pengurusan_stok` */

/*Table structure for table `tbl_farmasi_permohonan_liputan_perubatan_sukan` */

DROP TABLE IF EXISTS `tbl_farmasi_permohonan_liputan_perubatan_sukan`;

CREATE TABLE `tbl_farmasi_permohonan_liputan_perubatan_sukan` (
  `permohonan_liputan_perubatan_sukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(80) NOT NULL,
  `tarikh_program` date NOT NULL,
  `tempat_program` varchar(90) NOT NULL,
  `nama_pemohon` varchar(80) NOT NULL,
  `no_tel_pemohon` varchar(14) NOT NULL,
  `pegawai_bertugas` varchar(80) NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  `kelulusan_ceo` tinyint(1) NOT NULL,
  `kelulusan_pbu` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonan_liputan_perubatan_sukan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_farmasi_permohonan_liputan_perubatan_sukan` */

/*Table structure for table `tbl_farmasi_permohonan_ubatan` */

DROP TABLE IF EXISTS `tbl_farmasi_permohonan_ubatan`;

CREATE TABLE `tbl_farmasi_permohonan_ubatan` (
  `farmasi_permohonan_ubatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh_pemberian` date NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`farmasi_permohonan_ubatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_farmasi_permohonan_ubatan` */

/*Table structure for table `tbl_farmasi_ubatan` */

DROP TABLE IF EXISTS `tbl_farmasi_ubatan`;

CREATE TABLE `tbl_farmasi_ubatan` (
  `farmasi_ubatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `farmasi_permohonan_ubatan_id` int(11) NOT NULL,
  `nama_ubat` varchar(80) NOT NULL,
  `size` varchar(30) DEFAULT NULL,
  `kuantiti` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`farmasi_ubatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_farmasi_ubatan` */

/*Table structure for table `tbl_forum_seminar_persidangan_di_luar_negara` */

DROP TABLE IF EXISTS `tbl_forum_seminar_persidangan_di_luar_negara`;

CREATE TABLE `tbl_forum_seminar_persidangan_di_luar_negara` (
  `forum_seminar_persidangan_di_luar_negara_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemohon` varchar(80) NOT NULL,
  `jawatan_pemohon` varchar(80) NOT NULL,
  `persatuan_pemohon` varchar(80) NOT NULL,
  `jenis_program` varchar(30) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  `persatuan` varchar(80) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `nama_wakil_persatuan_1` varchar(80) NOT NULL,
  `nama_wakil_persatuan_2` varchar(80) NOT NULL,
  `amaun` decimal(10,2) NOT NULL,
  `negara` varchar(30) NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`forum_seminar_persidangan_di_luar_negara_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_forum_seminar_persidangan_di_luar_negara` */

/*Table structure for table `tbl_gaji_dan_elaun_jurulatih` */

DROP TABLE IF EXISTS `tbl_gaji_dan_elaun_jurulatih`;

CREATE TABLE `tbl_gaji_dan_elaun_jurulatih` (
  `gaji_dan_elaun_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurulatih` int(11) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `no_passport` varchar(15) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `bank` varchar(80) NOT NULL,
  `no_akaun` varchar(50) NOT NULL,
  `cawangan` varchar(80) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gaji_dan_elaun_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_gaji_dan_elaun_jurulatih` */

/*Table structure for table `tbl_geran_bantuan_gaji` */

DROP TABLE IF EXISTS `tbl_geran_bantuan_gaji`;

CREATE TABLE `tbl_geran_bantuan_gaji` (
  `geran_bantuan_gaji_id` int(11) NOT NULL AUTO_INCREMENT,
  `muatnaik_gambar` varchar(100) NOT NULL,
  `nama_jurulatih` varchar(80) NOT NULL,
  `cawangan` varchar(80) NOT NULL,
  `sub_cawangan` varchar(80) NOT NULL,
  `program_msn` varchar(80) NOT NULL,
  `lain_lain_program` varchar(80) NOT NULL,
  `pusat_latihan` varchar(80) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `status_jurulatih` varchar(30) NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `status_keaktifan_jurulatih` varchar(30) NOT NULL,
  `kategori_geran` varchar(30) NOT NULL,
  `jumlah_geran` decimal(10,2) NOT NULL,
  `status_geran` varchar(30) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`geran_bantuan_gaji_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_geran_bantuan_gaji` */

/*Table structure for table `tbl_informasi_permohonan` */

DROP TABLE IF EXISTS `tbl_informasi_permohonan`;

CREATE TABLE `tbl_informasi_permohonan` (
  `informasi_permohonan_id` int(11) NOT NULL AUTO_INCREMENT,
  `butiran_permohonan` varchar(80) NOT NULL,
  `amaun` decimal(10,2) NOT NULL,
  `muatnaik_dokumen` varchar(100) NOT NULL,
  PRIMARY KEY (`informasi_permohonan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_informasi_permohonan` */

/*Table structure for table `tbl_informasi_persatuan` */

DROP TABLE IF EXISTS `tbl_informasi_persatuan`;

CREATE TABLE `tbl_informasi_persatuan` (
  `informasi_persatuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_persatuan` varchar(80) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel` varchar(14) NOT NULL,
  `no_faks` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `laman_web` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`informasi_persatuan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_informasi_persatuan` */

/*Table structure for table `tbl_jenis_kebajikan` */

DROP TABLE IF EXISTS `tbl_jenis_kebajikan`;

CREATE TABLE `tbl_jenis_kebajikan` (
  `jenis_kebajikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kebajikan` varchar(30) NOT NULL,
  `perkara` varchar(100) NOT NULL,
  `sukan_sea_para_asean` decimal(10,2) NOT NULL,
  `sukan_asia_komenwel_para_asia_ead` decimal(10,2) NOT NULL,
  `sukan_olimpik_paralimpik` decimal(10,2) NOT NULL,
  `kejohanan_asia_dunia` decimal(10,2) NOT NULL,
  PRIMARY KEY (`jenis_kebajikan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jenis_kebajikan` */

insert  into `tbl_jenis_kebajikan`(`jenis_kebajikan_id`,`jenis_kebajikan`,`perkara`,`sukan_sea_para_asean`,`sukan_asia_komenwel_para_asia_ead`,`sukan_olimpik_paralimpik`,`kejohanan_asia_dunia`) values (1,'2','Kebajikan ','500.00','1000.00','2000.00','3000.00'),(2,'3','Tambah','500.00','300.00','400.00','100.00');

/*Table structure for table `tbl_journal` */

DROP TABLE IF EXISTS `tbl_journal`;

CREATE TABLE `tbl_journal` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(80) NOT NULL,
  `telefon_no` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `tarikh_journal` date NOT NULL,
  `bahagian` varchar(30) NOT NULL,
  `artikel_journal` text NOT NULL,
  `status_journal` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_journal` */

/*Table structure for table `tbl_jurulatih` */

DROP TABLE IF EXISTS `tbl_jurulatih`;

CREATE TABLE `tbl_jurulatih` (
  `jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) NOT NULL,
  `no_fail` varchar(30) NOT NULL,
  `bahagian` varchar(30) NOT NULL,
  `cawangan` varchar(80) NOT NULL,
  `program` varchar(30) NOT NULL,
  `sub_cawangan_pelapis` varchar(80) NOT NULL,
  `lain_lain_program` varchar(80) NOT NULL,
  `pusat_latihan` varchar(80) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `status_jurulatih` varchar(30) NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `status_keaktifan_jurulatih` varchar(30) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `bangsa` varchar(25) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `warganegara` varchar(100) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `tempat_lahir` varchar(90) NOT NULL,
  `taraf_perkahwinan` varchar(15) NOT NULL,
  `bil_tanggungan` int(11) NOT NULL,
  `ic_no` varchar(12) DEFAULT NULL,
  `ic_no_lama` varchar(8) DEFAULT NULL,
  `ic_tentera` varchar(12) DEFAULT NULL,
  `passport_no` varchar(15) DEFAULT NULL,
  `tamat_tempoh` date DEFAULT NULL,
  `no_visa` varchar(30) DEFAULT NULL,
  `tamat_visa_tempoh` date DEFAULT NULL,
  `no_permit_kerja` varchar(30) DEFAULT NULL,
  `tamat_permit_tempoh` date DEFAULT NULL,
  `alamat_rumah_1` varchar(90) NOT NULL,
  `alamat_rumah_2` varchar(90) DEFAULT NULL,
  `alamat_rumah_3` varchar(90) DEFAULT NULL,
  `alamat_rumah_negeri` varchar(30) NOT NULL,
  `alamat_rumah_bandar` varchar(40) NOT NULL,
  `alamat_rumah_poskod` varchar(5) NOT NULL,
  `alamat_surat_menyurat_1` varchar(90) NOT NULL,
  `alamat_surat_menyurat_2` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_3` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_negeri` varchar(30) NOT NULL,
  `alamat_surat_menyurat_bandar` varchar(40) NOT NULL,
  `alamat_surat_menyurat_poskod` varchar(5) NOT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `no_telefon_bimbit` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `sektor` varchar(30) NOT NULL,
  `jawatan` varchar(30) NOT NULL,
  `no_telefon_pejabat` varchar(14) NOT NULL,
  `nama_majikan` varchar(80) DEFAULT NULL,
  `alamat_majikan_1` varchar(90) NOT NULL,
  `alamat_majikan_2` varchar(90) DEFAULT NULL,
  `alamat_majikan_3` varchar(90) DEFAULT NULL,
  `alamat_majikan_negeri` varchar(30) NOT NULL,
  `alamat_majikan_bandar` varchar(40) NOT NULL,
  `alamat_majikan_poskod` varchar(5) NOT NULL,
  PRIMARY KEY (`jurulatih_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurulatih` */

insert  into `tbl_jurulatih`(`jurulatih_id`,`gambar`,`no_fail`,`bahagian`,`cawangan`,`program`,`sub_cawangan_pelapis`,`lain_lain_program`,`pusat_latihan`,`nama_sukan`,`nama_acara`,`status_jurulatih`,`status_permohonan`,`status_keaktifan_jurulatih`,`nama`,`bangsa`,`agama`,`jantina`,`warganegara`,`tarikh_lahir`,`tempat_lahir`,`taraf_perkahwinan`,`bil_tanggungan`,`ic_no`,`ic_no_lama`,`ic_tentera`,`passport_no`,`tamat_tempoh`,`no_visa`,`tamat_visa_tempoh`,`no_permit_kerja`,`tamat_permit_tempoh`,`alamat_rumah_1`,`alamat_rumah_2`,`alamat_rumah_3`,`alamat_rumah_negeri`,`alamat_rumah_bandar`,`alamat_rumah_poskod`,`alamat_surat_menyurat_1`,`alamat_surat_menyurat_2`,`alamat_surat_menyurat_3`,`alamat_surat_menyurat_negeri`,`alamat_surat_menyurat_bandar`,`alamat_surat_menyurat_poskod`,`no_telefon`,`no_telefon_bimbit`,`emel`,`status`,`sektor`,`jawatan`,`no_telefon_pejabat`,`nama_majikan`,`alamat_majikan_1`,`alamat_majikan_2`,`alamat_majikan_3`,`alamat_majikan_negeri`,`alamat_majikan_bandar`,`alamat_majikan_poskod`) values (1,'','','MSN','','','','','','','','','','','Jason Loong','','','','','0000-00-00','','',0,'860601085504',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,'','','','',NULL,NULL,'','','','','',NULL,NULL,'','','',NULL,'',NULL,NULL,'','',''),(2,'','','KBS','','','','','','','','','','','Mohd Ahli Kamar','','','','','0000-00-00','','',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,'','','','',NULL,NULL,'','','','','',NULL,NULL,'','','',NULL,'',NULL,NULL,'','','');

/*Table structure for table `tbl_jurulatih_keluarga` */

DROP TABLE IF EXISTS `tbl_jurulatih_keluarga`;

CREATE TABLE `tbl_jurulatih_keluarga` (
  `jurulatih_keluarga_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurulatih_id` int(11) NOT NULL,
  `nama_suami_isteri_waris` varchar(80) NOT NULL,
  `alamat_surat_menyurat_1` varchar(90) NOT NULL,
  `alamat_surat_menyurat_2` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_3` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_negeri` varchar(30) NOT NULL,
  `alamat_surat_menyurat_bandar` varchar(40) NOT NULL,
  `alamat_surat_menyurat_poskod` varchar(5) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `no_telefon_bimbit` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`jurulatih_keluarga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurulatih_keluarga` */

/*Table structure for table `tbl_jurulatih_kesihatan` */

DROP TABLE IF EXISTS `tbl_jurulatih_kesihatan`;

CREATE TABLE `tbl_jurulatih_kesihatan` (
  `jurulatih_kesihatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurulatih_id` int(11) NOT NULL,
  `tinggi` decimal(10,2) NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `masalah_kesihatan` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `pembedahan` varchar(255) DEFAULT NULL,
  `alahan` varchar(255) DEFAULT NULL,
  `sejarah_perubatan` varchar(255) DEFAULT NULL,
  `kecacatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`jurulatih_kesihatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurulatih_kesihatan` */

/*Table structure for table `tbl_jurulatih_kursus_tertinggi` */

DROP TABLE IF EXISTS `tbl_jurulatih_kursus_tertinggi`;

CREATE TABLE `tbl_jurulatih_kursus_tertinggi` (
  `kursus_tertinggi_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurulatih_id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kursus` varchar(80) NOT NULL,
  PRIMARY KEY (`kursus_tertinggi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurulatih_kursus_tertinggi` */

/*Table structure for table `tbl_jurulatih_pendidikan` */

DROP TABLE IF EXISTS `tbl_jurulatih_pendidikan`;

CREATE TABLE `tbl_jurulatih_pendidikan` (
  `jurulatih_pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurulatih_id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `sekolah_kolej_universiti` varchar(80) NOT NULL,
  `gred` varchar(255) NOT NULL,
  PRIMARY KEY (`jurulatih_pendidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurulatih_pendidikan` */

/*Table structure for table `tbl_jurulatih_pengalaman` */

DROP TABLE IF EXISTS `tbl_jurulatih_pengalaman`;

CREATE TABLE `tbl_jurulatih_pengalaman` (
  `jurulatih_pengalaman_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurulatih_id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `perkara_aktiviti` varchar(80) NOT NULL,
  PRIMARY KEY (`jurulatih_pengalaman_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurulatih_pengalaman` */

/*Table structure for table `tbl_jurulatih_spkk` */

DROP TABLE IF EXISTS `tbl_jurulatih_spkk`;

CREATE TABLE `tbl_jurulatih_spkk` (
  `jurulatih_spkk_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurulatih_id` int(11) NOT NULL,
  `jenis_spkk` varchar(30) NOT NULL,
  `tahap` varchar(30) NOT NULL,
  `sukan` varchar(80) NOT NULL,
  `muatnaik_sijil` varchar(100) NOT NULL,
  PRIMARY KEY (`jurulatih_spkk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurulatih_spkk` */

/*Table structure for table `tbl_kegiatan_pengalaman_atlet_akk` */

DROP TABLE IF EXISTS `tbl_kegiatan_pengalaman_atlet_akk`;

CREATE TABLE `tbl_kegiatan_pengalaman_atlet_akk` (
  `kegiatan_pengalaman_atlet_akk_id` int(11) NOT NULL AUTO_INCREMENT,
  `akademi_akk_id` int(11) NOT NULL,
  `nama_sukan_pertandingan` varchar(80) NOT NULL,
  `tahun` year(4) NOT NULL,
  `sukan_acara` varchar(80) NOT NULL,
  `pencapaian` varchar(80) NOT NULL,
  PRIMARY KEY (`kegiatan_pengalaman_atlet_akk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kegiatan_pengalaman_atlet_akk` */

/*Table structure for table `tbl_kegiatan_pengalaman_jurulatih_akk` */

DROP TABLE IF EXISTS `tbl_kegiatan_pengalaman_jurulatih_akk`;

CREATE TABLE `tbl_kegiatan_pengalaman_jurulatih_akk` (
  `kegiatan_pengalaman_jurulatih_akk_id` int(11) NOT NULL AUTO_INCREMENT,
  `akademi_akk_id` int(11) NOT NULL,
  `nama_sukan_pertandingan` varchar(80) NOT NULL,
  `tahun` year(4) NOT NULL,
  `peranan` varchar(80) NOT NULL,
  `peringkat` varchar(30) NOT NULL,
  `persatuan_sukan` varchar(80) NOT NULL,
  `dokumen_lampiran` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kegiatan_pengalaman_jurulatih_akk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kegiatan_pengalaman_jurulatih_akk` */

/*Table structure for table `tbl_kelayakan_akademi_akk` */

DROP TABLE IF EXISTS `tbl_kelayakan_akademi_akk`;

CREATE TABLE `tbl_kelayakan_akademi_akk` (
  `kelayakan_akademi_akk_id` int(11) NOT NULL AUTO_INCREMENT,
  `akademi_akk_id` int(11) NOT NULL,
  `nama_peperiksaan` varchar(80) NOT NULL,
  `tahun` year(4) NOT NULL,
  `keputusan` varchar(80) NOT NULL,
  PRIMARY KEY (`kelayakan_akademi_akk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kelayakan_akademi_akk` */

/*Table structure for table `tbl_kelayakan_sukan_spesifik_akk` */

DROP TABLE IF EXISTS `tbl_kelayakan_sukan_spesifik_akk`;

CREATE TABLE `tbl_kelayakan_sukan_spesifik_akk` (
  `kelayakan_sukan_spesifik_akk_id` int(11) NOT NULL AUTO_INCREMENT,
  `akademi_akk_id` int(11) NOT NULL,
  `nama_kursus` varchar(80) NOT NULL,
  `tahap` varchar(30) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `persatuan_sukan` varchar(80) NOT NULL,
  PRIMARY KEY (`kelayakan_sukan_spesifik_akk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kelayakan_sukan_spesifik_akk` */

/*Table structure for table `tbl_kemudah_pakaian_peralatan_tiket` */

DROP TABLE IF EXISTS `tbl_kemudah_pakaian_peralatan_tiket`;

CREATE TABLE `tbl_kemudah_pakaian_peralatan_tiket` (
  `kemudah_pakaian_peralatan_tiket_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `kategori_permohonan` varchar(30) NOT NULL,
  `tarikh_diperlukan_pergi` date NOT NULL,
  `tarikh_dijangka_dipulangkan_balik` date NOT NULL,
  `destinasi_daripada` varchar(90) DEFAULT NULL,
  `destinasi_ke` varchar(90) DEFAULT NULL,
  `ulasan_permohonan` varchar(255) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`kemudah_pakaian_peralatan_tiket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kemudah_pakaian_peralatan_tiket` */

/*Table structure for table `tbl_keputusan_analisi_tubuh_badan` */

DROP TABLE IF EXISTS `tbl_keputusan_analisi_tubuh_badan`;

CREATE TABLE `tbl_keputusan_analisi_tubuh_badan` (
  `keputusan_analisi_tubuh_badan_id` int(11) NOT NULL AUTO_INCREMENT,
  `perkhidmatan_permakanan_id` int(11) NOT NULL,
  `kategori_atlet` varchar(30) DEFAULT NULL,
  `sukan` varchar(80) DEFAULT NULL,
  `acara` varchar(80) DEFAULT NULL,
  `atlet` varchar(80) NOT NULL,
  `fit` varchar(80) NOT NULL,
  `unfit` varchar(80) NOT NULL,
  `refer` varchar(80) NOT NULL,
  PRIMARY KEY (`keputusan_analisi_tubuh_badan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_keputusan_analisi_tubuh_badan` */

/*Table structure for table `tbl_keputusan_ujian_saringan` */

DROP TABLE IF EXISTS `tbl_keputusan_ujian_saringan`;

CREATE TABLE `tbl_keputusan_ujian_saringan` (
  `keputusan_ujian_saringan_id` int(11) NOT NULL AUTO_INCREMENT,
  `ujian_saringan_id` int(11) NOT NULL,
  `jenis_ujian_saringan` varchar(80) NOT NULL,
  `percubaan_1` decimal(10,2) NOT NULL,
  `percubaan_2` decimal(10,2) DEFAULT NULL,
  `terbaik` decimal(10,2) NOT NULL,
  PRIMARY KEY (`keputusan_ujian_saringan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_keputusan_ujian_saringan` */

/*Table structure for table `tbl_kursus` */

DROP TABLE IF EXISTS `tbl_kursus`;

CREATE TABLE `tbl_kursus` (
  `kursus_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kursus` varchar(80) NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `tarikh` date NOT NULL,
  `penganjur` varchar(80) NOT NULL,
  `kod_kursus` varchar(30) NOT NULL,
  `pengkhususan` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`kursus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kursus` */

/*Table structure for table `tbl_kursus_persatuan` */

DROP TABLE IF EXISTS `tbl_kursus_persatuan`;

CREATE TABLE `tbl_kursus_persatuan` (
  `kursus_persatuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kursus` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  `activiti` varchar(80) NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `pegawai_terlibat` varchar(80) NOT NULL,
  PRIMARY KEY (`kursus_persatuan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kursus_persatuan` */

/*Table structure for table `tbl_latihan_dan_program` */

DROP TABLE IF EXISTS `tbl_latihan_dan_program`;

CREATE TABLE `tbl_latihan_dan_program` (
  `latihan_dan_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_kursus` varchar(30) NOT NULL,
  `nama_kursus` varchar(100) NOT NULL,
  `tarikh_kursus` date NOT NULL,
  `lokasi_kursus` varchar(100) NOT NULL,
  `penganjuran_kursus` varchar(255) NOT NULL,
  `bilangan_ahli_yang_menyertai` int(10) NOT NULL,
  PRIMARY KEY (`latihan_dan_program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_latihan_dan_program` */

insert  into `tbl_latihan_dan_program`(`latihan_dan_program_id`,`kategori_kursus`,`nama_kursus`,`tarikh_kursus`,`lokasi_kursus`,`penganjuran_kursus`,`bilangan_ahli_yang_menyertai`) values (1,'Pendidikan','Kempen Komunikasi','2015-07-09','Stadium KL','Komunikasi',10);

/*Table structure for table `tbl_latihan_dan_program_peserta` */

DROP TABLE IF EXISTS `tbl_latihan_dan_program_peserta`;

CREATE TABLE `tbl_latihan_dan_program_peserta` (
  `latihan_dan_program_peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `latihan_dan_program_id` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `nama_badan_sukan` varchar(80) NOT NULL,
  `no_pendaftaran_sukan` varchar(30) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `tempoh_memegang_jawatan` varchar(80) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`latihan_dan_program_peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_latihan_dan_program_peserta` */

/*Table structure for table `tbl_ltbs_ahli_gabungan` */

DROP TABLE IF EXISTS `tbl_ltbs_ahli_gabungan`;

CREATE TABLE `tbl_ltbs_ahli_gabungan` (
  `ahli_gabungan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_badan_sukan` varchar(80) NOT NULL,
  `peringkat_badan_sukan` varchar(30) NOT NULL,
  `alamat_badan_sukan_1` varchar(30) NOT NULL,
  `alamat_badan_sukan_2` varchar(30) DEFAULT NULL,
  `alamat_badan_sukan_3` varchar(30) DEFAULT NULL,
  `alamat_badan_sukan_negeri` varchar(30) NOT NULL,
  `alamat_badan_sukan_bandar` varchar(40) NOT NULL,
  `alamat_badan_sukan_poskod` varbinary(5) NOT NULL,
  `nama_penuh_presiden_badan_sukan` varchar(80) NOT NULL,
  `no_tel_bimbit_presiden_badan_sukan` varchar(14) NOT NULL,
  `emel_presiden_badan_sukan` varchar(100) DEFAULT NULL,
  `nama_penuh_setiausaha_badan_sukan` varchar(80) NOT NULL,
  `no_tel_bimbit_setiausaha_badan_sukan` varchar(14) NOT NULL,
  `emel_setiausaha_badan_sukan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ahli_gabungan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_ahli_gabungan` */

/*Table structure for table `tbl_ltbs_ahli_jawatankuasa_induk_kecil` */

DROP TABLE IF EXISTS `tbl_ltbs_ahli_jawatankuasa_induk_kecil`;

CREATE TABLE `tbl_ltbs_ahli_jawatankuasa_induk_kecil` (
  `ahli_jawatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_jawatankuasa` varchar(30) NOT NULL,
  `nama_jawatankuasa` varchar(80) NOT NULL,
  `jawatan` varchar(50) NOT NULL,
  `nama_penuh` varchar(100) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `bangsa` varchar(25) NOT NULL,
  `umur` int(11) NOT NULL,
  `no_tel` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `nama_majikan` varchar(30) DEFAULT NULL,
  `tarikh_mula_memegang_jawatan` date NOT NULL,
  `pengiktirafan_yang_diterima` varchar(100) DEFAULT NULL,
  `kursus_yang_pernah_diikuti_oleh_pemegang_jawatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ahli_jawatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_ahli_jawatankuasa_induk_kecil` */

/*Table structure for table `tbl_ltbs_ahli_jawatankuasa_kecil` */

DROP TABLE IF EXISTS `tbl_ltbs_ahli_jawatankuasa_kecil`;

CREATE TABLE `tbl_ltbs_ahli_jawatankuasa_kecil` (
  `ahli_jawatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jawatankuasa` varchar(80) NOT NULL,
  `jawatan` varchar(50) NOT NULL,
  `nama_penuh` varchar(100) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `bangsa` varchar(25) NOT NULL,
  `umur` int(11) NOT NULL,
  `no_tel` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `nama_majikan` varchar(30) DEFAULT NULL,
  `tarikh_mula_memegang_jawatan` date NOT NULL,
  `pengiktirafan_yang_diterima` varchar(100) DEFAULT NULL,
  `kursus_yang_pernah_diikuti_oleh_pemegang_jawatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ahli_jawatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_ahli_jawatankuasa_kecil` */

/*Table structure for table `tbl_ltbs_kejohanan_program_aktiviti` */

DROP TABLE IF EXISTS `tbl_ltbs_kejohanan_program_aktiviti`;

CREATE TABLE `tbl_ltbs_kejohanan_program_aktiviti` (
  `kejohanan_program_aktiviti_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kejohanana_program_aktiviti_yang_disertai` varchar(80) NOT NULL,
  `tarikh_kejohanan_program_aktiviti_yang_disertai` date NOT NULL,
  `lokasi_tempat_kejohanan_program_aktiviti_yang_disertai` varchar(90) NOT NULL,
  `bilangan_peserta_yang_menyertai` int(11) NOT NULL,
  `kos_kejohanan_program_aktiviti_yang_disertai` decimal(10,2) NOT NULL,
  PRIMARY KEY (`kejohanan_program_aktiviti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_kejohanan_program_aktiviti` */

/*Table structure for table `tbl_ltbs_minit_mesyuarat_agm` */

DROP TABLE IF EXISTS `tbl_ltbs_minit_mesyuarat_agm`;

CREATE TABLE `tbl_ltbs_minit_mesyuarat_agm` (
  `mesyuarat_agm_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh` date NOT NULL,
  `masa` time NOT NULL,
  `tempat` varchar(30) NOT NULL,
  `jumlah_ahli_yang_hadir` int(11) NOT NULL,
  `jumlah_ahli_yang_layak_mengundi` int(11) NOT NULL,
  `agenda_mesyuarat` varchar(255) NOT NULL,
  `keputusan_mesyuarat` varchar(255) NOT NULL,
  PRIMARY KEY (`mesyuarat_agm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_minit_mesyuarat_agm` */

/*Table structure for table `tbl_ltbs_minit_mesyuarat_jawatankuasa` */

DROP TABLE IF EXISTS `tbl_ltbs_minit_mesyuarat_jawatankuasa`;

CREATE TABLE `tbl_ltbs_minit_mesyuarat_jawatankuasa` (
  `mesyuarat_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh` datetime NOT NULL,
  `masa` time NOT NULL,
  `tempat` varchar(30) NOT NULL,
  `mengikut_perlembagaan` varchar(255) DEFAULT NULL,
  `korum_mesyuarat_jumlah_ahli_yang_hadir` int(11) NOT NULL,
  `jumlah_ahli_yang_hadir` int(11) NOT NULL,
  `agenda_mesyuarat` varchar(255) DEFAULT NULL,
  `keputusan_mesyuarat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mesyuarat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_minit_mesyuarat_jawatankuasa` */

insert  into `tbl_ltbs_minit_mesyuarat_jawatankuasa`(`mesyuarat_id`,`tarikh`,`masa`,`tempat`,`mengikut_perlembagaan`,`korum_mesyuarat_jumlah_ahli_yang_hadir`,`jumlah_ahli_yang_hadir`,`agenda_mesyuarat`,`keputusan_mesyuarat`) values (1,'2015-10-08 15:30:00','00:00:00','Manara KBS','Korum Mesyuarat Mengikut Perlembagaan 1',13,5,'- Agenda Mesyuarat 1','- Keputusan Mesyuarat A'),(3,'2015-07-15 06:30:00','00:00:00','Bukit Jalil Stadium AB','Korum Mesyuarat Mengikut Perlembagaan 15',5,15,'Agenda Mesyuarat Test','Keputusan Mesyuarat Test'),(4,'2015-09-17 01:00:00','00:00:00','Bukit Jalil Stadium ABC','Korum Mesyuarat Mengikut Perlembagaan 2019',13,21,'Agenda Mesyuarat','Keputusan Mesyuarat Test'),(5,'2015-10-01 08:00:00','00:00:00','Bukit Jalil Stadium','Korum Mesyuarat Mengikut Perlembagaan 2020',10,35,'Agenda Mesyuarat 1\r\nAgenda Mesyuarat 6','Keputusan Mesyuarat 1\r\nKeputusan Mesyuarat 2');

/*Table structure for table `tbl_ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik` */

DROP TABLE IF EXISTS `tbl_ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik`;

CREATE TABLE `tbl_ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik` (
  `dokumen_muat_naik_id` int(11) NOT NULL AUTO_INCREMENT,
  `mesyuarat_id` int(11) NOT NULL,
  `nama_dokumen` varchar(80) NOT NULL,
  `muat_naik` varchar(100) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dokumen_muat_naik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik` */

insert  into `tbl_ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik`(`dokumen_muat_naik_id`,`mesyuarat_id`,`nama_dokumen`,`muat_naik`,`session_id`) values (1,0,'Dokument Meeting 1','',NULL),(2,0,'Dokument Meeting 2','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/2.xlsx',NULL),(3,0,'Dokument Meeting 2015','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/3.xlsx',NULL),(4,0,'Dokument Meeting 4','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/4.xlsx',NULL),(5,0,'Dokument Meeting 7','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/5.jpg',NULL),(6,0,'Test 1','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/6.jpg',NULL),(7,4,'Dokument Meeting 2016','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/7.jpg',''),(8,4,'Dokument Meeting 2017','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/8.jpg',''),(9,4,'Dokument Meeting 1','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/9.ctg',NULL),(10,4,'Dokument Meeting 3','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/10.jpg',NULL),(11,5,'Dokument Meeting 2016','uploads/ltbs_mesyuarat/muat_naik_jawatankuasa/11.exe','');

/*Table structure for table `tbl_ltbs_notis_agm` */

DROP TABLE IF EXISTS `tbl_ltbs_notis_agm`;

CREATE TABLE `tbl_ltbs_notis_agm` (
  `tbl_ltbs_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mesyuarat_agong` varchar(80) NOT NULL,
  `tahun` year(4) NOT NULL,
  `notis_agm` varchar(100) NOT NULL,
  PRIMARY KEY (`tbl_ltbs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_notis_agm` */

insert  into `tbl_ltbs_notis_agm`(`tbl_ltbs_id`,`nama_mesyuarat_agong`,`tahun`,`notis_agm`) values (4,'Nama Mesyuarat Agong Tahun',2015,'uploads/ltbs_mesyuarat/notis_agm/4.zip'),(5,'Nama Mesyuarat Agong Tahun',2015,'uploads/ltbs_mesyuarat/notis_agm/5.exe'),(6,'Nama Mesyuarat Agong Tahun',2015,''),(7,'Nama Mesyuarat Agong Tahun',2018,'uploads/ltbs_mesyuarat/notis_agm/7.png'),(8,'Nama Mesyuarat Agong Tahun',2015,'');

/*Table structure for table `tbl_ltbs_penyata_kewangan` */

DROP TABLE IF EXISTS `tbl_ltbs_penyata_kewangan`;

CREATE TABLE `tbl_ltbs_penyata_kewangan` (
  `penyata_kewangan_id` int(11) NOT NULL AUTO_INCREMENT,
  `penyata_penerimaan_dan_pembayaran` varchar(100) NOT NULL,
  `penyata_pendapatan_dan_perbelanjaan` varchar(100) NOT NULL,
  `kunci_kira_kira` varchar(100) NOT NULL,
  PRIMARY KEY (`penyata_kewangan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_penyata_kewangan` */

/*Table structure for table `tbl_ltbs_senarai_nama_hadir_agm` */

DROP TABLE IF EXISTS `tbl_ltbs_senarai_nama_hadir_agm`;

CREATE TABLE `tbl_ltbs_senarai_nama_hadir_agm` (
  `senarai_nama_hadir_id` int(11) NOT NULL AUTO_INCREMENT,
  `mesyuarat_agm_id` int(11) NOT NULL,
  `nama_penuh` varchar(100) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `jawatan` varchar(50) DEFAULT NULL,
  `kategori_keahlian` varchar(30) NOT NULL,
  `kehadiran` tinyint(1) NOT NULL,
  PRIMARY KEY (`senarai_nama_hadir_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_senarai_nama_hadir_agm` */

/*Table structure for table `tbl_ltbs_senarai_nama_hadir_jawatankuasa` */

DROP TABLE IF EXISTS `tbl_ltbs_senarai_nama_hadir_jawatankuasa`;

CREATE TABLE `tbl_ltbs_senarai_nama_hadir_jawatankuasa` (
  `senarai_nama_hadi_id` int(11) NOT NULL AUTO_INCREMENT,
  `mesyuarat_id` int(11) NOT NULL,
  `nama_penuh` varchar(100) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `jantina` varchar(1) DEFAULT NULL,
  `jawatan` varchar(80) NOT NULL,
  `kategori_keahlian` varchar(30) DEFAULT NULL,
  `kehadiran` tinyint(1) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`senarai_nama_hadi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_senarai_nama_hadir_jawatankuasa` */

insert  into `tbl_ltbs_senarai_nama_hadir_jawatankuasa`(`senarai_nama_hadi_id`,`mesyuarat_id`,`nama_penuh`,`no_kad_pengenalan`,`jantina`,`jawatan`,`kategori_keahlian`,`kehadiran`,`session_id`) values (3,5,'Jim Han Ken','880301084554',NULL,'Juru',NULL,0,NULL);

/*Table structure for table `tbl_ltbs_sumber_kewangan` */

DROP TABLE IF EXISTS `tbl_ltbs_sumber_kewangan`;

CREATE TABLE `tbl_ltbs_sumber_kewangan` (
  `sumber_kewangan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(30) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sumber_kewangan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ltbs_sumber_kewangan` */

/*Table structure for table `tbl_maklumat_kongres_di_luar_negara` */

DROP TABLE IF EXISTS `tbl_maklumat_kongres_di_luar_negara`;

CREATE TABLE `tbl_maklumat_kongres_di_luar_negara` (
  `maklumat_kongres_di_luar_negara_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id` int(11) NOT NULL,
  `tajuk` varchar(80) NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `masa` datetime NOT NULL,
  `tarikh_penerbangan` datetime NOT NULL,
  `tiket_penerbangan` varchar(50) NOT NULL,
  `jumlah_penerbangan` decimal(10,2) NOT NULL,
  `lain_lain` decimal(10,2) DEFAULT NULL,
  `jumlah_kos_lain_lain` decimal(10,2) DEFAULT NULL,
  `nama_pegawai_terlibat` varchar(80) NOT NULL,
  PRIMARY KEY (`maklumat_kongres_di_luar_negara_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_maklumat_kongres_di_luar_negara` */

/*Table structure for table `tbl_mesyuarat` */

DROP TABLE IF EXISTS `tbl_mesyuarat`;

CREATE TABLE `tbl_mesyuarat` (
  `mesyuarat_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mesyuarat` varchar(80) NOT NULL,
  `agenda` varchar(255) NOT NULL,
  `bil_mesyuarat` varchar(20) NOT NULL,
  `tarikh` datetime NOT NULL,
  `masa` time NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `pengurusi` varchar(255) DEFAULT NULL,
  `pencatat_minit` varchar(255) DEFAULT NULL,
  `perkara_perkara_dan_tindakan` varchar(255) DEFAULT NULL,
  `mesyuarat_tamat` varchar(100) DEFAULT NULL,
  `mesyuarat_seterusnya` varchar(100) DEFAULT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  `disedia_oleh` varchar(100) NOT NULL,
  `disemak_oleh` varchar(100) NOT NULL,
  PRIMARY KEY (`mesyuarat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_mesyuarat` */

insert  into `tbl_mesyuarat`(`mesyuarat_id`,`nama_mesyuarat`,`agenda`,`bil_mesyuarat`,`tarikh`,`masa`,`tempat`,`pengurusi`,`pencatat_minit`,`perkara_perkara_dan_tindakan`,`mesyuarat_tamat`,`mesyuarat_seterusnya`,`muat_naik`,`disedia_oleh`,`disemak_oleh`) values (1,'Mesyuarat International','International Sport','BILMES001','2015-05-19 14:30:00','12:00:00','Bukit Jalil Stadium','Pengurusi','','','','','uploads/mesyuarat/1.php','Ken ','Mohd Adli'),(2,'Mesyuarat Tinggi KBS','KBS Event Festival','BILMES02','2015-09-01 11:00:00','00:00:00','Manara KBS',NULL,'- Catat Minit 1\r\n- Catat Minit 2','- Perkara 1\r\n- Perkara 2','Tamat','Seterus',NULL,'Mohd Kahlib','Mohd Ahli'),(3,'Mesyuarat Pegawai Menteri','Status Project','BILMES03','2015-08-21 09:30:00','00:00:00','Bukit Jalil MSN',NULL,'- Minit 1\r\n- Minit 2','- Perkara1\r\n- Perkara2\r\n- Perkara3','N/A','N/A','uploads/mesyuarat/3.php','Mohd Syarif B Khlid','Dato Sarifa '),(4,'Mesyuarat Pegawai Pengawai MSN','MSN Project Progress','BILMES04','2015-05-20 10:30:00','00:00:00','Bukit Jalil MSN',NULL,'Minit 1,\r\nMinit 2','Perkara 1,\r\nPerkara 2','N/A','Seterusnya',NULL,'Kamen','Mohd Adli'),(5,'Mesyuarat CCBS','International Talk','BILMES06','2015-06-10 10:30:00','00:00:00','Manara KBS',NULL,'Pencatat Minit A','Perkara Perkara Dan Tindakan A','Tiada','Seterus','uploads/mesyuarat/5.jpg','Mohd Aman','James Loong'),(6,'Mesyuarat ALL','World Sport International Meeting','BILMES09','2015-04-29 06:30:00','00:00:00','Putrajaya',NULL,'Pencatat Minit','Tindakan 1','Tamat','Seterus','uploads/mesyuarat/6.txt','Kamal','Ahmad');

/*Table structure for table `tbl_mesyuarat_senarai_nama_hadir` */

DROP TABLE IF EXISTS `tbl_mesyuarat_senarai_nama_hadir`;

CREATE TABLE `tbl_mesyuarat_senarai_nama_hadir` (
  `senarai_nama_hadir_id` int(11) NOT NULL AUTO_INCREMENT,
  `mesyuarat_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `organisasi` varchar(80) NOT NULL,
  `no_tel` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `kehadiran` varchar(20) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`senarai_nama_hadir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_mesyuarat_senarai_nama_hadir` */

insert  into `tbl_mesyuarat_senarai_nama_hadir`(`senarai_nama_hadir_id`,`mesyuarat_id`,`nama`,`status`,`jawatan`,`organisasi`,`no_tel`,`emel`,`kehadiran`,`session_id`) values (1,1,'Mohd Ali Husim','2','2','Organisasi Test','01339994545','mali@test.com','0',NULL),(4,5,'Kenneth','2','2','Organisasi 1','01339994545','ken@test.com','1',''),(5,5,'Wan','3','1','Organisasi BBC','0399477754','wan@test.com','1',''),(6,6,'Any','2','2','Organisasi Jaya','039999999','99@hotmail.com','0','');

/*Table structure for table `tbl_mesyuarat_senarai_tugas` */

DROP TABLE IF EXISTS `tbl_mesyuarat_senarai_tugas`;

CREATE TABLE `tbl_mesyuarat_senarai_tugas` (
  `senarai_tugas_id` int(11) NOT NULL AUTO_INCREMENT,
  `mesyuarat_id` int(11) NOT NULL,
  `name_tugas` varchar(100) NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `pegawai` varchar(20) NOT NULL,
  `atlet_id` int(11) NOT NULL,
  `persatuan` varchar(100) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`senarai_tugas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_mesyuarat_senarai_tugas` */

insert  into `tbl_mesyuarat_senarai_tugas`(`senarai_tugas_id`,`mesyuarat_id`,`name_tugas`,`tarikh_tamat`,`pegawai`,`atlet_id`,`persatuan`,`status`,`session_id`) values (1,5,'Kemas Dokumen','2015-09-09','3',3,'Agensi A','2',''),(2,5,'Atlet Status Update','2015-07-23','2',2,'Agensi C','2',''),(3,5,'Kemas Dokumen','2015-10-15','3',1,'Agensi BBS','2',''),(4,6,'Kemas Dokumen','2015-10-28','2',3,'Agensi BBS','2','');

/*Table structure for table `tbl_muat_naik_dokumen` */

DROP TABLE IF EXISTS `tbl_muat_naik_dokumen`;

CREATE TABLE `tbl_muat_naik_dokumen` (
  `muat_naik_dokumen_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_muat_naik` varchar(80) NOT NULL,
  `muat_naik_dokumen` varchar(100) NOT NULL,
  `tarikh_muat_naik` date DEFAULT NULL,
  PRIMARY KEY (`muat_naik_dokumen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_muat_naik_dokumen` */

/*Table structure for table `tbl_paobs_penganjur` */

DROP TABLE IF EXISTS `tbl_paobs_penganjur`;

CREATE TABLE `tbl_paobs_penganjur` (
  `penganjur_id` int(11) NOT NULL AUTO_INCREMENT,
  `penganjuran_id` int(11) NOT NULL,
  `profil_syarikat` varchar(255) DEFAULT NULL,
  `nama_penganjur` varchar(80) NOT NULL,
  `no_pendaftaran_syarikat` varchar(30) NOT NULL,
  `tarikh_penubuhan_syarikat` date NOT NULL,
  `sijil_pendaftaran` varchar(100) NOT NULL,
  `alamat_penganjur_1` varchar(30) NOT NULL,
  `alamat_penganjur_2` varchar(30) DEFAULT NULL,
  `alamat_penganjur_3` varchar(30) DEFAULT NULL,
  `alamat_penganjur_negeri` varchar(20) NOT NULL,
  `alamat_penganjur_bandar` varchar(30) NOT NULL,
  `alamat_penganjur_poskod` varchar(5) NOT NULL,
  `no_telefon_penganjur` int(14) NOT NULL,
  `no_faks_penganjur` int(14) DEFAULT NULL,
  `emel_penganjur` varchar(100) DEFAULT NULL,
  `kertas_cadangan_pelaksanaan` varchar(100) DEFAULT NULL,
  `nama_aktiviti` varchar(80) NOT NULL,
  `jenis_sukan` varchar(30) NOT NULL,
  `tarikh_aktiviti` date NOT NULL,
  `alamat_lokasi` varchar(90) NOT NULL,
  `pemilik_lokasi` varchar(90) DEFAULT NULL,
  `bilangan_peserta` int(11) NOT NULL,
  `negara_peserta` int(11) DEFAULT NULL,
  `kos_aktiviti` decimal(10,2) NOT NULL,
  `sumber_kewangan` decimal(10,2) DEFAULT NULL,
  `surat_sokongan` varchar(255) DEFAULT NULL,
  `laporan_penganjuran` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`penganjur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_paobs_penganjur` */

/*Table structure for table `tbl_paobs_penganjuran` */

DROP TABLE IF EXISTS `tbl_paobs_penganjuran`;

CREATE TABLE `tbl_paobs_penganjuran` (
  `penganjuran_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aktiviti` varchar(80) NOT NULL,
  `jenis_sukan` varchar(30) NOT NULL,
  `tarikh_aktiviti` date NOT NULL,
  `alamat_lokasi_1` varchar(30) NOT NULL,
  `alamat_lokasi_2` varchar(30) DEFAULT NULL,
  `alamat_lokasi_3` varchar(30) DEFAULT NULL,
  `alamat_lokasi_negeri` varchar(30) NOT NULL,
  `alamat_lokasi_bandar` varchar(40) NOT NULL,
  `alamat_lokasi_poskod` varchar(5) NOT NULL,
  `pemilik_lokasi` varchar(90) NOT NULL,
  `bilangan_peserta` int(11) NOT NULL,
  `negara_peserta` int(11) DEFAULT NULL,
  `kos_aktiviti` decimal(10,2) NOT NULL,
  `sumber_kewangan` varchar(100) DEFAULT NULL,
  `surat_sokongan` varchar(255) DEFAULT NULL,
  `laporan_penganjuran` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`penganjuran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_paobs_penganjuran` */

/*Table structure for table `tbl_pembayaran_elaun` */

DROP TABLE IF EXISTS `tbl_pembayaran_elaun`;

CREATE TABLE `tbl_pembayaran_elaun` (
  `pembayaran_elaun_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_atlet` varchar(30) NOT NULL,
  `atlet_id` int(11) NOT NULL,
  `kategori_elaun` varchar(30) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `tempoh_elaun` varchar(20) NOT NULL,
  `sebab_elaun` varchar(100) DEFAULT NULL,
  `jumlah_elaun` decimal(10,2) NOT NULL,
  `status_elaun` varchar(30) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`pembayaran_elaun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pembayaran_elaun` */

insert  into `tbl_pembayaran_elaun`(`pembayaran_elaun_id`,`jenis_atlet`,`atlet_id`,`kategori_elaun`,`tarikh_mula`,`tarikh_tamat`,`tempoh_elaun`,`sebab_elaun`,`jumlah_elaun`,`status_elaun`,`kelulusan`) values (1,'',2,'1','2015-09-16','2015-09-24','10','','30000.00','2',1),(4,'',3,'1','2015-09-01','2015-09-25','3','','30000.00','2',0);

/*Table structure for table `tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan` */

DROP TABLE IF EXISTS `tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan`;

CREATE TABLE `tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan` (
  `pemberian_suplemen_makanan_jus_rundingan_pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `perkhidmatan_permakanan_id` int(11) NOT NULL,
  `kategori_atlet` varchar(30) DEFAULT NULL,
  `sukan` varchar(80) DEFAULT NULL,
  `acara` varchar(80) DEFAULT NULL,
  `atlet` varchar(80) NOT NULL,
  `nama_suplemen_makanan_jus_rundingan_pendidikan` date NOT NULL,
  `kuantiti_ml_g` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pemberian_suplemen_makanan_jus_rundingan_pendidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan` */

/*Table structure for table `tbl_pemohon_kursus_tahap_akk` */

DROP TABLE IF EXISTS `tbl_pemohon_kursus_tahap_akk`;

CREATE TABLE `tbl_pemohon_kursus_tahap_akk` (
  `pemohon_kursus_tahap_akk_id` int(11) NOT NULL AUTO_INCREMENT,
  `akademi_akk_id` int(11) NOT NULL,
  `tahap` varchar(30) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `no_sijil` varchar(30) NOT NULL,
  `kod_kursus` varchar(30) NOT NULL,
  `tempat` varchar(80) NOT NULL,
  `muatnaik_sijil` varchar(100) NOT NULL,
  PRIMARY KEY (`pemohon_kursus_tahap_akk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pemohon_kursus_tahap_akk` */

/*Table structure for table `tbl_pendaftaran_gym` */

DROP TABLE IF EXISTS `tbl_pendaftaran_gym`;

CREATE TABLE `tbl_pendaftaran_gym` (
  `pendaftaran_gym_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `sukan` varchar(30) NOT NULL,
  PRIMARY KEY (`pendaftaran_gym_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pendaftaran_gym` */

/*Table structure for table `tbl_penganjuran_kursus` */

DROP TABLE IF EXISTS `tbl_penganjuran_kursus`;

CREATE TABLE `tbl_penganjuran_kursus` (
  `penganjuran_kursus_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kursus` varchar(30) NOT NULL,
  `tarikh_kursus` date NOT NULL,
  `tempat_kursus` varchar(90) NOT NULL,
  `negeri` varchar(30) NOT NULL,
  `nama_penyelaras` varchar(80) NOT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `kuota_kursus` int(11) NOT NULL,
  PRIMARY KEY (`penganjuran_kursus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penganjuran_kursus` */

/*Table structure for table `tbl_penganjuran_kursus_penganjur` */

DROP TABLE IF EXISTS `tbl_penganjuran_kursus_penganjur`;

CREATE TABLE `tbl_penganjuran_kursus_penganjur` (
  `penganjuran_kursus_penganjur_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_kursus` varchar(80) NOT NULL,
  `nama_kursus` varchar(80) NOT NULL,
  `kod_kursus` varchar(30) NOT NULL,
  `tarikh` date NOT NULL,
  `tempat` varchar(90) NOT NULL,
  PRIMARY KEY (`penganjuran_kursus_penganjur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penganjuran_kursus_penganjur` */

/*Table structure for table `tbl_penganjuran_kursus_peserta` */

DROP TABLE IF EXISTS `tbl_penganjuran_kursus_peserta`;

CREATE TABLE `tbl_penganjuran_kursus_peserta` (
  `penganjuran_kursus_peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_kursus` varchar(80) NOT NULL,
  `nama_kursus` varchar(80) NOT NULL,
  `kod_kursus` varchar(30) NOT NULL,
  `tarikh` date NOT NULL,
  `tempat` varchar(80) NOT NULL,
  `yuran` decimal(10,2) NOT NULL,
  `nama_penuh` varchar(80) NOT NULL,
  `muatnaik_gambar` varchar(100) DEFAULT NULL,
  `jantina` varchar(1) NOT NULL,
  `taraf_perkahwinan` varchar(25) NOT NULL,
  `no_passport` varchar(15) DEFAULT NULL,
  `no_kad_pengenalan` varchar(12) DEFAULT NULL,
  `no_kp_polis_tentera` varchar(12) DEFAULT NULL,
  `kaum` varchar(25) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `no_tel_rumah` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(80) NOT NULL,
  `nama_majikan` varchar(80) NOT NULL,
  `alamat_majikan_1` varchar(90) NOT NULL,
  `alamat_majikan_2` varchar(90) DEFAULT NULL,
  `alamat_majikan_3` varchar(90) DEFAULT NULL,
  `alamat_majikan_negeri` varchar(30) NOT NULL,
  `alamat_majikan_bandar` varchar(40) NOT NULL,
  `alamat_majikan_poskod` varchar(5) NOT NULL,
  `no_tel_majikan` varchar(14) NOT NULL,
  `no_faks_majikan` varchar(14) DEFAULT NULL,
  `kelulusan_akademi` varchar(80) DEFAULT NULL,
  `nama_kelulusan` varchar(80) DEFAULT NULL,
  `kelulusan_sukan_spesifik` varchar(80) DEFAULT NULL,
  `nama_sukan_akademi` varchar(80) DEFAULT NULL,
  `kelulusan_sains_sukan` varchar(80) DEFAULT NULL,
  `sijil_spkk_msn` varchar(80) DEFAULT NULL,
  `lesen_kejurulatihan_msn` varchar(80) DEFAULT NULL,
  `status_jurulatih` varchar(30) DEFAULT NULL,
  `lantikan` varchar(80) DEFAULT NULL,
  `nama_sukan_jurulatih` varchar(80) DEFAULT NULL,
  `tahun_berkhidmat_mula` year(4) DEFAULT NULL,
  `tahun_berkhidmat_tamat` year(4) DEFAULT NULL,
  `pencapaian` varchar(255) DEFAULT NULL,
  `dokumen_lampiran` varchar(100) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`penganjuran_kursus_peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penganjuran_kursus_peserta` */

/*Table structure for table `tbl_penganjuran_pemantuan` */

DROP TABLE IF EXISTS `tbl_penganjuran_pemantuan`;

CREATE TABLE `tbl_penganjuran_pemantuan` (
  `penganjuran_pemantuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_pendahuluan_pelagai` tinyint(1) NOT NULL,
  `menghantar_surat_cuti_tanpa` tinyint(1) NOT NULL,
  `keperluan_bengkel_telah` tinyint(1) NOT NULL,
  `membuat_tempahan_penginapan` tinyint(1) NOT NULL,
  `membuat_tempahan_tempat_untuk` tinyint(1) NOT NULL,
  `mengesahan_kehadiran_panel` tinyint(1) NOT NULL,
  `mengesahan_pendaftaran_panel` tinyint(1) NOT NULL,
  `memberi_taklimat` tinyint(1) NOT NULL,
  `mengumpul_dan_membukukan` tinyint(1) NOT NULL,
  `membuat_pelarasan_kewangan` tinyint(1) NOT NULL,
  PRIMARY KEY (`penganjuran_pemantuan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penganjuran_pemantuan` */

/*Table structure for table `tbl_pengurusan_anjuran` */

DROP TABLE IF EXISTS `tbl_pengurusan_anjuran`;

CREATE TABLE `tbl_pengurusan_anjuran` (
  `pengurusan_anjuran_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program_anjuran` varchar(80) NOT NULL,
  `tarikh_program_anjuran` date NOT NULL,
  `nama_badan_sukan_antarabangsa` varchar(80) NOT NULL,
  `nama_delegasi` varchar(80) NOT NULL,
  `negara` varchar(30) NOT NULL,
  PRIMARY KEY (`pengurusan_anjuran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_anjuran` */

/*Table structure for table `tbl_pengurusan_berita_antarabangsa` */

DROP TABLE IF EXISTS `tbl_pengurusan_berita_antarabangsa`;

CREATE TABLE `tbl_pengurusan_berita_antarabangsa` (
  `pengurusan_berita_antarabangsa_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_berita` varchar(80) NOT NULL,
  `nama_berita` varchar(80) NOT NULL,
  `tarikh_berita` date NOT NULL,
  `muatnaik` varchar(100) NOT NULL,
  PRIMARY KEY (`pengurusan_berita_antarabangsa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_berita_antarabangsa` */

/*Table structure for table `tbl_pengurusan_biasiswa_atlet` */

DROP TABLE IF EXISTS `tbl_pengurusan_biasiswa_atlet`;

CREATE TABLE `tbl_pengurusan_biasiswa_atlet` (
  `pengurusan_biasiswa_atlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_akhir` date NOT NULL,
  `nama_biasiswa_sponsor` varchar(80) NOT NULL,
  `jumlah_penajaan` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pengurusan_biasiswa_atlet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_biasiswa_atlet` */

/*Table structure for table `tbl_pengurusan_dan_pemantauan` */

DROP TABLE IF EXISTS `tbl_pengurusan_dan_pemantauan`;

CREATE TABLE `tbl_pengurusan_dan_pemantauan` (
  `pengurusan_dan_pemantauan_id` int(11) NOT NULL AUTO_INCREMENT,
  `sukan` varchar(30) NOT NULL,
  `tarikh` date NOT NULL,
  `tempoh_laporan` varchar(30) NOT NULL,
  `disediakan_oleh` varchar(80) NOT NULL,
  `permerhatian_tindakan` varchar(255) DEFAULT NULL,
  `dapatan_dan_kesimpulan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_dan_pemantauan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_dan_pemantauan` */

/*Table structure for table `tbl_pengurusan_dokumen_media_program` */

DROP TABLE IF EXISTS `tbl_pengurusan_dokumen_media_program`;

CREATE TABLE `tbl_pengurusan_dokumen_media_program` (
  `pengurusan_dokumen_media_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_media_program_id` int(11) NOT NULL,
  `kategori_dokumen` varchar(80) NOT NULL,
  `nama_dokumen` varchar(80) NOT NULL,
  `muatnaik` varchar(100) NOT NULL,
  PRIMARY KEY (`pengurusan_dokumen_media_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_dokumen_media_program` */

/*Table structure for table `tbl_pengurusan_insentif` */

DROP TABLE IF EXISTS `tbl_pengurusan_insentif`;

CREATE TABLE `tbl_pengurusan_insentif` (
  `pengurusan_insentif_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_insentif` varchar(80) NOT NULL,
  `kumpulan` varchar(30) NOT NULL,
  `rekod_baru` varchar(30) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `kelayakan_pingat` varchar(30) NOT NULL,
  `jumlah_insentif` decimal(10,2) NOT NULL,
  `sgar_nama_jurulatih` varchar(80) NOT NULL,
  `jumlah_sgar` decimal(10,2) DEFAULT NULL,
  `sikap_nama_persatuan` varchar(80) DEFAULT NULL,
  `jumlah_sikap` decimal(10,2) DEFAULT NULL,
  `siso_tarikh_kelayakan` date DEFAULT NULL,
  `sisi_tarikh_olimpik` date DEFAULT NULL,
  `jumlah_siso` decimal(10,2) DEFAULT NULL,
  `sito_nama_acara_di_olimpik` varchar(80) DEFAULT NULL,
  `sito_pingat` varchar(30) DEFAULT NULL,
  `jumlah_sito` decimal(10,2) DEFAULT NULL,
  `category_insentif` varchar(30) NOT NULL,
  `muat_naik_dokumen` varchar(100) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`pengurusan_insentif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_insentif` */

insert  into `tbl_pengurusan_insentif`(`pengurusan_insentif_id`,`atlet_id`,`nama_insentif`,`kumpulan`,`rekod_baru`,`nama_sukan`,`kelayakan_pingat`,`jumlah_insentif`,`sgar_nama_jurulatih`,`jumlah_sgar`,`sikap_nama_persatuan`,`jumlah_sikap`,`siso_tarikh_kelayakan`,`sisi_tarikh_olimpik`,`jumlah_siso`,`sito_nama_acara_di_olimpik`,`sito_pingat`,`jumlah_sito`,`category_insentif`,`muat_naik_dokumen`,`kelulusan`) values (1,1,'2','3','2','3','2','5000.00','1','1000.00','3','300.00','2015-06-17','2015-08-13','250.00','2','2','600.00','2','uploads/pengurusan_insentif/1.sh',0),(2,2,'2','3','2','3','3','500.00','2','200.00','2','3000.00','2015-04-28','2015-07-08','250.00','3','2','3000.00','2','uploads/pengurusan_insentif/2.sample',0);

/*Table structure for table `tbl_pengurusan_insuran` */

DROP TABLE IF EXISTS `tbl_pengurusan_insuran`;

CREATE TABLE `tbl_pengurusan_insuran` (
  `pengurusan_insuran_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_insuran` varchar(80) NOT NULL,
  `jumlah_tuntutan` decimal(10,2) NOT NULL,
  `tarikh_tuntutan` date NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_insuran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_insuran` */

insert  into `tbl_pengurusan_insuran`(`pengurusan_insuran_id`,`atlet_id`,`nama_insuran`,`jumlah_tuntutan`,`tarikh_tuntutan`,`pegawai_yang_bertanggungjawab`,`catatan`) values (1,3,'AIA','8450.00','2015-10-01','Kenne','Test Catta'),(2,2,'Zurich','500.00','2015-07-07','Wantennen','Masuk Wad'),(3,4,'Prudential','988.00','2015-06-29','Mohd Camel','Sakit Tangan Operation');

/*Table structure for table `tbl_pengurusan_jaringan_antarabangsa` */

DROP TABLE IF EXISTS `tbl_pengurusan_jaringan_antarabangsa`;

CREATE TABLE `tbl_pengurusan_jaringan_antarabangsa` (
  `pengurusan_jaringan_antarabangsa_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_badan_sukan` varchar(80) NOT NULL,
  `negara` varchar(80) NOT NULL,
  `nama_pemohon` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `alamat_surat_menyurat_1` varchar(90) NOT NULL,
  `alamat_surat_menyurat_2` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_3` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_negeri` varchar(30) NOT NULL,
  `alamat_surat_menyurat_bandar` varchar(40) NOT NULL,
  `alamat_surat_menyurat_poskod` varchar(5) NOT NULL,
  `pegawai_teknikal` varchar(80) NOT NULL,
  `permohonan` varchar(80) NOT NULL,
  `jenis_program` varchar(30) NOT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `no_faks` varchar(14) DEFAULT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `nama_majikan` varchar(80) NOT NULL,
  `alamat_majikan_1` varchar(90) NOT NULL,
  `alamat_majikan_2` varchar(90) DEFAULT NULL,
  `alamat_majikan_3` varchar(90) DEFAULT NULL,
  `alamat_majikan_negeri` varchar(30) NOT NULL,
  `alamat_majikan_bandar` varchar(40) NOT NULL,
  `alamat_majikan_poskod` varchar(5) NOT NULL,
  `jawatan_di_persatuan` varchar(80) NOT NULL,
  `tahap_kelayakan_sekarang` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_jaringan_antarabangsa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_jaringan_antarabangsa` */

/*Table structure for table `tbl_pengurusan_jkk_jkp` */

DROP TABLE IF EXISTS `tbl_pengurusan_jkk_jkp`;

CREATE TABLE `tbl_pengurusan_jkk_jkp` (
  `pengurusan_jkk_jkp_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_setiausaha_jkk_jkp` varchar(80) NOT NULL,
  `jenis_cawangan_kuasa` varchar(30) NOT NULL,
  `tarikh_pelantikan_jkk_jkp` date NOT NULL,
  `tempoh_hak_jkk_jkp` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `nama_pegawai_coach` varchar(80) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `tarikh_pelantikan` date NOT NULL,
  `peranan` varchar(30) DEFAULT NULL,
  `agensi` varchar(80) DEFAULT NULL,
  `jawatan_agensi` varchar(80) DEFAULT NULL,
  `tempoh_hak` int(11) NOT NULL,
  `sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `nama_atlet` varchar(80) NOT NULL,
  `status_pilihan` tinyint(1) NOT NULL,
  `nama_jurulatih` varchar(80) NOT NULL,
  PRIMARY KEY (`pengurusan_jkk_jkp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_jkk_jkp` */

/*Table structure for table `tbl_pengurusan_jkk_jkp_bajet` */

DROP TABLE IF EXISTS `tbl_pengurusan_jkk_jkp_bajet`;

CREATE TABLE `tbl_pengurusan_jkk_jkp_bajet` (
  `pengurusan_jkk_jkp_bajet_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_jkk_jkp_id` int(11) NOT NULL,
  `kategori_bajet` varchar(80) NOT NULL,
  `jumlah_bajet` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pengurusan_jkk_jkp_bajet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_jkk_jkp_bajet` */

/*Table structure for table `tbl_pengurusan_jkk_jkp_program` */

DROP TABLE IF EXISTS `tbl_pengurusan_jkk_jkp_program`;

CREATE TABLE `tbl_pengurusan_jkk_jkp_program` (
  `pengurusan_jkk_jkp_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_jkk_jkp_id` int(11) NOT NULL,
  `tarikh_mula_program` date NOT NULL,
  `tarikh_tamat_program` date NOT NULL,
  `lokasi_program` varchar(90) NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `nama_pesserta` varchar(80) NOT NULL,
  PRIMARY KEY (`pengurusan_jkk_jkp_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_jkk_jkp_program` */

/*Table structure for table `tbl_pengurusan_kehadiran_media_program` */

DROP TABLE IF EXISTS `tbl_pengurusan_kehadiran_media_program`;

CREATE TABLE `tbl_pengurusan_kehadiran_media_program` (
  `pengurusan_kehadiran_media_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_media_program_id` int(11) NOT NULL,
  `program` varchar(80) NOT NULL,
  `nama_wartawan` varchar(80) NOT NULL,
  `emel` varchar(100) NOT NULL,
  `agensi` varchar(80) DEFAULT NULL,
  `no_telefon` varchar(14) NOT NULL,
  PRIMARY KEY (`pengurusan_kehadiran_media_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kehadiran_media_program` */

/*Table structure for table `tbl_pengurusan_kejohanan_temasya` */

DROP TABLE IF EXISTS `tbl_pengurusan_kejohanan_temasya`;

CREATE TABLE `tbl_pengurusan_kejohanan_temasya` (
  `pengurusan_kejohanan_temasya_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kejohanan_temasya` varchar(80) NOT NULL,
  `peringkat` varchar(30) NOT NULL,
  `tarikh_kejohanan` date NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `lokasi_kejohanan` varchar(90) NOT NULL,
  `nama_ketua_kontijen` varchar(80) NOT NULL,
  `nama_atlet` varchar(80) NOT NULL,
  `nama_pegawai` varchar(80) NOT NULL,
  `nama_doktor` varchar(80) NOT NULL,
  `nama_fisio` varchar(80) NOT NULL,
  `tarikh_penginapan_mula` date NOT NULL,
  `tarikh_penginapan_akhir` date NOT NULL,
  `tarikh_perjalanan_pesawat` date NOT NULL,
  `tarikh_pulang_perjalanan_pesawat` date NOT NULL,
  `catatan_pesawat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_kejohanan_temasya_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kejohanan_temasya` */

/*Table structure for table `tbl_pengurusan_kejohanan_temasya_main` */

DROP TABLE IF EXISTS `tbl_pengurusan_kejohanan_temasya_main`;

CREATE TABLE `tbl_pengurusan_kejohanan_temasya_main` (
  `pengurusan_kejohanan_temasya_main_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_kejohanan_temasya_id` int(11) NOT NULL,
  `nama_temasya` varchar(80) NOT NULL,
  `nama_pertandingan` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  PRIMARY KEY (`pengurusan_kejohanan_temasya_main_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kejohanan_temasya_main` */

/*Table structure for table `tbl_pengurusan_kelayakan_jaringan_antarabangsa` */

DROP TABLE IF EXISTS `tbl_pengurusan_kelayakan_jaringan_antarabangsa`;

CREATE TABLE `tbl_pengurusan_kelayakan_jaringan_antarabangsa` (
  `pengurusan_kelayakan_jaringan_antarabangsa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_jaringan_antarabangsa_id` int(11) NOT NULL,
  `nama_kursus` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `tahap_kelayakan` varchar(80) NOT NULL,
  PRIMARY KEY (`pengurusan_kelayakan_jaringan_antarabangsa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kelayakan_jaringan_antarabangsa` */

/*Table structure for table `tbl_pengurusan_kemudahan_aduan` */

DROP TABLE IF EXISTS `tbl_pengurusan_kemudahan_aduan`;

CREATE TABLE `tbl_pengurusan_kemudahan_aduan` (
  `pengurusan_kemudahan_aduan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_kemudahan_venue_id` int(11) NOT NULL,
  `kategori_aduan` varchar(30) NOT NULL,
  `venue` varchar(80) DEFAULT NULL,
  `peralatan` varchar(80) DEFAULT NULL,
  `tarikh_aduan` date NOT NULL,
  `nama_pengadu` varchar(80) NOT NULL,
  `emel_pengadu` varchar(100) DEFAULT NULL,
  `tel_bimbit_pengadu` varchar(14) DEFAULT NULL,
  `kenyataan_aduan` varchar(255) DEFAULT NULL,
  `tindakan_ulasan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_kemudahan_aduan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kemudahan_aduan` */

/*Table structure for table `tbl_pengurusan_kemudahan_aduan_kerosakan` */

DROP TABLE IF EXISTS `tbl_pengurusan_kemudahan_aduan_kerosakan`;

CREATE TABLE `tbl_pengurusan_kemudahan_aduan_kerosakan` (
  `pengurusan_kemudahan_aduan_kerosakan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_kemudahan_aduan_id` int(11) NOT NULL,
  `jenis_kerosakan` varchar(30) NOT NULL,
  `lokasi_kerosakan` varchar(90) NOT NULL,
  PRIMARY KEY (`pengurusan_kemudahan_aduan_kerosakan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kemudahan_aduan_kerosakan` */

/*Table structure for table `tbl_pengurusan_kemudahan_aduan_pemeriksa` */

DROP TABLE IF EXISTS `tbl_pengurusan_kemudahan_aduan_pemeriksa`;

CREATE TABLE `tbl_pengurusan_kemudahan_aduan_pemeriksa` (
  `pengurusan_kemudahan_aduan_pemeriksa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_kemudahan_venue_id` int(11) NOT NULL,
  `kategori_aduan` varchar(30) NOT NULL,
  `venue` varchar(80) DEFAULT NULL,
  `peralatan` varchar(80) DEFAULT NULL,
  `tarikh_aduan` date NOT NULL,
  `nama_pengadu` varchar(80) NOT NULL,
  `kenyataan_aduan` varchar(255) DEFAULT NULL,
  `tindakan_ulasan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_kemudahan_aduan_pemeriksa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kemudahan_aduan_pemeriksa` */

/*Table structure for table `tbl_pengurusan_kemudahan_dan_peralatan` */

DROP TABLE IF EXISTS `tbl_pengurusan_kemudahan_dan_peralatan`;

CREATE TABLE `tbl_pengurusan_kemudahan_dan_peralatan` (
  `pengurusan_kemudahan_dan_peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kerja` varchar(80) NOT NULL,
  `masa` datetime NOT NULL,
  `catatan_ringkas` varchar(255) DEFAULT NULL,
  `tindakan_yang_diambil` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) DEFAULT NULL,
  `ketidakpatuhan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_kemudahan_dan_peralatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kemudahan_dan_peralatan` */

/*Table structure for table `tbl_pengurusan_kemudahan_peralatan_sedia_ada` */

DROP TABLE IF EXISTS `tbl_pengurusan_kemudahan_peralatan_sedia_ada`;

CREATE TABLE `tbl_pengurusan_kemudahan_peralatan_sedia_ada` (
  `pengurusan_kemudahan_peralatan_sedia_ada_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_kemudahan_venue_id` int(11) NOT NULL,
  `nama_kemudahan` varchar(80) NOT NULL,
  `jenama` varchar(30) NOT NULL,
  `nama_peralatan` varchar(80) NOT NULL,
  `kuantiti` int(11) NOT NULL,
  PRIMARY KEY (`pengurusan_kemudahan_peralatan_sedia_ada_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kemudahan_peralatan_sedia_ada` */

/*Table structure for table `tbl_pengurusan_kemudahan_sedia_ada` */

DROP TABLE IF EXISTS `tbl_pengurusan_kemudahan_sedia_ada`;

CREATE TABLE `tbl_pengurusan_kemudahan_sedia_ada` (
  `pengurusan_kemudahan_sedia_ada_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_kemudahan_venue_id` int(11) NOT NULL,
  `nama_kemudahan` varchar(80) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `lokasi` varchar(30) NOT NULL,
  `keluasan_padang` varchar(50) NOT NULL,
  `jumlah_kapasiti` int(11) NOT NULL,
  `bilangan_kekerapan_penyenggaran` int(11) NOT NULL,
  `kekerapan_penggunaan` int(11) NOT NULL,
  `kekerapan_kerosakan_berlaku` int(11) NOT NULL,
  `cost_pembaikian` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_kemudahan_sedia_ada_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kemudahan_sedia_ada` */

/*Table structure for table `tbl_pengurusan_kemudahan_venue` */

DROP TABLE IF EXISTS `tbl_pengurusan_kemudahan_venue`;

CREATE TABLE `tbl_pengurusan_kemudahan_venue` (
  `pengurusan_kemudahan_venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_venue` varchar(80) DEFAULT NULL,
  `alamat_1` varchar(90) DEFAULT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) DEFAULT NULL,
  `alamat_bandar` varchar(40) DEFAULT NULL,
  `alamat_poskod` varchar(5) DEFAULT NULL,
  `no_telefon` varchar(14) DEFAULT NULL,
  `no_faks` varchar(14) DEFAULT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `tahun_pembinaan` year(4) DEFAULT NULL,
  `tahun_siap_pembinaan` year(4) DEFAULT NULL,
  `kos_project` decimal(10,2) DEFAULT NULL,
  `keluasan_venue` varchar(50) DEFAULT NULL,
  `hakmilik` varchar(80) DEFAULT NULL,
  `sewaan` varchar(80) DEFAULT NULL,
  `bayaran_sewa` decimal(10,2) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_kemudahan_venue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kemudahan_venue` */

/*Table structure for table `tbl_pengurusan_kewangan` */

DROP TABLE IF EXISTS `tbl_pengurusan_kewangan`;

CREATE TABLE `tbl_pengurusan_kewangan` (
  `pengurusan_kewangan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_acara_program` varchar(80) NOT NULL,
  `tarikh_acara` date NOT NULL,
  `kategori_acara` varchar(80) NOT NULL,
  `objektif` varchar(255) NOT NULL,
  `kategori_penggunaan` varchar(80) NOT NULL,
  `harga_penggunaan` decimal(10,2) NOT NULL,
  `jumlah_bajet` decimal(10,2) NOT NULL,
  `jumlah_penggunaan` decimal(10,2) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `bajet_keseluruhan` decimal(10,2) NOT NULL,
  `penggunaan_keseluruhan` decimal(10,2) NOT NULL,
  `baki` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pengurusan_kewangan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kewangan` */

/*Table structure for table `tbl_pengurusan_kontraktor` */

DROP TABLE IF EXISTS `tbl_pengurusan_kontraktor`;

CREATE TABLE `tbl_pengurusan_kontraktor` (
  `pengurusan_kontraktor_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kontraktor` varchar(80) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `telefon_pejabat` varchar(14) NOT NULL,
  `telefon_bimbit` varchar(14) NOT NULL,
  `peralatan_yang_dibekal` varchar(80) NOT NULL,
  PRIMARY KEY (`pengurusan_kontraktor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kontraktor` */

/*Table structure for table `tbl_pengurusan_kpi` */

DROP TABLE IF EXISTS `tbl_pengurusan_kpi`;

CREATE TABLE `tbl_pengurusan_kpi` (
  `pengurusan_kpi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `jumlah_sasaran_pingat` int(11) NOT NULL,
  `jumlah_pingat_yang_telah_dimenangi` int(11) NOT NULL,
  `rekod_baru_yang_dicipta` varchar(80) NOT NULL,
  `senarai_atlet_yang_memenangi` varchar(255) NOT NULL,
  PRIMARY KEY (`pengurusan_kpi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_kpi` */

/*Table structure for table `tbl_pengurusan_maklum_balas_peserta` */

DROP TABLE IF EXISTS `tbl_pengurusan_maklum_balas_peserta`;

CREATE TABLE `tbl_pengurusan_maklum_balas_peserta` (
  `pengurusan_maklum_balas_peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penganjuran_kursus` varchar(80) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `bangsa` varchar(20) NOT NULL,
  `kod_kursus` varchar(30) NOT NULL,
  `tarikh_kursus` date NOT NULL,
  `catatan` varchar(255) NOT NULL,
  PRIMARY KEY (`pengurusan_maklum_balas_peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_maklum_balas_peserta` */

/*Table structure for table `tbl_pengurusan_maklumat_psk` */

DROP TABLE IF EXISTS `tbl_pengurusan_maklumat_psk`;

CREATE TABLE `tbl_pengurusan_maklumat_psk` (
  `pengurusan_maklumat_psk_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sponsor` varchar(80) NOT NULL,
  `jumlah_sponsor` int(11) NOT NULL,
  `tarikh_sponsor_mula` date NOT NULL,
  `tarikh_sponsor_tamat` date NOT NULL,
  PRIMARY KEY (`pengurusan_maklumat_psk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_maklumat_psk` */

/*Table structure for table `tbl_pengurusan_media_program` */

DROP TABLE IF EXISTS `tbl_pengurusan_media_program`;

CREATE TABLE `tbl_pengurusan_media_program` (
  `pengurusan_media_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `cawangan` varchar(80) NOT NULL,
  `maklumat_msn_negeri` varchar(80) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_media_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_media_program` */

/*Table structure for table `tbl_pengurusan_mou_moa_antarabangsa` */

DROP TABLE IF EXISTS `tbl_pengurusan_mou_moa_antarabangsa`;

CREATE TABLE `tbl_pengurusan_mou_moa_antarabangsa` (
  `pengurusan_mou_moa_antarabangsa_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_negara_terlibat` varchar(80) NOT NULL,
  `agensi` varchar(80) NOT NULL,
  `asas_asas_pertimbangan` varchar(255) DEFAULT NULL,
  `jangka_waktu_mula` datetime NOT NULL,
  `jangka_waktu_tamat` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `tajuk_mou_moa` varchar(80) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_mou_moa_antarabangsa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_mou_moa_antarabangsa` */

/*Table structure for table `tbl_pengurusan_pemantauan_dan_penilaian_jurulatih` */

DROP TABLE IF EXISTS `tbl_pengurusan_pemantauan_dan_penilaian_jurulatih`;

CREATE TABLE `tbl_pengurusan_pemantauan_dan_penilaian_jurulatih` (
  `pengurusan_pemantauan_dan_penilaian_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurulatih_dinilai` varchar(80) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `pusat_latihan` varchar(80) NOT NULL,
  `penilaian_oleh` varchar(80) NOT NULL,
  `tarikh_dinilai` date NOT NULL,
  PRIMARY KEY (`pengurusan_pemantauan_dan_penilaian_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_pemantauan_dan_penilaian_jurulatih` */

/*Table structure for table `tbl_pengurusan_penginapan` */

DROP TABLE IF EXISTS `tbl_pengurusan_penginapan`;

CREATE TABLE `tbl_pengurusan_penginapan` (
  `pengurusan_penginapan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_pegawai` varchar(80) NOT NULL,
  `tarikh_masa_penginapan_mula` datetime NOT NULL,
  `tarikh_masa_penginapan_akhir` datetime NOT NULL,
  `lokasi` varchar(90) NOT NULL,
  `nama_penginapan` varchar(80) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_penginapan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_penginapan` */

/*Table structure for table `tbl_pengurusan_penilaian_jurulatih` */

DROP TABLE IF EXISTS `tbl_pengurusan_penilaian_jurulatih`;

CREATE TABLE `tbl_pengurusan_penilaian_jurulatih` (
  `pengurusan_penilaian_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_pemantauan_dan_penilaian_jurulatih_id` int(11) NOT NULL,
  `penilaian_oleh` varchar(80) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `tarikh_dinilai` date NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_penilaian_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_penilaian_jurulatih` */

/*Table structure for table `tbl_pengurusan_penilaian_kategori_jurulatih` */

DROP TABLE IF EXISTS `tbl_pengurusan_penilaian_kategori_jurulatih`;

CREATE TABLE `tbl_pengurusan_penilaian_kategori_jurulatih` (
  `pengurusan_penilaian_kategori_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_penilaian_jurulatih_id` int(11) NOT NULL,
  `penilaian_kategori` varchar(80) NOT NULL,
  `penilaian_sub_kategori` varchar(80) NOT NULL,
  `markah_penilaian` int(11) NOT NULL,
  PRIMARY KEY (`pengurusan_penilaian_kategori_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_penilaian_kategori_jurulatih` */

/*Table structure for table `tbl_pengurusan_penilaian_pendidikan_penganjur_intructor` */

DROP TABLE IF EXISTS `tbl_pengurusan_penilaian_pendidikan_penganjur_intructor`;

CREATE TABLE `tbl_pengurusan_penilaian_pendidikan_penganjur_intructor` (
  `pengurusan_penilaian_pendidikan_penganjur_intructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penganjuran_kursus` varchar(80) NOT NULL,
  `kod_kursus` varchar(30) NOT NULL,
  `tarikh_kursus` date NOT NULL,
  `instructor` varchar(80) NOT NULL,
  PRIMARY KEY (`pengurusan_penilaian_pendidikan_penganjur_intructor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_penilaian_pendidikan_penganjur_intructor` */

/*Table structure for table `tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih` */

DROP TABLE IF EXISTS `tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih`;

CREATE TABLE `tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih` (
  `pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurulatih` varchar(80) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `program_msn` varchar(80) NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `muat_naik_document` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih` */

/*Table structure for table `tbl_pengurusan_perhimpunan_kem` */

DROP TABLE IF EXISTS `tbl_pengurusan_perhimpunan_kem`;

CREATE TABLE `tbl_pengurusan_perhimpunan_kem` (
  `pengurusan_perhimpunan_kem_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_geran_bantuan` varchar(30) NOT NULL,
  `nama_ppn` varchar(80) NOT NULL,
  `pengurus_pn` varchar(80) NOT NULL,
  `nama_penganjuran` varchar(80) NOT NULL,
  `kategori_penganjuran` varchar(80) NOT NULL,
  `sub_kategori_penganjuran` varchar(80) NOT NULL,
  `tahap_penganjuran` varchar(80) NOT NULL,
  `negeri` varchar(30) NOT NULL,
  `kategori_sukan` varchar(80) NOT NULL,
  `tarikh_penganjuran` date NOT NULL,
  `activiti` varchar(80) NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `disahkan` tinyint(1) NOT NULL,
  `tarikh_disahkan` date NOT NULL,
  `sokongan_pn` tinyint(1) NOT NULL,
  `tarikh_sokong_pn` date NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  `tarikh_kelulusan` date NOT NULL,
  PRIMARY KEY (`pengurusan_perhimpunan_kem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_perhimpunan_kem` */

/*Table structure for table `tbl_pengurusan_perhimpunan_kem_kos` */

DROP TABLE IF EXISTS `tbl_pengurusan_perhimpunan_kem_kos`;

CREATE TABLE `tbl_pengurusan_perhimpunan_kem_kos` (
  `pengurusan_perhimpunan_kem_kos_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_perhimpunan_kem_id` int(11) NOT NULL,
  `kategori_kos` varchar(30) NOT NULL,
  `anggaran_kos_per_kategori` decimal(10,2) NOT NULL,
  `revised_kos_per_kategori` decimal(10,2) NOT NULL,
  `approved_kos_per_kategori` decimal(10,2) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_perhimpunan_kem_kos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_perhimpunan_kem_kos` */

/*Table structure for table `tbl_pengurusan_perhimpunan_kem_peserta` */

DROP TABLE IF EXISTS `tbl_pengurusan_perhimpunan_kem_peserta`;

CREATE TABLE `tbl_pengurusan_perhimpunan_kem_peserta` (
  `pengurusan_perhimpunan_kem_peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_perhimpunan_kem_id` int(11) NOT NULL,
  `nama_peserta` varchar(80) NOT NULL,
  `kategori_peserta` varchar(30) NOT NULL,
  `jawatan` varchar(30) NOT NULL,
  PRIMARY KEY (`pengurusan_perhimpunan_kem_peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_perhimpunan_kem_peserta` */

/*Table structure for table `tbl_pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat` */

DROP TABLE IF EXISTS `tbl_pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat`;

CREATE TABLE `tbl_pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat` (
  `pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `muatnaik_dokumen` varchar(100) DEFAULT NULL,
  `nama_kejohonan` varchar(80) NOT NULL,
  `muatnaik_dokumen_kejohanan` varchar(100) DEFAULT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  PRIMARY KEY (`pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat` */

/*Table structure for table `tbl_pengurusan_permohonan_kursus_persatuan` */

DROP TABLE IF EXISTS `tbl_pengurusan_permohonan_kursus_persatuan`;

CREATE TABLE `tbl_pengurusan_permohonan_kursus_persatuan` (
  `pengurusan_permohonan_kursus_persatuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `jantina` varchar(1) DEFAULT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `kelayakan_akademi` varchar(80) NOT NULL,
  `perkerjaan` varchar(80) NOT NULL,
  `nama_majikan` varchar(80) NOT NULL,
  `yuran_program` decimal(10,2) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`pengurusan_permohonan_kursus_persatuan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_permohonan_kursus_persatuan` */

/*Table structure for table `tbl_pengurusan_permohonan_pendidikan` */

DROP TABLE IF EXISTS `tbl_pengurusan_permohonan_pendidikan`;

CREATE TABLE `tbl_pengurusan_permohonan_pendidikan` (
  `pengurusan_permohonan_pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemohon` varchar(80) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `persatuan` varchar(80) NOT NULL,
  `jenis_penganjuran` varchar(30) NOT NULL,
  `cadangan_program_kursus_bengkel` varchar(80) NOT NULL,
  `nama_program_kursus_bengkel` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `jantina` varchar(1) DEFAULT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `kelayakan_akademi` varchar(80) NOT NULL,
  `perkerjaan` varchar(80) NOT NULL,
  `nama_majikan` varchar(80) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`pengurusan_permohonan_pendidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_permohonan_pendidikan` */

/*Table structure for table `tbl_pengurusan_program_binaan` */

DROP TABLE IF EXISTS `tbl_pengurusan_program_binaan`;

CREATE TABLE `tbl_pengurusan_program_binaan` (
  `pengurusan_program_binaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(100) NOT NULL,
  `nama_ppn` varchar(80) NOT NULL,
  `pengurus_pn` varchar(80) NOT NULL,
  `kategori_permohonan` varchar(30) NOT NULL,
  `jenis_permohonan` varchar(30) NOT NULL,
  `sukan` varchar(80) NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `tahap` varchar(30) NOT NULL,
  `negeri` varchar(30) NOT NULL,
  `daerah` varchar(40) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `sokongan_pn` tinyint(1) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`pengurusan_program_binaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_program_binaan` */

insert  into `tbl_pengurusan_program_binaan`(`pengurusan_program_binaan_id`,`nama_program`,`nama_ppn`,`pengurus_pn`,`kategori_permohonan`,`jenis_permohonan`,`sukan`,`tempat`,`tahap`,`negeri`,`daerah`,`tarikh_mula`,`tarikh_tamat`,`sokongan_pn`,`kelulusan`) values (1,'Program Pertanding 2014','','','1','2','3','Bukit Jalil Stadium','4','3','Kenjang','2015-07-01','2015-08-19',1,0),(2,'Training Centre 2015 ','','','3','5','1','Stadium Merdeka','3','3','Center','2015-07-07','2015-08-31',1,1),(3,'Pertanding Dalam Negeri Selangor 2015','','','1','2','2','Taman Jaya Court','1','10','Selangor','2015-07-06','2015-08-12',0,0);

/*Table structure for table `tbl_pengurusan_program_binaan_kos` */

DROP TABLE IF EXISTS `tbl_pengurusan_program_binaan_kos`;

CREATE TABLE `tbl_pengurusan_program_binaan_kos` (
  `pengurusan_program_binaan_kos_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_program_binaan_id` int(11) NOT NULL,
  `kategori_kos` varchar(30) NOT NULL,
  `anggaran_kos_per_kategori` decimal(10,2) NOT NULL,
  `revised_kos_per_kategori` decimal(10,2) NOT NULL,
  `approved_kos_per_kategori` decimal(10,2) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_program_binaan_kos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_program_binaan_kos` */

/*Table structure for table `tbl_pengurusan_program_binaan_peserta` */

DROP TABLE IF EXISTS `tbl_pengurusan_program_binaan_peserta`;

CREATE TABLE `tbl_pengurusan_program_binaan_peserta` (
  `pengurusan_program_binaan_peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_program_binaan_id` int(11) NOT NULL,
  `kategori_peserta` varchar(30) NOT NULL,
  `atlet_jurulatih` varchar(80) NOT NULL,
  `nama_peserta` varchar(80) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  PRIMARY KEY (`pengurusan_program_binaan_peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_program_binaan_peserta` */

/*Table structure for table `tbl_pengurusan_program_persatuan` */

DROP TABLE IF EXISTS `tbl_pengurusan_program_persatuan`;

CREATE TABLE `tbl_pengurusan_program_persatuan` (
  `pengurusan_program_persatuan` int(11) NOT NULL AUTO_INCREMENT,
  `bantuan_tahun` year(4) NOT NULL,
  `nama_persatuan` varchar(80) NOT NULL,
  PRIMARY KEY (`pengurusan_program_persatuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_program_persatuan` */

/*Table structure for table `tbl_pengurusan_sajian_makan` */

DROP TABLE IF EXISTS `tbl_pengurusan_sajian_makan`;

CREATE TABLE `tbl_pengurusan_sajian_makan` (
  `pengurusan_sajian_makan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_akhir` date NOT NULL,
  `bilangan_tempahan_makan` varchar(50) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_sajian_makan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_sajian_makan` */

/*Table structure for table `tbl_pengurusan_shuttle_bus` */

DROP TABLE IF EXISTS `tbl_pengurusan_shuttle_bus`;

CREATE TABLE `tbl_pengurusan_shuttle_bus` (
  `pengurusan_shuttle_bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_akhir` date NOT NULL,
  `pilihan_shuttle` varchar(80) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_shuttle_bus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_shuttle_bus` */

/*Table structure for table `tbl_pengurusan_soalan_maklum_balas_peserta` */

DROP TABLE IF EXISTS `tbl_pengurusan_soalan_maklum_balas_peserta`;

CREATE TABLE `tbl_pengurusan_soalan_maklum_balas_peserta` (
  `pengurusan_soalan_maklum_balas_peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_maklum_balas_peserta_id` int(11) NOT NULL,
  `kategori_penilaian` varchar(30) NOT NULL,
  `nama_temasya` varchar(80) NOT NULL,
  `soalan` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`pengurusan_soalan_maklum_balas_peserta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_soalan_maklum_balas_peserta` */

/*Table structure for table `tbl_pengurusan_soalan_penilaian_pendidikan_penganjur` */

DROP TABLE IF EXISTS `tbl_pengurusan_soalan_penilaian_pendidikan_penganjur`;

CREATE TABLE `tbl_pengurusan_soalan_penilaian_pendidikan_penganjur` (
  `pengurusan_soalan_penilaian_pendidikan_penganjur_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_penilaian_pendidikan_penganjur_intructor_id` int(11) NOT NULL,
  `soalan` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`pengurusan_soalan_penilaian_pendidikan_penganjur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_soalan_penilaian_pendidikan_penganjur` */

/*Table structure for table `tbl_pengurusan_upstn` */

DROP TABLE IF EXISTS `tbl_pengurusan_upstn`;

CREATE TABLE `tbl_pengurusan_upstn` (
  `pengurusan_upstn_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengurus_sukan` varchar(80) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `tarikh_lawatan` date NOT NULL,
  `masa` time NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `kehadiran` varchar(255) NOT NULL,
  `isu` varchar(255) NOT NULL,
  `ulasan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pengurusan_upstn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengurusan_upstn` */

/*Table structure for table `tbl_penilaian_pestasi` */

DROP TABLE IF EXISTS `tbl_penilaian_pestasi`;

CREATE TABLE `tbl_penilaian_pestasi` (
  `penilaian_pestasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `tahap_sihat` varchar(100) NOT NULL,
  `kategori_kecergasan` varchar(30) NOT NULL,
  `kejohanan` varchar(80) DEFAULT NULL,
  `pencapaian_sukan_dalam_tahun_yang_dinilai` varchar(100) NOT NULL,
  `kecederaan_jika_ada` varchar(100) DEFAULT NULL,
  `laporan_kesihatan` varchar(100) DEFAULT NULL,
  `elaun_yang_diterima` decimal(10,2) DEFAULT NULL,
  `skim_hadiah_kemenangan_sukan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`penilaian_pestasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penilaian_pestasi` */

insert  into `tbl_penilaian_pestasi`(`penilaian_pestasi_id`,`atlet_id`,`tarikh`,`tahap_sihat`,`kategori_kecergasan`,`kejohanan`,`pencapaian_sukan_dalam_tahun_yang_dinilai`,`kecederaan_jika_ada`,`laporan_kesihatan`,`elaun_yang_diterima`,`skim_hadiah_kemenangan_sukan`) values (1,2,'2015-09-24','N/A','2','4','Pencapaian Sukan 2015','Ada','uploads/pernilaian_prestasi/1.jpg','5000.00','Menang'),(2,4,'2015-09-30','Sihat','2','2','15000','Jerrr','uploads/pernilaian_prestasi/2.docx','5000.00','Menang'),(3,3,'2015-06-09','Kecergasan','2','2','Pencapaian Sukan 2014','Tiada','uploads/pernilaian_prestasi/3.txt','1500.00','Pertama'),(4,3,'2015-09-17','Sihat','2','2','Pencapaian Sukan 2015','Tiada','uploads/pernilaian_prestasi/4.txt','1500.00','Menang'),(5,2,'2015-09-15','Kecergasan','2','2','Pencapaian Sukan 2015','Tiada','uploads/pernilaian_prestasi/5.txt','5000.00','Menang'),(6,4,'2015-09-14','Kecergasan','1','3','Pencapaian Sukan 2013','Ada','uploads/pernilaian_prestasi/6.jpg','2500.00','2nd');

/*Table structure for table `tbl_penilaian_prestasi_atlet` */

DROP TABLE IF EXISTS `tbl_penilaian_prestasi_atlet`;

CREATE TABLE `tbl_penilaian_prestasi_atlet` (
  `penilaian_prestasi_atlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tahap_kesihatan` varchar(80) DEFAULT NULL,
  `tahap_kecederaan` varchar(80) DEFAULT NULL,
  `kecederaan_tarikh_mula` date DEFAULT NULL,
  `kecederaan_tarikh_tamat` date DEFAULT NULL,
  `ulasan` varchar(255) DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  `tahun_penilaian` year(4) DEFAULT NULL,
  `jadual_latihan` date NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `sasaran` varchar(50) DEFAULT NULL,
  `keputusan` varchar(80) DEFAULT NULL,
  `break_record` tinyint(1) NOT NULL,
  `maklumat_shakam_shakar` varchar(255) NOT NULL,
  PRIMARY KEY (`penilaian_prestasi_atlet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penilaian_prestasi_atlet` */

/*Table structure for table `tbl_peningkatan_kerjaya_jurulatih` */

DROP TABLE IF EXISTS `tbl_peningkatan_kerjaya_jurulatih`;

CREATE TABLE `tbl_peningkatan_kerjaya_jurulatih` (
  `peningkatan_kerjaya_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurulatih` varchar(80) NOT NULL,
  `cawangan` varchar(80) NOT NULL,
  `sub_cawangan` varchar(80) NOT NULL,
  `program_msn` varchar(80) NOT NULL,
  `lain_lain_program` varchar(80) NOT NULL,
  `pusat_latihan` varchar(80) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  PRIMARY KEY (`peningkatan_kerjaya_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_peningkatan_kerjaya_jurulatih` */

/*Table structure for table `tbl_penjadualan_ujian_fisiologi` */

DROP TABLE IF EXISTS `tbl_penjadualan_ujian_fisiologi`;

CREATE TABLE `tbl_penjadualan_ujian_fisiologi` (
  `penjadualan_ujian_fisiologi_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `perkhidmatan` varchar(80) NOT NULL,
  `tarikh_masa` datetime NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`penjadualan_ujian_fisiologi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penjadualan_ujian_fisiologi` */

/*Table structure for table `tbl_penyelidikan_komposisi_pasukan` */

DROP TABLE IF EXISTS `tbl_penyelidikan_komposisi_pasukan`;

CREATE TABLE `tbl_penyelidikan_komposisi_pasukan` (
  `penyelidikan_komposisi_pasukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonana_penyelidikan_id` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `pasukan` varchar(30) NOT NULL,
  `jawatan` varchar(30) DEFAULT NULL,
  `telefon_no` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `institusi_universiti_syarikat` varchar(80) NOT NULL,
  PRIMARY KEY (`penyelidikan_komposisi_pasukan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penyelidikan_komposisi_pasukan` */

/*Table structure for table `tbl_penyertaan_sukan` */

DROP TABLE IF EXISTS `tbl_penyertaan_sukan`;

CREATE TABLE `tbl_penyertaan_sukan` (
  `penyertaan_sukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_penilaian` varchar(30) NOT NULL,
  `nama_temasya` varchar(80) NOT NULL,
  `nama_sukan` varchar(80) NOT NULL,
  `tempat_penginapan` varchar(90) NOT NULL,
  `tempat_latihan` varchar(90) NOT NULL,
  `nama_atlet` varchar(80) NOT NULL,
  `nama_pegawai` varchar(80) NOT NULL,
  `jawatan_pegawai` varchar(80) NOT NULL,
  `nama_pengurus_sukan` varchar(80) NOT NULL,
  `nama_sukarelawan` varchar(80) NOT NULL,
  PRIMARY KEY (`penyertaan_sukan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penyertaan_sukan` */

/*Table structure for table `tbl_penyertaan_sukan_acara` */

DROP TABLE IF EXISTS `tbl_penyertaan_sukan_acara`;

CREATE TABLE `tbl_penyertaan_sukan_acara` (
  `penyertaan_sukan_acara_id` int(11) NOT NULL AUTO_INCREMENT,
  `penyertaan_sukan_id` int(11) NOT NULL,
  `nama_acara` varchar(80) NOT NULL,
  `tarikh_acara` date NOT NULL,
  `keputusan_acara` varchar(80) NOT NULL,
  `jumlah_pingat` int(11) NOT NULL,
  `rekod_baru` tinyint(1) NOT NULL,
  `catatan_rekod_baru` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`penyertaan_sukan_acara_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penyertaan_sukan_acara` */

/*Table structure for table `tbl_penyertaan_sukan_aduan` */

DROP TABLE IF EXISTS `tbl_penyertaan_sukan_aduan`;

CREATE TABLE `tbl_penyertaan_sukan_aduan` (
  `penyertaan_sukan_aduan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengadu` varchar(80) NOT NULL,
  `tarikh_aduan` date NOT NULL,
  `status_aduan` varchar(30) NOT NULL,
  `aduan_kategori` varchar(80) NOT NULL,
  `penyataan_aduan` varchar(80) NOT NULL,
  PRIMARY KEY (`penyertaan_sukan_aduan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penyertaan_sukan_aduan` */

/*Table structure for table `tbl_peralatan` */

DROP TABLE IF EXISTS `tbl_peralatan`;

CREATE TABLE `tbl_peralatan` (
  `peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_peralatan_id` int(11) NOT NULL,
  `nama_peralatan` varchar(80) NOT NULL,
  `spesifikasi` varchar(30) DEFAULT NULL,
  `kuantiti_unit` varchar(30) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`peralatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_peralatan` */

insert  into `tbl_peralatan`(`peralatan_id`,`permohonan_peralatan_id`,`nama_peralatan`,`spesifikasi`,`kuantiti_unit`,`catatan`,`session_id`) values (1,0,'Test123','','1','',NULL),(3,2,'Test','Book','3','',''),(8,2,'Baju','Sport','5','',''),(9,2,'Jaring','Pika','1','Yang Paling Besar',''),(11,2,'Test123','','1','',''),(13,2,'Bola','Size 12','1','Testing Sahaja',NULL),(14,3,'Glove','Size M','1','',''),(15,3,'Baju','Size M','1','',''),(31,3,'123214','B','1','',''),(41,3,'Kem','Besar','1','',''),(42,3,'Baju','Size M','1','',NULL),(43,3,'Pen','Ball','2','',NULL),(44,4,'BIke','200C','2','','');

/*Table structure for table `tbl_perancangan_program` */

DROP TABLE IF EXISTS `tbl_perancangan_program`;

CREATE TABLE `tbl_perancangan_program` (
  `perancangan_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `jenis_program` varchar(30) NOT NULL,
  `lokasi` varchar(90) DEFAULT NULL,
  `muat_naik` varchar(100) NOT NULL,
  PRIMARY KEY (`perancangan_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_perancangan_program` */

/*Table structure for table `tbl_perkhidmatan_analisa_perlawanan_biomekanik` */

DROP TABLE IF EXISTS `tbl_perkhidmatan_analisa_perlawanan_biomekanik`;

CREATE TABLE `tbl_perkhidmatan_analisa_perlawanan_biomekanik` (
  `perkhidmatan_analisa_perlawanan_biomekanik_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id` int(11) NOT NULL,
  `perkhidmatan` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `status_ujian` varchar(30) NOT NULL,
  `muat_naik_video` varchar(100) DEFAULT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`perkhidmatan_analisa_perlawanan_biomekanik_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_perkhidmatan_analisa_perlawanan_biomekanik` */

/*Table structure for table `tbl_perkhidmatan_permakanan` */

DROP TABLE IF EXISTS `tbl_perkhidmatan_permakanan`;

CREATE TABLE `tbl_perkhidmatan_permakanan` (
  `perkhidmatan_permakanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_perkhidmatan_permakanan_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`perkhidmatan_permakanan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_perkhidmatan_permakanan` */

/*Table structure for table `tbl_perlembagaan_badan_sukan` */

DROP TABLE IF EXISTS `tbl_perlembagaan_badan_sukan`;

CREATE TABLE `tbl_perlembagaan_badan_sukan` (
  `perlembagaan_badan_sukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_kelulusan_Terkini` date NOT NULL,
  `bilangan_pindaan_perlembagaan_dilakukan` varchar(50) NOT NULL,
  `tarikh_pindaan` date NOT NULL,
  `tarikh_kelulusan` date DEFAULT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perlembagaan_badan_sukan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_perlembagaan_badan_sukan` */

insert  into `tbl_perlembagaan_badan_sukan`(`perlembagaan_badan_sukan_id`,`tarikh_kelulusan_Terkini`,`bilangan_pindaan_perlembagaan_dilakukan`,`tarikh_pindaan`,`tarikh_kelulusan`,`muat_naik`) values (1,'2015-02-01','10','2015-04-01','2015-03-18',NULL);

/*Table structure for table `tbl_permohonan_biasiswa` */

DROP TABLE IF EXISTS `tbl_permohonan_biasiswa`;

CREATE TABLE `tbl_permohonan_biasiswa` (
  `permohonan_biasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `sukan` varchar(30) NOT NULL,
  `nama_institusi_pengajian` varchar(80) NOT NULL,
  `tarikh_mula_pengajian` date NOT NULL,
  `tarikh_tamat_pengajian` date NOT NULL,
  `nama_program_pengajian` varchar(80) NOT NULL,
  `atlet_id` int(11) NOT NULL,
  `no_ic` varchar(12) NOT NULL,
  `umur` int(11) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `alamat_rumah_1` varchar(90) NOT NULL,
  `alamat_rumah_2` varchar(90) DEFAULT NULL,
  `alamat_rumah_3` varchar(90) DEFAULT NULL,
  `alamat_rumah_negeri` varchar(30) NOT NULL,
  `alamat_rumah_bandar` varchar(40) NOT NULL,
  `alamat_rumah_poskod` varchar(5) NOT NULL,
  `no_tel_rumah` varchar(14) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `alamat_pengajian_1` varchar(90) NOT NULL,
  `alamat_pengajian_2` varchar(90) DEFAULT NULL,
  `alamat_pengajian_3` varchar(90) DEFAULT NULL,
  `alamat_pengajian_negeri` varchar(30) NOT NULL,
  `alamat_pengajian_bandar` varchar(40) NOT NULL,
  `alamat_pengajian_poskod` varchar(5) NOT NULL,
  `no_tel_pengajian` varchar(14) NOT NULL,
  `no_fax_pengajian` varchar(14) DEFAULT NULL,
  `jenis_biasiswa` varchar(80) NOT NULL,
  `muatnaik` varchar(100) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonan_biasiswa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_biasiswa` */

/*Table structure for table `tbl_permohonan_bimbingan_kaunseling` */

DROP TABLE IF EXISTS `tbl_permohonan_bimbingan_kaunseling`;

CREATE TABLE `tbl_permohonan_bimbingan_kaunseling` (
  `permohonan_bimbingan_kaunseling_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh_temujanji` date NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `tarikh_rujukan` date DEFAULT NULL,
  `nama_pemohon_rujukan` varchar(80) NOT NULL,
  `kes_latarbelakang` varchar(30) NOT NULL,
  `kes_latarbelakang_lain` varchar(255) DEFAULT NULL,
  `notis` varchar(255) DEFAULT NULL,
  `pekerjaan_bapa` varchar(80) DEFAULT NULL,
  `pekerjaan_ibu` varchar(80) DEFAULT NULL,
  `bil_adik_beradik` int(11) DEFAULT NULL,
  `no_telefon` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`permohonan_bimbingan_kaunseling_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_bimbingan_kaunseling` */

/*Table structure for table `tbl_permohonan_e_bantuan` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan`;

CREATE TABLE `tbl_permohonan_e_bantuan` (
  `permohonan_e_bantuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `ebantuan_id` varchar(30) NOT NULL,
  `kategori_persatuan` varchar(80) NOT NULL,
  `kategori_program` varchar(80) NOT NULL,
  `nama_pertubuhan_persatuan` varchar(80) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `tarikh_didaftarkan` date NOT NULL,
  `pejabat_yang_mendaftarkan` varchar(80) DEFAULT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `alamat_surat_menyurat_1` varchar(90) NOT NULL,
  `alamat_surat_menyurat_2` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_3` varchar(90) DEFAULT NULL,
  `alamat_surat_menyurat_negeri` varchar(30) NOT NULL,
  `alamat_surat_menyurat_bandar` varchar(40) NOT NULL,
  `alamat_surat_menyurat_poskod` varchar(5) NOT NULL,
  `no_telefon_pejabat` varchar(14) NOT NULL,
  `no_telefon_bimbit` varchar(14) NOT NULL,
  `no_fax` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bilangan_keahlian` int(11) NOT NULL,
  `bilangan_cawangan_badan_gabungan` int(11) DEFAULT NULL,
  `jumlah_perbelanjaan` decimal(10,2) NOT NULL,
  `no_akaun` varchar(20) NOT NULL,
  `nama_bank` varchar(80) NOT NULL,
  `cawangan_dan_alamat_bank` varchar(90) NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `tarikh_pelaksanaan` date NOT NULL,
  `tempat_pelaksanaan` varchar(90) NOT NULL,
  `bilangan_peserta` int(11) NOT NULL,
  `tujuan_program_aktiviti` varchar(100) NOT NULL,
  `pertubuhan_persatuan_sendiri` decimal(10,2) NOT NULL,
  `lain_lain_sumbangan` decimal(10,2) NOT NULL,
  `yuran_bayaran_penyertaan` decimal(10,2) NOT NULL,
  `jumlah_bantuan_yang_dipohon` decimal(10,2) NOT NULL,
  `objektif_pertubuhan` varchar(255) DEFAULT NULL,
  `aktiviti_dan_kejayaan_yang_dicapai` varchar(255) DEFAULT NULL,
  `sokongan` varchar(30) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `disclaimer` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`permohonan_e_bantuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan` */

insert  into `tbl_permohonan_e_bantuan`(`permohonan_e_bantuan_id`,`ebantuan_id`,`kategori_persatuan`,`kategori_program`,`nama_pertubuhan_persatuan`,`no_pendaftaran`,`tarikh_didaftarkan`,`pejabat_yang_mendaftarkan`,`alamat_1`,`alamat_2`,`alamat_3`,`alamat_negeri`,`alamat_bandar`,`alamat_poskod`,`alamat_surat_menyurat_1`,`alamat_surat_menyurat_2`,`alamat_surat_menyurat_3`,`alamat_surat_menyurat_negeri`,`alamat_surat_menyurat_bandar`,`alamat_surat_menyurat_poskod`,`no_telefon_pejabat`,`no_telefon_bimbit`,`no_fax`,`email`,`bilangan_keahlian`,`bilangan_cawangan_badan_gabungan`,`jumlah_perbelanjaan`,`no_akaun`,`nama_bank`,`cawangan_dan_alamat_bank`,`nama_program`,`tarikh_pelaksanaan`,`tempat_pelaksanaan`,`bilangan_peserta`,`tujuan_program_aktiviti`,`pertubuhan_persatuan_sendiri`,`lain_lain_sumbangan`,`yuran_bayaran_penyertaan`,`jumlah_bantuan_yang_dipohon`,`objektif_pertubuhan`,`aktiviti_dan_kejayaan_yang_dicapai`,`sokongan`,`kelulusan`,`catatan`,`disclaimer`) values (1,'EBID00001','2','2','','PP00001','2015-10-01','Bukit Jalil Office','Alamat Berdaftar 1','Alamat Berdaftar 2','Alamat Berdaftar 3','4','10','70000','Alamat Surat Menyurat 1','Alamat Surat Menyurat 2','Alamat Surat Menyurat 3','4','11','67000','038','313','','test@email.com',5,NULL,'0.00','3216666666','2','Sri Petaling','','0000-00-00','',6,'','1000.00','0.00','0.00','20000.00',NULL,'','1',0,'',NULL),(2,'EBID00002','3','2','','PP00002','2015-05-14','MSN Office','Alamat Berdaftar 1','Alamat Berdaftar 2','Alamat Berdaftar 3','4','10','70000','Alamat Surat Menyurat 1','Alamat Surat Menyurat 2','Alamat Surat Menyurat 3','7','13','98000','0388889999','0193338454','0399998888','admin@jasmin.com',10,3,'0.00','88397489933','2','Maybank Putrajaya','','0000-00-00','',0,'','2000.00','0.00','0.00','0.00',NULL,'- Aktiviti Dan Kejayaan Yang Dicapai 1\r\n- Aktiviti Dan Kejayaan Yang Dicapai 2','2',0,'',NULL),(3,'EBID00002','3','2','','PP00002','2015-05-14','Bukit Jalil Office','Alamat Berdaftar 1','Alamat Berdaftar 2','Alamat Berdaftar 3','4','10','70000','Alamat Surat Menyurat 1','Alamat Surat Menyurat 2','Alamat Surat Menyurat 3','7','13','98000','0388889999','0193338454','0399998888','admin@jasmin.com',10,3,'20000.00','88397489933','2','Maybank Putrajaya','Program Festival','2015-06-19','Bukit Jalil Stadium',10,'Motivasi','9000.00','300.00','200.20','1000.00',NULL,'- Aktiviti Dan Kejayaan Yang Dicapai 1\r\n- Aktiviti Dan Kejayaan Yang Dicapai 2','2',1,'- Catatan 1\r\n- Catatan 2\r\n- Catatan 3',NULL),(4,'EBID00003','3','2','','PP00003','2015-02-10','ISN Office','Alamat Berdaftar 11','Alamat Berdaftar 22','Alamat Berdaftar 33','4','11','75000','Alamat Surat Menyurat 11','Alamat Surat Menyurat 22','Alamat Surat Menyurat 33','10','2','48000','0388889991','0193338888','0399997777','admin@isn.com',12,7,'30000.00','8888888888888888','2','Bukit Bintang','Festal 2015','2015-07-14','Stadium Shah Alam',28,'Training','30000.00','10000.00','888.00','999999.00',NULL,'Aktiviti Dan Kejayaan Yang Dicapai1','3',1,'Catatan1',NULL);

/*Table structure for table `tbl_permohonan_e_bantuan_anggaran_perbelanjaan` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan_anggaran_perbelanjaan`;

CREATE TABLE `tbl_permohonan_e_bantuan_anggaran_perbelanjaan` (
  `anggaran_perbelanjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_bantuan_id` int(11) NOT NULL,
  `butir_butir_perbelanjaan` varchar(255) NOT NULL,
  `jumlah_perbelanjaan` decimal(10,2) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`anggaran_perbelanjaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan_anggaran_perbelanjaan` */

insert  into `tbl_permohonan_e_bantuan_anggaran_perbelanjaan`(`anggaran_perbelanjaan_id`,`permohonan_e_bantuan_id`,`butir_butir_perbelanjaan`,`jumlah_perbelanjaan`,`session_id`) values (1,3,'Kos-kos Sewa','5000.00',''),(2,0,'Stationary','200.00',''),(3,2,'Kos-kos lain','2000.00',NULL),(4,4,'Perbelanjaan 2','3000.00',''),(5,4,'Perbelanjaan 3','2001.00',NULL),(6,0,'Kos-kos lain','300.00','pk3qenm62dv7mo11p6ihuqli46');

/*Table structure for table `tbl_permohonan_e_bantuan_jawatankuasa` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan_jawatankuasa`;

CREATE TABLE `tbl_permohonan_e_bantuan_jawatankuasa` (
  `jawatankuasa_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_bantuan_id` int(11) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`jawatankuasa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan_jawatankuasa` */

insert  into `tbl_permohonan_e_bantuan_jawatankuasa`(`jawatankuasa_id`,`permohonan_e_bantuan_id`,`jawatan`,`nama`,`session_id`) values (1,0,'Test','Kenneth','h9qer85ijh35hphbnso37dtg67'),(3,2,'Penguru','Jason',''),(4,2,'Helper','Yee',''),(5,3,'Helper','Ken Lim',NULL),(6,4,'Kerani','Yan',''),(7,0,'Manager','Wanne','pk3qenm62dv7mo11p6ihuqli46');

/*Table structure for table `tbl_permohonan_e_bantuan_objektif_pertubuhan` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan_objektif_pertubuhan`;

CREATE TABLE `tbl_permohonan_e_bantuan_objektif_pertubuhan` (
  `objektif_pertubuhan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_bantuan_id` int(11) NOT NULL,
  `objektif` varchar(80) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`objektif_pertubuhan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan_objektif_pertubuhan` */

insert  into `tbl_permohonan_e_bantuan_objektif_pertubuhan`(`objektif_pertubuhan_id`,`permohonan_e_bantuan_id`,`objektif`,`session_id`) values (3,2,'Objektif 2',''),(4,2,'Objektif 2015',''),(5,3,'Objektif Baru 2015',NULL),(6,4,'Objektik 2009',''),(7,0,'2015 Target','pk3qenm62dv7mo11p6ihuqli46');

/*Table structure for table `tbl_permohonan_e_bantuan_pendapatan_tahun_lepas` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan_pendapatan_tahun_lepas`;

CREATE TABLE `tbl_permohonan_e_bantuan_pendapatan_tahun_lepas` (
  `pendapatan_tahun_lepas_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_bantuan_id` int(11) NOT NULL,
  `jenis_pendapatan` varchar(80) NOT NULL,
  `butir_butir` varchar(255) NOT NULL,
  `jumlah_pendapatan` decimal(10,2) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pendapatan_tahun_lepas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan_pendapatan_tahun_lepas` */

insert  into `tbl_permohonan_e_bantuan_pendapatan_tahun_lepas`(`pendapatan_tahun_lepas_id`,`permohonan_e_bantuan_id`,`jenis_pendapatan`,`butir_butir`,`jumlah_pendapatan`,`session_id`) values (1,0,'3','Kerja Event','2000.00',NULL),(2,3,'2','Lain-lain','2500.00',''),(3,3,'1','Monthly','200.00',NULL),(4,4,'2','Butir 123','3000.00',''),(5,1,'1','Pendapatan 2015 ','2000.00',NULL),(6,0,'2','Kerja Event 2016','500.00','pk3qenm62dv7mo11p6ihuqli46');

/*Table structure for table `tbl_permohonan_e_bantuan_senarai_aktiviti_projek` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan_senarai_aktiviti_projek`;

CREATE TABLE `tbl_permohonan_e_bantuan_senarai_aktiviti_projek` (
  `senarai_aktiviti_projek_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_bantuan_id` int(11) NOT NULL,
  `nama_aktiviti_projek` varchar(80) NOT NULL,
  `keterangan_ringkas` varchar(255) NOT NULL,
  `kejayaan_yang_dicapai` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`senarai_aktiviti_projek_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan_senarai_aktiviti_projek` */

/*Table structure for table `tbl_permohonan_e_bantuan_senarai_permohonan` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan_senarai_permohonan`;

CREATE TABLE `tbl_permohonan_e_bantuan_senarai_permohonan` (
  `senarai_permohonan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_bantuan_id` int(11) NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_kelulusan` decimal(10,2) NOT NULL,
  `penghantaran_laporan` varchar(100) DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`senarai_permohonan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan_senarai_permohonan` */

insert  into `tbl_permohonan_e_bantuan_senarai_permohonan`(`senarai_permohonan_id`,`permohonan_e_bantuan_id`,`nama_program`,`tahun`,`jumlah_kelulusan`,`penghantaran_laporan`,`session_id`) values (7,3,'Testing Program 3',2015,'10000.00','',''),(8,3,'Testing Program 4',2016,'60000.00','uploads/e_bantuan/senarai_permohonan/8.php',''),(9,3,'Program Nama 15',2018,'60000.00','uploads/e_bantuan/senarai_permohonan/9.php',''),(10,4,'Program Bintang 2015',2015,'3000.00','uploads/e_bantuan/senarai_permohonan/10.txt',''),(11,4,'Program Tanah 2015',2015,'10000.00','',''),(12,0,'Testing Program 2',2016,'10000.00','uploads/e_bantuan/senarai_permohonan/12.txt','pk3qenm62dv7mo11p6ihuqli46');

/*Table structure for table `tbl_permohonan_e_bantuan_senarai_semak` */

DROP TABLE IF EXISTS `tbl_permohonan_e_bantuan_senarai_semak`;

CREATE TABLE `tbl_permohonan_e_bantuan_senarai_semak` (
  `senarai_semak_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_bantuan_id` int(11) NOT NULL,
  `kertas_kerja_projek_program` varchar(100) DEFAULT NULL,
  `salinan_sijil_pendaftaran_persatuan_pertubuhan` varchar(100) DEFAULT NULL,
  `salinan_perlembagaan_persatuan_pertubuhan` varchar(100) DEFAULT NULL,
  `salinan_buku_bank` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`senarai_semak_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_bantuan_senarai_semak` */

/*Table structure for table `tbl_permohonan_e_biasiswa` */

DROP TABLE IF EXISTS `tbl_permohonan_e_biasiswa`;

CREATE TABLE `tbl_permohonan_e_biasiswa` (
  `permohonan_e_biasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `muat_naik_gambar` varchar(100) DEFAULT NULL,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `umur` int(2) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `keturunan` varchar(25) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `taraf_perkahwinan` varchar(15) NOT NULL,
  `kawasan_temuduga_anda` varchar(30) NOT NULL,
  `tarikh_temuduga` date DEFAULT NULL,
  `alamat_1` varchar(30) NOT NULL,
  `alamat_2` varchar(30) DEFAULT NULL,
  `alamat_3` varchar(30) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `no_pendaftaran_oku` varchar(30) DEFAULT NULL,
  `kategori_oku` varchar(30) DEFAULT NULL,
  `oku_lain_lain` varchar(80) DEFAULT NULL,
  `universiti_institusi` varchar(80) NOT NULL,
  `program_pengajian` varchar(80) NOT NULL,
  `kursus_bidang_pengajian` varchar(80) NOT NULL,
  `falkulti` varchar(80) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `semester_terkini` int(11) NOT NULL,
  `baki_semester_yang_tinggal` int(11) NOT NULL,
  `png_semasa` varchar(20) DEFAULT NULL,
  `pngk_semasa` varchar(20) DEFAULT NULL,
  `no_matriks` varchar(30) NOT NULL,
  `mendapat_pembiayaan_pendidikan` varchar(30) NOT NULL,
  `mendapat_pembiayaan_pendidikan_bool` tinyint(1) NOT NULL,
  `nyatakan_nama_penaja` varchar(80) NOT NULL,
  `sukan` varchar(80) NOT NULL,
  `perakuan_pemohon` tinyint(1) NOT NULL,
  `contoh` tinyint(1) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  PRIMARY KEY (`permohonan_e_biasiswa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_biasiswa` */

/*Table structure for table `tbl_permohonan_e_biasiswa_penyertaan_kejohanan` */

DROP TABLE IF EXISTS `tbl_permohonan_e_biasiswa_penyertaan_kejohanan`;

CREATE TABLE `tbl_permohonan_e_biasiswa_penyertaan_kejohanan` (
  `penyertaan_kejohanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_e_biasiswa_id` int(11) NOT NULL,
  `sukan` varchar(80) NOT NULL,
  `tarikh` date NOT NULL,
  `anjuran` varchar(80) DEFAULT NULL,
  `kejohanan_mewakili` varchar(30) NOT NULL,
  `acara` varchar(80) NOT NULL,
  `nama_kejohanan` varchar(80) NOT NULL,
  `tempat` varchar(90) NOT NULL,
  `pencapaian` varchar(30) NOT NULL,
  PRIMARY KEY (`penyertaan_kejohanan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_e_biasiswa_penyertaan_kejohanan` */

/*Table structure for table `tbl_permohonan_inovasi_peralatan` */

DROP TABLE IF EXISTS `tbl_permohonan_inovasi_peralatan`;

CREATE TABLE `tbl_permohonan_inovasi_peralatan` (
  `permohonan_inovasi_peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_permohonan` date NOT NULL,
  `pemohon` varchar(80) NOT NULL,
  `nama_peralatan` varchar(80) NOT NULL,
  `ringkasan_inovasi_peralatan` varchar(255) NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  PRIMARY KEY (`permohonan_inovasi_peralatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_inovasi_peralatan` */

/*Table structure for table `tbl_permohonan_kemudahan_ticket_kapal_terbang` */

DROP TABLE IF EXISTS `tbl_permohonan_kemudahan_ticket_kapal_terbang`;

CREATE TABLE `tbl_permohonan_kemudahan_ticket_kapal_terbang` (
  `permohonan_kemudahan_ticket_kapal_terbang_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemohon` varchar(80) NOT NULL,
  `bahagian` varchar(30) NOT NULL,
  `jawatan` varchar(80) NOT NULL,
  `destinasi` varchar(90) NOT NULL,
  `tarikh` date NOT NULL,
  `nama_program` varchar(80) NOT NULL,
  `no_fail_kelulusan` varchar(20) NOT NULL,
  `bil_penumpang` int(11) NOT NULL,
  `aktiviti` varchar(80) NOT NULL,
  `kod_perbelanjaan` varchar(20) DEFAULT NULL,
  `sukan` varchar(30) NOT NULL,
  `atlet` varchar(80) DEFAULT NULL,
  `jurulatih` varchar(80) DEFAULT NULL,
  `pegawai_teknikal` varchar(255) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonan_kemudahan_ticket_kapal_terbang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_kemudahan_ticket_kapal_terbang` */

insert  into `tbl_permohonan_kemudahan_ticket_kapal_terbang`(`permohonan_kemudahan_ticket_kapal_terbang_id`,`nama_pemohon`,`bahagian`,`jawatan`,`destinasi`,`tarikh`,`nama_program`,`no_fail_kelulusan`,`bil_penumpang`,`aktiviti`,`kod_perbelanjaan`,`sukan`,`atlet`,`jurulatih`,`pegawai_teknikal`,`kelulusan`) values (1,'Wilson Yee','Office','Juru','Tampin Jaya','2015-09-01','2','NFK10011',5,'Pertanding SEA','K0019','2','2','1','Kamal ',1),(2,'Jiliy','Sukan','Officer','Sabah, Bukit Taman','2015-09-30','4','NFK10011',1,'Side Visit','KP00394','3','1','2','Ken Lim',0);

/*Table structure for table `tbl_permohonan_membaiki_peralatan` */

DROP TABLE IF EXISTS `tbl_permohonan_membaiki_peralatan`;

CREATE TABLE `tbl_permohonan_membaiki_peralatan` (
  `permohonan_membaiki_peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_permohonan` date NOT NULL,
  `pemohon` varchar(80) NOT NULL,
  `nama_peralatan` varchar(80) NOT NULL,
  `model` varchar(40) DEFAULT NULL,
  `nombor_siri` varchar(40) DEFAULT NULL,
  `tarikh_diterima` date DEFAULT NULL,
  `tarikh_dipulang` date DEFAULT NULL,
  `kerosakan` varchar(255) DEFAULT NULL,
  `simptom_kerosakan` varchar(255) DEFAULT NULL,
  `komponen_utama` varchar(255) DEFAULT NULL,
  `proses_pemeriksaan` varchar(255) DEFAULT NULL,
  `pembaikan` varchar(255) DEFAULT NULL,
  `cadangan` varchar(255) DEFAULT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  PRIMARY KEY (`permohonan_membaiki_peralatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_membaiki_peralatan` */

/*Table structure for table `tbl_permohonan_pendidikan` */

DROP TABLE IF EXISTS `tbl_permohonan_pendidikan`;

CREATE TABLE `tbl_permohonan_pendidikan` (
  `permohonan_pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_permohonan` varchar(30) NOT NULL,
  `atlet_id` int(11) NOT NULL,
  `no_ic` varchar(12) NOT NULL,
  `umur` int(11) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `tinggi` decimal(10,2) NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `alamat_rumah_1` varchar(90) NOT NULL,
  `alamat_rumah_2` varchar(90) DEFAULT NULL,
  `alamat_rumah_3` varchar(90) DEFAULT NULL,
  `alamat_rumah_negeri` varchar(30) NOT NULL,
  `alamat_rumah_bandar` varchar(40) NOT NULL,
  `alamat_rumah_poskod` varchar(5) NOT NULL,
  `no_telefon_rumah` varchar(14) NOT NULL,
  `no_telefon_bimbit` varchar(14) NOT NULL,
  `nama_ibu_bapa_penjaga` varchar(80) NOT NULL,
  `tahap_pendidikan` varchar(30) NOT NULL,
  `aliran` varchar(80) DEFAULT NULL,
  `keputusan_spm` varchar(255) DEFAULT NULL,
  `pilihan_aliran_spm` varchar(80) DEFAULT NULL,
  `sukan` varchar(80) NOT NULL,
  `acara` varchar(80) NOT NULL,
  `tahun_program` year(4) DEFAULT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `alamat_pendidikan_1` varchar(90) NOT NULL,
  `alamat_pendidikan_2` varchar(90) DEFAULT NULL,
  `alamat_pendidikan_3` varchar(90) DEFAULT NULL,
  `alamat_pendidikan_negeri` varchar(30) NOT NULL,
  `alamat_pendidikan_bandar` varchar(40) NOT NULL,
  `alamat_pendidikan_poskod` varchar(5) NOT NULL,
  `no_tel_pendidikan` varchar(14) NOT NULL,
  `no_fax_pendidikan` varchar(14) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  `nama_pencadang` varchar(80) DEFAULT NULL,
  `jawatan_pencadang` varchar(80) DEFAULT NULL,
  `no_telefon_pencadang` varchar(14) DEFAULT NULL,
  `sekolah_unit_sukan_pdd_psk_pencadang` varchar(80) DEFAULT NULL,
  `nama_pengesahan` varchar(80) NOT NULL,
  `jawatan_pengesahan` varchar(80) NOT NULL,
  `no_telefon_pengesahan` varchar(14) NOT NULL,
  `sekolah_unit_sukan_pdd_psk_pengesahan` varchar(80) NOT NULL,
  PRIMARY KEY (`permohonan_pendidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_pendidikan` */

/*Table structure for table `tbl_permohonan_penyelidikan` */

DROP TABLE IF EXISTS `tbl_permohonan_penyelidikan`;

CREATE TABLE `tbl_permohonan_penyelidikan` (
  `permohonana_penyelidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_permohon` varchar(80) NOT NULL,
  `tarikh_permohonan` date NOT NULL,
  `tajuk_penyelidikan` varchar(80) NOT NULL,
  `ringkasan_permohonan` varchar(255) NOT NULL,
  `biasa_dengan_keperluan_penyelidikan` tinyint(1) NOT NULL,
  `kelulusan_echics` tinyint(1) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonana_penyelidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_penyelidikan` */

/*Table structure for table `tbl_permohonan_peralatan` */

DROP TABLE IF EXISTS `tbl_permohonan_peralatan`;

CREATE TABLE `tbl_permohonan_peralatan` (
  `permohonan_peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `cawangan` varchar(80) NOT NULL,
  `negeri` varchar(30) NOT NULL,
  `sukan` varchar(30) NOT NULL,
  `program` varchar(90) NOT NULL,
  `tarikh` date NOT NULL,
  `aktiviti` varchar(80) NOT NULL,
  `jumlah_peralatan` int(11) NOT NULL,
  `nota_urus_setia` varchar(255) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonan_peralatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_peralatan` */

insert  into `tbl_permohonan_peralatan`(`permohonan_peralatan_id`,`cawangan`,`negeri`,`sukan`,`program`,`tarikh`,`aktiviti`,`jumlah_peralatan`,`nota_urus_setia`,`kelulusan`) values (2,'1','2','2','2','2015-09-01','Hoki',5,'',1),(3,'1','2','1','2','2015-09-16','Kem 12',6,'Testing Nota',0),(4,'1','4','3','2','2015-09-10','Kem Event 2015',1,'',0);

/*Table structure for table `tbl_permohonan_perganjuran` */

DROP TABLE IF EXISTS `tbl_permohonan_perganjuran`;

CREATE TABLE `tbl_permohonan_perganjuran` (
  `permohonan_perganjuran_id` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_kursus` date NOT NULL,
  `tempat_kursus` varchar(90) NOT NULL,
  `aktiviti` varchar(80) NOT NULL,
  `nama_instructor` varchar(80) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonan_perganjuran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_perganjuran` */

/*Table structure for table `tbl_permohonan_perganjuran_instructor` */

DROP TABLE IF EXISTS `tbl_permohonan_perganjuran_instructor`;

CREATE TABLE `tbl_permohonan_perganjuran_instructor` (
  `permohonan_perganjuran_instructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_perganjuran_id` int(11) NOT NULL,
  `nama_instructor` varchar(80) NOT NULL,
  PRIMARY KEY (`permohonan_perganjuran_instructor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_perganjuran_instructor` */

/*Table structure for table `tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik` */

DROP TABLE IF EXISTS `tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik`;

CREATE TABLE `tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik` (
  `permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `sukan` varchar(30) NOT NULL,
  `tujuan` varchar(80) NOT NULL,
  `perkhidmatan` varchar(80) NOT NULL,
  PRIMARY KEY (`permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik` */

/*Table structure for table `tbl_permohonan_perkhidmatan_permakanan` */

DROP TABLE IF EXISTS `tbl_permohonan_perkhidmatan_permakanan`;

CREATE TABLE `tbl_permohonan_perkhidmatan_permakanan` (
  `permohonan_perkhidmatan_permakanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `sukan` varchar(30) NOT NULL,
  `tujuan` varchar(80) NOT NULL,
  `kategori_permohonan` varchar(30) NOT NULL,
  `jenis_perkhidmatan` varchar(80) NOT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonan_perkhidmatan_permakanan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_perkhidmatan_permakanan` */

/*Table structure for table `tbl_permohonan_program_pendidikan_kesihatan` */

DROP TABLE IF EXISTS `tbl_permohonan_program_pendidikan_kesihatan`;

CREATE TABLE `tbl_permohonan_program_pendidikan_kesihatan` (
  `permohonan_program_pendidikan_kesihatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(80) NOT NULL,
  `tarikh_program` date NOT NULL,
  `tempat_program` varchar(90) NOT NULL,
  `nama_pemohon` varchar(80) NOT NULL,
  `no_tel_pemohon` varchar(14) NOT NULL,
  `pegawai_bertugas` varchar(80) NOT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  `kelulusan_ceo` tinyint(1) NOT NULL,
  `kelulusan_pbu` tinyint(1) NOT NULL,
  PRIMARY KEY (`permohonan_program_pendidikan_kesihatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_program_pendidikan_kesihatan` */

/*Table structure for table `tbl_permohonan_program_pendidikan_pencegahan` */

DROP TABLE IF EXISTS `tbl_permohonan_program_pendidikan_pencegahan`;

CREATE TABLE `tbl_permohonan_program_pendidikan_pencegahan` (
  `program_pendidikan_pencegahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id_staff_id` int(11) NOT NULL,
  `program` varchar(80) NOT NULL,
  `tarikh_permohonan` date NOT NULL,
  `status_permohonan` varchar(30) NOT NULL,
  `kategori_permohonan` varchar(30) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`program_pendidikan_pencegahan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permohonan_program_pendidikan_pencegahan` */

/*Table structure for table `tbl_pertukaran_pengajian` */

DROP TABLE IF EXISTS `tbl_pertukaran_pengajian`;

CREATE TABLE `tbl_pertukaran_pengajian` (
  `pertukaran_pengajian_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `sebab_pemohonan` varchar(255) NOT NULL,
  `kategori_pengajian` varchar(30) NOT NULL,
  `nama_pengajian_sekarang` varchar(80) NOT NULL,
  `nama_pertukaran_pengajian` varchar(80) NOT NULL,
  `sebab_pertukaran` varchar(255) DEFAULT NULL,
  `sebab_penangguhan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pertukaran_pengajian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pertukaran_pengajian` */

/*Table structure for table `tbl_pinjaman_peralatan` */

DROP TABLE IF EXISTS `tbl_pinjaman_peralatan`;

CREATE TABLE `tbl_pinjaman_peralatan` (
  `pinjaman_peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_peralatan` varchar(80) NOT NULL,
  `kuantiti` int(11) NOT NULL,
  `tarikh_diberi` datetime NOT NULL,
  `tarikh_dipulang` datetime DEFAULT NULL,
  `tempoh_pinjaman` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pinjaman_peralatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pinjaman_peralatan` */

/*Table structure for table `tbl_pl_data_klinikal` */

DROP TABLE IF EXISTS `tbl_pl_data_klinikal`;

CREATE TABLE `tbl_pl_data_klinikal` (
  `pl_data_klinikal_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `penglihatan_tanpa_cermin_mata_kiri` varchar(30) DEFAULT NULL,
  `penglihatan_tanpa_cermin_mata_kanan` varchar(30) DEFAULT NULL,
  `penglihatan_cermin_mata_kiri` varchar(30) DEFAULT NULL,
  `penglihatan_cermin_mata_kanan` varchar(30) DEFAULT NULL,
  `usia_kali_pertama_haid` int(11) DEFAULT NULL,
  `haid_kitaran` varchar(20) DEFAULT NULL,
  `status_haid` varchar(30) DEFAULT NULL,
  `haid_kali_terakhir_hari_pertama` date DEFAULT NULL,
  `kali_terakhir_bersalin` date DEFAULT NULL,
  `bilangan_kanak_kanak` int(11) DEFAULT NULL,
  `masalah_haid` varchar(255) DEFAULT NULL,
  `perokok_tempoh` int(11) DEFAULT NULL,
  `status_perokok` varchar(30) DEFAULT NULL,
  `alkohol` int(11) DEFAULT NULL,
  `jenis_alkohol` varchar(30) DEFAULT NULL,
  `diet_harian` varchar(30) DEFAULT NULL,
  `berat_badan_turun` int(11) DEFAULT NULL,
  `berat_badan_naik` int(11) DEFAULT NULL,
  `supplements` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pl_data_klinikal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pl_data_klinikal` */

/*Table structure for table `tbl_pl_diagnosis_preskripsi_pemeriksaan` */

DROP TABLE IF EXISTS `tbl_pl_diagnosis_preskripsi_pemeriksaan`;

CREATE TABLE `tbl_pl_diagnosis_preskripsi_pemeriksaan` (
  `pl_diagnosis_preskripsi_pemeriksaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `temujanji_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `jenis_diagnosis_preskripsi_pemeriksaan` varchar(30) NOT NULL,
  `status_diagnosis_preskripsi_pemeriksaan` varchar(30) NOT NULL,
  `unit` varchar(80) NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `catitan_ringkas` varchar(255) NOT NULL,
  PRIMARY KEY (`pl_diagnosis_preskripsi_pemeriksaan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pl_diagnosis_preskripsi_pemeriksaan` */

/*Table structure for table `tbl_pl_sejarah_perubatan` */

DROP TABLE IF EXISTS `tbl_pl_sejarah_perubatan`;

CREATE TABLE `tbl_pl_sejarah_perubatan` (
  `pl_sejarah_perubatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `nama_perubatan` varchar(80) NOT NULL,
  `butiran_perubatan` varchar(255) NOT NULL,
  PRIMARY KEY (`pl_sejarah_perubatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pl_sejarah_perubatan` */

/*Table structure for table `tbl_pl_temujanji` */

DROP TABLE IF EXISTS `tbl_pl_temujanji`;

CREATE TABLE `tbl_pl_temujanji` (
  `pl_temujanji_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh_temujanji` date NOT NULL,
  `doktor_pegawai_perubatan` varchar(80) NOT NULL,
  `makmal_perubatan` varchar(80) DEFAULT NULL,
  `status_temujanji` varchar(30) NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `catitan_ringkas` varchar(255) NOT NULL,
  PRIMARY KEY (`pl_temujanji_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pl_temujanji` */

/*Table structure for table `tbl_profil_badan_sukan` */

DROP TABLE IF EXISTS `tbl_profil_badan_sukan`;

CREATE TABLE `tbl_profil_badan_sukan` (
  `profil_badan_sukan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_badan_sukan` varchar(100) NOT NULL,
  `nama_badan_sukan_sebelum_ini` varchar(100) NOT NULL,
  `no_pendaftaran_sijil_pendaftaran` varchar(100) NOT NULL,
  `tarikh_lulus_pendaftaran` date NOT NULL,
  `peringkat_badan_sukan` varchar(20) NOT NULL,
  `jenis_sukan` varchar(30) NOT NULL,
  `alamat_tetap_badan_sukan_1` varchar(30) NOT NULL,
  `alamat_tetap_badan_sukan_2` varchar(30) DEFAULT NULL,
  `alamat_tetap_badan_sukan_3` varchar(30) DEFAULT NULL,
  `alamat_tetap_badan_sukan_negeri` varchar(20) NOT NULL,
  `alamat_tetap_badan_sukan_bandar` varchar(30) NOT NULL,
  `alamat_tetap_badan_sukan_poskod` varchar(5) NOT NULL,
  `alamat_surat_menyurat_badan_sukan_1` varchar(30) NOT NULL,
  `alamat_surat_menyurat_badan_sukan_2` varchar(30) DEFAULT NULL,
  `alamat_surat_menyurat_badan_sukan_3` varchar(30) DEFAULT NULL,
  `alamat_surat_menyurat_badan_sukan_negeri` varchar(20) NOT NULL,
  `alamat_surat_menyurat_badan_sukan_bandar` varchar(30) NOT NULL,
  `alamat_surat_menyurat_badan_sukan_poskod` varchar(5) NOT NULL,
  `no_telefon_pejabat` varchar(14) NOT NULL,
  `no_faks_pejabat` varchar(14) DEFAULT NULL,
  `emel_badan_sukan` varchar(100) DEFAULT NULL,
  `pengiktirafan_yang_pernah_diterima_badan_sukan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`profil_badan_sukan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_profil_badan_sukan` */

insert  into `tbl_profil_badan_sukan`(`profil_badan_sukan`,`nama_badan_sukan`,`nama_badan_sukan_sebelum_ini`,`no_pendaftaran_sijil_pendaftaran`,`tarikh_lulus_pendaftaran`,`peringkat_badan_sukan`,`jenis_sukan`,`alamat_tetap_badan_sukan_1`,`alamat_tetap_badan_sukan_2`,`alamat_tetap_badan_sukan_3`,`alamat_tetap_badan_sukan_negeri`,`alamat_tetap_badan_sukan_bandar`,`alamat_tetap_badan_sukan_poskod`,`alamat_surat_menyurat_badan_sukan_1`,`alamat_surat_menyurat_badan_sukan_2`,`alamat_surat_menyurat_badan_sukan_3`,`alamat_surat_menyurat_badan_sukan_negeri`,`alamat_surat_menyurat_badan_sukan_bandar`,`alamat_surat_menyurat_badan_sukan_poskod`,`no_telefon_pejabat`,`no_faks_pejabat`,`emel_badan_sukan`,`pengiktirafan_yang_pernah_diterima_badan_sukan`) values (2,'Badan Sukan Baru','Badan Sukan Sebelum','','2015-08-05','3','2','Alamat Tetap Badan Sukan 1','Alamat Tetap Badan Sukan 2','Alamat Tetap Badan Sukan 3','4','9','75200','','','','','','','348898554','348898555','email@test.com','Oleh'),(3,'Badan Sukan Baru','Badan Sukan Sebelum','','2015-08-05','3','2','',NULL,NULL,'','','','',NULL,NULL,'','','','348898554','348898555','email@test.com','Oleh'),(4,'Badan Sukan Baru','Badan Sukan Sebelum','uploads/profil_badan_sukan/4.php','2015-08-05','3','2','Alamat Tetap Badan Sukan 1','Alamat Tetap Badan Sukan 2','Alamat Tetap Badan Sukan 3','4','10','75200','Alamat Surat Menyurat 1','Alamat Surat Menyurat 2','Alamat Surat Menyurat 3','4','9','47100','03-48898554','348898555','email@test.com','Oleh'),(5,'Badan Sukan 2015','Badan Sukan Sebelum','uploads/profil_badan_sukan/5.txt','2015-10-01','2','3','Alamat Tetap Badan Sukan 11','Alamat Tetap Badan Sukan 22','Alamat Tetap Badan Sukan 33','4','10','75200','Alamat Surat Menyurat 11','Alamat Surat Menyurat 22','Alamat Surat Menyurat 33','7','13','87000','03-48898554','0348898555','email@test.com','Oleh Pengawai');

/*Table structure for table `tbl_profil_konsultan` */

DROP TABLE IF EXISTS `tbl_profil_konsultan`;

CREATE TABLE `tbl_profil_konsultan` (
  `profil_konsultan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_konsultan` varchar(80) NOT NULL,
  `ic_no` varchar(12) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `no_bimbit` varchar(14) NOT NULL,
  `bidang_konsultansi` varchar(80) DEFAULT NULL,
  `kepakaran_pengalaman` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`profil_konsultan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_profil_konsultan` */

/*Table structure for table `tbl_profil_wartawan_sukan` */

DROP TABLE IF EXISTS `tbl_profil_wartawan_sukan`;

CREATE TABLE `tbl_profil_wartawan_sukan` (
  `profil_wartawan_sukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `agensi` varchar(80) NOT NULL,
  `no_tel` varchar(14) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY (`profil_wartawan_sukan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_profil_wartawan_sukan` */

/*Table structure for table `tbl_psikologi_aktiviti` */

DROP TABLE IF EXISTS `tbl_psikologi_aktiviti`;

CREATE TABLE `tbl_psikologi_aktiviti` (
  `psikologi_aktiviti_id` int(11) NOT NULL AUTO_INCREMENT,
  `psikologi_profil_id` int(11) NOT NULL,
  `nama_aktiviti` varchar(80) NOT NULL,
  `tarikh_mula` datetime NOT NULL,
  `tarikh_tamat` datetime NOT NULL,
  PRIMARY KEY (`psikologi_aktiviti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_psikologi_aktiviti` */

/*Table structure for table `tbl_psikologi_profil` */

DROP TABLE IF EXISTS `tbl_psikologi_profil`;

CREATE TABLE `tbl_psikologi_profil` (
  `psikologi_profil_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `pangkat` varchar(30) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `jantina` varchar(1) DEFAULT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `muat_naik` varchar(100) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `pengalaman_pertandingan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`psikologi_profil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_psikologi_profil` */

/*Table structure for table `tbl_ref_acara` */

DROP TABLE IF EXISTS `tbl_ref_acara`;

CREATE TABLE `tbl_ref_acara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_sukan_id` int(11) NOT NULL,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_acara` */

insert  into `tbl_ref_acara`(`id`,`ref_sukan_id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,1,'Tenis Acara 1',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(2,1,'Tenis Acara 2',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(3,2,'Badminton Acara 1',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(4,2,'Badminton Acara 2',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(5,2,'Badminton Acara 3',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(6,3,'Boling Acara 1',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(7,3,'Boling Acara 2',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(8,3,'Boling Acara 3',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(9,4,'Hoki Acara 1',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(10,4,'Hoki Acara 2',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(11,5,'Bola Sepak 1',0,NULL,NULL,'2015-10-07 17:02:52',NULL),(12,5,'Bola Sepak 2',0,NULL,NULL,'2015-10-07 17:02:52',NULL);

/*Table structure for table `tbl_ref_acara_olimpik` */

DROP TABLE IF EXISTS `tbl_ref_acara_olimpik`;

CREATE TABLE `tbl_ref_acara_olimpik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_acara_olimpik` */

insert  into `tbl_ref_acara_olimpik`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Acara Olimpik 1',1,NULL,NULL,'2015-10-01 14:10:59',NULL),(2,'Acara Olimpik 2',1,NULL,NULL,'2015-10-01 14:11:01',NULL),(3,'Acara Olimpik 3',1,NULL,NULL,'2015-10-01 14:11:10',NULL);

/*Table structure for table `tbl_ref_agama` */

DROP TABLE IF EXISTS `tbl_ref_agama`;

CREATE TABLE `tbl_ref_agama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_agama` */

insert  into `tbl_ref_agama`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Islam',1,NULL,NULL,'2015-08-06 17:11:36',NULL),(2,'Kristian',1,NULL,NULL,'2015-08-06 17:11:44',NULL),(3,'Buddha',1,NULL,NULL,'2015-08-06 17:12:36',NULL),(4,'Hindu',1,NULL,NULL,'2015-08-06 17:12:42',NULL),(5,'Lain-lain',1,NULL,NULL,'2015-08-06 17:12:52',NULL);

/*Table structure for table `tbl_ref_atlet_tahap` */

DROP TABLE IF EXISTS `tbl_ref_atlet_tahap`;

CREATE TABLE `tbl_ref_atlet_tahap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_atlet_tahap` */

insert  into `tbl_ref_atlet_tahap`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Pelapis',1,NULL,NULL,'2015-08-06 13:57:37',NULL),(2,'Bakat',1,NULL,NULL,'2015-08-06 13:57:37',NULL),(3,'Senior',1,NULL,NULL,'2015-08-06 13:57:37',NULL),(4,'Podium',1,NULL,NULL,'2015-08-06 13:57:37',NULL);

/*Table structure for table `tbl_ref_bahasa` */

DROP TABLE IF EXISTS `tbl_ref_bahasa`;

CREATE TABLE `tbl_ref_bahasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_bahasa` */

insert  into `tbl_ref_bahasa`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Bahasa Melayu',1,NULL,NULL,'2015-08-06 22:14:34',NULL),(2,'Bahasa Cina',1,NULL,NULL,'2015-08-06 22:14:46',NULL),(3,'Bahasa Inggeris',1,NULL,NULL,'2015-08-06 22:14:57',NULL),(4,'Bahasa Tamil',1,NULL,NULL,'2015-08-06 22:15:12',NULL),(5,'Lain-lain',1,NULL,NULL,'2015-08-06 22:15:19',NULL);

/*Table structure for table `tbl_ref_bandar` */

DROP TABLE IF EXISTS `tbl_ref_bandar`;

CREATE TABLE `tbl_ref_bandar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_negeri_id` int(11) NOT NULL,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_bandar` */

insert  into `tbl_ref_bandar`(`id`,`ref_negeri_id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,10,'Petaling Jaya',1,NULL,NULL,'2015-08-06 17:01:11',NULL),(2,10,'Puchong',1,NULL,NULL,'2015-08-06 17:01:15',NULL),(3,10,'Shah Alam',1,NULL,NULL,'2015-08-06 17:01:28',NULL),(4,10,'Klang',1,NULL,NULL,'2015-08-06 17:01:38',NULL),(5,14,'Bandar Damai Perdana',1,NULL,NULL,'2015-09-08 22:52:56',NULL),(6,14,'Bandar Tasik Selatan',1,NULL,NULL,'2015-09-08 22:53:01',NULL),(7,14,'Cheras',1,NULL,NULL,'2015-09-08 22:53:07',NULL),(8,14,'Desa ParkCity',1,NULL,NULL,'2015-09-08 22:53:16',NULL),(9,4,'Alor Gajah',1,NULL,NULL,'2015-09-08 22:53:59',NULL),(10,4,'Ayer Keroh',1,NULL,NULL,'2015-09-08 22:54:06',NULL),(11,4,'Bandar Hilir',1,NULL,NULL,'2015-09-08 22:54:18',NULL),(12,7,'Bukit Mertajam',1,NULL,NULL,'2015-09-08 22:55:05',NULL),(13,7,'Georgetown',1,NULL,NULL,'2015-09-08 22:55:13',NULL),(14,7,'Prai',1,NULL,NULL,'2015-09-08 22:55:35',NULL),(15,1,'Bakri',1,NULL,NULL,'2015-09-08 23:01:39',NULL),(16,1,'Bukit Pasir',1,NULL,NULL,'2015-09-08 23:01:48',NULL),(17,1,'Jementah',1,NULL,NULL,'2015-09-08 23:02:02',NULL),(18,1,'Bekok',1,NULL,NULL,'2015-09-08 23:02:04',NULL);

/*Table structure for table `tbl_ref_bangsa` */

DROP TABLE IF EXISTS `tbl_ref_bangsa`;

CREATE TABLE `tbl_ref_bangsa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_bangsa` */

insert  into `tbl_ref_bangsa`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Melayu',1,NULL,NULL,'2015-08-06 17:04:11',NULL),(2,'Cina',1,NULL,NULL,'2015-08-06 17:04:13',NULL),(3,'India',1,NULL,NULL,'2015-08-06 17:04:18',NULL),(4,'Lain-lain',1,NULL,NULL,'2015-08-06 17:04:24',NULL);

/*Table structure for table `tbl_ref_bank` */

DROP TABLE IF EXISTS `tbl_ref_bank`;

CREATE TABLE `tbl_ref_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_bank` */

insert  into `tbl_ref_bank`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'CIMB',1,NULL,NULL,'2015-09-07 13:08:42',NULL),(2,'Maybank',1,NULL,NULL,'2015-09-07 13:08:46',NULL),(3,'RHB',1,NULL,NULL,'2015-09-07 13:08:49',NULL),(4,'Public Bank',1,NULL,NULL,'2015-09-07 13:08:55',NULL);

/*Table structure for table `tbl_ref_cawangan` */

DROP TABLE IF EXISTS `tbl_ref_cawangan`;

CREATE TABLE `tbl_ref_cawangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_cawangan` */

insert  into `tbl_ref_cawangan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'MSN',1,NULL,NULL,'2015-08-06 13:57:37',NULL),(2,'ISN',1,NULL,NULL,'2015-08-06 13:57:41',NULL);

/*Table structure for table `tbl_ref_jantina` */

DROP TABLE IF EXISTS `tbl_ref_jantina`;

CREATE TABLE `tbl_ref_jantina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jantina` */

insert  into `tbl_ref_jantina`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Lelaki',1,NULL,NULL,'2015-08-06 14:30:33',NULL),(2,'Perempuan',1,NULL,NULL,'2015-08-06 14:30:42',NULL);

/*Table structure for table `tbl_ref_jawatan` */

DROP TABLE IF EXISTS `tbl_ref_jawatan`;

CREATE TABLE `tbl_ref_jawatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jawatan` */

insert  into `tbl_ref_jawatan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Jawatan 1',1,NULL,NULL,'2015-10-08 13:51:46',NULL),(2,'Jawatan 2',1,NULL,NULL,'2015-10-08 13:51:48',NULL),(3,'Jawatan 3',1,NULL,NULL,'2015-10-08 13:51:51',NULL),(4,'Jawatan 4',1,NULL,NULL,'2015-10-08 13:51:59',NULL);

/*Table structure for table `tbl_ref_jenis_aset` */

DROP TABLE IF EXISTS `tbl_ref_jenis_aset`;

CREATE TABLE `tbl_ref_jenis_aset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_aset` */

insert  into `tbl_ref_jenis_aset`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Harta',1,NULL,NULL,'2015-09-07 11:50:35',NULL),(2,'Pengangkutan',1,NULL,NULL,'2015-09-07 11:50:42',NULL),(3,'Perniagaan',1,NULL,NULL,'2015-09-07 11:50:55',NULL);

/*Table structure for table `tbl_ref_jenis_aset_sub` */

DROP TABLE IF EXISTS `tbl_ref_jenis_aset_sub`;

CREATE TABLE `tbl_ref_jenis_aset_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_jenis_aset_id` int(11) NOT NULL,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_aset_sub` */

insert  into `tbl_ref_jenis_aset_sub`(`id`,`ref_jenis_aset_id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,1,'Teres',1,NULL,NULL,'2015-09-07 12:26:07',NULL),(2,1,'Pangsapuri',1,NULL,NULL,'2015-09-07 12:26:31',NULL),(3,2,'Kereta Saloon',1,NULL,NULL,'2015-09-07 12:26:47',NULL),(4,2,'Kereta MPV',1,NULL,NULL,'2015-09-07 12:26:55',NULL),(5,3,'IT',1,NULL,NULL,'2015-09-07 12:27:06',NULL),(6,3,'Agent',1,NULL,NULL,'2015-09-07 12:27:49',NULL);

/*Table structure for table `tbl_ref_jenis_bantuan_skak` */

DROP TABLE IF EXISTS `tbl_ref_jenis_bantuan_skak`;

CREATE TABLE `tbl_ref_jenis_bantuan_skak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_bantuan_skak` */

insert  into `tbl_ref_jenis_bantuan_skak`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Jenis Bantuan SKAK 1',1,NULL,NULL,'2015-09-30 15:44:33',NULL),(2,'Jenis Bantuan SKAK 2',1,NULL,NULL,'2015-09-30 15:44:35',NULL),(3,'Jenis Bantuan SKAK 3',1,NULL,NULL,'2015-09-30 15:44:39',NULL),(4,'Jenis Bantuan SKAK 4',1,NULL,NULL,'2015-09-30 15:44:43',NULL),(5,'Jenis Bantuan SKAK 5',1,NULL,NULL,'2015-09-30 15:44:46',NULL);

/*Table structure for table `tbl_ref_jenis_biasiswa` */

DROP TABLE IF EXISTS `tbl_ref_jenis_biasiswa`;

CREATE TABLE `tbl_ref_jenis_biasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_biasiswa` */

insert  into `tbl_ref_jenis_biasiswa`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'PTPTN',1,NULL,NULL,'2015-08-25 12:32:04',NULL),(2,'JPA',1,NULL,NULL,'2015-08-25 12:32:17',NULL),(3,'YAYASAN NEGERI',1,NULL,NULL,'2015-08-25 12:32:28',NULL),(4,'MARA',1,NULL,NULL,'2015-08-25 12:32:33',NULL);

/*Table structure for table `tbl_ref_jenis_kebajikan` */

DROP TABLE IF EXISTS `tbl_ref_jenis_kebajikan`;

CREATE TABLE `tbl_ref_jenis_kebajikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_kebajikan` */

insert  into `tbl_ref_jenis_kebajikan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Jenis Kebajikan 1',1,NULL,NULL,'2015-09-30 16:53:34',NULL),(2,'Jenis Kebajikan 2',1,NULL,NULL,'2015-09-30 16:53:36',NULL),(3,'Jenis Kebajikan 3',1,NULL,NULL,'2015-09-30 16:53:41',NULL);

/*Table structure for table `tbl_ref_jenis_lesen_memandu` */

DROP TABLE IF EXISTS `tbl_ref_jenis_lesen_memandu`;

CREATE TABLE `tbl_ref_jenis_lesen_memandu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_lesen_memandu` */

insert  into `tbl_ref_jenis_lesen_memandu`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'B2 & B',1,NULL,NULL,'2015-08-06 22:16:07',NULL),(2,'D',1,NULL,NULL,'2015-08-06 22:16:10',NULL),(3,'E',1,NULL,NULL,'2015-08-06 22:16:11',NULL),(4,'GDL / PSV',1,NULL,NULL,'2015-08-06 22:16:20',NULL),(5,'Conductor',1,NULL,NULL,'2015-08-06 22:16:25',NULL),(6,'H / I',1,NULL,NULL,'2015-08-06 22:16:40',NULL);

/*Table structure for table `tbl_ref_jenis_pendapatan` */

DROP TABLE IF EXISTS `tbl_ref_jenis_pendapatan`;

CREATE TABLE `tbl_ref_jenis_pendapatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_pendapatan` */

insert  into `tbl_ref_jenis_pendapatan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Jenis Pendapatan 1',1,NULL,NULL,'2015-10-07 11:39:50',NULL),(2,'Jenis Pendapatan 2',1,NULL,NULL,'2015-10-07 11:39:53',NULL),(3,'Jenis Pendapatan 3',1,NULL,NULL,'2015-10-07 11:39:56',NULL);

/*Table structure for table `tbl_ref_jenis_permohonan_program_binaan` */

DROP TABLE IF EXISTS `tbl_ref_jenis_permohonan_program_binaan`;

CREATE TABLE `tbl_ref_jenis_permohonan_program_binaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_permohonan_program_binaan` */

insert  into `tbl_ref_jenis_permohonan_program_binaan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Jenis Permohonan Program Binaan 1',1,NULL,NULL,'2015-10-01 16:17:54',NULL),(2,'Jenis Permohonan Program Binaan 2',1,NULL,NULL,'2015-10-01 16:17:56',NULL),(3,'Jenis Permohonan Program Binaan 3',1,NULL,NULL,'2015-10-01 16:18:00',NULL),(4,'Jenis Permohonan Program Binaan 4',1,NULL,NULL,'2015-10-01 16:18:10',NULL),(5,'Jenis Permohonan Program Binaan 5',1,NULL,NULL,'2015-10-01 16:18:14',NULL);

/*Table structure for table `tbl_ref_jenis_pinjaman` */

DROP TABLE IF EXISTS `tbl_ref_jenis_pinjaman`;

CREATE TABLE `tbl_ref_jenis_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_pinjaman` */

insert  into `tbl_ref_jenis_pinjaman`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Jenis Pinjaman 1',1,NULL,NULL,'2015-09-07 13:09:15',NULL),(2,'Jenis Pinjaman 2',1,NULL,NULL,'2015-09-07 13:09:20',NULL);

/*Table structure for table `tbl_ref_jenis_sejarah_perubatan` */

DROP TABLE IF EXISTS `tbl_ref_jenis_sejarah_perubatan`;

CREATE TABLE `tbl_ref_jenis_sejarah_perubatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_jenis_sejarah_perubatan` */

insert  into `tbl_ref_jenis_sejarah_perubatan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Jenis Sejarah Perubatan 1',1,NULL,NULL,'2015-09-10 14:47:03',NULL),(2,'Jenis Sejarah Perubatan 2',1,NULL,NULL,'2015-09-10 14:47:06',NULL),(3,'Jenis Sejarah Perubatan 3',1,NULL,NULL,'2015-09-10 14:47:13',NULL);

/*Table structure for table `tbl_ref_kategori_elaun` */

DROP TABLE IF EXISTS `tbl_ref_kategori_elaun`;

CREATE TABLE `tbl_ref_kategori_elaun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kategori_elaun` */

insert  into `tbl_ref_kategori_elaun`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kategori Elaun 1',1,NULL,NULL,'2015-09-22 15:50:05',NULL),(2,'Kategori Elaun 2',1,NULL,NULL,'2015-09-22 15:50:07',NULL),(3,'Kategori Elaun 3',1,NULL,NULL,'2015-09-22 15:50:14',NULL);

/*Table structure for table `tbl_ref_kategori_insentif` */

DROP TABLE IF EXISTS `tbl_ref_kategori_insentif`;

CREATE TABLE `tbl_ref_kategori_insentif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kategori_insentif` */

insert  into `tbl_ref_kategori_insentif`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kategori Insentif 1',1,NULL,NULL,'2015-10-01 14:25:33',NULL),(2,'Kategori Insentif 2',1,NULL,NULL,'2015-10-01 14:25:36',NULL),(3,'Kategori Insentif 3',1,NULL,NULL,'2015-10-01 14:25:39',NULL);

/*Table structure for table `tbl_ref_kategori_kecergasan` */

DROP TABLE IF EXISTS `tbl_ref_kategori_kecergasan`;

CREATE TABLE `tbl_ref_kategori_kecergasan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kategori_kecergasan` */

insert  into `tbl_ref_kategori_kecergasan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kategori Kecergasan 1',1,NULL,NULL,'2015-09-23 11:17:24',NULL),(2,'Kategori Kecergasan 2',1,NULL,NULL,'2015-09-23 11:17:27',NULL),(3,'Kategori Kecergasan 3',1,NULL,NULL,'2015-09-23 11:17:31',NULL);

/*Table structure for table `tbl_ref_kategori_permohonan_program_binaan` */

DROP TABLE IF EXISTS `tbl_ref_kategori_permohonan_program_binaan`;

CREATE TABLE `tbl_ref_kategori_permohonan_program_binaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kategori_permohonan_program_binaan` */

insert  into `tbl_ref_kategori_permohonan_program_binaan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kategori Permohonan Program Binaan 1',1,NULL,NULL,'2015-10-01 16:14:45',NULL),(2,'Kategori Permohonan Program Binaan 2',1,NULL,NULL,'2015-10-01 16:14:47',NULL),(3,'Kategori Permohonan Program Binaan 3',1,NULL,NULL,'2015-10-01 16:14:50',NULL);

/*Table structure for table `tbl_ref_kategori_persatuan` */

DROP TABLE IF EXISTS `tbl_ref_kategori_persatuan`;

CREATE TABLE `tbl_ref_kategori_persatuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kategori_persatuan` */

insert  into `tbl_ref_kategori_persatuan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kategori Persatuan 1',1,NULL,NULL,'2015-10-05 12:24:24',NULL),(2,'Kategori Persatuan 2',1,NULL,NULL,'2015-10-05 12:24:26',NULL),(3,'Kategori Persatuan 3',1,NULL,NULL,'2015-10-05 12:24:28',NULL),(4,'Kategori Persatuan 4',1,NULL,NULL,'2015-10-05 12:24:31',NULL),(5,'Kategori Persatuan 5',1,NULL,NULL,'2015-10-05 12:24:35',NULL);

/*Table structure for table `tbl_ref_kategori_program` */

DROP TABLE IF EXISTS `tbl_ref_kategori_program`;

CREATE TABLE `tbl_ref_kategori_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kategori_program` */

insert  into `tbl_ref_kategori_program`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kategori Program 1',1,NULL,NULL,'2015-10-05 12:28:36',NULL),(2,'Kategori Program 2',1,NULL,NULL,'2015-10-05 12:28:39',NULL),(3,'Kategori Program 3',1,NULL,NULL,'2015-10-05 12:29:05',NULL);

/*Table structure for table `tbl_ref_kategori_sukan` */

DROP TABLE IF EXISTS `tbl_ref_kategori_sukan`;

CREATE TABLE `tbl_ref_kategori_sukan` (
  `ref_kategori_sukan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori_sukan` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY (`ref_kategori_sukan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kategori_sukan` */

/*Table structure for table `tbl_ref_kejohanan` */

DROP TABLE IF EXISTS `tbl_ref_kejohanan`;

CREATE TABLE `tbl_ref_kejohanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kejohanan` */

insert  into `tbl_ref_kejohanan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kejohanan 1',1,NULL,NULL,'2015-09-23 11:18:23',NULL),(2,'Kejohanan 2',1,NULL,NULL,'2015-09-23 11:18:28',NULL),(3,'Kejohanan 3',1,NULL,NULL,'2015-09-23 11:18:31',NULL),(4,'Kejohanan 4',1,NULL,NULL,'2015-09-23 11:18:35',NULL);

/*Table structure for table `tbl_ref_kelayakan_pingat` */

DROP TABLE IF EXISTS `tbl_ref_kelayakan_pingat`;

CREATE TABLE `tbl_ref_kelayakan_pingat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kelayakan_pingat` */

insert  into `tbl_ref_kelayakan_pingat`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kelayakan Pingat 1',1,NULL,NULL,'2015-10-01 13:14:29',NULL),(2,'Kelayakan Pingat 2',1,NULL,NULL,'2015-10-01 13:14:32',NULL),(3,'Kelayakan Pingat 3',1,NULL,NULL,'2015-10-01 13:14:36',NULL);

/*Table structure for table `tbl_ref_kelulusan` */

DROP TABLE IF EXISTS `tbl_ref_kelulusan`;

CREATE TABLE `tbl_ref_kelulusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kelulusan` */

insert  into `tbl_ref_kelulusan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (0,'Tidak',1,NULL,NULL,'2015-09-30 12:16:39',NULL),(1,'Ya',1,NULL,NULL,'2015-09-30 12:16:45',NULL);

/*Table structure for table `tbl_ref_kumpulan` */

DROP TABLE IF EXISTS `tbl_ref_kumpulan`;

CREATE TABLE `tbl_ref_kumpulan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kumpulan` */

insert  into `tbl_ref_kumpulan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Kumpulan 1',1,NULL,NULL,'2015-10-01 13:02:53',NULL),(2,'Kumpulan 2',1,NULL,NULL,'2015-10-01 13:02:57',NULL),(3,'Kumpulan 3',1,NULL,NULL,'2015-10-01 13:03:01',NULL),(4,'Kumpulan 4',1,NULL,NULL,'2015-10-01 13:03:04',NULL),(5,'Kumpulan 5',1,NULL,NULL,'2015-10-01 13:03:14',NULL);

/*Table structure for table `tbl_ref_kumpulan_darah` */

DROP TABLE IF EXISTS `tbl_ref_kumpulan_darah`;

CREATE TABLE `tbl_ref_kumpulan_darah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_kumpulan_darah` */

insert  into `tbl_ref_kumpulan_darah`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'A',1,NULL,NULL,'2015-09-09 15:05:56',NULL),(2,'B',1,NULL,NULL,'2015-09-09 15:05:58',NULL),(3,'AB',1,NULL,NULL,'2015-09-09 15:06:00',NULL),(4,'O',1,NULL,NULL,'2015-09-09 15:06:04',NULL);

/*Table structure for table `tbl_ref_mesyuarat_ahli_status` */

DROP TABLE IF EXISTS `tbl_ref_mesyuarat_ahli_status`;

CREATE TABLE `tbl_ref_mesyuarat_ahli_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_mesyuarat_ahli_status` */

insert  into `tbl_ref_mesyuarat_ahli_status`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Ahli Status 1',1,NULL,NULL,'2015-10-08 13:48:15',NULL),(2,'Ahli Status 2',1,NULL,NULL,'2015-10-08 13:48:17',NULL),(3,'Ahli Status 3',1,NULL,NULL,'2015-10-08 13:48:20',NULL);

/*Table structure for table `tbl_ref_mesyuarat_pegawai` */

DROP TABLE IF EXISTS `tbl_ref_mesyuarat_pegawai`;

CREATE TABLE `tbl_ref_mesyuarat_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_mesyuarat_pegawai` */

insert  into `tbl_ref_mesyuarat_pegawai`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Mesyuarat Pegawai A',1,NULL,NULL,'2015-10-08 14:26:08',NULL),(2,'Mesyuarat Pegawai B',1,NULL,NULL,'2015-10-08 14:26:11',NULL),(3,'Mesyuarat Pegawai C',1,NULL,NULL,'2015-10-08 14:26:14',NULL),(4,'Mesyuarat Pegawai D',1,NULL,NULL,'2015-10-08 14:26:17',NULL);

/*Table structure for table `tbl_ref_mesyuarat_tugas_status` */

DROP TABLE IF EXISTS `tbl_ref_mesyuarat_tugas_status`;

CREATE TABLE `tbl_ref_mesyuarat_tugas_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_mesyuarat_tugas_status` */

insert  into `tbl_ref_mesyuarat_tugas_status`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Mesyuarat Tugas Status 1',1,NULL,NULL,'2015-10-08 14:28:34',NULL),(2,'Mesyuarat Tugas Status 2',1,NULL,NULL,'2015-10-08 14:28:59',NULL),(3,'Mesyuarat Tugas Status 3',1,NULL,NULL,'2015-10-08 14:29:03',NULL);

/*Table structure for table `tbl_ref_nama_insentif` */

DROP TABLE IF EXISTS `tbl_ref_nama_insentif`;

CREATE TABLE `tbl_ref_nama_insentif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_nama_insentif` */

insert  into `tbl_ref_nama_insentif`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Nama Insentif 1',1,NULL,NULL,'2015-10-01 12:59:27',NULL),(2,'Nama Insentif 2',1,NULL,NULL,'2015-10-01 12:59:30',NULL),(3,'Nama Insentif 3',1,NULL,NULL,'2015-10-01 12:59:35',NULL);

/*Table structure for table `tbl_ref_negeri` */

DROP TABLE IF EXISTS `tbl_ref_negeri`;

CREATE TABLE `tbl_ref_negeri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_negeri` */

insert  into `tbl_ref_negeri`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Johor',1,NULL,NULL,'2015-08-06 16:59:22',NULL),(2,'Kedah',1,NULL,NULL,'2015-08-06 16:59:29',NULL),(3,'Kelantan',1,NULL,NULL,'2015-08-06 16:59:42',NULL),(4,'Melaka',1,NULL,NULL,'2015-08-06 16:59:47',NULL),(5,'Negeri Sembilan',1,NULL,NULL,'2015-08-06 16:59:51',NULL),(6,'Pahang',1,NULL,NULL,'2015-08-06 16:59:57',NULL),(7,'Pulau Pinang',1,NULL,NULL,'2015-08-06 17:00:01',NULL),(8,'Perak',1,NULL,NULL,'2015-08-06 17:00:06',NULL),(9,'Perlis',1,NULL,NULL,'2015-08-06 17:00:16',NULL),(10,'Selangor',1,NULL,NULL,'2015-08-06 17:00:21',NULL),(11,'Terengganu',1,NULL,NULL,'2015-08-06 17:00:27',NULL),(12,'Sabah',1,NULL,NULL,'2015-08-06 17:00:30',NULL),(13,'Sarawak',1,NULL,NULL,'2015-08-06 17:00:33',NULL),(14,'Wilayah Persekutuan Kuala Lumpur',1,NULL,NULL,'2015-08-06 17:00:47',NULL),(15,'Wilayah Persekutuan Labuan',1,NULL,NULL,'2015-08-07 09:50:01',NULL),(16,'Wilayah Persekutuan Putrajaya',1,NULL,NULL,'2015-08-07 09:50:04',NULL);

/*Table structure for table `tbl_ref_penyakit` */

DROP TABLE IF EXISTS `tbl_ref_penyakit`;

CREATE TABLE `tbl_ref_penyakit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_penyakit` */

insert  into `tbl_ref_penyakit`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Biologi Darah',1,NULL,NULL,'2015-09-09 15:16:27',NULL),(2,'Bronkiolitis',1,NULL,NULL,'2015-09-09 15:16:59',NULL);

/*Table structure for table `tbl_ref_peringkat_badan_sukan` */

DROP TABLE IF EXISTS `tbl_ref_peringkat_badan_sukan`;

CREATE TABLE `tbl_ref_peringkat_badan_sukan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_peringkat_badan_sukan` */

insert  into `tbl_ref_peringkat_badan_sukan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Peringkat Badan Sukan 1',1,NULL,NULL,'2015-10-02 11:54:18',NULL),(2,'Peringkat Badan Sukan 2',1,NULL,NULL,'2015-10-02 11:54:20',NULL),(3,'Peringkat Badan Sukan 3',1,NULL,NULL,'2015-10-02 11:54:23',NULL),(4,'Peringkat Badan Sukan 4',1,NULL,NULL,'2015-10-02 11:54:26',NULL),(5,'Peringkat Badan Sukan 5',1,NULL,NULL,'2015-10-02 11:54:29',NULL);

/*Table structure for table `tbl_ref_persatuan` */

DROP TABLE IF EXISTS `tbl_ref_persatuan`;

CREATE TABLE `tbl_ref_persatuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_persatuan` */

insert  into `tbl_ref_persatuan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Persatuan 1',1,NULL,NULL,'2015-10-01 14:05:33',NULL),(2,'Persatuan 2',1,NULL,NULL,'2015-10-01 14:05:38',NULL),(3,'Persatuan 3',1,NULL,NULL,'2015-10-01 14:05:41',NULL),(4,'Persatuan 4',1,NULL,NULL,'2015-10-01 14:05:44',NULL),(5,'Persatuan 5',1,NULL,NULL,'2015-10-01 14:05:48',NULL);

/*Table structure for table `tbl_ref_pingat` */

DROP TABLE IF EXISTS `tbl_ref_pingat`;

CREATE TABLE `tbl_ref_pingat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_pingat` */

insert  into `tbl_ref_pingat`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Pingat 1',1,NULL,NULL,'2015-10-01 14:14:44',NULL),(2,'Pingat 2',1,NULL,NULL,'2015-10-01 14:14:49',NULL),(3,'Pingat 3',1,NULL,NULL,'2015-10-01 14:14:52',NULL);

/*Table structure for table `tbl_ref_program` */

DROP TABLE IF EXISTS `tbl_ref_program`;

CREATE TABLE `tbl_ref_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_program` */

insert  into `tbl_ref_program`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Program 1',1,NULL,NULL,'2015-09-23 18:18:58',NULL),(2,'Program 2',1,NULL,NULL,'2015-09-23 18:19:00',NULL),(3,'Program 3',1,NULL,NULL,'2015-09-23 18:19:04',NULL),(4,'Program 4',1,NULL,NULL,'2015-09-23 18:19:10',NULL);

/*Table structure for table `tbl_ref_rekod_baru` */

DROP TABLE IF EXISTS `tbl_ref_rekod_baru`;

CREATE TABLE `tbl_ref_rekod_baru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_rekod_baru` */

insert  into `tbl_ref_rekod_baru`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Rekod Baru 1',1,NULL,NULL,'2015-10-01 13:06:36',NULL),(2,'Rekod Baru 2',1,NULL,NULL,'2015-10-01 13:06:41',NULL),(3,'Rekod Baru 3',1,NULL,NULL,'2015-10-01 13:06:45',NULL),(4,'Rekod Baru 4',1,NULL,NULL,'2015-10-01 13:06:48',NULL);

/*Table structure for table `tbl_ref_sixstep_stage` */

DROP TABLE IF EXISTS `tbl_ref_sixstep_stage`;

CREATE TABLE `tbl_ref_sixstep_stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_sixstep_stage` */

insert  into `tbl_ref_sixstep_stage`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Stage 1',1,NULL,NULL,'2015-10-07 16:43:26',NULL),(2,'Stage 2',1,NULL,NULL,'2015-10-07 16:43:29',NULL),(3,'Stage 3',1,NULL,NULL,'2015-10-07 16:43:32',NULL),(4,'Stage 4',1,NULL,NULL,'2015-10-07 16:43:34',NULL),(5,'Stage 5',1,NULL,NULL,'2015-10-07 16:43:39',NULL),(6,'Stage 6',1,NULL,NULL,'2015-10-07 16:43:43',NULL);

/*Table structure for table `tbl_ref_sixstep_status` */

DROP TABLE IF EXISTS `tbl_ref_sixstep_status`;

CREATE TABLE `tbl_ref_sixstep_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_sixstep_status` */

insert  into `tbl_ref_sixstep_status`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Status 1',1,NULL,NULL,'2015-10-07 16:48:37',NULL),(2,'Status 2',1,NULL,NULL,'2015-10-07 16:48:40',NULL),(3,'Status 3',1,NULL,NULL,'2015-10-07 16:48:43',NULL),(4,'Status 4',1,NULL,NULL,'2015-10-07 16:48:46',NULL);

/*Table structure for table `tbl_ref_sokongan` */

DROP TABLE IF EXISTS `tbl_ref_sokongan`;

CREATE TABLE `tbl_ref_sokongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_sokongan` */

insert  into `tbl_ref_sokongan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Pejabat peringkat daerah ',1,NULL,NULL,'2015-10-05 12:30:04',NULL),(2,'Jabatan belia dan Sukan Negeri ',1,NULL,NULL,'2015-10-05 12:30:06',NULL),(3,'Jabatan belia dan Sukan Negara ',1,NULL,NULL,'2015-10-05 12:30:09',NULL);

/*Table structure for table `tbl_ref_status_elaun` */

DROP TABLE IF EXISTS `tbl_ref_status_elaun`;

CREATE TABLE `tbl_ref_status_elaun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_status_elaun` */

insert  into `tbl_ref_status_elaun`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Status Elaun 1',1,NULL,NULL,'2015-09-22 17:07:24',NULL),(2,'Status Elaun 2',1,NULL,NULL,'2015-09-22 17:07:27',NULL),(3,'Status Elaun 3',1,NULL,NULL,'2015-09-22 17:07:33',NULL);

/*Table structure for table `tbl_ref_sukan` */

DROP TABLE IF EXISTS `tbl_ref_sukan`;

CREATE TABLE `tbl_ref_sukan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_kategori_sukan_id` int(11) NOT NULL,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_sukan` */

insert  into `tbl_ref_sukan`(`id`,`ref_kategori_sukan_id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,0,'Tenis',1,NULL,NULL,'2015-09-28 16:25:04',NULL),(2,0,'Badminton',1,NULL,NULL,'2015-09-28 16:25:04',NULL),(3,0,'Boling',1,NULL,NULL,'2015-09-28 16:25:04',NULL),(4,0,'Hoki',1,NULL,NULL,'2015-09-28 16:25:04',NULL),(5,0,'Bola Sepak',1,NULL,NULL,'2015-09-28 16:25:04',NULL);

/*Table structure for table `tbl_ref_tahap_pendidikan` */

DROP TABLE IF EXISTS `tbl_ref_tahap_pendidikan`;

CREATE TABLE `tbl_ref_tahap_pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_tahap_pendidikan` */

insert  into `tbl_ref_tahap_pendidikan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'SPM',1,NULL,NULL,'2015-08-25 12:24:35',NULL),(2,'STPM',1,NULL,NULL,'2015-08-25 12:24:39',NULL),(3,'Kolej',1,NULL,NULL,'2015-08-25 12:24:49',NULL),(4,'Universiti',1,NULL,NULL,'2015-08-25 19:20:02',NULL);

/*Table structure for table `tbl_ref_taraf_perkahwinan` */

DROP TABLE IF EXISTS `tbl_ref_taraf_perkahwinan`;

CREATE TABLE `tbl_ref_taraf_perkahwinan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ref_taraf_perkahwinan` */

insert  into `tbl_ref_taraf_perkahwinan`(`id`,`desc`,`aktif`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Bujang',1,NULL,NULL,'2015-08-06 21:55:26',NULL),(2,'Berkahwin',1,NULL,NULL,'2015-08-06 21:55:32',NULL),(3,'Bercerai',1,NULL,NULL,'2015-08-06 21:57:22',NULL),(4,'Duda / Janda',1,NULL,NULL,'2015-08-06 21:57:59',NULL),(5,'Lain-lain',1,NULL,NULL,'2015-08-06 21:58:08',NULL);

/*Table structure for table `tbl_rehabilitasi` */

DROP TABLE IF EXISTS `tbl_rehabilitasi`;

CREATE TABLE `tbl_rehabilitasi` (
  `rehabilitasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `pl_diagnosis_preskripsi_pemeriksaan_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `kesan_klinikal` varchar(255) DEFAULT NULL,
  `masalah_yang_dikenal_pasti` varchar(255) NOT NULL,
  `potensi_rehabilitasi` varchar(255) DEFAULT NULL,
  `matlamat_rehabilitasi` varchar(255) NOT NULL,
  PRIMARY KEY (`rehabilitasi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rehabilitasi` */

/*Table structure for table `tbl_rehabilitasi_program` */

DROP TABLE IF EXISTS `tbl_rehabilitasi_program`;

CREATE TABLE `tbl_rehabilitasi_program` (
  `rehabilitasi_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `rehabilitasi_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `nama_exercise_modality` varchar(80) NOT NULL,
  PRIMARY KEY (`rehabilitasi_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rehabilitasi_program` */

/*Table structure for table `tbl_satelit` */

DROP TABLE IF EXISTS `tbl_satelit`;

CREATE TABLE `tbl_satelit` (
  `satelit_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `sukan` varchar(30) NOT NULL,
  `perkhidmatan` varchar(80) NOT NULL,
  `fasiliti` varchar(80) NOT NULL,
  PRIMARY KEY (`satelit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_satelit` */

/*Table structure for table `tbl_senarai_atlet` */

DROP TABLE IF EXISTS `tbl_senarai_atlet`;

CREATE TABLE `tbl_senarai_atlet` (
  `senarai_atlet_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_jkk_jkp_program_id` int(11) NOT NULL,
  `atlet` varchar(80) NOT NULL,
  PRIMARY KEY (`senarai_atlet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_senarai_atlet` */

/*Table structure for table `tbl_senarai_harga_perkhidmatan_ubatan_peralatan` */

DROP TABLE IF EXISTS `tbl_senarai_harga_perkhidmatan_ubatan_peralatan`;

CREATE TABLE `tbl_senarai_harga_perkhidmatan_ubatan_peralatan` (
  `senarai_harga_perkhidmatan_ubatan_peralatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perkhidmatan_ubatan_peralatan` varchar(80) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`senarai_harga_perkhidmatan_ubatan_peralatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_senarai_harga_perkhidmatan_ubatan_peralatan` */

/*Table structure for table `tbl_senarai_jurulatih` */

DROP TABLE IF EXISTS `tbl_senarai_jurulatih`;

CREATE TABLE `tbl_senarai_jurulatih` (
  `senarai_jurulatih_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengurusan_jkk_jkp_program_id` int(11) NOT NULL,
  `jurulatih` varchar(80) NOT NULL,
  PRIMARY KEY (`senarai_jurulatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_senarai_jurulatih` */

/*Table structure for table `tbl_six_step` */

DROP TABLE IF EXISTS `tbl_six_step`;

CREATE TABLE `tbl_six_step` (
  `six_step_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `kategori_atlet` varchar(30) DEFAULT NULL,
  `sukan` varchar(80) DEFAULT NULL,
  `acara` varchar(80) DEFAULT NULL,
  `stage` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`six_step_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_six_step` */

insert  into `tbl_six_step`(`six_step_id`,`atlet_id`,`kategori_atlet`,`sukan`,`acara`,`stage`,`status`) values (1,3,'3','1','2','2','2'),(2,4,'2','3','7','3','1'),(3,2,'2','5','12','3','2');

/*Table structure for table `tbl_skim_kebajikan` */

DROP TABLE IF EXISTS `tbl_skim_kebajikan`;

CREATE TABLE `tbl_skim_kebajikan` (
  `skim_kebajikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_bantuan_skak` varchar(30) NOT NULL,
  `jumlah_bantuan` decimal(10,2) NOT NULL,
  `nama_pemohon` varchar(80) NOT NULL,
  `nama_penerima` varchar(80) NOT NULL,
  `jenis_sukan` varchar(30) NOT NULL,
  `masalah_dihadapi` varchar(100) DEFAULT NULL,
  `tarikh_kejadian` date DEFAULT NULL,
  `lokasi_kejadian` varchar(90) DEFAULT NULL,
  `jenis_bantuan_lain_yang_diterima` varchar(30) DEFAULT NULL,
  `kelulusan` tinyint(1) NOT NULL,
  PRIMARY KEY (`skim_kebajikan_id`),
  KEY `skim_kebajikan_id` (`skim_kebajikan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_skim_kebajikan` */

insert  into `tbl_skim_kebajikan`(`skim_kebajikan_id`,`jenis_bantuan_skak`,`jumlah_bantuan`,`nama_pemohon`,`nama_penerima`,`jenis_sukan`,`masalah_dihadapi`,`tarikh_kejadian`,`lokasi_kejadian`,`jenis_bantuan_lain_yang_diterima`,`kelulusan`) values (1,'3','20000.00','3','Ken','4','Kaki Sakit','2015-07-17','Stadium Bukit Jalil','Allowance',0),(3,'5','20.00','4','Kahmel','2','Tangan','2015-04-08','Stadium Merdeka','',0);

/*Table structure for table `tbl_soal_selidik_sebelum_ujian` */

DROP TABLE IF EXISTS `tbl_soal_selidik_sebelum_ujian`;

CREATE TABLE `tbl_soal_selidik_sebelum_ujian` (
  `soal_selidik_sebelum_ujian_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `soalan` varchar(80) NOT NULL,
  `jawapan` varchar(30) NOT NULL,
  PRIMARY KEY (`soal_selidik_sebelum_ujian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_soal_selidik_sebelum_ujian` */

/*Table structure for table `tbl_soalan_penilaian` */

DROP TABLE IF EXISTS `tbl_soalan_penilaian`;

CREATE TABLE `tbl_soalan_penilaian` (
  `soalan_penilaian_id` int(11) NOT NULL AUTO_INCREMENT,
  `borang_penilaian_id` int(11) NOT NULL,
  `bahagian` varchar(80) NOT NULL,
  `soalan` varchar(255) NOT NULL,
  `jawapan` int(11) NOT NULL,
  PRIMARY KEY (`soalan_penilaian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_soalan_penilaian` */

/*Table structure for table `tbl_sukarelawan` */

DROP TABLE IF EXISTS `tbl_sukarelawan`;

CREATE TABLE `tbl_sukarelawan` (
  `sukarelawan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `tarikh_lahir` date NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `saiz_baju` varchar(30) NOT NULL,
  `no_tel_bimbit` varchar(14) NOT NULL,
  `status` varchar(30) NOT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `kebatasan_fizikal` tinyint(1) NOT NULL,
  `menyatakan_jika_ada_kebatasan_fizikal` varchar(80) DEFAULT NULL,
  `kelulusan_akademi` varchar(80) NOT NULL,
  `bidang_kepakaran` varchar(80) NOT NULL,
  `pekerjaan_semasa` varchar(80) NOT NULL,
  `nama_majikan` varchar(80) DEFAULT NULL,
  `alamat_majikan_1` varchar(90) NOT NULL,
  `alamat_majikan_2` varchar(90) DEFAULT NULL,
  `alamat_majikan_3` varchar(90) DEFAULT NULL,
  `alamat_majikan_negeri` varchar(30) NOT NULL,
  `alamat_majikan_bandar` varchar(40) NOT NULL,
  `alamat_majikan_poskod` varchar(5) NOT NULL,
  `bidang_diminati` varchar(80) NOT NULL,
  `bidang_diminati_lain_lain` varchar(100) DEFAULT NULL,
  `waktu_ketika_diperlukan` varchar(80) NOT NULL,
  `menyatakan_waktu_ketika_diperlukan` varchar(80) NOT NULL,
  `muatnaik` varchar(100) DEFAULT NULL,
  `clause` tinyint(1) NOT NULL,
  PRIMARY KEY (`sukarelawan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sukarelawan` */

/*Table structure for table `tbl_tempahan_kemudahan` */

DROP TABLE IF EXISTS `tbl_tempahan_kemudahan`;

CREATE TABLE `tbl_tempahan_kemudahan` (
  `tempahan_kemudahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `no_kad_pengenalan` varchar(12) NOT NULL,
  `no_tel` varchar(14) NOT NULL,
  `emel` varchar(100) NOT NULL,
  `location` varchar(90) NOT NULL,
  `venue` varchar(80) NOT NULL,
  `kemudahan` varchar(80) NOT NULL,
  `bayaran_sewa` decimal(10,2) NOT NULL,
  `tarikh_mula` datetime NOT NULL,
  `tarikh_akhir` datetime NOT NULL,
  `lelaki` int(11) DEFAULT NULL,
  `wanita` int(11) DEFAULT NULL,
  `melayu` int(11) DEFAULT NULL,
  `cina` int(11) DEFAULT NULL,
  `india` int(11) DEFAULT NULL,
  `lain_lain` int(11) DEFAULT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tempahan_kemudahan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_tempahan_kemudahan` */

/*Table structure for table `tbl_tempahan_kursus_persatuan` */

DROP TABLE IF EXISTS `tbl_tempahan_kursus_persatuan`;

CREATE TABLE `tbl_tempahan_kursus_persatuan` (
  `tempahan_kursus_persatuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kursus_persatuan_id` int(11) NOT NULL,
  `tarikh` date NOT NULL,
  `jenis_tempahan` varchar(30) NOT NULL,
  `unit_tempahan` int(11) NOT NULL,
  `kos_tempahan` decimal(10,2) NOT NULL,
  PRIMARY KEY (`tempahan_kursus_persatuan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_tempahan_kursus_persatuan` */

/*Table structure for table `tbl_temujanji_komplimentari` */

DROP TABLE IF EXISTS `tbl_temujanji_komplimentari`;

CREATE TABLE `tbl_temujanji_komplimentari` (
  `temujanji_komplimentari_id` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `jenis_sukan` varchar(80) NOT NULL,
  `perkhidmatan` varchar(80) NOT NULL,
  `tarikh_khidmat` date NOT NULL,
  `lokasi` varchar(90) NOT NULL,
  `pegawai_yang_bertanggungjawab` varchar(80) NOT NULL,
  `status_temujanji` varchar(30) NOT NULL,
  `catitan_ringkas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`temujanji_komplimentari_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_temujanji_komplimentari` */

/*Table structure for table `tbl_ujian_saringan` */

DROP TABLE IF EXISTS `tbl_ujian_saringan`;

CREATE TABLE `tbl_ujian_saringan` (
  `ujian_saringan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) NOT NULL,
  `sekolah` varchar(80) NOT NULL,
  `alamat_1` varchar(90) NOT NULL,
  `alamat_2` varchar(90) DEFAULT NULL,
  `alamat_3` varchar(90) DEFAULT NULL,
  `alamat_negeri` varchar(30) NOT NULL,
  `alamat_bandar` varchar(40) NOT NULL,
  `alamat_poskod` varchar(5) NOT NULL,
  `jantina` varchar(1) NOT NULL,
  `no_telefon` varchar(14) NOT NULL,
  `darjah` varchar(30) NOT NULL,
  `berat_badan` decimal(10,2) NOT NULL,
  `ketinggian` decimal(10,2) NOT NULL,
  `tinggi_duduk` decimal(10,2) NOT NULL,
  `panjang_depa` decimal(10,2) NOT NULL,
  `body_mass_index` decimal(10,2) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ujian_saringan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ujian_saringan` */

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `peranan` int(11) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel_mobile_no` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `tel_no` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_user` */

/*Table structure for table `tbl_user_peranan` */

DROP TABLE IF EXISTS `tbl_user_peranan`;

CREATE TABLE `tbl_user_peranan` (
  `user_peranan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peranan` varchar(80) NOT NULL,
  `peranan_akses` varchar(80) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_peranan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user_peranan` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `status_code` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`status_code`,`created_at`,`updated_at`) values (1,'kbsuser','H0R4PlQqgpM9DpBVcqhikNvwtfHz_fyf','$2y$13$o45d7NUI4ZD.ymbpOhQQiOf11SL6Cjg2k49tzi0BHD17vUHbaqJTq',NULL,'kbsuser@kbs.com',10,'',1439436263,1439436263),(2,'admin','_1VItV2nMtGjrnZVxsK3idairbmhNiNS','$2y$13$vJV.6BrVNz75YzEG1M.vh.FuRCLOhYH9/AZggjEB5xqj11MXfT0NS',NULL,'admin@lunas.com',10,'',1443497431,1443497431);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
