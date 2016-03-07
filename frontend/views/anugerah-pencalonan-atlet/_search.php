<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AnugerahPencalonanAtletSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pencalonan-atlet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'anugerah_pencalonan_atlet') ?>

    <?= $form->field($model, 'nama_atlet') ?>

    <?= $form->field($model, 'tahun_pencalonan') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?= $form->field($model, 'nama_acara') ?>

    <?php // echo $form->field($model, 'status_pencalonan') ?>

    <?php // echo $form->field($model, 'kejayaan') ?>

    <?php // echo $form->field($model, 'ulasan_kejayaan') ?>

    <?php // echo $form->field($model, 'susan_ranking_kebangsaan') ?>

    <?php // echo $form->field($model, 'susan_ranking_asia') ?>

    <?php // echo $form->field($model, 'susan_ranking_asia_tenggara') ?>

    <?php // echo $form->field($model, 'susan_ranking_dunia') ?>

    <?php // echo $form->field($model, 'sifat_kepimpinan_ketua_pasukan') ?>

    <?php // echo $form->field($model, 'sifat_kepimpinan_jurulatih') ?>

    <?php // echo $form->field($model, 'sifat_kepimpinan_asia_tenggara') ?>

    <?php // echo $form->field($model, 'sifat_kepimpinan_penolong_jurulatih') ?>

    <?php // echo $form->field($model, 'sifat_kepimpinan_pegawai_teknikal') ?>

    <?php // echo $form->field($model, 'nama_sukan_sebelum_dicalon') ?>

    <?php // echo $form->field($model, 'mewakili') ?>

    <?php // echo $form->field($model, 'pencalonan_olahragawan_tahun') ?>

    <?php // echo $form->field($model, 'pencalonan_olahragawati_tahun') ?>

    <?php // echo $form->field($model, 'pencalonan_pasukan_lelaki_kebangsaan_tahun') ?>

    <?php // echo $form->field($model, 'pencalonan_pasukan_wanita_kebangsaan_tahun') ?>

    <?php // echo $form->field($model, 'pencalonan_olahragawan_harapan_tahun') ?>

    <?php // echo $form->field($model, 'pencalonan_olahragawati_harapan_tahun') ?>

    <?php // echo $form->field($model, 'memenangi_kategori_dalam_anugerah_sukan') ?>

    <?php // echo $form->field($model, 'nama_kategori') ?>

    <?php // echo $form->field($model, 'tahun') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
