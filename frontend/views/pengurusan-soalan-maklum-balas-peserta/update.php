<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanMaklumBalasPeserta */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_soalan_maklum_balas_peserta.': ' . ' ' . $model->pengurusan_soalan_maklum_balas_peserta_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_soalan_maklum_balas_pesertas, 'url' => ['index']];
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
