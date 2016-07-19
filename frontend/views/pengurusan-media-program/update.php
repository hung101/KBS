<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMediaProgram */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_media_program.': ' . ' ' . $model->pengurusan_media_program_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_media;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_media, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_media, 'url' => ['view', 'id' => $model->pengurusan_media_program_id]];
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
        'searchModelPengurusanMediaProgramWakil' => $searchModelPengurusanMediaProgramWakil,
        'dataProviderPengurusanMediaProgramWakil' => $dataProviderPengurusanMediaProgramWakil,
        'readonly' => $readonly,
    ]) ?>

</div>
