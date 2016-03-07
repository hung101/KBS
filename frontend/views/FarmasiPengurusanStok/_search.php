<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FarmasiPengurusanStokSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="farmasi-pengurusan-stok-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'farmasi_pengurusan_stok') ?>

    <?= $form->field($model, 'nama_ubat') ?>

    <?= $form->field($model, 'dos') ?>

    <?= $form->field($model, 'harga') ?>

    <?= $form->field($model, 'kuantiti') ?>

    <?php // echo $form->field($model, 'jumlah_harga') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
