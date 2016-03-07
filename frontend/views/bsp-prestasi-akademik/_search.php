<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspPrestasiAkademikSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-prestasi-akademik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_prestasi_akademik_id') ?>

    <?= $form->field($model, 'bsp_pemohon_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'png') ?>

    <?= $form->field($model, 'pngk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
