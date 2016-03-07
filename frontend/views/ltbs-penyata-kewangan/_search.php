<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsPenyataKewanganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-penyata-kewangan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penyata_kewangan_id') ?>

    <?= $form->field($model, 'penyata_penerimaan_dan_pembayaran') ?>

    <?= $form->field($model, 'penyata_pendapatan_dan_perbelanjaan') ?>

    <?= $form->field($model, 'kunci_kira_kira') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
