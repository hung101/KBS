<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use kartik\widgets\SideNav;

use app\models\UserPeranan;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href=<?= Yii::$app->getUrlManager()->getBaseUrl() . "/img/favicon.png"?>>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode("SPSB :: " . $this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img id="kbs_logo" src="' . Yii::$app->getUrlManager()->getBaseUrl() . '/img/kbs-logo.png" alt="KBS Logo">',
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => ['class'=>'container-fluid'],
                'options' => [
                    'class' => 'navbar-default',
                ],
            ]);
            
            if (Yii::$app->user->isGuest) {
                //$topMenuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $topMenuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                
            } else {
                // Login User System
                
                // get User Access Row
                //$modelUserPeranan = UserPeranan::findOne(['user_peranan_id' => Yii::$app->user->identity->peranan, 'aktif' => 1]);
                //Yii::$app->user->identity->peranan_akses = $modelUserPeranan->peranan_akses;
                /*if(isset($modelUserPeranan->peranan_akses)){
                    Yii::$app->user->identity->peranan_akses = json_decode($modelUserPeranan->peranan_akses, true);
                }*/
                
                
                //echo "Edward Access Role = " . print_r(Yii::$app->user->identity->peranan_akses) . "<br>";
                
                $sideMenuItems[] = ['label' => 'Dashboard', 'url' => ['/site/index']];
                /*$sideMenuItems[] = ['label' => 'Atlet', 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => 'Jurulatih', 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => 'MSN', 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => 'ISN', 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => 'PJS', 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => 'KBS', 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];*/
                
                if(isset(Yii::$app->user->identity->peranan_akses['MSN'])){
                    $sideMenuItems[] = ['label' => 'MSN', 'url' => ['#'],'items' => [
                        ['label' => 'Atlet', 'url' => ['/atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                        ['label' => 'Pembayaran Elaun', 'url' => ['/pembayaran-elaun/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['module'])],
                        ['label' => 'Penilaian Pestasi', 'url' => ['/penilaian-pestasi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['module'])],
                        [
                            'label' => 'Pengurusan Semua Kemudahan Atlet', 
                            'items' => [
                                ['label' => 'Permohonan Kemudahan Ticket Kapal Terbang', 'url' => ['/permohonan-kemudahan-ticket-kapal-terbang/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['module'])],
                                ['label' => 'Permohonan Peralatan', 'url' => ['/permohonan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['module'])],
                            ],
                        ],
                        ['label' => 'Skim Kebajikan', 'url' => ['/skim-kebajikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['module'])],
                        ['label' => 'Jenis Kebajikan', 'url' => ['/jenis-kebajikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['jenis-kebajikan']['module'])],
                        ['label' => 'Pengurusan Insurans', 'url' => ['/pengurusan-insuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insuran']['module'])],
                        ['label' => 'Pengurusan Insentif', 'url' => ['/pengurusan-insentif/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['module'])],
                        [
                            'label' => 'Permohonan Program Binaan',
                            'items' => [
                                ['label' => 'Permohonan Program Binaan', 'url' => ['/pengurusan-program-binaan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['module'])],
                                ['label' => 'Borang Penyertaan Atlet', 'url' => ['/borang-penyertaan-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penyertaan-atlet']['module'])],
                            ],
                        ],
                        [
                            'label' => 'Pengurusan Bimbingan Kaunseling dan Kerjaya ',
                            'items' => [
                                ['label' => 'Profil Kaunselor', 'url' => ['/profil-konsultan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-konsultan']['module'])],
                                ['label' => 'Permohonan Bimbingan Kaunseling', 'url' => ['/permohonan-bimbingan-kaunseling/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['module'])],
                                ['label' => 'Borang Aduan Atlet', 'url' => ['/borang-aduan-kaunseling/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kaunseling']['module'])],
                                ['label' => 'Laporan Sesi Kaunseling', 'url' => ['/borang-penilaian-kaunseling/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penilaian-kaunseling']['module'])],
                            ],
                        ],
                        [
                            'label' => 'Pengurusan Pendidikan Atlet',
                            'items' => [
                                ['label' => 'Permohonan Pendidikan', 'url' => ['/permohonan-pendidikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-pendidikan']['module'])],
                                ['label' => 'Pertukaran Pengajian', 'url' => ['/pertukaran-pengajian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['module'])],
                                ['label' => 'Permohonan Biasiswa', 'url' => ['/permohonan-biasiswa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-biasiswa']['module'])],
                                ['label' => 'Pengurusan Pengangkutan', 'url' => ['/pengurusan-shuttle-bus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-shuttle-bus']['module'])],
                                ['label' => 'Pengurusan Sajian Makan', 'url' => ['/pengurusan-sajian-makan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-sajian-makan']['module'])],
                                ['label' => 'Pengurusan Penginapan', 'url' => ['/pengurusan-penginapan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penginapan']['module'])],
                                ['label' => 'Pengurusan Biasiswa Atlet', 'url' => ['/pengurusan-biasiswa-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-biasiswa-atlet']['module'])],
                            ],
                        ],
                        ['label' => 'Pengurusan Kewangan', 'url' => ['/pengurusan-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['module'])],
                        ['label' => 'Penilaian Prestasi', 'url' => ['/penilaian-pestasi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['module'])],
                        ['label' => 'Perancangan Program', 'url' => ['/perancangan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['module'])],
                        [
                            'label' => 'Pengurusan Media',
                            'items' => [
                                ['label' => 'Pengurusan Media', 'url' => ['/pengurusan-media-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['module'])],
                                ['label' => 'Profil Wartawan Sukan', 'url' => ['/profil-wartawan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-wartawan-sukan']['module'])],
                            ],
                        ],
                        ['label' => 'Pengurusan Kejohanan Temasya Yang Disertai Oleh Atlet ', 'url' => ['/pengurusan-kejohanan-temasya-main/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kejohanan-temasya-main']['module'])],
                        ['label' => 'Pengurusan Mesyuarat/ Perbincangan Secara Online', 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        [
                            'label' => 'Pengurusan Jaringan Antarabangsa ',
                            'items' => [
                                ['label' => 'Pengurusan Jaringan Antarabangsa', 'url' => ['/pengurusan-jaringan-antarabangsa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jaringan-antarabangsa']['module'])],
                                ['label' => 'Pengurusan Berita Antarabangsa', 'url' => ['/pengurusan-berita-antarabangsa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-berita-antarabangsa']['module'])],
                                ['label' => 'Pengurusan Anjuran', 'url' => ['/pengurusan-anjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-anjuran']['module'])],
                                ['label' => 'Pengurusan MOU - MOA Antarabangsa', 'url' => ['/pengurusan-mou-moa-antarabangsa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-mou-moa-antarabangsa']['module'])],
                            ],
                        ],
                        [
                            'label' => 'Pengurusan Venue Latihan, Kemudahan Serta Spesifikasi Teknikal',
                            'items' => [
                                ['label' => 'Pengurusan Venue', 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-venue']['module'])],
                                ['label' => 'Pengurusan Kemudahan', 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['module'])],
                                ['label' => 'Pengurusan Peralatan', 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                ['label' => 'Kemudahan Aduan', 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan']['module'])],
                                ['label' => 'Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                                ['label' => 'Tempahan', 'url' => ['/tempahan-kemudahan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['module'])],
                            ],
                        ],
                        ['label' => 'Penyelidikan Program Latihan', 'url' => ['/atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                        [
                            'label' => 'Pengurusan Jawatankuasa Kerja (JKK)/Jawatankuasa Program  (JKP)/ Lembaga Pengarah/ Lembaga Institut',
                            'items' => [
                                ['label' => 'Pengurusan JKK/JKP', 'url' => ['/pengurusan-jkk-jkp/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['module'])],
                                ['label' => 'Pengurusan JKK/JKP Program', 'url' => ['/pengurusan-jkk-jkp-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp-program']['module'])],
                                ['label' => 'Pengurusan JKK/JKP Bajet', 'url' => ['/pengurusan-jkk-jkp-bajet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp-bajet']['module'])],
                            ],
                        ],
                        ['label' => 'Pengkomputeran Penilaian Presatasi Sukan Dan Program Latihan', 'url' => ['/atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                        ['label' => 'Pengurusan Perhimpunan / Kem Atlet', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        ['label' => 'Pengurusan KPI', 'url' => ['/pengurusan-kpi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kpi']['module'])],
                        [
                            'label' => 'Pengurusan Pusat Latihan',
                            'items' => [
                                ['label' => 'Pengurusan Venue', 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-venue']['module'])],
                                ['label' => 'Pengurusan Kemudahan', 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['module'])],
                                ['label' => 'Pengurusan Peralatan', 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                ['label' => 'Kemudahan Aduan', 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan']['module'])],
                                ['label' => 'Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                            ],
                        ],
                        ['label' => 'Pengurusan Kejohanan', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        ['label' => 'Pengurusan Program Binaan', 'url' => ['/pengurusan-program-binaan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['module'])],
                        ['label' => 'Pengurusan USPTN', 'url' => ['/pengurusan-upstn/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                        ['label' => 'Perlantikan Jurulatih Baru, Pengurusan Profil Jurulatih, Pengurusan Program Latihan Jurulatih', 'url' => ['/jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['module'])],
                        ['label' => 'Pengurusan Pemantauan Dan Penilaian Jurulatih', 'url' => ['/pengurusan-pemantauan-dan-penilaian-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-pemantauan-dan-penilaian-jurulatih']['module'])],
                        ['label' => 'Pengurusan Penyambungan Dan Penamatan Kontrak Jurulatih', 'url' => ['/pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['module'])],
                        ['label' => 'Pengurusan Bayaran Elaun dan Gaji Jurulatih Sambilan', 'url' => ['/gaji-dan-elaun-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['module'])],
                        ['label' => 'Geran Bantuan Gaji', 'url' => ['/geran-bantuan-gaji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['module'])],
                        ['label' => 'Peningkatan Kerjaya Jurulatih', 'url' => ['/akk-program-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['akk-program-jurulatih']['module'])],
                        [
                            'label' => 'Merekod Maklumat Sukan / Program Termasuk',
                            'items' => [
                                ['label' => 'Penilaian Prestasi Kejohanan', 'url' => ['/penyertaan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['module'])],
                                ['label' => 'Aduan', 'url' => ['/penyertaan-sukan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan-aduan']['module'])],
                            ],
                        ],
                        ['label' => 'Pengurusan Kewangan', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        ['label' => 'Kemasukan Dan Pengumpulan Data Maklumat Sukan Yang Dianjurkan', 'url' => ['/pengurusan-kejohanan-temasya-main/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kejohanan-temasya-main']['module'])],
                        ['label' => 'Penilaian Prestasi', 'url' => ['/penyertaan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['module'])],
                        ['label' => 'Perancangan Program', 'url' => ['/perancangan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['module'])],
                        [
                            'label' => 'Pengurusan Media',
                            'items' => [
                                ['label' => 'Pengurusan Media', 'url' => ['/pengurusan-media-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['module'])],
                                ['label' => 'Profil Wartawan Sukan', 'url' => ['/profil-wartawan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-wartawan-sukan']['module'])],
                            ],
                        ],
                        ['label' => 'Pengurusan Mesyuarat / Perbincangan Secara Online', 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        [
                            'label' => 'Pengurusan Anugerah Sukan',
                            'items' => [
                                ['label' => 'Anugerah Pencalonan Atlet', 'url' => ['/anugerah-pencalonan-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['module'])],
                                ['label' => 'Anugerah Pelaksaan Majlis', 'url' => ['/anugerah-pelaksaan-majlis/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pelaksaan-majlis']['module'])],
                            ],
                        ],
                        ['label' => 'Pengurusan Bantuan Geran Penganjuran', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        ['label' => 'Pengurusan Anjuran Kejohanan', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        ['label' => 'Pengurusan Bantuan Geran Penganjuran', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        ['label' => 'Pengurusan Bantuan Geran Teknikal Dan Kepegawaian', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        ['label' => 'Pengurusan Jawatankuasa – Jawatankuasa Khas', 'url' => ['/muat-naik-dokumen/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['muat-naik-dokumen']['module'])],
                        ['label' => 'Jawatankuasa Tertinggi Sukan Malaysia Teknikal dan Pertandingan', 'url' => ['/muat-naik-dokumen/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        ['label' => 'Pengurusan Penstruktur Kurikulum / Silibus Pegawai Teknikal', 'url' => ['/permohonan-perganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['module'])],
                        ['label' => 'Pengurusan Pembekalan Penyediaan Sukatan/Manual Teknikal Dan Kepegawaian', 'url' => ['/permohonan-perganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['module'])],
                        ['label' => 'Pengurusan Maklumat PSK', 'url' => ['/pengurusan-maklumat-psk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklumat-psk']['module'])],
                        [
                            'label' => 'Program Persatuan Sukan Kebangsaan (input oleh Cawangan)',
                            'items' => [
                                ['label' => 'Bantuan Elaun SUE/Elaun Penyelaras/Emolumen PSK', 'url' => ['/bantuan-elaun/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['module'])],
                                ['label' => 'Bantuan Pentadbiran Pejabat', 'url' => ['/bantuan-pentadbiran-pejabat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-pentadbiran-pejabat']['module'])],
                                ['label' => 'Bantuan Menghadiri Program Antarabangsa', 'url' => ['/forum-seminar-persidangan-di-luar-negara/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['module'])],
                                ['label' => 'Permohonan Penganjuran Program/Kursus/Bengkel', 'url' => ['/pengurusan-permohonan-pendidikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-pendidikan']['module'])],
                                ['label' => 'Pengurusan Penilaian Pendidikan Penganjur/Intructor', 'url' => ['/pengurusan-penilaian-pendidikan-penganjur-intructor/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penilaian-pendidikan-penganjur-intructor']['module'])],
                                ['label' => 'Kehadiran Peserta', 'url' => ['/pengurusan-maklum-balas-peserta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['module'])],
                            ],
                        ],
                        ['label' => 'Delegasi Teknikal  : Pengurusan  Delegasi Teknikal Serta Analisa', 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        [
                            'label' => 'Pengurusan Media',
                            'items' => [
                                ['label' => 'Pengurusan Media', 'url' => ['/pengurusan-media-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['module'])],
                                ['label' => 'Profil Wartawan Sukan', 'url' => ['/profil-wartawan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-wartawan-sukan']['module'])],
                            ],
                        ],
                        ['label' => 'Pengurusan Kewangan', 'url' => ['/pengurusan-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['module'])],
                        ['label' => 'Penilaian Prestasi', 'url' => ['/penilaian-prestasi-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-prestasi-atlet']['module'])],
                        ['label' => 'Perancangan Program', 'url' => ['/perancangan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['module'])],
                        ['label' => 'Pengurusan Mesyuarat / Perbincangan Secara Online', 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        [
                            'label' => 'Pengurusan Venue Latihan, Kemudahan Serta Spesifikasi Teknikal',
                            'items' => [
                                ['label' => 'Pengurusan Venue', 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-venue']['module'])],
                                ['label' => 'Pengurusan Kemudahan', 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['module'])],
                                ['label' => 'Pengurusan Peralatan', 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                ['label' => 'Kemudahan Aduan', 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan']['module'])],
                                ['label' => 'Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                                ['label' => 'Tempahan', 'url' => ['/tempahan-kemudahan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['module'])],
                            ],
                        ],
                        ['label' => 'Sukarelawan', 'url' => ['/sukarelawan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                        [
                            'label' => 'Pengurusan Modal Program / Kursus Pengurusan Sukan Kebangsaan',
                            'items' => [
                                ['label' => 'Kursus Persatuan', 'url' => ['/kursus-persatuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['kursus-persatuan']['module'])],
                                ['label' => 'Pengurusan Permohonan Kursus Persatuan', 'url' => ['/pengurusan-permohonan-kursus-persatuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-kursus-persatuan']['module'])],
                                ['label' => 'Pengurusan Penilaian Pendidikan Penganjur/Intructor', 'url' => ['/pengurusan-penilaian-pendidikan-penganjur-intructor/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penilaian-pendidikan-penganjur-intructor']['module'])],
                                ['label' => 'Kehadiran Peserta', 'url' => ['/pengurusan-maklum-balas-peserta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['module'])],
                            ],
                        ],
                    ]];
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['ISN'])){
                    $sideMenuItems[] = ['label' => 'ISN', 'url' => ['#'],'items' => [
                        ['label' => 'Mesyuarat', 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['mesyuarat']['module'])],
                        ['label' => 'HPT Pangkalan Data Laporan Bulanan', 'url' => ['/six-step/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step']['module'])],
                        ['label' => 'Suaian Fizikal – Sistem Pendaftaran Atlet di Gym', 'url' => ['/pendaftaran-gym/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pendaftaran-gym']['module'])],
                        ['label' => 'Suaian Fizikal – Sistem Pinjaman Peralatan', 'url' => ['/pinjaman-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                        ['label' => 'Suaian Fizikal – Sistem Pengurusan Kemudahan dan Peralatan', 'url' => ['/pengurusan-kemudahan-dan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kemudahan-dan-peralatan']['module'])],
                        ['label' => 'Suaian Fizikal – Sistem Pengurusan dan Analisis Pembekal', 'url' => ['/pengurusan-kontraktor/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kontraktor']['module'])],
                        ['label' => 'Suaian Fizikal – Sistem ‘SIX-STEP’', 'url' => ['/six-step-suaian-fizikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-suaian-fizikal']['module'])],
                        ['label' => 'Psikologi Sukan Sistem ‘SIX-STEP’', 'url' => ['/six-step-psikologi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-psikologi']['module'])],
                        [
                            'label' => 'Pengurusan Sesi Dengan Keselamatan Encryption ',
                            'items' => [
                                ['label' => 'Profil Psikologi', 'url' => ['/psikologi-profil/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-profil']['module'])],
                                ['label' => 'Aktiviti Psikologi', 'url' => ['/psikologi-aktiviti/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-aktiviti']['module'])],
                            ],
                        ],
                        ['label' => 'Fisiologi Sistem Penjadualan Ujian Fisiologi', 'url' => ['/penjadualan-ujian-fisiologi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['module'])],
                        ['label' => 'Fisiologi Sistem Pangkalan Data Atlet dan Journal', 'url' => ['/soal-selidik-sebelum-ujian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian']['module'])],
                        ['label' => 'Fisiologi Sistem ‘SIX-Step’', 'url' => ['/six-step-fisiologi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-fisiologi']['module'])],
                        ['label' => 'Biomekanik Sistem Permohonan Perkhidmatan Analisa Perlawanan dan Biomekanik', 'url' => ['/permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['module'])],
                        ['label' => 'Biomekanik Sistem Pangkalan Data', 'url' => ['/perkhidmatan-analisa-perlawanan-biomekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['module'])],
                        ['label' => 'Biomekanik Sistem Pengurusan Peralatan', 'url' => ['/pinjaman-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                        ['label' => 'Biomekanik Analisa Impak Biomekanik dan Analisa Sukan terhadap Prestasi Atlet', 'url' => ['/permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['module'])],
                        ['label' => 'Biomekanik Sistem Permohonan Khidmat Biomekanik Secara Atas Talian', 'url' => ['/permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['module'])],
                        ['label' => 'Biomekanik Sistem ‘SIX STEP’', 'url' => ['/six-step-biomekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-biomekanik']['module'])],
                        ['label' => 'Pemakanan Sistem Permohonan Khidmat Analisis Tubuh Badan', 'url' => ['/permohonan-perkhidmatan-permakanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                        ['label' => 'Pemakanan Sistem Permohonan Khidmat Pemberian Suplemen Dan Makanan', 'url' => ['/permohonan-perkhidmatan-permakanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                        ['label' => 'Pemakanan Sistem Pinjaman Barangan Dan Peralatan', 'url' => ['/pinjaman-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                        ['label' => 'Pemakanan Sistem Permohonan Khidmat Rundingan/ Pendidikan', 'url' => ['/permohonan-perkhidmatan-permakanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                        ['label' => 'Sistem Pengurusan Pengenalpastian Bakat Yang Telah Disaringkan', 'url' => ['/ujian-saringan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['ujian-saringan']['module'])],
                        ['label' => 'Satelit Sistem Laporan Pusat', 'url' => ['/satelit/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['satelit']['module'])],
                        ['label' => 'Satelit Sistem ‘SIX Step’', 'url' => ['/six-step-satelit/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-satelit']['module'])],
                        ['label' => 'Penyelidikan Sistem Pengurusan Geran Penyelidikan, Penyelidikan Sistem Penyelarasan Penyelidikan', 'url' => ['/permohonan-penyelidikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-penyelidikan']['module'])],
                        ['label' => 'Penyelidikan Sistem Pengurusan Penerbitan', 'url' => ['/journal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['journal']['module'])],
                        ['label' => 'Teknologi Instrumentasi Sistem Permohonan Projek Inovasi', 'url' => ['/permohonan-inovasi-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-inovasi-peralatan']['module'])],
                        ['label' => 'Permohonan Membaiki Peralatan', 'url' => ['/permohonan-membaiki-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-membaiki-peralatan']['module'])],
                        [
                            'label' => 'Pesakit Luar Sistem Pendaftaran Dan Temujanji Atlet, Pesakit Luar Sistem Proses Rawatan, Pesakit Luar Pengurusan Rekod Pemeriksaan Perubatan, Pesakit Luar Sistem Pemberian Ubat Kepada Psk',
                            'items' => [
                                ['label' => 'Temujanji', 'url' => ['/pl-temujanji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                                ['label' => 'Data Klinikal', 'url' => ['/pl-data-klinikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['module'])],
                            ],
                        ],
                        ['label' => 'Farmasi Rekod Permohonan Ubatan Di Kaunter Oleh Atlet (Otc Drug)', 'url' => ['/farmasi-permohonan-ubatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['module'])],
                        ['label' => 'Makmal Perubatan Permohonan Khidmat Ujian Makmal Melalui Sistem', 'url' => ['/pl-temujanji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                        ['label' => 'Permohonan Penyiasatan (Makmal dan Pengimejan), Pengimejan Pengurusan Pangkalan Data Atlet (Imej) ', 'url' => ['/pl-temujanji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                        ['label' => 'Caj Perkhidmatan Senarai Harga Perkhidmatan, Caj Perkhidmatan Senarai Harga Ubatan', 'url' => ['/senarai-harga-perkhidmatan-ubatan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['module'])],
                        ['label' => 'Fisioterapi Sistem Permohonan Khidmat Rawatan Fisioterapi', 'url' => ['/pl-temujanji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                        ['label' => 'Rehabilitasi Permohonan Khidmat Rawatan Rehabilitasi', 'url' => ['/pl-temujanji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                        [
                            'label' => 'Liputan Perubatan Dalam Dan Luar Negara',
                            'items' => [
                                ['label' => 'Permohonan Liputan Perubatan Sukan', 'url' => ['/farmasi-permohonan-liputan-perubatan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['module'])],
                                ['label' => 'Permohonan Ubatan', 'url' => ['/farmasi-permohonan-ubatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['module'])],
                            ],
                        ],
                        ['label' => 'Pendidikan Sistem Permohonan Program Pendidikan Kesihatan Kepada Atlet Dan Staf', 'url' => ['/permohonan-program-pendidikan-kesihatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['module'])],
                        ['label' => 'Komplementari Sistem Permohonan Perkhidmatan Perkhidmatan Komplementari', 'url' => ['/temujanji-komplimentari/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['module'])],
                        [
                            'label' => 'Akademi Kejurulatihan Kebangsaan (AKK)',
                            'items' => [
                                ['label' => 'Akademi Kejurulatihan Kebangsaan (AKK)', 'url' => ['/akademi-akk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['module'])],
                                ['label' => 'CCE', 'url' => ['/kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['kursus']['module'])],
                                ['label' => 'Penganjuran Kursus', 'url' => ['/penganjuran-kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['module'])],
                                ['label' => 'Penganjuran Kursus : Senarai Peserta', 'url' => ['/penganjuran-kursus-peserta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['module'])],
                                ['label' => 'Penganjuran Kursus : Penganjur', 'url' => ['/penganjuran-kursus-penganjur/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-penganjur']['module'])],
                            ],
                        ],
                    ]];
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['PJS'])){
                    $sideMenuItems[] = ['label' => 'PJS', 'url' => ['#'],'items' => [
                        ['label' => 'Profil Badan Sukan', 'url' => ['/profil-badan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                        ['label' => 'Maklumat Mesyuarat Agung Tahunan', 'url' => ['/ltbs-minit-mesyuarat-jawatankuasa/index','profil_badan_sukan_id' => ''], 'visible' => (isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['module']) && !Yii::$app->user->identity->profil_badan_sukan)],
                        /*[
                            'label' => 'Laporan Tahunan Badan Sukan',
                            'items' => [
                                ['label' => 'Maklumat Mesyuarat Agung Tahunan', 'url' => ['/ltbs-minit-mesyuarat-jawatankuasa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['module'])],
                                //['label' => 'Notis Mesyuarat Agong', 'url' => ['/ltbs-notis-agm/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-notis-agm']['module'])],
                                //['label' => 'Minit Mesyuarat Agong', 'url' => ['/ltbs-minit-mesyuarat-agm/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-agm']['module'])],
                                //['label' => 'Ahli Jawatankuasa Induk', 'url' => ['/ltbs-ahli-jawatankuasa-induk-kecil/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-induk-kecil']['module'])],
                                //['label' => 'Ahli Jawatankuasa Kecil / Biro ', 'url' => ['/ltbs-ahli-jawatankuasa-kecil/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-kecil']['module'])],
                                //['label' => 'Senarai Ahli Gabungan', 'url' => ['/ltbs-ahli-gabungan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-gabungan']['module'])],
                                ['label' => 'Laporan Aktiviti Badan Sukan', 'url' => ['/ltbs-kejohanan-program-aktiviti/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-kejohanan-program-aktiviti']['module'])],
                                ['label' => 'Penyata Kewangan', 'url' => ['/ltbs-penyata-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-penyata-kewangan']['module'])],
                                ['label' => 'Sumber Kewangan', 'url' => ['/ltbs-sumber-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-sumber-kewangan']['module'])],
                            ],
                        ],*/
                        //['label' => 'Perlembagaan Badan Sukan', 'url' => ['/perlembagaan-badan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['perlembagaan-badan-sukan']['module'])],
                        ['label' => 'Penganjuran Acara oleh Badan Sukan', 'url' => ['/paobs-penganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['module'])],
                        /*[
                            'label' => 'Penganjuran Acara oleh Badan Sukan',
                            'items' => [
                                ['label' => 'Penganjuran Acara Sukan', 'url' => ['/paobs-penganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['module'])],
                                ['label' => 'Penganjuran Acara Sukan Yang Disanksi', 'url' => ['/paobs-penganjur/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjur']['module'])],
                            ],
                        ],*/
                        ['label' => 'Latihan Pendidikan & Badan Sukan', 'url' => ['/latihan-dan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['latihan-dan-program']['module'])],
                        ['label' => 'Persatuan', 'url' => ['/persatuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['persatuan']['module'])],
                        [
                            'label' => 'Laporan',
                            'items' => [
                                ['label' => 'Laporan Ahli Jawatankuasa Induk', 'url' => ['/profil-badan-sukan/laporan-ahli-jawatankuasa-induk'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                                ['label' => 'Laporan Ahli Jawatankuasa Kecil / Biro', 'url' => ['/profil-badan-sukan/laporan-ahli-jawatankuasa-kecil-biro'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                                ['label' => 'Laporan Badan Sukan', 'url' => ['/profil-badan-sukan/laporan-badan-sukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                                ['label' => 'Laporan Penganjuran Acara', 'url' => ['/profil-badan-sukan/laporan-penganjuran-acara'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                            ],
                        ],
                    ]];
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['KBS'])){
                    $sideMenuItems[] = ['label' => 'KBS', 'url' => ['#'],'items' => [
                        [
                            'label' => 'e-Bantuan',
                            'items' => [
                                ['label' => 'Permohonan e-Bantuan', 'url' => ['/permohonan-e-bantuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['module'])],
                                ['label' => 'Urusetia', 'url' => ['/permohonan-e-bantuan-urusetia/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan-urusetia']['module'])],
                                ['label' => 'Laporan Status Permohonan Bantuan', 'url' => ['/permohonan-e-bantuan/laporan-status-permohonan-bantuan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['module'])],
                            ],
                        ],
                        [
                            'label' => 'e-Laporan',
                            'items' => [
                                ['label' => 'e-Laporan', 'url' => ['/elaporan-pelaksanaan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['module'])],
                                ['label' => 'Laporan Pelaksanaan Program', 'url' => ['/elaporan-pelaksanaan/report'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['module'])],
                            ],
                        ],
                        [
                            'label' => 'e-Fasiliti / e-Kemudahan',
                            'items' => [
                                ['label' => 'Pengurusan Venue', 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-venue']['module'])],
                                //['label' => 'Pengurusan Kemudahan', 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-sedia-ada']['module'])],
                                //['label' => 'Pengurusan Peralatan', 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                //['label' => 'Kemudahan Aduan', 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan']['module'])],
                                //['label' => 'Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                                ['label' => 'Tempahan', 'url' => ['/tempahan-kemudahan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                [
                                    'label' => 'Laporan',
                                    'items' => [
                                        ['label' => 'Laporan Pengguna Dan Hasil Bagi Kombes', 'url' => ['/tempahan-kemudahan/laporan-penggunaan-dan-hasil-bagi-kombes'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                        ['label' => 'Laporan Kuantiti Kemudahan', 'url' => ['/tempahan-kemudahan/laporan-kuantiti-kemudahan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                        ['label' => 'Laporan Pengguna Dan Hasil Bagi Kombes Tahunan', 'url' => ['/tempahan-kemudahan/laporan-penggunaan-dan-hasil-bagi-kombes-tahunan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => 'e-Biasiswa',
                            'items' => [
                                ['label' => 'Permohonan E-Biasiswa', 'url' => ['/permohonan-e-biasiswa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Penjamin Biasiswa Sukan Persekutuan', 'url' => ['/bsp-penjamin/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Kedudukan Kewangan Penjamin', 'url' => ['/bsp-kedudukan-kewangan-penjamin/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Kedudukan Kewangan Penjamin (Jenis Harta)', 'url' => ['/bsp-kedudukan-kewangan-penjamin-jenis-harta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Prestasi Akademik', 'url' => ['/bsp-prestasi-akademik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Tuntutan Elaun Tesis', 'url' => ['/bsp-tuntutan-elaun-tesis/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Elaun Latihan Praktikal', 'url' => ['/bsp-elaun-latihan-praktikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Elaun Perjalanan Udara', 'url' => ['/bsp-elaun-perjalanan-udara/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Pelanjutan', 'url' => ['/bsp-perlanjutan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Sebab Pelanjutan', 'url' => ['/bsp-perlanjutan-sebab/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Pertukaran Program Pengajian', 'url' => ['/bsp-pertukaran-program-pengajian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Sebab Pertukaran Program Pengajian', 'url' => ['/bsp-pertukaran-program-pengajian-sebab/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Dokumen Pertukaran Program Pengajian', 'url' => ['/bsp-pertukaran-program-pengajian-dokumen/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => 'Pembayaran Biasiswa Sukan Persekutuan', 'url' => ['/bsp-pembayaran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['bsp-pembayaran']['module'])],
                                ['label' => 'Pengesahan Tamat Pengajian', 'url' => ['/bsp-tamat-pengesahan-pengajian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['bsp-tamat-pengesahan-pengajian']['module'])],
                                ['label' => 'Bendahari IPT', 'url' => ['/bsp-bendahari-ipt/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['bsp-bendahari-ipt']['module'])],
                                [
                                    'label' => 'Laporan',
                                    'items' => [
                                        ['label' => 'Laporan Penyata Bayaran Pelajar', 'url' => ['/permohonan-e-biasiswa/laporan-penyata-bayaran-pelajar'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Prestasi Akademik', 'url' => ['/permohonan-e-biasiswa/laporan-prestasi-akademik'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Senarai Penerima Biasiswa', 'url' => ['/permohonan-e-biasiswa/laporan-senarai-penerima-biasiswa'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Statistik Permohonan Biasiswa Mengikut IPTA / IPTS', 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-ipta-ipts'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Statistik Permohonan Biasiswa Mengikut Jantina', 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-jantina'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Statistik Permohonan Biasiswa Mengikut Kaum', 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-kaum'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Statistik Permohonan Biasiswa Mengikut Peringkat Pengajian', 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-peringkat-pengajian'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Statistik Permohonan Biasiswa Mengikut Status', 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-status'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Statistik Permohonan Biasiswa Mengikut Sukan', 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-sukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => 'Laporan Statistik Permohonan Biasiswa Mengikut Universiti / Institusi', 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-universiti-institusi'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                    ],
                                ],
                            ],
                        ],
                        
                    ]];
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['Admin'])){
                    $sideMenuItems[] = ['label' => 'Administration', 'url' => ['#'],'items' => [
                        ['label' => 'User', 'url' => ['/user/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['module'])],
                        ['label' => 'User Peranan', 'url' => ['/user-peranan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['Admin']['user-peranan']['module'])],
                        ['label' => 'Admin : E-Biasiswa', 'url' => ['/admin-e-biasiswa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['Admin']['admin-e-biasiswa']['module'])],
                    ]];
                }
                
                $sideMenuItems[] = ['label' => 'Laporan', 'url' => 'http://10.19.189.87:8080/jasperserver'];
                
                $topMenuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $topMenuItems,
            ]);
            NavBar::end();
        ?>
        
        
        
        

        <div class="container-fluid">
            <div class="col-sm-2">
<?php 
if(isset($sideMenuItems)){
    $type = SideNav::TYPE_DEFAULT;
    $heading = false;
    echo SideNav::widget([
        'type' => $type,
        'encodeLabels' => false,
        'heading' => $heading,
        'headingOptions' => ['class'=>'head-style'],
        'items' => $sideMenuItems,
    ]);
}
?>
            </div>
            <div class="col-sm-10">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
                <br>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
        <p class="pull-left">Copyright &copy; <?= date('Y') ?> Portal Rasmi Kementerian Belia dan Sukan Malaysia. All Rights Reserved.</p>
        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
