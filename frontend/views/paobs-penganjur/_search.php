<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjurSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paobs-penganjur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penganjur_id') ?>

    <?= $form->field($model, 'penganjuran_id') ?>

    <?= $form->field($model, 'profil_syarikat') ?>

    <?= $form->field($model, 'nama_penganjur') ?>

    <?= $form->field($model, 'no_pendaftaran_syarikat') ?>

    <?php // echo $form->field($model, 'tarikh_penubuhan_syarikat') ?>

    <?php // echo $form->field($model, 'sijil_pendaftaran') ?>

    <?php // echo $form->field($model, 'alamat_penganjur') ?>

    <?php // echo $form->field($model, 'no_telefon_penganjur') ?>

    <?php // echo $form->field($model, 'no_faks_penganjur') ?>

    <?php // echo $form->field($model, 'emel_penganjur') ?>

    <?php // echo $form->field($model, 'kertas_cadangan_pelaksanaan') ?>

    <?php // echo $form->field($model, 'nama_aktiviti') ?>

    <?php // echo $form->field($model, 'jenis_sukan') ?>

    <?php // echo $form->field($model, 'tarikh_aktiviti') ?>

    <?php // echo $form->field($model, 'alamat_lokasi') ?>

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
