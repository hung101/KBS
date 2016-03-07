<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuarat */

$this->title = 'Update Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarat: ' . ' ' . $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id, 'url' => ['view', 'id' => $model->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-perhubungan-dalam-dan-luar-negara-mesyuarat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
