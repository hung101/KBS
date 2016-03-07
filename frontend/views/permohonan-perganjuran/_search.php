<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPerganjuranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-perganjuran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_perganjuran_id') ?>

    <?= $form->field($model, 'tarikh_kursus') ?>

    <?= $form->field($model, 'tempat_kursus') ?>

    <?= $form->field($model, 'aktiviti') ?>

    <?= $form->field($model, 'nama_instructor') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
