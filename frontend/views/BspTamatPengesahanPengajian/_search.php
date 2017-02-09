<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspTamatPengesahanPengajianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-tamat-pengesahan-pengajian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_tamat_pengesahan_pengajian_id') ?>

    <?= $form->field($model, 'nama_ipts') ?>

    <?= $form->field($model, 'pengajian') ?>

    <?= $form->field($model, 'bidang') ?>

    <?= $form->field($model, 'cgpa_pngk') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
