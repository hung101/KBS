<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhimpunanKemPeserta */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_perhimpunan_kem_peserta.': ' . ' ' . $model->pengurusan_perhimpunan_kem_peserta_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_perhimpunan_kem_pesertas, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_perhimpunan_kem_peserta_id, 'url' => ['view', 'id' => $model->pengurusan_perhimpunan_kem_peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-perhimpunan-kem-peserta-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
