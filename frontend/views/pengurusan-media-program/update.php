<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMediaProgram */

//$this->title = 'Update Pengurusan Media Program: ' . ' ' . $model->pengurusan_media_program_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Media';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Media', 'url' => ['view', 'id' => $model->pengurusan_media_program_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-media-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelDokumenMediaProgram' => $searchModelDokumenMediaProgram,
        'dataProviderDokumenMediaProgram' => $dataProviderDokumenMediaProgram,
        'searchModelKehadiranMediaProgram' => $searchModelKehadiranMediaProgram,
        'dataProviderKehadiranMediaProgram' => $dataProviderKehadiranMediaProgram,
        'readonly' => $readonly,
    ]) ?>

</div>
