<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanMaklumBalasPeserta */

$this->title = 'Update Pengurusan Soalan Maklum Balas Peserta: ' . ' ' . $model->pengurusan_soalan_maklum_balas_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Soalan Maklum Balas Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_soalan_maklum_balas_peserta_id, 'url' => ['view', 'id' => $model->pengurusan_soalan_maklum_balas_peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-soalan-maklum-balas-peserta-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
