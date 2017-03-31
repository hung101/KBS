<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MaklumatAkademikJadualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-akademik-jadual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'maklumat_akademik_jadual_id') ?>

    <?= $form->field($model, 'maklumat_akademik_id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'masa_dari') ?>

    <?php // echo $form->field($model, 'masa_hingga') ?>

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
