<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKewanganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kewangan-hpt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kewangan_id') ?>

    <?= $form->field($model, 'nama_acara_program') ?>

    <?= $form->field($model, 'tarikh_acara') ?>

    <?= $form->field($model, 'kategori_acara') ?>

    <?= $form->field($model, 'objektif') ?>

    <?php // echo $form->field($model, 'kategori_penggunaan') ?>

    <?php // echo $form->field($model, 'harga_penggunaan') ?>

    <?php // echo $form->field($model, 'jumlah_bajet') ?>

    <?php // echo $form->field($model, 'jumlah_penggunaan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'bajet_keseluruhan') ?>

    <?php // echo $form->field($model, 'penggunaan_keseluruhan') ?>

    <?php // echo $form->field($model, 'baki') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
