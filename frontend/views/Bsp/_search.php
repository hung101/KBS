<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'peringkat_pengajian') ?>

    <?= $form->field($model, 'bidang_pengajian') ?>

    <?= $form->field($model, 'falkuti_pengajian') ?>

    <?php // echo $form->field($model, 'ipt') ?>

    <?php // echo $form->field($model, 'tahun_mula_pengajian') ?>

    <?php // echo $form->field($model, 'tahun_tamat_pengajian') ?>

    <?php // echo $form->field($model, 'tahun_ditawarkan_biasiswa') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
