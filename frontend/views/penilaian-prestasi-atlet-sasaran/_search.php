<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenilaianPrestasiAtletSasaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-prestasi-atlet-sasaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penilaian_prestasi_atlet_sasaran_id') ?>

    <?= $form->field($model, 'penilaian_pestasi_id') ?>

    <?= $form->field($model, 'atlet') ?>

    <?= $form->field($model, 'sasaran') ?>

    <?= $form->field($model, 'keputusan') ?>

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
