<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKaunselingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pembangunan-kaunseling-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kaunseling_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'tujuan') ?>

    <?= $form->field($model, 'susulan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
