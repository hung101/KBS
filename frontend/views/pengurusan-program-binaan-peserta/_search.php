<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanProgramBinaanPesertaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-program-binaan-peserta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_program_binaan_peserta_id') ?>

    <?= $form->field($model, 'pengurusan_program_binaan_id') ?>

    <?= $form->field($model, 'kategori_peserta') ?>

    <?= $form->field($model, 'atlet_jurulatih') ?>

    <?= $form->field($model, 'nama_peserta') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
