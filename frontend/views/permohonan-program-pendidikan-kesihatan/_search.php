<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanProgramPendidikanKesihatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-program-pendidikan-kesihatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_program_pendidikan_kesihatan_id') ?>

    <?= $form->field($model, 'nama_program') ?>

    <?= $form->field($model, 'tarikh_program') ?>

    <?= $form->field($model, 'tempat_program') ?>

    <?= $form->field($model, 'nama_pemohon') ?>

    <?php // echo $form->field($model, 'no_tel_pemohon') ?>

    <?php // echo $form->field($model, 'pegawai_bertugas') ?>

    <?php // echo $form->field($model, 'muat_naik') ?>

    <?php // echo $form->field($model, 'kelulusan_ceo') ?>

    <?php // echo $form->field($model, 'kelulusan_pbu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
