<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

use common\models\PublicUser;
use app\models\general\GeneralLabel;

$this->title = GeneralLabel::sistem_pengurusan_sukan_bersepadu;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=GeneralLabel::selamat_datang?></h1>

        <p class="lead"><?=GeneralLabel::sistem_pengurusan_sukan_bersepadu?></p>
    </div>

    <div class="body-content">

        <div class="list-group">
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_BIASISWA])?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?=GeneralLabel::ebiasiswa?></h4>
              <p class="list-group-item-text"><?=GeneralLabel::memohon_biasiswa_melalui_secara_online?></p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_KEMUDAHAN])?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?=GeneralLabel::ekemudahan?></h4>
              <p class="list-group-item-text"><?=GeneralLabel::membuat_tempahan_mengiklan_secara_online?></p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_BANTUAN])?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?=GeneralLabel::ebantuan?></h4>
              <p class="list-group-item-text"><?=GeneralLabel::membuat_permohonan_secara_online?></p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_LAPORAN])?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?=GeneralLabel::elaporan?></h4>
              <p class="list-group-item-text"><?=GeneralLabel::mengisi_e_laporan_secara_online?></p>
            </a>
            <a href="<?php echo Yii::$app->urlManagerFrontEnd->createUrl(['/site/login']); ?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?=GeneralLabel::badan_sukan?></h4>
              <p class="list-group-item-text"><?=GeneralLabel::pengurusan_secara_online?></p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_KEMUDAHAN_MSN])?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?=GeneralLabel::ekemudahan?> MSN</h4>
              <p class="list-group-item-text"><?=GeneralLabel::membuat_tempahan_mengiklan_secara_online?></p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_SUKARELAWAN])?>" class="list-group-item">
              <h4 class="list-group-item-heading"><?=GeneralLabel::sukarelawan?></h4>
              <p class="list-group-item-text"><?=GeneralLabel::berdaftar_secara_online?></p>
            </a>
        </div>

    </div>
</div>
