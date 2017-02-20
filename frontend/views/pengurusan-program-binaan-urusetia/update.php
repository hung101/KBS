<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanUrusetia */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_program_binaan_urusetia.': ' . ' ' . $model->pengurusan_program_binaan_urusetia_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_binaan_urusetia, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_program_binaan_urusetia_id, 'url' => ['view', 'id' => $model->pengurusan_program_binaan_urusetia_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-urusetia-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
