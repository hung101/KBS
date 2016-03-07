<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MaklumatKongresDiLuarNegaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-kongres-di-luar-negara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'maklumat_kongres_di_luar_negara_id') ?>

    <?= $form->field($model, 'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id') ?>

    <?= $form->field($model, 'tajuk') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'masa') ?>

    <?php // echo $form->field($model, 'tarikh_penerbangan') ?>

    <?php // echo $form->field($model, 'tiket_penerbangan') ?>

    <?php // echo $form->field($model, 'jumlah_penerbangan') ?>

    <?php // echo $form->field($model, 'lain_lain') ?>

    <?php // echo $form->field($model, 'jumlah_kos_lain_lain') ?>

    <?php // echo $form->field($model, 'nama_pegawai_terlibat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
