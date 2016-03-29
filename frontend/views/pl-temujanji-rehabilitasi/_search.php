<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlTemujanjiRehabilitasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pl-temujanji-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pl_temujanji_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh_temujanji') ?>

    <?= $form->field($model, 'doktor_pegawai_perubatan') ?>

    <?= $form->field($model, 'makmal_perubatan') ?>

    <?php // echo $form->field($model, 'status_temujanji') ?>

    <?php // echo $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?php // echo $form->field($model, 'catitan_ringkas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
