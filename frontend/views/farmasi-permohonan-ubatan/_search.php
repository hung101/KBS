<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FarmasiPermohonanUbatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="farmasi-permohonan-ubatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'farmasi_permohonan_ubatan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh_pemberian') ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?= $form->field($model, 'catitan_ringkas') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
