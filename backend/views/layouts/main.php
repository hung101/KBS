<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\PublicUser;

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
                if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_BIASISWA){
                    $url_home = '/site/e-biasiswa-home';
                } else if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_KEMUDAHAN){
                    $url_home = '/site/e-kemudahan-home';
                }  else if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_BANTUAN){
                    $url_home = '/site/e-bantuan-home';
                } else if(Yii::$app->user->identity->category_access == PublicUser::ACCESS_LAPORAN){
                    $url_home = '/site/e-laporan-home';
                }
                $menuItems = [
                    ['label' => 'Home', 'url' => [$url_home]],
                ];
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

        <div class="container" style='margin-top: 1cm;'>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
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
