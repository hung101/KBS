<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenganjuranKursusPenganjurSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penganjuran-kursus-penganjur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penganjuran_kursus_penganjur_id') ?>

    <?= $form->field($model, 'kategori_kursus') ?>

    <?= $form->field($model, 'nama_kursus') ?>

    <?= $form->field($model, 'kod_kursus') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
