<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranElaunSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembayaran-elaun-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pembayaran_elaun_id') ?>

    <?= $form->field($model, 'jenis_atlet') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'kategori_elaun') ?>

    <?= $form->field($model, 'tempoh_elaun') ?>

    <?php // echo $form->field($model, 'sebab_elaun') ?>

    <?php // echo $form->field($model, 'jumlah_elaun') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
