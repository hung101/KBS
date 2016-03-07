<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanDokumenMediaProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-dokumen-media-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_dokumen_media_program_id') ?>

    <?= $form->field($model, 'pengurusan_media_program_id') ?>

    <?= $form->field($model, 'kategori_dokumen') ?>

    <?= $form->field($model, 'nama_dokumen') ?>

    <?= $form->field($model, 'muatnaik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
