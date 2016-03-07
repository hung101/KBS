<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'name_penuh') ?>

    <?= $form->field($model, 'tarikh_lahir') ?>

    <?= $form->field($model, 'umur') ?>

    <?= $form->field($model, 'tempat_lahir_bandar') ?>

    <?php // echo $form->field($model, 'tempat_lahir_negeri') ?>

    <?php // echo $form->field($model, 'bangsa') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'taraf_perkahwinan') ?>

    <?php // echo $form->field($model, 'tinggi') ?>

    <?php // echo $form->field($model, 'berat') ?>

    <?php // echo $form->field($model, 'bahasa_ibu') ?>

    <?php // echo $form->field($model, 'no_sijil_lahir') ?>

    <?php // echo $form->field($model, 'ic_no') ?>

    <?php // echo $form->field($model, 'ic_no_lama') ?>

    <?php // echo $form->field($model, 'passport_no') ?>

    <?php // echo $form->field($model, 'passport_tempat_dikeluarkan') ?>

    <?php // echo $form->field($model, 'lesen_memandu_no') ?>

    <?php // echo $form->field($model, 'lesen_tamat_tempoh') ?>

    <?php // echo $form->field($model, 'jenis_lesen') ?>

    <?php // echo $form->field($model, 'tel_bimbit_no_1') ?>

    <?php // echo $form->field($model, 'tel_bimbit_no_2') ?>

    <?php // echo $form->field($model, 'tel_no') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'twitter') ?>

    <?php // echo $form->field($model, 'alamat_rumah') ?>

    <?php // echo $form->field($model, 'alamat_surat_menyurat') ?>

    <?php // echo $form->field($model, 'msn') ?>

    <?php // echo $form->field($model, 'dari_bahagian') ?>

    <?php // echo $form->field($model, 'sumber') ?>

    <?php // echo $form->field($model, 'negeri_diwakili') ?>

    <?php // echo $form->field($model, 'nama_kecemasan') ?>

    <?php // echo $form->field($model, 'pertalian_kecemasan') ?>

    <?php // echo $form->field($model, 'tel_no_kecemasan') ?>

    <?php // echo $form->field($model, 'tel_bimbit_no_kecemasan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
