<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\DashboardAsset;
use frontend\widgets\Alert;
use kartik\widgets\SideNav;

use app\models\UserPeranan;
use app\models\general\GeneralLabel;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$dashboardAsset = DashboardAsset::register($this);
$dashboardBaseUrl = $dashboardAsset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" href=<?= Yii::$app->getUrlManager()->getBaseUrl() . "/img/favicon.png"?>>-->
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

            $session = Yii::$app->getSession();
            $current_language = $session->get('language');
            $language_string = "Bahasa";

            switch ($current_language) {
                case "BM":
                    $language_string = "Bahasa";
                    break;
                case "EN":
                    $language_string = "English";
                    break;
                default:
                    $language_string = "Bahasa";
            }


            $topMenuItems[] = [
                'label' => $language_string,
                'items' => [
                     '<li class="dropdown-header">Select Your Language</li>',
                     ['label' => GeneralLabel::english, 'url' => ['/language/change','language'=>"EN"]],
                     ['label' => GeneralLabel::bahasa, 'url' => ['/language/change','language'=>"BM"]],
                ],
            ];
            
            if (Yii::$app->user->isGuest) {
                //$topMenuItems[] = ['label' => GeneralLabel::signup, 'url' => ['/site/signup']];
                $topMenuItems[] = ['label' => GeneralLabel::login, 'url' => ['/site/login']];
                
            } else {
                // Login User System
                
                // get User Access Row
                //$modelUserPeranan = UserPeranan::findOne(['user_peranan_id' => Yii::$app->user->identity->peranan, 'aktif' => 1]);
                //Yii::$app->user->identity->peranan_akses = $modelUserPeranan->peranan_akses;
                /*if(isset($modelUserPeranan->peranan_akses)){
                    Yii::$app->user->identity->peranan_akses = json_decode($modelUserPeranan->peranan_akses, true);
                }*/
                
                
                //echo "Edward Access Role = " . print_r(Yii::$app->user->identity->peranan_akses) . "<br>";
                
                $sideMenuItems[] = ['label' => GeneralLabel::dashboard, 'url' => ['/site/index']];
                /*$sideMenuItems[] = ['label' => GeneralLabel::atlet, 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => GeneralLabel::jurulatih, 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => GeneralLabel::msn, 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => GeneralLabel::isn, 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => GeneralLabel::pjs, 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];
                $sideMenuItems[] = ['label' => GeneralLabel::kbs, 'url' => ['/atlet/index'],'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]];*/
                
                if(isset(Yii::$app->user->identity->peranan_akses['MSN'])){
                    $sideMenuItems[] = ['label' => GeneralLabel::msn, 'url' => ['#'],'items' => [
                        [
                            'label' => GeneralLabel::sistem_pengurusan_atlet, 
                            'items' => [
                                [
                                    'label' => GeneralLabel::atlet, 
                                    'items' => [
                                        ['label' => GeneralLabel::atlet, 'url' => ['/atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_senarai_atlet, 'url' => ['/atlet/laporan-senarai-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_atlet, 'url' => ['/atlet/laporan-statistik-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::pengurusan_tawaran_atlet, 'url' => ['/atlet/tawaran'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['tawaran'])],
                                ['label' => GeneralLabel::pembayaran_elaun, 'url' => ['/pembayaran-elaun/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['module'])],
                                [
                                    'label' => GeneralLabel::pengurusan_semua_kemudahan_atlet, 
                                    'items' => [
                                        ['label' => GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang, 'url' => ['/permohonan-kemudahan-ticket-kapal-terbang/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['module'])],
                                        ['label' => GeneralLabel::permohonan_peralatan, 'url' => ['/permohonan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['module'])],
                                        ['label' => GeneralLabel::inventori, 'url' => ['/inventori/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['inventori']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::skim_insentif_dan_kebajikan, 
                                    'items' => [
                                        ['label' => GeneralLabel::skim_kebajikan, 'url' => ['/skim-kebajikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['module'])],
                                        ['label' => GeneralLabel::jenis_kebajikan, 'url' => ['/jenis-kebajikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['jenis-kebajikan']['module'])],
                                        [
                                            'label' => GeneralLabel::pengurusan_insentif,
                                            'items' => [
                                                ['label' => GeneralLabel::pengurusan_insentif_tetapan, 'url' => ['/pengurusan-insentif-tetapan/load'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif-tetapan']['module'])],
                                                ['label' => GeneralLabel::pembayaran_insentif, 'url' => ['/pembayaran-insentif/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::pengurusan_insurans,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_insurans, 'url' => ['/pengurusan-insuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insuran']['module'])],
                                        ['label' => GeneralLabel::laporan_tuntutan_insurans, 'url' => ['/pengurusan-insuran/laporan-tuntutan-insurans'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insuran']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::pengurusan_pendidikan_atlet,
                                    'items' => [
                                        ['label' => GeneralLabel::permohonan_pendidikan, 'url' => ['/permohonan-pendidikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-pendidikan']['module'])],
                                        ['label' => GeneralLabel::pertukaran_pengajian, 'url' => ['/pertukaran-pengajian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['module'])],
                                        ['label' => GeneralLabel::permohonan_biasiswa, 'url' => ['/permohonan-biasiswa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-biasiswa']['module'])],
                                        ['label' => GeneralLabel::pengurusan_pengangkutan, 'url' => ['/pengurusan-shuttle-bus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-shuttle-bus']['module'])],
                                        ['label' => GeneralLabel::pengurusan_sajian_makan, 'url' => ['/pengurusan-sajian-makan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-sajian-makan']['module'])],
                                        ['label' => GeneralLabel::pengurusan_penginapan, 'url' => ['/pengurusan-penginapan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penginapan']['module'])],
                                        ['label' => GeneralLabel::pengurusan_biasiswa_atlet, 'url' => ['/pengurusan-biasiswa-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-biasiswa-atlet']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::kejohanan_temasya_atlet,
                                    'items' => [
                                        [
                                            'label' => GeneralLabel::merekod_maklumat_sukan_program_termasuk,
                                            'items' => [
                                                ['label' => GeneralLabel::penilaian_prestasi_kejohanan, 'url' => ['/penyertaan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['module'])],
                                                ['label' => GeneralLabel::aduan, 'url' => ['/penyertaan-sukan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan-aduan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::perancangan_program, 'url' => ['/perancangan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['module'])],
                                [
                                    'label' => GeneralLabel::pengurusan_jawatankuasa_kerja_jkkjawatankuasa_program_jkp_lembaga_pengarah_lembaga_institut,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_jkkjkp, 'url' => ['/pengurusan-jkk-jkp/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['module'])],
                                        ['label' => GeneralLabel::pengurusan_mesyuarat_jawatankuasa_kerja_jkk, 'url' => ['/mesyuarat-jkk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat-jkk']['module'])],
                                        ['label' => GeneralLabel::pengurusan_jkkjkp_program, 'url' => ['/pengurusan-jkk-jkp-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp-program']['module'])],
                                        ['label' => GeneralLabel::pengurusan_jkkjkp_bajet, 'url' => ['/pengurusan-jkk-jkp-bajet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp-bajet']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::prestasi_atlet,
                                    'items' => [
                                        ['label' => GeneralLabel::penilaian_pestasi, 'url' => ['/penilaian-pestasi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::program_binaan,
                                    'items' => [
                                        ['label' => GeneralLabel::permohonan_program_binaan, 'url' => ['/pengurusan-program-binaan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['module'])],
                                        ['label' => GeneralLabel::borang_penyertaan_atlet, 'url' => ['/borang-penyertaan-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penyertaan-atlet']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_senarai_penganjuran_program_binaan, 'url' => ['/pengurusan-program-binaan/laporan-senarai-penganjuran-program-binaan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_program_binaan_mengikut_negeri, 'url' => ['/pengurusan-program-binaan/laporan-statistik-program-binaan-mengikut-negeri'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_program_binaan_mengikut_sukan, 'url' => ['/pengurusan-program-binaan/laporan-statistik-program-binaan-mengikut-sukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::pengurusan_usptn,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_usptn, 'url' => ['/pengurusan-upstn/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_statistik_pemantauan, 'url' => ['/pengurusan-upstn/laporan-statistik-pemantauan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                                                ['label' => GeneralLabel::laporan_usptn_lawatan_pemantauan, 'url' => ['/pengurusan-upstn/laporan-usptn-lawatan-pemantauan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                                                ['label' => GeneralLabel::laporan_usptn_pecahan_kaum, 'url' => ['/pengurusan-upstn/laporan-usptn-pecahan-kaum'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                                                ['label' => GeneralLabel::laporan_usptn_pecahan_umur, 'url' => ['/pengurusan-upstn/laporan-usptn-pecahan-umur'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                                                ['label' => GeneralLabel::laporan_usptn_perjumpaan_atlet, 'url' => ['/pengurusan-upstn/laporan-usptn-perjumpaan-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                                                ['label' => GeneralLabel::laporan_usptn_perjumpaan_jurulatih, 'url' => ['/pengurusan-upstn/laporan-usptn-perjumpaan-jurulatih'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::senarai_jurulatih, 'url' => ['/jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['module'])],
                                ['label' => GeneralLabel::pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih, 'url' => ['/pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['module'])],
                                ['label' => GeneralLabel::pengurusan_bayaran_elaun_dan_gaji_jurulatih_sambilan, 'url' => ['/gaji-dan-elaun-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['module'])],
                                [
                                    'label' => GeneralLabel::geran_bantuan_gaji,
                                    'items' => [
                                        ['label' => GeneralLabel::geran_bantuan_gaji, 'url' => ['/geran-bantuan-gaji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_maklumat_pembayaran_geran_bantuan, 'url' => ['/geran-bantuan-gaji/laporan-maklumat-pembayaran-geran-bantuan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::pengurusan_pemantauan_dan_penilaian_jurulatih, 'url' => ['/pengurusan-pemantauan-dan-penilaian-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-pemantauan-dan-penilaian-jurulatih']['module'])],
                                ['label' => GeneralLabel::peningkatan_kerjaya_jurulatih, 'url' => ['/akk-program-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['akk-program-jurulatih']['module'])], 
                            ],
                        ],
                        [
                            'label' => GeneralLabel::sistem_pengurusan_kejohanan,
                            'items' => [
                                [
                                    'label' => GeneralLabel::urusetia_kejohanan,
                                    'items' => [
                                        ['label' => GeneralLabel::bantuan_penganjuran_kejohanan, 'url' => ['/bantuan-penganjuran-kejohanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::pengurusan_teknikal_dan_kepegawaian,
                                    'items' => [
                                        ['label' => GeneralLabel::maklumat_pegawai_teknikal, 'url' => ['/maklumat-pegawai-teknikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['maklumat-pegawai-teknikal']['module'])],
                                        ['label' => GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian, 'url' => ['/manual-silibus-kurikulum-teknikal-kepegawaian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['manual-silibus-kurikulum-teknikal-kepegawaian']['module'])],
                                        [
                                            'label' => GeneralLabel::geran_bantuan,
                                            'items' => [
                                                ['label' => GeneralLabel::bantuan_penganjuran_kursus_bengkel_seminar, 'url' => ['/bantuan-penganjuran-kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['module'])],
                                                ['label' => GeneralLabel::bantuan_penyertaan_pegawai_teknikal, 'url' => ['/bantuan-penyertaan-pegawai-teknikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['module'])],
                                                ['label' => GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal, 'url' => ['/bantuan-penganjuran-kursus-pegawai-teknikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus-pegawai-teknikal']['module'])],
                                            ],
                                        ],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_maklumat_pembayaran_geran_bantuan, 'url' => ['/geran-bantuan-gaji/laporan-maklumat-pembayaran-geran-bantuan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::pengurusan_jawatankuasa_jawatankuasa_khas,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia, 'url' => ['/pengurusan-jawatankuasa-khas-sukan-malaysia/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jawatankuasa-khas-sukan-malaysia']['module'])],
                                        ['label' => GeneralLabel::maklumat_sukan_malaysia, 'url' => ['/muat-naik-dokumen/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['muat-naik-dokumen']['module'])],
                                        ['label' => GeneralLabel::profil_delegasi_teknikal, 'url' => ['/profil-delegasi-teknikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-delegasi-teknikal']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_profil_ahli_jawatankuasa_khas_sukan_malaysia, 'url' => ['/pengurusan-jawatankuasa-khas-sukan-malaysia/laporan-profil-ahli-jawatankuasa-khas-sukan-malaysia'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jawatankuasa-khas-sukan-malaysia']['module'])],
                                                ['label' => GeneralLabel::laporan_delegasi_teknikal, 'url' => ['/profil-delegasi-teknikal/laporan-delegasi-teknikal'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-delegasi-teknikal']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_delegasi_teknikal, 'url' => ['/profil-delegasi-teknikal/laporan-statistik-delegasi-teknikal'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-delegasi-teknikal']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::sistem_pengurusan_sukan,
                            'items' => [
                                [
                                    //'label' => GeneralLabel::program_persatuan_sukan_kebangsaan_input_oleh_cawangan,
                                    'label' => GeneralLabel::pengurusan_maklumat_psk,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_maklumat_psk, 'url' => ['/pengurusan-maklumat-psk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklumat-psk']['module'])],
                                        ['label' => GeneralLabel::permohonan_pelantikan_sue, 'url' => ['/permohonan-pelantikan-sue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['module'])],
                                        ['label' => GeneralLabel::bantuan_elaun_sueelaun_penyelarasemolumen_psk, 'url' => ['/bantuan-elaun/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-elaun']['module'])],
                                        ['label' => GeneralLabel::bantuan_pentadbiran_pejabat, 'url' => ['/bantuan-pentadbiran-pejabat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-pentadbiran-pejabat']['module'])],
                                        ['label' => GeneralLabel::bantuan_menghadiri_program_antarabangsa, 'url' => ['/forum-seminar-persidangan-di-luar-negara/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['module'])],
                                        //['label' => GeneralLabel::permohonan_penganjuran_programkursusbengkel, 'url' => ['/pengurusan-permohonan-pendidikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-pendidikan']['module'])],
                                        //['label' => GeneralLabel::pengurusan_penilaian_pendidikan_penganjurintructor, 'url' => ['/pengurusan-penilaian-pendidikan-penganjur-intructor/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penilaian-pendidikan-penganjur-intructor']['module'])],
                                        //['label' => GeneralLabel::kehadiran_peserta, 'url' => ['/pengurusan-maklum-balas-peserta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::notis_kontrak_setiausaha_eksekutif_persatuan, 'url' => ['/permohonan-pelantikan-sue/notis-kontrak-setiausaha-eksekutif-persatuan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['forum-seminar-persidangan-di-luar-negara']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::delegasi_teknikal_pengurusan_delegasi_teknikal_serta_analisa, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                                [
                                    'label' => GeneralLabel::sukarelawan,
                                    'items' => [
                                        ['label' => GeneralLabel::sukarelawan, 'url' => ['/sukarelawan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_senarai_sukarelawan, 'url' => ['/sukarelawan/laporan-senarai-sukarelawan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_sukarelawan_mengikut_negeri, 'url' => ['/sukarelawan/laporan-statistik-sukarelawan-mengikut-negeri'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_sukarelawan_mengikut_jantina, 'url' => ['/sukarelawan/laporan-statistik-sukarelawan-mengikut-jantina'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_sukarelawan_mengikut_umur, 'url' => ['/sukarelawan/laporan-statistik-sukarelawan-mengikut-umur'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_sukarelawan_mengikut_kecenderungan, 'url' => ['/sukarelawan/laporan-statistik-sukarelawan-mengikut-kecenderungan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_sukarelawan_mengikut_keterbatasan_fizikal, 'url' => ['/sukarelawan/laporan-statistik-sukarelawan-mengikut-keterbatasan-fizikal'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_sukarelawan_mengikut_bangsa, 'url' => ['/sukarelawan/laporan-statistik-sukarelawan-mengikut-bangsa'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::pengurusan_anugerah_sukan,
                                    'items' => [
                                        ['label' => GeneralLabel::anugerah_pencalonan_atlet, 'url' => ['/anugerah-pencalonan-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['module'])],
                                        ['label' => GeneralLabel::anugerah_pencalonan_jurulatih, 'url' => ['/anugerah-pencalonan-jurulatih/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['module'])],
                                        ['label' => GeneralLabel::anugerah_pencalonan_pasukan, 'url' => ['/anugerah-pencalonan-pasukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['module'])],
                                        ['label' => GeneralLabel::anugerah_pencalonan_lain, 'url' => ['/anugerah-pencalonan-lain/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['module'])],
                                        //['label' => GeneralLabel::anugerah_pelaksaan_majlis, 'url' => ['/anugerah-pelaksaan-majlis/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pelaksaan-majlis']['module'])],
                                        ['label' => GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan, 'url' => ['/anugerah-ahli-jawantankuasa-pemilihan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pelaksaan-majlis']['module'])],
                                        ['label' => GeneralLabel::anugerah_ahli_jawantankuasa_pengelola, 'url' => ['/anugerah-ahli-jawantankuasa-pengelola/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pelaksaan-majlis']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_pencalonan_anugerah_sukan_negara_atlet, 'url' => ['/anugerah-pencalonan-atlet/laporan-pencalonan-anugerah-sukan-negara-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['anugerah-pencalonan-atlet']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                
                            ],
                        ],
                        [
                            'label' => GeneralLabel::pengurusan_bimbingan_kaunseling_dan_kerjaya,
                            'items' => [
                                ['label' => GeneralLabel::profil_kaunselor, 'url' => ['/profil-konsultan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-konsultan']['module'])],
                                ['label' => GeneralLabel::permohonan_bimbingan_kaunseling, 'url' => ['/permohonan-bimbingan-kaunseling/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['module'])],
                                ['label' => GeneralLabel::permohonan_bimbingan_kaunseling_pegawai_anggota, 'url' => ['/permohonan-bimbingan-kaunseling-pegawai-anggota/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['module'])],
                                ['label' => GeneralLabel::borang_aduan_atlet, 'url' => ['/borang-aduan-kaunseling/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kaunseling']['module'])],
                                ['label' => GeneralLabel::laporan_sesi_kaunseling, 'url' => ['/borang-penilaian-kaunseling/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penilaian-kaunseling']['module'])],
                                [
                                    'label' => GeneralLabel::laporan,
                                    'items' => [
                                        ['label' => GeneralLabel::laporan_bimbingan_kaunseling_pegawai, 'url' => ['/permohonan-bimbingan-kaunseling-pegawai-anggota/laporan-bimbingan-kaunseling-pegawai'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['module'])],
                                        ['label' => GeneralLabel::laporan_bimbingan_kaunseling_kes_rujukan, 'url' => ['/permohonan-bimbingan-kaunseling/laporan-bimbingan-kaunseling-kes-rujukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['module'])],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::pengurusan_venue_latihan_kemudahan_serta_spesifikasi_teknikal,
                            'items' => [
                                ['label' => GeneralLabel::pengurusan_venue, 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-venue']['module'])],
                                ['label' => GeneralLabel::pengurusan_kemudahan, 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['module'])],
                                ['label' => GeneralLabel::pengurusan_peralatan, 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                ['label' => GeneralLabel::pengurusan_penyelia, 'url' => ['/pengurusan-penyelia/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyelia']['module'])],
                                ['label' => GeneralLabel::borang_aduan_kerosakan, 'url' => ['/borang-aduan-kerosakan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kerosakan']['module'])],
                                //['label' => GeneralLabel::kemudahan_aduan, 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan']['module'])],
                                //['label' => GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                                ['label' => GeneralLabel::tempahan, 'url' => ['/tempahan-kemudahan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['module'])],
                                [
                                    'label' => GeneralLabel::laporan,
                                    'items' => [
                                        ['label' => GeneralLabel::laporan_aduan_kerosakan, 'url' => ['/borang-aduan-kerosakan/laporan-aduan-kerosakan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kerosakan']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::profil_pusat_latihan,
                                    'items' => [
                                        ['label' => GeneralLabel::profil_pusat_latihan, 'url' => ['/profil-pusat-latihan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_pusat_latihan, 'url' => ['/profil-pusat-latihan/laporan-pusat-latihan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        /*[
                            'label' => GeneralLabel::pengurusan_pusat_latihan,*/
                            /*'items' => [
                                ['label' => GeneralLabel::pengurusan_venue, 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-venue']['module'])],
                                ['label' => GeneralLabel::pengurusan_kemudahan, 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['module'])],
                                ['label' => GeneralLabel::pengurusan_peralatan, 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                ['label' => GeneralLabel::kemudahan_aduan, 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan']['module'])],
                                ['label' => GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                            ],*/
                            /*'items' => [
                                ['label' => GeneralLabel::profil_pusat_latihan, 'url' => ['/profil-pusat-latihan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['module'])],
                                [
                                    'label' => GeneralLabel::laporan,
                                    'items' => [
                                        ['label' => GeneralLabel::laporan_pusat_latihan, 'url' => ['/profil-pusat-latihan/laporan-pusat-latihan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['module'])],
                                    ],
                                ],
                            ],
                        ],*/
                        [
                            'label' => GeneralLabel::pengurusan_media,
                            'items' => [
                                ['label' => GeneralLabel::pengurusan_media, 'url' => ['/pengurusan-media-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['module'])],
                                ['label' => GeneralLabel::profil_wartawan_sukan, 'url' => ['/profil-wartawan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-wartawan-sukan']['module'])],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::pengurusan_jaringan_antarabangsa,
                            'items' => [
                                ['label' => GeneralLabel::pengurusan_jaringan_antarabangsa, 'url' => ['/pengurusan-jaringan-antarabangsa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jaringan-antarabangsa']['module'])],
                                ['label' => GeneralLabel::pengurusan_berita_antarabangsa, 'url' => ['/pengurusan-berita-antarabangsa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-berita-antarabangsa']['module'])],
                                ['label' => GeneralLabel::pengurusan_anjuran, 'url' => ['/pengurusan-anjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-anjuran']['module'])],
                                ['label' => GeneralLabel::pengurusan_mou_moa_antarabangsa, 'url' => ['/pengurusan-mou-moa-antarabangsa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-mou-moa-antarabangsa']['module'])],
                            ],
                        ],
                        
                        
                        
                        //['label' => GeneralLabel::pengurusan_insurans, 'url' => ['/pengurusan-insuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insuran']['module'])],
                        
                        //['label' => GeneralLabel::pengurusan_insentif, 'url' => ['/pengurusan-insentif/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['module'])],
                        
                        
                        
                        
                        
                        // TEMP ['label' => GeneralLabel::pengurusan_kewangan, 'url' => ['/pengurusan-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['module'])],
                        //['label' => GeneralLabel::penilaian_prestasi, 'url' => ['/penilaian-pestasi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['module'])],
                        //['label' => GeneralLabel::perancangan_program, 'url' => ['/perancangan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['module'])],
                        
                        //['label' => GeneralLabel::pengurusan_kejohanan_temasya_yang_disertai_oleh_atlet, 'url' => ['/pengurusan-kejohanan-temasya-main/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kejohanan-temasya-main']['module'])],
                        //['label' => GeneralLabel::pengurusan_mesyuarat_perbincangan_secara_online, 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        
                        
                        //['label' => GeneralLabel::penyelidikan_program_latihan, 'url' => ['/atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                        
                        //['label' => GeneralLabel::pengkomputeran_penilaian_presatasi_sukan_dan_program_latihan, 'url' => ['/atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['module'])],
                        //['label' => GeneralLabel::pengurusan_perhimpunan_kem_atlet, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        //['label' => GeneralLabel::pengurusan_kpi, 'url' => ['/pengurusan-kpi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kpi']['module'])],
                        
                        //['label' => GeneralLabel::pengurusan_kejohanan, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        //['label' => GeneralLabel::pengurusan_program_binaan, 'url' => ['/pengurusan-program-binaan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['module'])],
                        //['label' => GeneralLabel::pengurusan_usptn, 'url' => ['/pengurusan-upstn/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['module'])],
                        
                        //['label' => GeneralLabel::geran_bantuan_gaji, 'url' => ['/geran-bantuan-gaji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['module'])],
                        
                        
                        //['label' => GeneralLabel::pengurusan_kewangan, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        //['label' => GeneralLabel::kemasukan_dan_pengumpulan_data_maklumat_sukan_yang_dianjurkan, 'url' => ['/pengurusan-kejohanan-temasya-main/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kejohanan-temasya-main']['module'])],
                        //['label' => GeneralLabel::penilaian_prestasi, 'url' => ['/penyertaan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['module'])],
                        /*[
                            'label' => GeneralLabel::pengurusan_media,
                            'items' => [
                                ['label' => GeneralLabel::pengurusan_media, 'url' => ['/pengurusan-media-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['module'])],
                                ['label' => GeneralLabel::profil_wartawan_sukan, 'url' => ['/profil-wartawan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-wartawan-sukan']['module'])],
                            ],
                        ],*/
                        // TEMP ['label' => GeneralLabel::pengurusan_mesyuarat_perbincangan_secara_online, 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        
                        
                        //['label' => GeneralLabel::pengurusan_bantuan_geran_penganjuran, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        
                        //['label' => GeneralLabel::pengurusan_anjuran_kejohanan, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        //['label' => GeneralLabel::pengurusan_bantuan_geran_penganjuran, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        //['label' => GeneralLabel::pengurusan_bantuan_geran_teknikal_dan_kepegawaian, 'url' => ['/pengurusan-perhimpunan-kem/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['module'])],
                        
                        //['label' => GeneralLabel::jawatankuasa_tertinggi_sukan_malaysia_teknikal_dan_pertandingan, 'url' => ['/muat-naik-dokumen/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        //['label' => GeneralLabel::pengurusan_penstruktur_kurikulum_silibus_pegawai_teknikal, 'url' => ['/permohonan-perganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['module'])],
                        //['label' => GeneralLabel::pengurusan_pembekalan_penyediaan_sukatanmanual_teknikal_dan_kepegawaian, 'url' => ['/permohonan-perganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['module'])],
                        //['label' => GeneralLabel::pengurusan_maklumat_psk, 'url' => ['/pengurusan-maklumat-psk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklumat-psk']['module'])],
                        
                        /*[
                            'label' => GeneralLabel::pengurusan_media,
                            'items' => [
                                ['label' => GeneralLabel::pengurusan_media, 'url' => ['/pengurusan-media-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-media-program']['module'])],
                                ['label' => GeneralLabel::profil_wartawan_sukan, 'url' => ['/profil-wartawan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-wartawan-sukan']['module'])],
                            ],
                        ],*/
                        //['label' => GeneralLabel::pengurusan_kewangan, 'url' => ['/pengurusan-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['module'])],
                        //['label' => GeneralLabel::penilaian_prestasi, 'url' => ['/penilaian-prestasi-atlet/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-prestasi-atlet']['module'])],
                        //['label' => GeneralLabel::perancangan_program, 'url' => ['/perancangan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['perancangan-program']['module'])],
                        //['label' => GeneralLabel::pengurusan_mesyuarat_perbincangan_secara_online, 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat']['module'])],
                        /*[
                            'label' => GeneralLabel::pengurusan_venue_latihan_kemudahan_serta_spesifikasi_teknikal,
                            'items' => [
                                ['label' => GeneralLabel::pengurusan_venue, 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-venue']['module'])],
                                ['label' => GeneralLabel::pengurusan_kemudahan, 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['module'])],
                                ['label' => GeneralLabel::pengurusan_peralatan, 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                ['label' => GeneralLabel::kemudahan_aduan, 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan']['module'])],
                                ['label' => GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                                ['label' => GeneralLabel::tempahan, 'url' => ['/tempahan-kemudahan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['module'])],
                            ],
                        ],*/
                        //['label' => GeneralLabel::sukarelawan, 'url' => ['/sukarelawan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['module'])],
                        
                        /* TEMP[
                            'label' => GeneralLabel::pengurusan_modal_program_kursus_pengurusan_sukan_kebangsaan,
                            'items' => [
                                //['label' => GeneralLabel::kursus_persatuan, 'url' => ['/kursus-persatuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['kursus-persatuan']['module'])],
                                ['label' => GeneralLabel::profil_panel_penasihat_kpsk, 'url' => ['/profil-panel-penasihat-kpsk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-panel-penasihat-kpsk']['module'])],
                                ['label' => GeneralLabel::borang_profil_peserta_kpsk, 'url' => ['/borang-profil-peserta-kpsk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['module'])],
                                ['label' => GeneralLabel::pengurusan_permohonan_kursus_persatuan, 'url' => ['/pengurusan-permohonan-kursus-persatuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-permohonan-kursus-persatuan']['module'])],
                                [
                                    'label' => GeneralLabel::penilaian,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_penilaian_pendidikan_penganjurintructor, 'url' => ['/pengurusan-penilaian-pendidikan-penganjur-intructor/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penilaian-pendidikan-penganjur-intructor']['module'])],
                                        ['label' => GeneralLabel::penilaian_penganjur_kursus, 'url' => ['/penilaian-penganjur-kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-penganjur-kursus']['module'])],
                                        ['label' => GeneralLabel::penilaian_peserta_terhadap_kursus, 'url' => ['/penilaian-peserta-terhadap-kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-peserta-terhadap-kursus']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::laporan,
                                    'items' => [
                                        ['label' => GeneralLabel::laporan_statistik_kehadiran_peserta_mengikut_kursus_jantina, 'url' => ['/borang-profil-peserta-kpsk/laporan-statistik-kehadiran-peserta-mengikut-kursus-jantina'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_kehadiran_peserta_mengikut_kursus_bangsa, 'url' => ['/borang-profil-peserta-kpsk/laporan-statistik-kehadiran-peserta-mengikut-kursus-bangsa'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_kehadiran_peserta_mengikut_kursus_umur, 'url' => ['/borang-profil-peserta-kpsk/laporan-statistik-kehadiran-peserta-mengikut-kursus-umur'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_keputusan_peserta_mengikut_kursus, 'url' => ['/borang-profil-peserta-kpsk/laporan-statistik-keputusan-peserta-mengikut-kursus'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-profil-peserta-kpsk']['module'])],
                                    ],
                                ],
                                //['label' => GeneralLabel::kehadiran_peserta, 'url' => ['/pengurusan-maklum-balas-peserta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['module'])],
                            ],
                        ],*/
                    ]]; 
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['ISN'])){
                    $sideMenuItems[] = ['label' => GeneralLabel::isn, 'url' => ['#'],'items' => [
                        [
                            'label' => GeneralLabel::sains_sukan,
                            'items' => [
                                ['label' => GeneralLabel::mesyuarat, 'url' => ['/mesyuarat/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['mesyuarat']['module'])],
                                //['label' => GeneralLabel::hpt_pangkalan_data_laporan_bulanan, 'url' => ['/six-step/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step']['module'])],
                                [
                                    'label' => GeneralLabel::hpt_pangkalan_data_laporan_bulanan,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_kewangan_hpt, 'url' => ['/pengurusan-kewangan-hpt/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kewangan-hpt']['module'])],
                                        ['label' => GeneralLabel::soal_selidik_sebelum_ujian_hpt, 'url' => ['/soal-selidik-sebelum-ujian-hpt/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian-hpt']['module'])],
                                        ['label' => GeneralLabel::perancangan_program_hpt, 'url' => ['/perancangan-program-hpt/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perancangan-program-hpt']['module'])],
                                        ['label' => GeneralLabel::six_step_hpt, 'url' => ['/six-step/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step']['module'])],
                                        ['label' => GeneralLabel::hpt_laporan_bulanan_pegawai, 'url' => ['/hpt-laporan-bulanan-pegawai/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['hpt-laporan-bulanan-pegawai']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_senarai_program_setiap_bulan, 'url' => ['/perancangan-program-hpt/laporan-senarai-program-setiap-bulan-hpt'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perancangan-program-hpt']['module'])],
                                                ['label' => GeneralLabel::laporan_bilangan_program_bagi_setiap_bulan, 'url' => ['/perancangan-program-hpt/laporan-bilangan-program-bagi-setiap-bulan-hpt'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perancangan-program-hpt']['module'])],
                                                ['label' => GeneralLabel::laporan_senarai_hpt_laporan_bulanan_pegawai, 'url' => ['/hpt-laporan-bulanan-pegawai/laporan-senarai-hpt-laporan-bulanan-pegawai'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['hpt-laporan-bulanan-pegawai']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::suaian_fizikal_sistem_pendaftaran_atlet_di_gym,
                                    'items' => [
                                        ['label' => GeneralLabel::suaian_fizikal_sistem_pendaftaran_atlet_di_gym, 'url' => ['/pendaftaran-gym/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pendaftaran-gym']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_gym_jumlah_atlet, 'url' => ['/pendaftaran-gym/laporan-gym-jumlah-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pendaftaran-gym']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::suaian_fizikal_sistem_pinjaman_peralatan,
                                    'items' => [
                                        ['label' => GeneralLabel::suaian_fizikal_sistem_pinjaman_peralatan, 'url' => ['/pinjaman-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_gym_kehadiran_atlet, 'url' => ['/pinjaman-peralatan/laporan-gym-kehadiran-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                //['label' => GeneralLabel::suaian_fizikal_sistem_pengurusan_kemudahan_dan_peralatan, 'url' => ['/pengurusan-kemudahan-dan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kemudahan-dan-peralatan']['module'])],
                                [
                                    'label' => GeneralLabel::suaian_fizikal_sistem_pengurusan_kemudahan_dan_peralatan,
                                    'items' => [
                                        ['label' => GeneralLabel::pengurusan_kemudahan_dan_peralatan, 'url' => ['/pengurusan-kemudahan-dan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kemudahan-dan-peralatan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_statistik_pengurusan_kemudahan, 'url' => ['/pengurusan-kemudahan-dan-peralatan/laporan-statistik-pengurusan-kemudahan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kemudahan-dan-peralatan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::suaian_fizikal_sistem_pengurusan_dan_analisis_pembekal, 'url' => ['/pengurusan-kontraktor/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kontraktor']['module'])],
                                ['label' => GeneralLabel::suaian_fizikal_sistem_sixstep, 'url' => ['/six-step-suaian-fizikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-suaian-fizikal']['module'])],
                                ['label' => GeneralLabel::psikologi_sukan_sistem_sixstep, 'url' => ['/six-step-psikologi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-psikologi']['module'])],
                                [
                                    'label' => GeneralLabel::pengurusan_sesi_dengan_keselamatan_encryption,
                                    'items' => [
                                        ['label' => GeneralLabel::profil_psikologi, 'url' => ['/psikologi-profil/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-profil']['module'])],
                                        //['label' => GeneralLabel::aktiviti_psikologi, 'url' => ['/psikologi-aktiviti/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-aktiviti']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::fisiologi_sistem_penjadualan_ujian_fisiologi,
                                    'items' => [
                                        ['label' => GeneralLabel::penjadualan_ujian_fisiologi, 'url' => ['/penjadualan-ujian-fisiologi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_fisiologi_jumlah_bilangan_ujian, 'url' => ['/penjadualan-ujian-fisiologi/laporan-fisiologi-jumlah-bilangan-ujian'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::fisiologi_sistem_pangkalan_data_atlet_dan_journal, 'url' => ['/soal-selidik-sebelum-ujian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian']['module'])],
                                ['label' => GeneralLabel::fisiologi_sistem_sixstep, 'url' => ['/six-step-fisiologi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-fisiologi']['module'])],
                                ['label' => GeneralLabel::biomekanik_sistem_permohonan_perkhidmatan_analisa_perlawanan_dan_biomekanik, 'url' => ['/permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['module'])],
                                //['label' => GeneralLabel::biomekanik_sistem_pangkalan_data, 'url' => ['/perkhidmatan-analisa-perlawanan-biomekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['module'])],
                                [
                                    'label' => GeneralLabel::biomekanik_sistem_pangkalan_data,
                                    'items' => [
                                        ['label' => GeneralLabel::perkhidmatan_analisa_perlawananbiomekanik, 'url' => ['/perkhidmatan-analisa-perlawanan-biomekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_perkhidmatan_biomekanik_mengikut_atlet, 'url' => ['/perkhidmatan-analisa-perlawanan-biomekanik/laporan-perkhidmatan-biomekanik-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['module'])],
                                                ['label' => GeneralLabel::laporan_perkhidmatan_biomekanik_bilangan, 'url' => ['/perkhidmatan-analisa-perlawanan-biomekanik/laporan-perkhidmatan-biomekanik-bilangan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['perkhidmatan-analisa-perlawanan-biomekanik']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::biomekanik_sistem_pengurusan_peralatan,
                                    'items' => [
                                        ['label' => GeneralLabel::pinjaman_peralatan, 'url' => ['/pinjaman-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_gym_kehadiran_atlet, 'url' => ['/pinjaman-peralatan/laporan-gym-kehadiran-atlet'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::biomekanik_analisa_impak_biomekanik_dan_analisa_sukan_terhadap_prestasi_atlet, 'url' => ['/permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['module'])],
                                ['label' => GeneralLabel::biomekanik_sistem_permohonan_khidmat_biomekanik_secara_atas_talian, 'url' => ['/permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik']['module'])],
                                ['label' => GeneralLabel::biomekanik_sistem_six_step, 'url' => ['/six-step-biomekanik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-biomekanik']['module'])],
                                //['label' => GeneralLabel::pemakanan_sistem_permohonan_khidmat_analisis_tubuh_badan, 'url' => ['/permohonan-perkhidmatan-permakanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                                [
                                    'label' => GeneralLabel::pemakanan_sistem_permohonan_khidmat_analisis_tubuh_badan,
                                    'items' => [
                                        ['label' => GeneralLabel::perkhidmatan_permakanan, 'url' => ['/permohonan-perkhidmatan-permakanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_statistik_analisi_tubuh_badan, 'url' => ['/perkhidmatan-permakanan/laporan-statistik-analisi-tubuh-badan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_makanan_tambahan, 'url' => ['/perkhidmatan-permakanan/laporan-statistik-makanan-tambahan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                                                ['label' => GeneralLabel::laporan_statistik_jus, 'url' => ['/perkhidmatan-permakanan/laporan-statistik-jus'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::pemakanan_sistem_permohonan_khidmat_pemberian_suplemen_dan_makanan, 'url' => ['/permohonan-perkhidmatan-permakanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                                ['label' => GeneralLabel::pemakanan_sistem_pinjaman_barangan_dan_peralatan, 'url' => ['/pinjaman-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pinjaman-peralatan']['module'])],
                                ['label' => GeneralLabel::pemakanan_sistem_permohonan_khidmat_rundingan_pendidikan, 'url' => ['/permohonan-perkhidmatan-permakanan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['module'])],
                                //['label' => GeneralLabel::sistem_pengurusan_pengenalpastian_bakat_yang_telah_disaringkan, 'url' => ['/ujian-saringan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['ujian-saringan']['module'])],
                                [
                                    'label' => GeneralLabel::sistem_pengurusan_pengenalpastian_bakat_yang_telah_disaringkan,
                                    'items' => [
                                        ['label' => GeneralLabel::maklumat_bakat, 'url' => ['/ujian-saringan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['ujian-saringan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_statistik_program, 'url' => ['/ujian-saringan/laporan-statistik-program'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['ujian-saringan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::satelit_sistem_laporan_pusat, 'url' => ['/satelit/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['satelit']['module'])],
                                ['label' => GeneralLabel::satelit_sistem_six_step, 'url' => ['/six-step-satelit/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-satelit']['module'])],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::pendidikan_sukan,
                            'items' => [
                                ['label' => GeneralLabel::penyelidikan_sistem_pengurusan_geran_penyelidikan_penyelidikan_sistem_penyelarasan_penyelidikan, 'url' => ['/permohonan-penyelidikan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-penyelidikan']['module'])],
                                ['label' => GeneralLabel::penyelidikan_sistem_pengurusan_penerbitan, 'url' => ['/journal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['journal']['module'])],
                                ['label' => GeneralLabel::teknologi_instrumentasi_sistem_permohonan_projek_inovasi, 'url' => ['/permohonan-inovasi-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-inovasi-peralatan']['module'])],
                                ['label' => GeneralLabel::permohonan_membaiki_peralatan, 'url' => ['/permohonan-membaiki-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-membaiki-peralatan']['module'])],
                                [
                                    'label' => GeneralLabel::pengurusan_pendidikan,
                                    'items' => [
                                        ['label' => GeneralLabel::penganjuran_kursus, 'url' => ['/penganjuran-kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['module'])],
                                        //['label' => GeneralLabel::penganjuran_kursus_senarai_peserta, 'url' => ['/penganjuran-kursus-peserta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['module'])],
                                        //['label' => GeneralLabel::penganjuran_kursus_penganjur, 'url' => ['/penganjuran-kursus-penganjur/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-penganjur']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_senarai_kursus, 'url' => ['/penganjuran-kursus/laporan-senarai-kursus'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['module'])],
                                                ['label' => GeneralLabel::laporan_senarai_peserta, 'url' => ['/penganjuran-kursus/laporan-senarai-peserta'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::perubatan_sukan,
                            'items' => [
                                [
                                    'label' => GeneralLabel::pesakit_luar_sistem_pendaftaran_dan_temujanji_atlet_pesakit_luar_sistem_proses_rawatan_pesakit_luar_pengurusan_rekod_pemeriksaan_perubatan_pesakit_luar_sistem_pemberian_ubat_kepada_psk,
                                    'items' => [
                                        ['label' => GeneralLabel::temujanji, 'url' => ['/pl-temujanji/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                                        //['label' => GeneralLabel::data_klinikal, 'url' => ['/pl-data-klinikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_temujanji_kedatangan_pesakit, 'url' => ['/pl-temujanji/laporan-temujanji-kedatangan-pesakit'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                                                ['label' => GeneralLabel::laporan_temujanji_kedatangan_pegawai, 'url' => ['/pl-temujanji/laporan-temujanji-kedatangan-pegawai'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                                                ['label' => GeneralLabel::laporan_temujanji_mengikut_status, 'url' => ['/pl-temujanji/laporan-temujanji-mengikut-status'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                                                ['label' => GeneralLabel::laporan_temujanji_mengikut_sukan, 'url' => ['/pl-temujanji/laporan-temujanji-mengikut-sukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                ['label' => GeneralLabel::farmasi_rekod_permohonan_ubatan_di_kaunter_oleh_atlet_otc_drug, 'url' => ['/farmasi-permohonan-ubatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['module'])],
                                [
                                    'label' => GeneralLabel::makmal_perubatan_permohonan_khidmat_ujian_makmal_melalui_sistem,
                                    'items' => [
                                        ['label' => GeneralLabel::temujanji_makmal_perubatan, 'url' => ['/pl-temujanji-makmal-perubatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-makmal-perubatan']['module'])],
                                        ['label' => GeneralLabel::laporan_temujanji_makmal_perubatan, 'url' => ['/pl-temujanji-makmal-perubatan/laporan-temujanji-makmal-perubatan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-makmal-perubatan']['module'])],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::permohonan_penyiasatan_makmal_dan_pengimejan_pengimejan_pengurusan_pangkalan_data_atlet_imej,
                                    'items' => [
                                        ['label' => GeneralLabel::temujanji_penyiasatan, 'url' => ['/pl-temujanji-penyiasatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-penyiasatan']['module'])],
                                        //['label' => GeneralLabel::data_klinikal, 'url' => ['/pl-data-klinikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_temujanji_penyiasatan, 'url' => ['/pl-temujanji-penyiasatan/laporan-temujanji-penyiasatan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-penyiasatan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                //['label' => GeneralLabel::caj_perkhidmatan_senarai_harga_perkhidmatan_caj_perkhidmatan_senarai_harga_ubatan, 'url' => ['/senarai-harga-perkhidmatan-ubatan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['module'])],
                                [
                                    'label' => GeneralLabel::caj_perkhidmatan_senarai_harga_perkhidmatan_caj_perkhidmatan_senarai_harga_ubatan,
                                    'items' => [
                                        ['label' => GeneralLabel::senarai_harga_perkhidmatanubatanperalatan, 'url' => ['/senarai-harga-perkhidmatan-ubatan-peralatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_senarai_harga_perkhidmatan_ubatan_peralatan, 'url' => ['/senarai-harga-perkhidmatan-ubatan-peralatan/laporan-senarai-harga-perkhidmatan-ubatan-peralatan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['senarai-harga-perkhidmatan-ubatan-peralatan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => GeneralLabel::fisioterapi_sistem_permohonan_khidmat_rawatan_fisioterapi,
                                    'items' => [
                                        ['label' => GeneralLabel::temujanji_fisioterapi, 'url' => ['/pl-temujanji-fisioterapi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['module'])],
                                        ['label' => GeneralLabel::laporan_temujanji_fisioterapi, 'url' => ['/pl-temujanji-fisioterapi/laporan-temujanji-fisioterapi'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['module'])],
                                    ],
                                ],
                                /*[
                                    'label' => GeneralLabel::rehabilitasi_permohonan_khidmat_rawatan_rehabilitasi,
                                    'items' => [
                                        ['label' => GeneralLabel::temujanji_rehabilitasi, 'url' => ['/pl-temujanji-rehabilitasi/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-rehabilitasi']['module'])],
                                        ['label' => GeneralLabel::laporan_temujanji_rehabilitasi, 'url' => ['/pl-temujanji-rehabilitasi/laporan-temujanji-rehabilitasi'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-rehabilitasi']['module'])],
                                    ],
                                ],*/
                                [
                                    'label' => GeneralLabel::liputan_perubatan_dalam_dan_luar_negara,
                                    'items' => [
                                        ['label' => GeneralLabel::permohonan_liputan_perubatan_sukan, 'url' => ['/farmasi-permohonan-liputan-perubatan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['module'])],
                                        ['label' => GeneralLabel::permohonan_ubatan, 'url' => ['/farmasi-permohonan-ubatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-ubatan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_ringkasan_statistik, 'url' => ['/farmasi-permohonan-liputan-perubatan-sukan/laporan-ringkasan-statistik'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['module'])],
                                                ['label' => GeneralLabel::laporan_ringkasan_statistik_bulanan, 'url' => ['/farmasi-permohonan-liputan-perubatan-sukan/laporan-ringkasan-statistik-bulanan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['module'])],
                                                ['label' => GeneralLabel::laporan_bulanan_secara_detail, 'url' => ['/farmasi-permohonan-liputan-perubatan-sukan/laporan-bulanan-secara-detail'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],
                                //['label' => GeneralLabel::pendidikan_sistem_permohonan_program_pendidikan_kesihatan_kepada_atlet_dan_staf, 'url' => ['/permohonan-program-pendidikan-kesihatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['module'])],
                                [
                                    'label' => GeneralLabel::pendidikan_sistem_permohonan_program_pendidikan_kesihatan_kepada_atlet_dan_staf,
                                    'items' => [
                                        ['label' => GeneralLabel::permohonan_program_pendidikan_kesihatan, 'url' => ['/permohonan-program-pendidikan-kesihatan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_ringkasan_statistik_program_pendidikan, 'url' => ['/permohonan-program-pendidikan-kesihatan/laporan-ringkasan-statistik-program-pendidikan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['module'])],
                                                ['label' => GeneralLabel::laporan_bulanan_program_pendidikan, 'url' => ['/permohonan-program-pendidikan-kesihatan/laporan-bulanan-program-pendidikan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-program-pendidikan-kesihatan']['module'])],
                                            ],
                                        ],
                                    ],
                                ],    
                                [
                                    'label' => GeneralLabel::komplementari_sistem_permohonan_perkhidmatan_perkhidmatan_komplementari,
                                    'items' => [
                                        ['label' => GeneralLabel::temujanji_komplimentori, 'url' => ['/temujanji-komplimentari/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['module'])],
                                        [
                                            'label' => GeneralLabel::laporan,
                                            'items' => [
                                                ['label' => GeneralLabel::laporan_komplimentori, 'url' => ['/temujanji-komplimentari/laporan-komplimentori'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['module'])],
                                                ['label' => GeneralLabel::laporan_ringkasan_statistik_komplimentari, 'url' => ['/temujanji-komplimentari/laporan-ringkasan-statistik-komplimentari'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['module'])],
                                            ],
                                        ],
                                        ['label' => GeneralLabel::permohonan_liputan_perubatan_sukan, 'url' => ['/farmasi-permohonan-liputan-perubatan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['farmasi-permohonan-liputan-perubatan-sukan']['module'])],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk,
                            'items' => [
                                ['label' => GeneralLabel::permohonan_lesen, 'url' => ['/akademi-akk/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['module'])],
                                //['label' => GeneralLabel::cce, 'url' => ['/kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['kursus']['module'])],
                                ['label' => GeneralLabel::penganjuran_kursus, 'url' => ['/penganjuran-kursus/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['module'])],
                                //['label' => GeneralLabel::penganjuran_kursus_senarai_peserta, 'url' => ['/penganjuran-kursus-peserta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['module'])],
                                //['label' => GeneralLabel::penganjuran_kursus_penganjur, 'url' => ['/penganjuran-kursus-penganjur/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-penganjur']['module'])],
                                [
                                    'label' => GeneralLabel::laporan,
                                    'items' => [
                                        ['label' => GeneralLabel::laporan_senarai_peserta, 'url' => ['/penganjuran-kursus/laporan-senarai-peserta'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['module'])],
                                        ['label' => GeneralLabel::laporan_senarai_kursus, 'url' => ['/penganjuran-kursus/laporan-senarai-kursus'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus']['module'])],
                                        ['label' => GeneralLabel::laporan_skim_pelesenan_kejurulatihan_kebangsaan, 'url' => ['/akademi-akk/laporan-skim-pelesenan-kejurulatihan-kebangsaan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['module'])],
                                        ['label' => GeneralLabel::laporan_kursus_sains_sukan, 'url' => ['/akademi-akk/laporan-kursus-sains-sukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['ISN']['akademi-akk']['module'])],
                                    ],
                                ],
                            ],
                        ],
                    ]];
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['PJS'])){
                    $sideMenuItems[] = ['label' => GeneralLabel::pjs, 'url' => ['#'],'items' => [
                        ['label' => GeneralLabel::profil_badan_sukan, 'url' => ['/profil-badan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                        ['label' => GeneralLabel::maklumat_mesyuarat_agung_tahunan, 'url' => ['/ltbs-minit-mesyuarat-jawatankuasa/index','profil_badan_sukan_id' => ''], 'visible' => (isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['module']) && !Yii::$app->user->identity->profil_badan_sukan)],
                        /*[
                            'label' => 'Laporan Tahunan Badan Sukan',
                            'items' => [
                                ['label' => GeneralLabel::maklumat_mesyuarat_agung_tahunan, 'url' => ['/ltbs-minit-mesyuarat-jawatankuasa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['module'])],
                                //['label' => GeneralLabel::notis_mesyuarat_agong, 'url' => ['/ltbs-notis-agm/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-notis-agm']['module'])],
                                //['label' => GeneralLabel::minit_mesyuarat_agong, 'url' => ['/ltbs-minit-mesyuarat-agm/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-agm']['module'])],
                                //['label' => GeneralLabel::ahli_jawatan_induk_id, 'url' => ['/ltbs-ahli-jawatankuasa-induk-kecil/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-induk-kecil']['module'])],
                                //['label' => GeneralLabel::ahli_jawatankuasa_kecil_biro_, 'url' => ['/ltbs-ahli-jawatankuasa-kecil/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-kecil']['module'])],
                                //['label' => GeneralLabel::senarai_ahli_gabungan, 'url' => ['/ltbs-ahli-gabungan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-gabungan']['module'])],
                                ['label' => GeneralLabel::laporan_aktiviti_badan_sukan, 'url' => ['/ltbs-kejohanan-program-aktiviti/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-kejohanan-program-aktiviti']['module'])],
                                ['label' => GeneralLabel::penyata_kewangan, 'url' => ['/ltbs-penyata-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-penyata-kewangan']['module'])],
                                ['label' => GeneralLabel::sumber_kewangan, 'url' => ['/ltbs-sumber-kewangan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-sumber-kewangan']['module'])],
                            ],
                        ],*/
                        //['label' => GeneralLabel::perlembagaan_badan_sukan, 'url' => ['/perlembagaan-badan-sukan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['perlembagaan-badan-sukan']['module'])],
                        ['label' => GeneralLabel::penganjuran_acara_oleh_badan_sukan, 'url' => ['/paobs-penganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['module'])],
                        /*[
                            'label' => GeneralLabel::penganjuran_acara_oleh_badan_sukan,
                            'items' => [
                                ['label' => GeneralLabel::penganjuran_acara_sukan, 'url' => ['/paobs-penganjuran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['module'])],
                                ['label' => GeneralLabel::penganjuran_acara_sukan_yang_disanksi, 'url' => ['/paobs-penganjur/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjur']['module'])],
                            ],
                        ],*/
                        ['label' => GeneralLabel::latihan_pendidikan_badan_sukan, 'url' => ['/latihan-dan-program/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['latihan-dan-program']['module'])],
                        ['label' => GeneralLabel::persatuan, 'url' => ['/persatuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['persatuan']['module'])],
                        [
                            'label' => GeneralLabel::laporan,
                            'items' => [
                                ['label' => GeneralLabel::laporan_ahli_jawatankuasa_induk, 'url' => ['/profil-badan-sukan/laporan-ahli-jawatankuasa-induk'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                                ['label' => GeneralLabel::laporan_ahli_jawatankuasa_kecil_biro, 'url' => ['/profil-badan-sukan/laporan-ahli-jawatankuasa-kecil-biro'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                                ['label' => GeneralLabel::laporan_badan_sukan, 'url' => ['/profil-badan-sukan/laporan-badan-sukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                                ['label' => GeneralLabel::laporan_penganjuran_acara, 'url' => ['/profil-badan-sukan/laporan-penganjuran-acara'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['PJS']['profil-badan-sukan']['module'])],
                            ],
                        ],
                    ]];
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['KBS'])){
                    $sideMenuItems[] = ['label' => GeneralLabel::kbs, 'url' => ['#'],'items' => [
                        [
                            'label' => GeneralLabel::ebantuan,
                            'items' => [
                                ['label' => GeneralLabel::permohonan_ebantuan, 'url' => ['/permohonan-e-bantuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['module'])],
                                ['label' => GeneralLabel::urusetia, 'url' => ['/permohonan-e-bantuan-urusetia/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan-urusetia']['module'])],
                                ['label' => GeneralLabel::e_bantuan_public_user, 'url' => ['/public-user-e-bantuan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['public-user-e-bantuan']['module'])],
                                ['label' => GeneralLabel::laporan_status_permohonan_bantuan, 'url' => ['/permohonan-e-bantuan/laporan-status-permohonan-bantuan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['module'])],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::elaporan,
                            'items' => [
                                ['label' => GeneralLabel::elaporan, 'url' => ['/elaporan-pelaksanaan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['module'])],
                                ['label' => GeneralLabel::e_laporan_public_user, 'url' => ['/public-user-e-laporan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['public-user-e-laporan']['module'])],
                                ['label' => GeneralLabel::laporan_pelaksanaan_program, 'url' => ['/elaporan-pelaksanaan/report'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['elaporan-pelaksanaan']['module'])],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::efasiliti_ekemudahan,
                            'items' => [
                                ['label' => GeneralLabel::pengurusan_venue, 'url' => ['/pengurusan-kemudahan-venue/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-venue']['module'])],
                                //['label' => GeneralLabel::pengurusan_kemudahan, 'url' => ['/pengurusan-kemudahan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-sedia-ada']['module'])],
                                //['label' => GeneralLabel::pengurusan_peralatan, 'url' => ['/pengurusan-kemudahan-peralatan-sedia-ada/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-peralatan-sedia-ada']['module'])],
                                //['label' => GeneralLabel::kemudahan_aduan, 'url' => ['/pengurusan-kemudahan-aduan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan']['module'])],
                                //['label' => GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, 'url' => ['/pengurusan-kemudahan-aduan-pemeriksa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan-pemeriksa']['module'])],
                                ['label' => GeneralLabel::tempahan, 'url' => ['/tempahan-kemudahan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                ['label' => GeneralLabel::e_kemudahan_public_user, 'url' => ['/public-user-e-kemudahan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['public-user-e-kemudahan']['module'])],
                                [
                                    'label' => GeneralLabel::laporan,
                                    'items' => [
                                        ['label' => GeneralLabel::laporan_pengguna_dan_hasil_bagi_kombes, 'url' => ['/tempahan-kemudahan/laporan-penggunaan-dan-hasil-bagi-kombes'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                        ['label' => GeneralLabel::laporan_kuantiti_kemudahan, 'url' => ['/tempahan-kemudahan/laporan-kuantiti-kemudahan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                        ['label' => GeneralLabel::laporan_pengguna_dan_hasil_bagi_kombes_tahunan, 'url' => ['/tempahan-kemudahan/laporan-penggunaan-dan-hasil-bagi-kombes-tahunan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['module'])],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => GeneralLabel::ebiasiswa,
                            'items' => [
                                ['label' => GeneralLabel::permohonan_ebiasiswa, 'url' => ['/permohonan-e-biasiswa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::penjamin_biasiswa_sukan_persekutuan, 'url' => ['/bsp-penjamin/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::kedudukan_kewangan_penjamin, 'url' => ['/bsp-kedudukan-kewangan-penjamin/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::kedudukan_kewangan_penjamin_jenis_harta, 'url' => ['/bsp-kedudukan-kewangan-penjamin-jenis-harta/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::prestasi_akademik, 'url' => ['/bsp-prestasi-akademik/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::tuntutan_elaun_tesis, 'url' => ['/bsp-tuntutan-elaun-tesis/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::elaun_latihan_praktikal, 'url' => ['/bsp-elaun-latihan-praktikal/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::elaun_perjalanan_udara, 'url' => ['/bsp-elaun-perjalanan-udara/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::pelanjutan, 'url' => ['/bsp-perlanjutan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::sebab_pelanjutan, 'url' => ['/bsp-perlanjutan-sebab/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::pertukaran_program_pengajian, 'url' => ['/bsp-pertukaran-program-pengajian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::sebab_pertukaran_program_pengajian, 'url' => ['/bsp-pertukaran-program-pengajian-sebab/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::dokumen_pertukaran_program_pengajian, 'url' => ['/bsp-pertukaran-program-pengajian-dokumen/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                //['label' => GeneralLabel::pembayaran_biasiswa_sukan_persekutuan, 'url' => ['/bsp-pembayaran/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['bsp-pembayaran']['module'])],
                                ['label' => GeneralLabel::pengesahan_tamat_pengajian, 'url' => ['/bsp-tamat-pengesahan-pengajian/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['bsp-tamat-pengesahan-pengajian']['module'])],
                                ['label' => GeneralLabel::bendahari_ipt, 'url' => ['/bsp-bendahari-ipt/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['bsp-bendahari-ipt']['module'])],
                                ['label' => GeneralLabel::e_biasiswa_public_user, 'url' => ['/public-user-e-biasiswa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['public-user-e-biasiswa']['module'])],
                                [
                                    'label' => GeneralLabel::laporan,
                                    'items' => [
                                        ['label' => GeneralLabel::laporan_penyata_bayaran_pelajar, 'url' => ['/permohonan-e-biasiswa/laporan-penyata-bayaran-pelajar'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_prestasi_akademik, 'url' => ['/permohonan-e-biasiswa/laporan-prestasi-akademik'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_senarai_penerima_biasiswa, 'url' => ['/permohonan-e-biasiswa/laporan-senarai-penerima-biasiswa'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_permohonan_biasiswa_mengikut_ipta_ipts, 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-ipta-ipts'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_permohonan_biasiswa_mengikut_jantina, 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-jantina'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_permohonan_biasiswa_mengikut_kaum, 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-kaum'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_permohonan_biasiswa_mengikut_peringkat_pengajian, 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-peringkat-pengajian'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_permohonan_biasiswa_mengikut_status, 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-status'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_permohonan_biasiswa_mengikut_sukan, 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-sukan'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                        ['label' => GeneralLabel::laporan_statistik_permohonan_biasiswa_mengikut_universiti_institusi, 'url' => ['/permohonan-e-biasiswa/laporan-statistik-permohonan-biasiswa-mengikut-universiti-institusi'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-biasiswa']['module'])],
                                    ],
                                ],
                            ],
                        ],
                        
                    ]];
                }
                
                if(isset(Yii::$app->user->identity->peranan_akses['Admin'])){
                    $sideMenuItems[] = ['label' => GeneralLabel::administration, 'url' => ['#'],'items' => [
                        ['label' => GeneralLabel::user, 'url' => ['/user/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['module'])],
                        ['label' => GeneralLabel::user_peranan, 'url' => ['/user-peranan/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['Admin']['user-peranan']['module'])],
                        ['label' => GeneralLabel::admin_ebiasiswa, 'url' => ['/admin-e-biasiswa/index'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['Admin']['admin-e-biasiswa']['module'])],
                        ['label' => GeneralLabel::admin_audit_log, 'url' => ['/audit/trail'], 'visible' => isset(Yii::$app->user->identity->peranan_akses['Admin']['admin-audit']['module'])],
                    ]];
                }
                
                //$sideMenuItems[] = ['label' => GeneralLabel::laporan, 'url' => 'http://10.19.189.87:8080/jasperserver'];
                
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

/*function print_item_label($items) {
    foreach ($items as $item) {

        $lbl = trim($item['label']);
        $val = str_replace(" ","_",strtolower($lbl));

        echo $val."\t".$lbl."\n";
        //echo $lbl."\n";

        if(isset($item['items']))
            print_item_label($item['items']);
    }
}*/

if(isset($sideMenuItems)){

/*    echo "<textarea cols=\"189\" rows=\"30\">";
    print_item_label($sideMenuItems);
    exit();
    echo "</textarea>";*/

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
