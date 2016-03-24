<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenganjuranKursusPesertaSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penganjuran-kursus-peserta-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penganjuran_kursus_peserta_sukan_id') ?>

    <?= $form->field($model, 'penganjuran_kursus_peserta_id') ?>

    <?= $form->field($model, 'jenis_sukan') ?>

    <?= $form->field($model, 'tahap') ?>

    <?= $form->field($model, 'tahun') ?>

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
