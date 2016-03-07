<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspBorangBorangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-borang-borang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_borang_borang_id') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'bsp_03') ?>

    <?= $form->field($model, 'bsp_04') ?>

    <?= $form->field($model, 'bsp_05') ?>

    <?php // echo $form->field($model, 'bsp_07') ?>

    <?php // echo $form->field($model, 'bsp_08') ?>

    <?php // echo $form->field($model, 'bsp_09') ?>

    <?php // echo $form->field($model, 'bsp_12') ?>

    <?php // echo $form->field($model, 'bsp_13') ?>

    <?php // echo $form->field($model, 'bsp_14') ?>

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
