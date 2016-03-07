<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliGabunganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-ahli-gabungan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ahli_gabungan_id') ?>

    <?= $form->field($model, 'nama_badan_sukan') ?>

    <?= $form->field($model, 'alamat_badan_sukan') ?>

    <?= $form->field($model, 'nama_penuh_presiden_badan_sukan') ?>

    <?= $form->field($model, 'nama_penuh_setiausaha_badan_sukan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
