<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenganjuranPemantuanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penganjuran-pemantuan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penganjuran_pemantuan_id') ?>

    <?= $form->field($model, 'permohonan_pendahuluan_pelagai') ?>

    <?= $form->field($model, 'menghantar_surat_cuti_tanpa') ?>

    <?= $form->field($model, 'keperluan_bengkel_telah') ?>

    <?= $form->field($model, 'membuat_tempahan_penginapan') ?>

    <?php // echo $form->field($model, 'membuat_tempahan_tempat_untuk') ?>

    <?php // echo $form->field($model, 'mengesahan_kehadiran_panel') ?>

    <?php // echo $form->field($model, 'mengesahan_pendaftaran_panel') ?>

    <?php // echo $form->field($model, 'memberi_taklimat') ?>

    <?php // echo $form->field($model, 'mengumpul_dan_membukukan') ?>

    <?php // echo $form->field($model, 'membuat_pelarasan_kewangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
