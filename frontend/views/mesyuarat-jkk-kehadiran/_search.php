<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratJkkKehadiranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mesyuarat-jkk-kehadiran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'senarai_nama_hadir_id') ?>

    <?= $form->field($model, 'mesyuarat_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'kehadiran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
