<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMediaProgramWakil */

$this->title = 'Update Pengurusan Media Program Wakil: ' . $model->pengurusan_media_program_wakil_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Media Program Wakils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_media_program_wakil_id, 'url' => ['view', 'id' => $model->pengurusan_media_program_wakil_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-media-program-wakil-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
