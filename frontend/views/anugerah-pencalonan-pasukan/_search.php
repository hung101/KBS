<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AnugerahPencalonanPasukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pencalonan-pasukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'anugerah_pencalonan_pasukan_id') ?>

    <?= $form->field($model, 'kategori') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'nama_pasukan') ?>

    <?= $form->field($model, 'gambar_pasukan') ?>

    <?php // echo $form->field($model, 'ulasan_pencapaian') ?>

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