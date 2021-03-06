<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BantuanPenganjuranKejohananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penganjuran-kejohanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bantuan_penganjuran_kejohanan_id') ?>

    <?= $form->field($model, 'badan_sukan') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'no_pendaftaran') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'no_faks') ?>

    <?php // echo $form->field($model, 'laman_sesawang') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'twitter') ?>

    <?php // echo $form->field($model, 'nama_bank') ?>

    <?php // echo $form->field($model, 'no_akaun') ?>

    <?php // echo $form->field($model, 'nama_kejohanan_pertandingan') ?>

    <?php // echo $form->field($model, 'peringkat') ?>

    <?php // echo $form->field($model, 'tarikh_mula') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'tujuan') ?>

    <?php // echo $form->field($model, 'bil_pasukan') ?>

    <?php // echo $form->field($model, 'bil_peserta') ?>

    <?php // echo $form->field($model, 'bil_pengadil_hakim') ?>

    <?php // echo $form->field($model, 'bil_pegawai_teknikal') ?>

    <?php // echo $form->field($model, 'bilangan_pembantu') ?>

    <?php // echo $form->field($model, 'anggaran_perbelanjaan') ?>

    <?php // echo $form->field($model, 'kertas_kerja') ?>

    <?php // echo $form->field($model, 'surat_rasmi_badan_sukan_ms_negeri') ?>

    <?php // echo $form->field($model, 'permohonan_rasmi_dari_ahli_gabungan') ?>

    <?php // echo $form->field($model, 'maklumat_lain_sokongan') ?>

    <?php // echo $form->field($model, 'jumlah_bantuan_yang_dipohon') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'tarikh_permohonan') ?>

    <?php // echo $form->field($model, 'jumlah_dilulus') ?>

    <?php // echo $form->field($model, 'jkb') ?>

    <?php // echo $form->field($model, 'tarikh_jkb') ?>

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
