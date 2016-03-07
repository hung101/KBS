<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FarmasiUbatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="farmasi-ubatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'farmasi_ubatan_id') ?>

    <?= $form->field($model, 'farmasi_permohonan_ubatan_id') ?>

    <?= $form->field($model, 'nama_ubat') ?>

    <?= $form->field($model, 'size') ?>

    <?= $form->field($model, 'kuantiti') ?>

    <?php // echo $form->field($model, 'harga') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
