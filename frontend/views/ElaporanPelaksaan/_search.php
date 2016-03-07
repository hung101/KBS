<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ElaporanPelaksaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-pelaksaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'elaporan_pelaksaan_id') ?>

    <?= $form->field($model, 'nama_projek_program_aktiviti_kejohanan') ?>

    <?= $form->field($model, 'nama_persatuan') ?>

    <?= $form->field($model, 'jumlah_bantuan') ?>

    <?= $form->field($model, 'no_cek_eft') ?>

    <?php // echo $form->field($model, 'tarikh_cek_eft') ?>

    <?php // echo $form->field($model, 'objektif_pelaksaan') ?>

    <?php // echo $form->field($model, 'tarikh_dilaksanakan') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'dirasmikan_oleh') ?>

    <?php // echo $form->field($model, 'jumlah_penyertaan_keseluruhan') ?>

    <?php // echo $form->field($model, 'keberkesanan_pelaksaan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
