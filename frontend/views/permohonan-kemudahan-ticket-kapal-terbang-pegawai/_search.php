<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanKemudahanTicketKapalTerbangPegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-kemudahan-ticket-kapal-terbang-pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_kemudahan_ticket_kapal_terbang_pegawai_id') ?>

    <?= $form->field($model, 'permohonan_kemudahan_ticket_kapal_terbang_id') ?>

    <?= $form->field($model, 'pegawai') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
