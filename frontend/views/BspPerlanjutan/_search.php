<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspPerlanjutanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-perlanjutan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_perlanjutan_id') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'tempoh_mohon_perlanjutan') ?>

    <?= $form->field($model, 'permohonan_pelanjutan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
