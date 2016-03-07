<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlSejarahPerubatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pl-sejarah-perubatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pl_sejarah_perubatan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'nama_perubatan') ?>

    <?= $form->field($model, 'butiran_perubatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
