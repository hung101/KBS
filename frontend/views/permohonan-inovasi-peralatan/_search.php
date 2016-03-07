<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanInovasiPeralatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-inovasi-peralatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_inovasi_peralatan_id') ?>

    <?= $form->field($model, 'tarikh_permohonan') ?>

    <?= $form->field($model, 'pemohon') ?>

    <?= $form->field($model, 'nama_peralatan') ?>

    <?= $form->field($model, 'ringkasan_inovasi_peralatan') ?>

    <?php // echo $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?php // echo $form->field($model, 'catitan_ringkas') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
