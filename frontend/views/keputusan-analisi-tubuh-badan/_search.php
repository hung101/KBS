<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KeputusanAnalisiTubuhBadanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keputusan-analisi-tubuh-badan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'keputusan_analisi_tubuh_badan_id') ?>

    <?= $form->field($model, 'perkhidmatan_permakanan_id') ?>

    <?= $form->field($model, 'kategori_atlet') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'acara') ?>

    <?php // echo $form->field($model, 'atlet') ?>

    <?php // echo $form->field($model, 'fit') ?>

    <?php // echo $form->field($model, 'unfit') ?>

    <?php // echo $form->field($model, 'refer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
