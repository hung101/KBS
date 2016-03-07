<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlDataKlinikalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pl-data-klinikal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pl_data_klinikal_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'penglihatan_tanpa_cermin_mata_kiri') ?>

    <?= $form->field($model, 'penglihatan_tanpa_cermin_mata_kanan') ?>

    <?= $form->field($model, 'penglihatan_cermin_mata_kiri') ?>

    <?php // echo $form->field($model, 'penglihatan_cermin_mata_kanan') ?>

    <?php // echo $form->field($model, 'usia_kali_pertama_haid') ?>

    <?php // echo $form->field($model, 'haid_kitaran') ?>

    <?php // echo $form->field($model, 'status_haid') ?>

    <?php // echo $form->field($model, 'haid_kali_terakhir_hari_pertama') ?>

    <?php // echo $form->field($model, 'kali_terakhir_bersalin') ?>

    <?php // echo $form->field($model, 'bilangan_kanak_kanak') ?>

    <?php // echo $form->field($model, 'masalah_haid') ?>

    <?php // echo $form->field($model, 'perokok_tempoh') ?>

    <?php // echo $form->field($model, 'status_perokok') ?>

    <?php // echo $form->field($model, 'alkohol') ?>

    <?php // echo $form->field($model, 'jenis_alkohol') ?>

    <?php // echo $form->field($model, 'diet_harian') ?>

    <?php // echo $form->field($model, 'berat_badan_turun') ?>

    <?php // echo $form->field($model, 'berat_badan_naik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
