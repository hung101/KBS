<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanBimbinganKaunselingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-bimbingan-kaunseling-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_bimbingan_kaunseling_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'status_permohonan') ?>

    <?= $form->field($model, 'tarikh_rujukan') ?>

    <?= $form->field($model, 'nama_pemohon_rujukan') ?>

    <?php // echo $form->field($model, 'kes_latarbelakang') ?>

    <?php // echo $form->field($model, 'notis') ?>

    <?php // echo $form->field($model, 'pekerjaan_bapa') ?>

    <?php // echo $form->field($model, 'pekerjaan_ibu') ?>

    <?php // echo $form->field($model, 'bil_adik_beradik') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
