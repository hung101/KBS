<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMaklumBalasPeserta */

//$this->title = 'Update Pengurusan Maklum Balas Peserta: ' . ' ' . $model->pengurusan_maklum_balas_peserta_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::kehadiran_peserta;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kehadiran_peserta, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::kehadiran_peserta, 'url' => ['view', 'id' => $model->pengurusan_maklum_balas_peserta_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-maklum-balas-peserta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanSoalanMaklumBalasPeserta' => $searchModelPengurusanSoalanMaklumBalasPeserta,
        'dataProviderPengurusanSoalanMaklumBalasPeserta' => $dataProviderPengurusanSoalanMaklumBalasPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
