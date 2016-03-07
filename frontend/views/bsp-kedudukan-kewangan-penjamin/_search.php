<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspKedudukanKewanganPenjaminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-kedudukan-kewangan-penjamin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_kedudukan_kewangan_penjamin_id') ?>

    <?= $form->field($model, 'bsp_penjamin_id') ?>

    <?= $form->field($model, 'pendapatan_bulanan') ?>

    <?= $form->field($model, 'pinjaman_perumahan_baki_terkini') ?>

    <?= $form->field($model, 'sebagai_penjamin_siberhutang') ?>

    <?php // echo $form->field($model, 'lain_lain_pinjaman_tanggungan') ?>

    <?php // echo $form->field($model, 'perkerjaan') ?>

    <?php // echo $form->field($model, 'nama_alamat_majikan') ?>

    <?php // echo $form->field($model, 'nama_isteri_suami') ?>

    <?php // echo $form->field($model, 'no_kp_isteri_suami') ?>

    <?php // echo $form->field($model, 'jumlah_anak') ?>

    <?php // echo $form->field($model, 'pertalian_keluarga_dengan_pelajar') ?>

    <?php // echo $form->field($model, 'pelajar_lain_selain_daripada_penerima_di_atas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
