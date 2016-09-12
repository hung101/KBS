<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AnugerahPencalonanTokohSukanJawatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pencalonan-lain-jawatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'anugerah_pencalonan_lain_jawatan_id') ?>

    <?= $form->field($model, 'anugerah_pencalonan_lain_id') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'nama_persatuan_pertubuhan') ?>

    <?= $form->field($model, 'tempoh') ?>

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
