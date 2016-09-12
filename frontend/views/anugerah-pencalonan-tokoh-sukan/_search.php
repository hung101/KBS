<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AnugerahPencalonanTokohSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pencalonan-lain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'anugerah_pencalonan_lain_id') ?>

    <?= $form->field($model, 'kategori') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'gambar') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?php // echo $form->field($model, 'no_tel_1') ?>

    <?php // echo $form->field($model, 'no_tel_2') ?>

    <?php // echo $form->field($model, 'sumbangan_dalam_pencapaian') ?>

    <?php // echo $form->field($model, 'ulasan_justifikasi') ?>

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
