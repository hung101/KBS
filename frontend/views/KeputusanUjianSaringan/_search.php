<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KeputusanUjianSaringanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keputusan-ujian-saringan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'keputusan_ujian_saringan_id') ?>

    <?= $form->field($model, 'ujian_saringan_id') ?>

    <?= $form->field($model, 'jenis_ujian_saringan') ?>

    <?= $form->field($model, 'percubaan_1') ?>

    <?= $form->field($model, 'percubaan_2') ?>

    <?php // echo $form->field($model, 'terbaik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
