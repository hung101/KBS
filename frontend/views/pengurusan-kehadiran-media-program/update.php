<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKehadiranMediaProgram */

$this->title = 'Update Pengurusan Kehadiran Media Program: ' . ' ' . $model->pengurusan_kehadiran_media_program_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kehadiran Media Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_kehadiran_media_program_id, 'url' => ['view', 'id' => $model->pengurusan_kehadiran_media_program_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-kehadiran-media-program-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
