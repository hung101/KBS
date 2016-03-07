<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PaobsPenganjuranSumberKewanganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paobs-penganjuran-sumber-kewangan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'paobs_penganjuran_sumber_kewangan_id') ?>

    <?= $form->field($model, 'penganjuran_id') ?>

    <?= $form->field($model, 'sumber') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'session_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
