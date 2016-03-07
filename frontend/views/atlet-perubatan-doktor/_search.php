<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanDoktorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-perubatan-doktor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'doktor_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'name_doktor') ?>

    <?= $form->field($model, 'no_telefon') ?>

    <?= $form->field($model, 'hospital_klinik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
