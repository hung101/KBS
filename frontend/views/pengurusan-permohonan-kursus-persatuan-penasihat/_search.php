<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPermohonanKursusPersatuanPenasihatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-permohonan-kursus-persatuan-penasihat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_permohonan_kursus_persatuan_penasihat_id') ?>

    <?= $form->field($model, 'pengurusan_permohonan_kursus_persatuan_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tarikh_mula_bertugas') ?>

    <?= $form->field($model, 'tarikh_tamat_bertugas') ?>

    <?php // echo $form->field($model, 'silibus') ?>

    <?php // echo $form->field($model, 'catatan') ?>

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
