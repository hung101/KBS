<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKarierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-karier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'karier_atlet_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'syarikat') ?>

    <?= $form->field($model, 'alamat') ?>

    <?= $form->field($model, 'laman_web') ?>

    <?php // echo $form->field($model, 'tel_no') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'jawatan_kerja') ?>

    <?php // echo $form->field($model, 'pendapatan') ?>

    <?php // echo $form->field($model, 'tahun_mula') ?>

    <?php // echo $form->field($model, 'tahun_tamat') ?>

    <?php // echo $form->field($model, 'socso_no') ?>

    <?php // echo $form->field($model, 'kwsp_no') ?>

    <?php // echo $form->field($model, 'income_tax_no') ?>

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
