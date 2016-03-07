<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanKemudahanTicketKapalTerbangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-kemudahan-ticket-kapal-terbang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_kemudahan_ticket_kapal_terbang_id') ?>

    <?= $form->field($model, 'nama_pemohon') ?>

    <?= $form->field($model, 'bahagian') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'destinasi') ?>

    <?php // echo $form->field($model, 'tarikh') ?>

    <?php // echo $form->field($model, 'nama_program') ?>

    <?php // echo $form->field($model, 'no_fail_kelulusan') ?>

    <?php // echo $form->field($model, 'bil_penumpang') ?>

    <?php // echo $form->field($model, 'aktiviti') ?>

    <?php // echo $form->field($model, 'kod_perbelanjaan') ?>

    <?php // echo $form->field($model, 'sukan') ?>

    <?php // echo $form->field($model, 'atlet') ?>

    <?php // echo $form->field($model, 'jurulatih') ?>

    <?php // echo $form->field($model, 'pegawai_teknikal') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
