<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanTeknikal */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_program_binaan_teknikal.': ' . ' ' . $model->pengurusan_program_binaan_teknikal_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_binaan_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_program_binaan_teknikal_id, 'url' => ['view', 'id' => $model->pengurusan_program_binaan_teknikal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-teknikal-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
