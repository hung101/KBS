<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanMaklumatPskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-maklumat-psk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_maklumat_psk_id') ?>

    <?= $form->field($model, 'nama_sponsor') ?>

    <?= $form->field($model, 'jumlah_sponsor') ?>

    <?= $form->field($model, 'tarikh_sponsor_mula') ?>

    <?= $form->field($model, 'tarikh_sponsor_tamat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
