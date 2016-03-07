<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPerhimpunanKemPesertaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-perhimpunan-kem-peserta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_perhimpunan_kem_peserta_id') ?>

    <?= $form->field($model, 'pengurusan_perhimpunan_kem_id') ?>

    <?= $form->field($model, 'nama_peserta') ?>

    <?= $form->field($model, 'kategori_peserta') ?>

    <?= $form->field($model, 'jawatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
