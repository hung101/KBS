<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletOkuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-oku-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'oku_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'kurang_upaya_pendengaran') ?>

    <?= $form->field($model, 'jenis_kurang_upaya_pendengaran') ?>

    <?= $form->field($model, 'kurang_upaya_penglihatan') ?>

    <?php // echo $form->field($model, 'kurang_upaya_fizikal') ?>

    <?php // echo $form->field($model, 'masalah_pembelajaran') ?>

    <?php // echo $form->field($model, 'kurang_upaya_pertuturan') ?>

    <?php // echo $form->field($model, 'kurang_upaya_mental') ?>

    <?php // echo $form->field($model, 'kurang_upaya_pelbagai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
