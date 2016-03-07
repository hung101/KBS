<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jurulatih_id') ?>

    <?= $form->field($model, 'gambar') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?= $form->field($model, 'sub_cawangan_pelapis') ?>

    <?= $form->field($model, 'lain_lain_program') ?>

    <?php // echo $form->field($model, 'pusat_latihan') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'nama_acara') ?>

    <?php // echo $form->field($model, 'status_jurulatih') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'status_keaktifan_jurulatih') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'bangsa') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'warganegara') ?>

    <?php // echo $form->field($model, 'tarikh_lahir') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'taraf_perkahwinan') ?>

    <?php // echo $form->field($model, 'bil_tanggungan') ?>

    <?php // echo $form->field($model, 'ic_no') ?>

    <?php // echo $form->field($model, 'ic_no_lama') ?>

    <?php // echo $form->field($model, 'ic_tentera') ?>

    <?php // echo $form->field($model, 'passport_no') ?>

    <?php // echo $form->field($model, 'tamat_tempoh') ?>

    <?php // echo $form->field($model, 'no_visa') ?>

    <?php // echo $form->field($model, 'tamat_visa_tempoh') ?>

    <?php // echo $form->field($model, 'no_permit_kerja') ?>

    <?php // echo $form->field($model, 'tamat_permit_tempoh') ?>

    <?php // echo $form->field($model, 'alamat_rumah_1') ?>

    <?php // echo $form->field($model, 'alamat_rumah_2') ?>

    <?php // echo $form->field($model, 'alamat_rumah_3') ?>

    <?php // echo $form->field($model, 'alamat_rumah_negeri') ?>

    <?php // echo $form->field($model, 'alamat_rumah_bandar') ?>

    <?php // echo $form->field($model, 'alamat_rumah_poskod') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_1') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_2') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_3') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat_poskod') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sektor') ?>

    <?php // echo $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'no_telefon_pejabat') ?>

    <?php // echo $form->field($model, 'nama_majikan') ?>

    <?php // echo $form->field($model, 'alamat_majikan_1') ?>

    <?php // echo $form->field($model, 'alamat_majikan_2') ?>

    <?php // echo $form->field($model, 'alamat_majikan_3') ?>

    <?php // echo $form->field($model, 'alamat_majikan_negeri') ?>

    <?php // echo $form->field($model, 'alamat_majikan_bandar') ?>

    <?php // echo $form->field($model, 'alamat_majikan_poskod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
