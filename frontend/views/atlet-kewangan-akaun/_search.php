<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganAkaunSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-kewangan-akaun-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'akaun_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_bank') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?= $form->field($model, 'no_akaun') ?>

    <?php // echo $form->field($model, 'jenis_akaun') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
