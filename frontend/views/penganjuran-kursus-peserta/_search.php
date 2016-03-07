<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenganjuranKursusPesertaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penganjuran-kursus-peserta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penganjuran_kursus_peserta_id') ?>

    <?= $form->field($model, 'kategori_kursus') ?>

    <?= $form->field($model, 'nama_kursus') ?>

    <?= $form->field($model, 'kod_kursus') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'yuran') ?>

    <?php // echo $form->field($model, 'nama_penuh') ?>

    <?php // echo $form->field($model, 'muatnaik_gambar') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'taraf_perkahwinan') ?>

    <?php // echo $form->field($model, 'no_passport') ?>

    <?php // echo $form->field($model, 'no_kad_pengenalan') ?>

    <?php // echo $form->field($model, 'no_kp_polis_tentera') ?>

    <?php // echo $form->field($model, 'kaum') ?>

    <?php // echo $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'no_tel_rumah') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'nama_majikan') ?>

    <?php // echo $form->field($model, 'alamat_majikan_1') ?>

    <?php // echo $form->field($model, 'alamat_majikan_2') ?>

    <?php // echo $form->field($model, 'alamat_majikan_3') ?>

    <?php // echo $form->field($model, 'alamat_majikan_negeri') ?>

    <?php // echo $form->field($model, 'alamat_majikan_bandar') ?>

    <?php // echo $form->field($model, 'alamat_majikan_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_majikan') ?>

    <?php // echo $form->field($model, 'no_faks_majikan') ?>

    <?php // echo $form->field($model, 'kelulusan_akademi') ?>

    <?php // echo $form->field($model, 'nama_kelulusan') ?>

    <?php // echo $form->field($model, 'kelulusan_sukan_spesifik') ?>

    <?php // echo $form->field($model, 'nama_sukan_akademi') ?>

    <?php // echo $form->field($model, 'kelulusan_sains_sukan') ?>

    <?php // echo $form->field($model, 'sijil_spkk_msn') ?>

    <?php // echo $form->field($model, 'lesen_kejurulatihan_msn') ?>

    <?php // echo $form->field($model, 'status_jurulatih') ?>

    <?php // echo $form->field($model, 'lantikan') ?>

    <?php // echo $form->field($model, 'nama_sukan_jurulatih') ?>

    <?php // echo $form->field($model, 'tahun_berkhidmat_mula') ?>

    <?php // echo $form->field($model, 'tahun_berkhidmat_tamat') ?>

    <?php // echo $form->field($model, 'pencapaian') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
