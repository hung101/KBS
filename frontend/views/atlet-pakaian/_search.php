<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPakaianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pakaian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pakaian_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'saiz_tshirt') ?>

    <?= $form->field($model, 'saiz_seluar_panjang') ?>

    <?= $form->field($model, 'saiz_saman_trek') ?>

    <?php // echo $form->field($model, 'saiz_kasut') ?>

    <?php // echo $form->field($model, 'saiz_tshir_sukan_tertentu') ?>

    <?php // echo $form->field($model, 'saiz_seluar_sukan_tertentu') ?>

    <?php // echo $form->field($model, 'saiz_kasut_sukan_tertentu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
