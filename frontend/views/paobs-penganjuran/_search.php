<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paobs-penganjuran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penganjuran_id') ?>

    <?= $form->field($model, 'nama_aktiviti') ?>

    <?= $form->field($model, 'jenis_sukan') ?>

    <?= $form->field($model, 'tarikh_aktiviti') ?>

    <?= $form->field($model, 'alamat_lokasi') ?>

    <?php // echo $form->field($model, 'pemilik_lokasi') ?>

    <?php // echo $form->field($model, 'bilangan_peserta') ?>

    <?php // echo $form->field($model, 'negara_peserta') ?>

    <?php // echo $form->field($model, 'kos_aktiviti') ?>

    <?php // echo $form->field($model, 'sumber_kewangan') ?>

    <?php // echo $form->field($model, 'surat_sokongan') ?>

    <?php // echo $form->field($model, 'laporan_penganjuran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
