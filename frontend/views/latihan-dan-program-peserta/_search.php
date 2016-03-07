<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LatihanDanProgramPesertaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="latihan-dan-program-peserta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'latihan_dan_program_peserta_id') ?>

    <?= $form->field($model, 'latihan_dan_program_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'nama_badan_sukan') ?>

    <?php // echo $form->field($model, 'no_pendaftaran_sukan') ?>

    <?php // echo $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'tempoh_memegang_jawatan') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
