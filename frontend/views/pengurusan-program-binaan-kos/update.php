<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanKos */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_program_binaan_kos.': ' . ' ' . $model->pengurusan_program_binaan_kos_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_binaan_kos, 'url' => ['index']];
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
