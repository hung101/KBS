<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\GeranBantuanGajiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geran-bantuan-gaji-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'geran_bantuan_gaji_id') ?>

    <?= $form->field($model, 'muatnaik_gambar') ?>

    <?= $form->field($model, 'nama_jurulatih') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?= $form->field($model, 'sub_cawangan') ?>

    <?php // echo $form->field($model, 'program_msn') ?>

    <?php // echo $form->field($model, 'lain_lain_program') ?>

    <?php // echo $form->field($model, 'pusat_latihan') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'nama_acara') ?>

    <?php // echo $form->field($model, 'status_jurulatih') ?>

    <?php // echo $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'status_keaktifan_jurulatih') ?>

    <?php // echo $form->field($model, 'kategori_geran') ?>

    <?php // echo $form->field($model, 'jumlah_geran') ?>

    <?php // echo $form->field($model, 'status_geran') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
