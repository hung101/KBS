<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPendidikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-pendidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_pendidikan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'no_ic') ?>

    <?= $form->field($model, 'umur') ?>

    <?= $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'tinggi') ?>

    <?php // echo $form->field($model, 'berat') ?>

    <?php // echo $form->field($model, 'alamat_rumah_1') ?>

    <?php // echo $form->field($model, 'alamat_rumah_2') ?>

    <?php // echo $form->field($model, 'alamat_rumah_3') ?>

    <?php // echo $form->field($model, 'alamat_rumah_negeri') ?>

    <?php // echo $form->field($model, 'alamat_rumah_bandar') ?>

    <?php // echo $form->field($model, 'alamat_rumah_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon_rumah') ?>

    <?php // echo $form->field($model, 'no_telefon_bimbit') ?>

    <?php // echo $form->field($model, 'nama_ibu_bapa_penjaga') ?>

    <?php // echo $form->field($model, 'tahap_pendidikan') ?>

    <?php // echo $form->field($model, 'aliran') ?>

    <?php // echo $form->field($model, 'keputusan_spm') ?>

    <?php // echo $form->field($model, 'pilihan_aliran_spm') ?>

    <?php // echo $form->field($model, 'sukan') ?>

    <?php // echo $form->field($model, 'acara') ?>

    <?php // echo $form->field($model, 'tahun_program') ?>

    <?php // echo $form->field($model, 'muat_naik') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'alamat_pendidikan_1') ?>

    <?php // echo $form->field($model, 'alamat_pendidikan_2') ?>

    <?php // echo $form->field($model, 'alamat_pendidikan_3') ?>

    <?php // echo $form->field($model, 'alamat_pendidikan_negeri') ?>

    <?php // echo $form->field($model, 'alamat_pendidikan_bandar') ?>

    <?php // echo $form->field($model, 'alamat_pendidikan_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_pendidikan') ?>

    <?php // echo $form->field($model, 'no_fax_pendidikan') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <?php // echo $form->field($model, 'nama_pencadang') ?>

    <?php // echo $form->field($model, 'jawatan_pencadang') ?>

    <?php // echo $form->field($model, 'no_telefon_pencadang') ?>

    <?php // echo $form->field($model, 'sekolah_unit_sukan_pdd_psk_pencadang') ?>

    <?php // echo $form->field($model, 'nama_pengesahan') ?>

    <?php // echo $form->field($model, 'jawatan_pengesahan') ?>

    <?php // echo $form->field($model, 'no_telefon_pengesahan') ?>

    <?php // echo $form->field($model, 'sekolah_unit_sukan_pdd_psk_pengesahan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
