<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspPerlanjutanSebabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-perlanjutan-sebab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_perlanjutan_sebab_id') ?>

    <?= $form->field($model, 'bsp_perlanjutan_id') ?>

    <?= $form->field($model, 'sebab') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
