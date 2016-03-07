<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanKos */

$this->title = 'Update Pengurusan Program Binaan Kos: ' . ' ' . $model->pengurusan_program_binaan_kos_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Kos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_program_binaan_kos_id, 'url' => ['view', 'id' => $model->pengurusan_program_binaan_kos_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-kos-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
