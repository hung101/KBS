<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenganjuranKursusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penganjuran-kursus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penganjuran_kursus_id') ?>

    <?= $form->field($model, 'tarikh_kursus_mula') ?>

    <?= $form->field($model, 'tempat_kursus') ?>

    <?= $form->field($model, 'negeri') ?>

    <?= $form->field($model, 'nama_penyelaras') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'kuota_kursus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
