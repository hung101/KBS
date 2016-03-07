<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ElaporanPelaksanaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-pelaksanaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'elaporan_pelaksaan_id') ?>

    <?= $form->field($model, 'kategori_elaporan') ?>

    <?= $form->field($model, 'nama_projek_program_aktiviti_kejohanan') ?>

    <?= $form->field($model, 'peringkat') ?>

    <?= $form->field($model, 'nama_penganjur_persatuan_kerjasama') ?>

    <?php // echo $form->field($model, 'jumlah_bantuan_peruntukan') ?>

    <?php // echo $form->field($model, 'jumlah_perbelanjaan') ?>

    <?php // echo $form->field($model, 'no_cek_eft') ?>

    <?php // echo $form->field($model, 'tarikh_cek_eft') ?>

    <?php // echo $form->field($model, 'tarikh_pelaksanaan_mula') ?>

    <?php // echo $form->field($model, 'tarikh_pelaksanaan_tarikh') ?>

    <?php // echo $form->field($model, 'objektif_pelaksaan') ?>

    <?php // echo $form->field($model, 'alamat_tempat_pelaksanaan_1') ?>

    <?php // echo $form->field($model, 'dirasmikan_oleh') ?>

    <?php // echo $form->field($model, 'lelaki') ?>

    <?php // echo $form->field($model, 'wanita') ?>

    <?php // echo $form->field($model, 'melayu') ?>

    <?php // echo $form->field($model, 'cina') ?>

    <?php // echo $form->field($model, 'india') ?>

    <?php // echo $form->field($model, 'lain_lain') ?>

    <?php // echo $form->field($model, 'jumlah_penyertaan') ?>

    <?php // echo $form->field($model, 'rumusan_program') ?>

    <?php // echo $form->field($model, 'muat_naik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
