<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanJaringanAntarabangsaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-jaringan-antarabangsa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_jaringan_antarabangsa_id') ?>

    <?= $form->field($model, 'nama_badan_sukan') ?>

    <?= $form->field($model, 'negara') ?>

    <?= $form->field($model, 'nama_pemohon') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_1') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_2') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_3') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_poskod') ?>

    <?php // echo $form->field($model, 'pegawai_teknikal') ?>

    <?php // echo $form->field($model, 'permohonan') ?>

    <?php // echo $form->field($model, 'jenis_program') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'no_faks') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'nama_majikan') ?>

    <?php // echo $form->field($model, 'alamat_majikan_1') ?>

    <?php // echo $form->field($model, 'alamat_majikan_2') ?>

    <?php // echo $form->field($model, 'alamat_majikan_3') ?>

    <?php // echo $form->field($model, 'alamat_majikan_negeri') ?>

    <?php // echo $form->field($model, 'alamat_majikan_bandar') ?>

    <?php // echo $form->field($model, 'alamat_majikan_poskod') ?>

    <?php // echo $form->field($model, 'jawatan_di_persatuan') ?>

    <?php // echo $form->field($model, 'tahap_kelayakan_sekarang') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
