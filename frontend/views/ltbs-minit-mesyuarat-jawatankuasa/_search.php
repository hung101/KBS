<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-minit-mesyuarat-jawatankuasa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mesyuarat_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'masa') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'mengikut_perlembagaan') ?>

    <?php // echo $form->field($model, 'jumlah_ahli_yang_hadir') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
