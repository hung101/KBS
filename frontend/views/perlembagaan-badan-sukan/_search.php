<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PerlembagaanBadanSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perlembagaan-badan-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'perlembagaan_badan_sukan_id') ?>

    <?= $form->field($model, 'tarikh_kelulusan_Terkini') ?>

    <?= $form->field($model, 'bilangan_pindaan_perlembagaan_dilakukan') ?>

    <?= $form->field($model, 'tarikh_pindaan') ?>

    <?= $form->field($model, 'tarikh_kelulusan') ?>

    <?php // echo $form->field($model, 'muat_naik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
