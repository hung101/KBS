<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EkemudahanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ekemudahan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ekemudahan_id') ?>

    <?= $form->field($model, 'kategori') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'gambar') ?>

    <?= $form->field($model, 'lokasi') ?>

    <?php // echo $form->field($model, 'dihubungi') ?>

    <?php // echo $form->field($model, 'kadar_sewa') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'nama_perniagaan_perkhidmatan_organisasi') ?>

    <?php // echo $form->field($model, 'kapasiti_penggunaan') ?>

    <?php // echo $form->field($model, 'no_lesen_pendaftaran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
