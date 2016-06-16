<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BantuanPenyertaanPegawaiTeknikalDicadangkanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penyertaan-pegawai-teknikal-dicadangkan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bantuan_penyertaan_pegawai_teknikal_dicadangkan_id') ?>

    <?= $form->field($model, 'bantuan_penyertaan_pegawai_teknikal_id') ?>

    <?= $form->field($model, 'badan_sukan') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_kad_pengenalan') ?>

    <?php // echo $form->field($model, 'umur') ?>

    <?php // echo $form->field($model, 'no_passport') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'alamat_e_mail') ?>

    <?php // echo $form->field($model, 'tahap_akademik') ?>

    <?php // echo $form->field($model, 'tahap_kelayakan_sukan_peringkat_kebangsaan') ?>

    <?php // echo $form->field($model, 'tahap_kelayakan_sukan_peringkat_antarabangsa') ?>

    <?php // echo $form->field($model, 'nama_majikan') ?>

    <?php // echo $form->field($model, 'no_telefon_majikan') ?>

    <?php // echo $form->field($model, 'no_faks') ?>

    <?php // echo $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'gred') ?>

    <?php // echo $form->field($model, 'nama_kejohanan_kursus') ?>

    <?php // echo $form->field($model, 'tarikh_mula') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'session_id') ?>

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
