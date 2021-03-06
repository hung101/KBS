<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'tujuan_kursus_kejohanan') ?>

    <?= $form->field($model, 'bilangan_pasukan') ?>

    <?php // echo $form->field($model, 'bilangan_peserta') ?>

    <?php // echo $form->field($model, 'bilangan_pegawai_teknikal') ?>

    <?php // echo $form->field($model, 'bilangan_pembantu') ?>

    <?php // echo $form->field($model, 'laporan_bergambar') ?>

    <?php // echo $form->field($model, 'penyata_perbelanjaan_resit_yang_telah_disahkan') ?>

    <?php // echo $form->field($model, 'jadual_keputusan_pertandingan') ?>

    <?php // echo $form->field($model, 'senarai_peserta') ?>

    <?php // echo $form->field($model, 'statistik_penyertaan') ?>

    <?php // echo $form->field($model, 'senarai_pegawai_penceramah') ?>

    <?php // echo $form->field($model, 'senarai_urusetia_sukarelawan') ?>

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
