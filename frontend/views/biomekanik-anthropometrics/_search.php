<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BiomekanikAnthropometricsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biomekanik-anthropometrics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'biomekanik_anthropometrics_id') ?>

    <?= $form->field($model, 'perkhidmatan_biomekanik_id') ?>

    <?= $form->field($model, 'anthropometrics') ?>

    <?= $form->field($model, 'cm_kg') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
