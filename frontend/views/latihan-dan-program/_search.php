<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="latihan-dan-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'latihan_dan_program_id') ?>

    <?= $form->field($model, 'nama_kursus') ?>

    <?= $form->field($model, 'tarikh_kursus') ?>

    <?= $form->field($model, 'lokasi_kursus') ?>

    <?= $form->field($model, 'penganjuran_kursus') ?>

    <?php // echo $form->field($model, 'bilangan_ahli_yang_menyertai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
