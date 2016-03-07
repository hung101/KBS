<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBantuanPendapatanTahunLepasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-pendapatan-tahun-lepas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pendapatan_tahun_lepas_id') ?>

    <?= $form->field($model, 'permohonan_e_bantuan_id') ?>

    <?= $form->field($model, 'jenis_pendapatan') ?>

    <?= $form->field($model, 'butir_butir') ?>

    <?= $form->field($model, 'jumlah_pendapatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
