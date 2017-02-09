<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspElaunLatihanPraktikalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-elaun-latihan-praktikal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_elaun_latihan_praktikal_id') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'jenis_latihan_amali') ?>

    <?= $form->field($model, 'tempat_latihan_praktikal') ?>

    <?php // echo $form->field($model, 'tarikh_mula') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'jumlah_hari') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
