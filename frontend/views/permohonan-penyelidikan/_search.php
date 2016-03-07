<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPenyelidikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-penyelidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonana_penyelidikan_id') ?>

    <?= $form->field($model, 'nama_permohon') ?>

    <?= $form->field($model, 'tarikh_permohonan') ?>

    <?= $form->field($model, 'tajuk_penyelidikan') ?>

    <?= $form->field($model, 'ringkasan_permohonan') ?>

    <?php // echo $form->field($model, 'biasa_dengan_keperluan_penyelidikan') ?>

    <?php // echo $form->field($model, 'kelulusan_echics') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
