<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletAsetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-aset-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'aset_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'jenis_aset') ?>

    <?= $form->field($model, 'daftar_no_pengangkutan') ?>

    <?= $form->field($model, 'jenis_harta_pengangkutan_perniagaan') ?>

    <?php // echo $form->field($model, 'nilai_harta_pengangkutan') ?>

    <?php // echo $form->field($model, 'daftar_alamat') ?>

    <?php // echo $form->field($model, 'nama_syarikat_perniagaan') ?>

    <?php // echo $form->field($model, 'produk_perkhidmatan_perniagaan') ?>

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
