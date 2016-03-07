<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CadanganElaunSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cadangan-elaun-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cadangan_elaun_id') ?>

    <?= $form->field($model, 'atlet') ?>

    <?= $form->field($model, 'elaun_semasa') ?>

    <?= $form->field($model, 'elaun_cadangan') ?>

    <?= $form->field($model, 'tarikh_mula') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'ulasan') ?>

    <?php // echo $form->field($model, 'jenis_kelulusan') ?>

    <?php // echo $form->field($model, 'muat_naik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
