<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanPeserta */

$this->title = 'Update Pengurusan Program Binaan Peserta: ' . ' ' . $model->pengurusan_program_binaan_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_program_binaan_peserta_id, 'url' => ['view', 'id' => $model->pengurusan_program_binaan_peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-peserta-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
