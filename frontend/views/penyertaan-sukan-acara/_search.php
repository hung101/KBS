<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenyertaanSukanAcaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyertaan-sukan-acara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penyertaan_sukan_acara_id') ?>

    <?= $form->field($model, 'penyertaan_sukan_id') ?>

    <?= $form->field($model, 'nama_acara') ?>

    <?= $form->field($model, 'tarikh_acara') ?>

    <?= $form->field($model, 'keputusan_acara') ?>

    <?php // echo $form->field($model, 'jumlah_pingat') ?>

    <?php // echo $form->field($model, 'rekod_baru') ?>

    <?php // echo $form->field($model, 'catatan_rekod_baru') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
