<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\PublicUser;
use frontend\widgets\Alert;
use kartik\widgets\SideNav;

use app\models\general\GeneralLabel;

// table reference
use app\models\RefKategoriHakmilik;

use backend\models\SignupEKemudahanForm;

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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img id="kbs_logo" src="' . Yii::$app->getUrlManager()->getBaseUrl() . '/img/kbs-logo.png" alt="KBS Logo">',
                //'brandLabel' => 'SBSP',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            if (!Yii::$app->user->isGuest) {
                $url_home = '/site';
                
                if(Yii::$app->user->identity->email_verified == 1){
                    if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_BIASISWA){
                        $url_home = '/site/e-biasiswa-home';
                        $sideMenuItems = [
                            ['label' => 'Permohonan e-Biasiswa', 'url' => ['/site/e-biasiswa-home']],
                            ['label' => 'Sejarah Permohonan', 'url' => ['/permohonan-e-biasiswa/index']],
                        ];
                    } else if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_KEMUDAHAN){
                        $url_home = '/site/e-kemudahan-home';
                        $ref = RefKategoriHakmilik::findOne(['id' => \Yii::$app->user->identity->kategory_hakmilik_e_kemudahan]);

                        if(\Yii::$app->user->identity->jenis_pengguna_e_kemudahan == SignupEKemudahanForm::PEMILIK){
                            $sideMenuItems[] = ['label' => 'Pengurusan Iklan', 'url' => ['/pengurusan-kemudahan-venue/index']];
                            if($ref['tempahan_display_flag']){
                                $sideMenuItems[] = ['label' => 'Pengurusan Tempahan', 'url' => ['/tempahan-kemudahan/index']];
                            }
                        }elseif(\Yii::$app->user->identity->jenis_pengguna_e_kemudahan == SignupEKemudahanForm::PENGGUNA){
                            $sideMenuItems = [
                                ['label' => 'Tempahan', 'url' => ['/tempahan-kemudahan/create']],
                                ['label' => 'Sejarah Tempahan', 'url' => ['/tempahan-kemudahan/index']],
                            ];
                        }
                    }  else if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_BANTUAN){
                        $url_home = '/site/e-bantuan-home';
                        $sideMenuItems = [
                            ['label' => 'Permohonan', 'url' => ['/permohonan-e-bantuan/create']],
                            ['label' => 'Permohonan Terdahulu', 'url' => ['/permohonan-e-bantuan/index']],
                        ];
                    } else if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_LAPORAN){
                        $url_home = '/site/e-laporan-home';

                        $sideMenuItems = [
                            ['label' => 'e-Laporan', 'url' => ['/elaporan-pelaksanaan/create', 'permohonan_e_bantuan_id' => '']],
                            ['label' => 'Sejarah e-Laporan', 'url' => ['/elaporan-pelaksanaan/index']],
                        ];
                    } else if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_KEMUDAHAN_MSN){
                        $url_home = '/site/e-kemudahan-msn-home';

                        $sideMenuItems = [
                            ['label' => 'Tempahan', 'url' => ['/tempahan-kemudahan-msn/create']],
                            ['label' => 'Sejarah Tempahan', 'url' => ['/tempahan-kemudahan-msn/index']],
                            ['label' => 'Kemaskini Profil', 'url' => ['/site/update-profile-kemudahan-msn']],
                        ];
                    }
                }
                /*$menuItems = [
                    ['label' => 'Home', 'url' => [$url_home]],
                ];*/
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            if(isset($menuItems)){
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
            }
            NavBar::end();
        ?>
        
        <div class="<?php echo isset($sideMenuItems) ? 'container' : 'container'; ?>" style='margin-top: 1cm;'>
            <div class="<?php echo isset($sideMenuItems) ? 'col-sm-2' : ''; ?>">
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
            <div class="<?php echo isset($sideMenuItems) ? 'col-sm-10' : 'col-sm-12'; ?>">
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
        <div class="container">
        <p class="pull-left">Copyright &copy; <?= date('Y') ?> Portal Rasmi Kementerian Belia dan Sukan Malaysia. All Rights Reserved.</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
