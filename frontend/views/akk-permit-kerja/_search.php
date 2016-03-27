<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AkkPermitKerjaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akk-permit-kerja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'akk_permit_kerja_id') ?>

    <?= $form->field($model, 'akademi_akk_id') ?>

    <?= $form->field($model, 'no_permit') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'permit') ?>

    <?php // echo $form->field($model, 'session_id') ?>

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
