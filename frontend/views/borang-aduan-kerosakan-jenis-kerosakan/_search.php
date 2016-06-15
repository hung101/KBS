<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorangAduanKerosakanJenisKerosakanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-aduan-kerosakan-jenis-kerosakan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borang_aduan_kerosakan_jenis_kerosakan_id') ?>

    <?= $form->field($model, 'borang_aduan_kerosakan_id') ?>

    <?= $form->field($model, 'lokasi') ?>

    <?= $form->field($model, 'jenis_kerosakan') ?>

    <?= $form->field($model, 'nama_pemeriksa') ?>

    <?php // echo $form->field($model, 'tarikh_pemeriksaan') ?>

    <?php // echo $form->field($model, 'kategori_kerosakan') ?>

    <?php // echo $form->field($model, 'tindakan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'selesai') ?>

    <?php // echo $form->field($model, 'ulasan_pemeriksa') ?>

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
