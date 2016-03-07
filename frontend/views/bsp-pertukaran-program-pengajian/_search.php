<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspPertukaranProgramPengajianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-pertukaran-program-pengajian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_pertukaran_program_pengajian_id') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'bidang_pengajian_kursus') ?>

    <?= $form->field($model, 'fakulti') ?>

    <?php // echo $form->field($model, 'tarikh_mula_pengajian') ?>

    <?php // echo $form->field($model, 'tarikh_tamat_pengajian') ?>

    <?php // echo $form->field($model, 'tempoh_perlanjutan_semester') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
