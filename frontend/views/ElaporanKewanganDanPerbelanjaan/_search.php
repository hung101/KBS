<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ElaporanKewanganDanPerbelanjaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-kewangan-dan-perbelanjaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'elaporan_kewangan_dan_perbelanjaan_id') ?>

    <?= $form->field($model, 'elaporan_pelaksaan_id') ?>

    <?= $form->field($model, 'program_aktiviti_butir') ?>

    <?= $form->field($model, 'jenis_kewangan') ?>

    <?= $form->field($model, 'jumlah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
