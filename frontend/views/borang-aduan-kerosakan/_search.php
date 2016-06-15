<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorangAduanKerosakanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-aduan-kerosakan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borang_aduan_kerosakan_id') ?>

    <?= $form->field($model, 'penyelia') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'venue') ?>

    <?php // echo $form->field($model, 'bahagian') ?>

    <?php // echo $form->field($model, 'no_tel_pejabat') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'kawasan') ?>

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
