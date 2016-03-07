<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PemberianSuplemenMakananJusRundinganPendidikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemberian-suplemen-makanan-jus-rundingan-pendidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pemberian_suplemen_makanan_jus_rundingan_pendidikan_id') ?>

    <?= $form->field($model, 'perkhidmatan_permakanan_id') ?>

    <?= $form->field($model, 'nama_suplemen_makanan_jus_rundingan_pendidikan') ?>

    <?= $form->field($model, 'kuantiti_ml_g') ?>

    <?= $form->field($model, 'harga') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
