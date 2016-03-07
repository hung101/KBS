<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SkimKebajikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skim-kebajikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'skim_kebajikan_id') ?>

    <?= $form->field($model, 'jenis_bantuan_skak') ?>

    <?= $form->field($model, 'jumlah_bantuan') ?>

    <?= $form->field($model, 'nama_pemohon') ?>

    <?= $form->field($model, 'nama_penerima') ?>

    <?php // echo $form->field($model, 'jenis_sukan') ?>

    <?php // echo $form->field($model, 'masalah_dihadapi') ?>

    <?php // echo $form->field($model, 'tarikh_kejadian') ?>

    <?php // echo $form->field($model, 'lokasi_kejadian') ?>

    <?php // echo $form->field($model, 'jenis_bantuan_lain_yang_diterima') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
