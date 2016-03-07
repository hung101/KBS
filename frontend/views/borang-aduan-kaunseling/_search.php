<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorangAduanKaunselingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-aduan-kaunseling-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borang_aduan_kaunseling_id') ?>

    <?= $form->field($model, 'nama_pengadu') ?>

    <?= $form->field($model, 'tarikh_aduan') ?>

    <?= $form->field($model, 'no_aduan') ?>

    <?= $form->field($model, 'status_aduan') ?>

    <?php // echo $form->field($model, 'aduan_kategori') ?>

    <?php // echo $form->field($model, 'penyataan_aduan') ?>

    <?php // echo $form->field($model, 'tindakan_yang_telah_diambil') ?>

    <?php // echo $form->field($model, 'dokumen_berkaitan_yang_dilampirkan') ?>

    <?php // echo $form->field($model, 'bantuan_yang_anda_perlukan') ?>

    <?php // echo $form->field($model, 'rujukan_aduan_kepada_cawangan_yang_berkaitan') ?>

    <?php // echo $form->field($model, 'rujuk_aduan_kepada_atlet') ?>

    <?php // echo $form->field($model, 'tiada_sebarang_tindakan') ?>

    <?php // echo $form->field($model, 'maklumbalas_kepada_pengadu') ?>

    <?php // echo $form->field($model, 'tindakan_susulan') ?>

    <?php // echo $form->field($model, 'aduan_dimajukan_kepada_agensi_lain') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
