<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BantuanPenganjuranKejohananLaporanTuntutanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penganjuran-kejohanan-laporan-tuntutan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bantuan_penganjuran_kejohanan_laporan_tuntutan_id') ?>

    <?= $form->field($model, 'bantuan_penganjuran_kejohanan_laporan_id') ?>

    <?= $form->field($model, 'kejohanan') ?>

    <?= $form->field($model, 'tarikh_mula') ?>

    <?= $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'jumlah_kelulusan') ?>

    <?php // echo $form->field($model, 'pendahuluan_80') ?>

    <?php // echo $form->field($model, 'no_cek') ?>

    <?php // echo $form->field($model, 'no_boucer') ?>

    <?php // echo $form->field($model, 'jumlah_yang_dituntut_20') ?>

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
