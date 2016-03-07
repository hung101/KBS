<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id') ?>

    <?= $form->field($model, 'jurulatih') ?>

    <?= $form->field($model, 'muatnaik_gambar') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?= $form->field($model, 'sub_cawangan') ?>

    <?php // echo $form->field($model, 'program_msn') ?>

    <?php // echo $form->field($model, 'lain_lain_program') ?>

    <?php // echo $form->field($model, 'pusat_latihan') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'nama_acara') ?>

    <?php // echo $form->field($model, 'status_jurulatih') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'status_keaktifan_jurulatih') ?>

    <?php // echo $form->field($model, 'muat_naik_document') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
