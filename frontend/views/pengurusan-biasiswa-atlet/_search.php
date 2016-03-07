<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanBiasiswaAtletSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-biasiswa-atlet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_biasiswa_atlet_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh_mula') ?>

    <?= $form->field($model, 'tarikh_akhir') ?>

    <?= $form->field($model, 'nama_biasiswa_sponsor') ?>

    <?php // echo $form->field($model, 'jumlah_penajaan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
