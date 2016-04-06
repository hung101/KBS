<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanDokumenMediaProgram */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_dokumen_media_program.': ' . ' ' . $model->pengurusan_dokumen_media_program_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_dokumen_media_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_dokumen_media_program_id, 'url' => ['view', 'id' => $model->pengurusan_dokumen_media_program_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-dokumen-media-program-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
