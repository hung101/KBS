<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

use common\models\PublicUser;

$this->title = 'System Pengurusan Sukan Bersepadu';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Selamat Datang</h1>

        <p class="lead">SISTEM PENGURUSAN SUKAN BERSEPADU</p>
    </div>

    <div class="body-content">

        <div class="list-group">
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_BIASISWA])?>" class="list-group-item">
              <h4 class="list-group-item-heading">e-Biasiswa</h4>
              <p class="list-group-item-text">Memohon biasiswa melalui secara online</p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_KEMUDAHAN])?>" class="list-group-item">
              <h4 class="list-group-item-heading">e-Kemudahan</h4>
              <p class="list-group-item-text">Membuat tempahan / Mengiklan secara online</p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_BANTUAN])?>" class="list-group-item">
              <h4 class="list-group-item-heading">e-Bantuan</h4>
              <p class="list-group-item-text">Membuat permohonan secara online</p>
            </a>
            <a href="<?=Url::to(['/site/login', 'access_id' => PublicUser::ACCESS_LAPORAN])?>" class="list-group-item">
              <h4 class="list-group-item-heading">e-Laporan</h4>
              <p class="list-group-item-text">Mengisi e-Laporan secara online</p>
            </a>
        </div>

    </div>
</div>
