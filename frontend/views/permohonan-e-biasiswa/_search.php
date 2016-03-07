<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanEBiasiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebiasiswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_e_biasiswa_id') ?>

    <?= $form->field($model, 'muat_naik_gambar') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'keturunan') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'taraf_perkahwinan') ?>

    <?php // echo $form->field($model, 'kawasan_temuduga_anda') ?>

    <?php // echo $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'no_pendaftaran_oku') ?>

    <?php // echo $form->field($model, 'kategori_oku') ?>

    <?php // echo $form->field($model, 'oku_lain_lain') ?>

    <?php // echo $form->field($model, 'universiti_institusi') ?>

    <?php // echo $form->field($model, 'program_pengajian') ?>

    <?php // echo $form->field($model, 'kursus_bidang_pengajian') ?>

    <?php // echo $form->field($model, 'falkulti') ?>

    <?php // echo $form->field($model, 'kategori') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'semester_terkini') ?>

    <?php // echo $form->field($model, 'baki_semester_yang_tinggal') ?>

    <?php // echo $form->field($model, 'no_matriks') ?>

    <?php // echo $form->field($model, 'mendapat_pembiayaan_pendidikan') ?>

    <?php // echo $form->field($model, 'sukan') ?>

    <?php // echo $form->field($model, 'perakuan_pemohon') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
