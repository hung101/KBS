<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKehadiranMediaProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kehadiran-media-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kehadiran_media_program_id') ?>

    <?= $form->field($model, 'pengurusan_media_program_id') ?>

    <?= $form->field($model, 'program') ?>

    <?= $form->field($model, 'nama_wartawan') ?>

    <?= $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'agensi') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
