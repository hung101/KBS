<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LawatanRasmiLuarNegaraDelegasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lawatan-rasmi-luar-negara-delegasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'lawatan_rasmi_luar_negara_delegasi_id') ?>

    <?= $form->field($model, 'lawatan_rasmi_luar_negara_id') ?>

    <?= $form->field($model, 'delegasi') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
