<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspTuntutanElaunTesisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-tuntutan-elaun-tesis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_tuntutan_elaun_tesis_od') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'tajuk_tesis') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
