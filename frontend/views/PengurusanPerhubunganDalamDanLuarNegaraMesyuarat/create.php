<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuarat */

$this->title = GeneralLabel::tambah_pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhubungan-dalam-dan-luar-negara-mesyuarat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
