<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganPinjamanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-kewangan-pinjaman-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pinjaman_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_bank') ?>

    <?= $form->field($model, 'jenis_pinjaman') ?>

    <?= $form->field($model, 'no_akaun') ?>

    <?php // echo $form->field($model, 'nilai_pinjaman') ?>

    <?php // echo $form->field($model, 'tahun_pinjaman') ?>

    <?php // echo $form->field($model, 'tahun_permulaan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
