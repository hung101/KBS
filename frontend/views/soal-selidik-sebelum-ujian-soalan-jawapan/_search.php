<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SoalSelidikSebelumUjianSoalanJawapanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soal-selidik-sebelum-ujian-soalan-jawapan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'soal_selidik_sebelum_ujian_soalan_jawapan_id') ?>

    <?= $form->field($model, 'soal_selidik_sebelum_ujian_id') ?>

    <?= $form->field($model, 'soalan') ?>

    <?= $form->field($model, 'jawapan') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
