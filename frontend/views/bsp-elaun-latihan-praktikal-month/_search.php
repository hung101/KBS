<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspElaunLatihanPraktikalMonthSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-elaun-latihan-praktikal-month-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_elaun_latihan_praktikal_month_id') ?>

    <?= $form->field($model, 'bsp_elaun_latihan_praktikal_id') ?>

    <?= $form->field($model, 'bulan') ?>

    <?= $form->field($model, 'jumlah_hari') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
