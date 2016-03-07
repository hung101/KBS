<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKejohananTemasyaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kejohanan-temasya-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kejohanan_temasya_id') ?>

    <?= $form->field($model, 'tarikh_kejohanan') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?= $form->field($model, 'nama_acara') ?>

    <?= $form->field($model, 'lokasi_kejohanan') ?>

    <?php // echo $form->field($model, 'nama_ketua_kontijen') ?>

    <?php // echo $form->field($model, 'nama_atlet') ?>

    <?php // echo $form->field($model, 'nama_pegawai') ?>

    <?php // echo $form->field($model, 'nama_doktor') ?>

    <?php // echo $form->field($model, 'nama_fisio') ?>

    <?php // echo $form->field($model, 'tarikh_penginapan_mula') ?>

    <?php // echo $form->field($model, 'tarikh_penginapan_akhir') ?>

    <?php // echo $form->field($model, 'tarikh_perjalanan_pesawat') ?>

    <?php // echo $form->field($model, 'tarikh_pulang_perjalanan_pesawat') ?>

    <?php // echo $form->field($model, 'catatan_pesawat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
