<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspPrestasiSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-prestasi-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_prestasi_sukan_id') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'kejohanan_yang_disertai') ?>

    <?= $form->field($model, 'lokasi_kejohanan') ?>

    <?php // echo $form->field($model, 'pencapaian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
