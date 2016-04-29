<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\HptLaporanBulananPegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hpt-laporan-bulanan-pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'hpt_laporan_bulanan_pegawai_id') ?>

    <?= $form->field($model, 'nama_pegawai') ?>

    <?= $form->field($model, 'bahagian_pusat_unit') ?>

    <?= $form->field($model, 'tajuk_laporan') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?php // echo $form->field($model, 'perkara') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'muat_naik') ?>

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
