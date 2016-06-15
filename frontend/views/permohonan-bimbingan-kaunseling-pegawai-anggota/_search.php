<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanBimbinganKaunselingPegawaiAnggotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-bimbingan-kaunseling-pegawai-anggota-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_bimbingan_kaunseling_pegawai_anggota_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'umur') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'bahagian') ?>

    <?php // echo $form->field($model, 'taraf_perkahwinan') ?>

    <?php // echo $form->field($model, 'status_jawatan') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'tarikh_temujanji') ?>

    <?php // echo $form->field($model, 'kategori_masalah') ?>

    <?php // echo $form->field($model, 'catatan_kaunselor') ?>

    <?php // echo $form->field($model, 'tindakan_kaunselor') ?>

    <?php // echo $form->field($model, 'cadangan_kaunselor') ?>

    <?php // echo $form->field($model, 'tarikh_permohonan') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'catatan_permohonan') ?>

    <?php // echo $form->field($model, 'nama_pegawai_anggota') ?>

    <?php // echo $form->field($model, 'no_kad_pengenalan_pegawai') ?>

    <?php // echo $form->field($model, 'umur_pegawai') ?>

    <?php // echo $form->field($model, 'jawatan_pegawai') ?>

    <?php // echo $form->field($model, 'bahagian_pegawai') ?>

    <?php // echo $form->field($model, 'no_tel_pegawai') ?>

    <?php // echo $form->field($model, 'emel_pegawai') ?>

    <?php // echo $form->field($model, 'taraf_perkahwinan_pegawai') ?>

    <?php // echo $form->field($model, 'status_jawatan_pegawai') ?>

    <?php // echo $form->field($model, 'jantina_pegawai') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
