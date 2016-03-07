<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AdminEBiasiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-ebiasiswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'admin_e_biasiswa_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tarikh_mula') ?>

    <?= $form->field($model, 'tarikh_tamat') ?>

    <?= $form->field($model, 'aktif') ?>

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
