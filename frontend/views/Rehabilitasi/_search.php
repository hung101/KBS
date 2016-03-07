<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RehabilitasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rehabilitasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rehabilitasi_id') ?>

    <?= $form->field($model, 'pl_diagnosis_preskripsi_pemeriksaan_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'kesan_klinikal') ?>

    <?= $form->field($model, 'masalah_yang_dikenal_pasti') ?>

    <?php // echo $form->field($model, 'potensi_rehabilitasi') ?>

    <?php // echo $form->field($model, 'matlamat_rehabilitasi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
