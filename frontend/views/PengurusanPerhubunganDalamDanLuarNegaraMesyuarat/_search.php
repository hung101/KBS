<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuaratSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-perhubungan-dalam-dan-luar-negara-mesyuarat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'muatnaik_dokumen') ?>

    <?php // echo $form->field($model, 'nama_kejohonan') ?>

    <?php // echo $form->field($model, 'muatnaik_dokumen_kejohanan') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
