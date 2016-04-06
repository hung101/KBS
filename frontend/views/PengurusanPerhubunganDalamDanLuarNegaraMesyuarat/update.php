<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuarat */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat.': ' . ' ' . $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id, 'url' => ['view', 'id' => $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-perhubungan-dalam-dan-luar-negara-mesyuarat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
