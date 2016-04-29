<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlDiagnosisPreskripsiPemeriksaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pl-diagnosis-preskripsi-pemeriksaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pl_diagnosis_preskripsi_pemeriksaan_id') ?>

    <?= $form->field($model, 'pl_temujanji_id') ?>

    <?= $form->field($model, 'jenis_diagnosis_preskripsi_pemeriksaan') ?>

    <?= $form->field($model, 'status_diagnosis_preskripsi_pemeriksaan') ?>

    <?= $form->field($model, 'catitan_ringkas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
