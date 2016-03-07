<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenilaianPrestasiAtletSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-prestasi-atlet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penilaian_prestasi_atlet_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tahap_kesihatan') ?>

    <?= $form->field($model, 'tahap_kecederaan') ?>

    <?= $form->field($model, 'tahun_penilaian') ?>

    <?php // echo $form->field($model, 'jadual_latihan') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'nama_acara') ?>

    <?php // echo $form->field($model, 'sasaran') ?>

    <?php // echo $form->field($model, 'keputusan') ?>

    <?php // echo $form->field($model, 'break_record') ?>

    <?php // echo $form->field($model, 'maklumat_shakam_shakar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
