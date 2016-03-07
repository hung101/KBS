<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RehabilitasiProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rehabilitasi-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rehabilitasi_program_id') ?>

    <?= $form->field($model, 'rehabilitasi_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'nama_exercise_modality') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
