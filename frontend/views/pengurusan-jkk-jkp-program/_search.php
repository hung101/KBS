<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanJkkJkpProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-jkk-jkp-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_jkk_jkp_program_id') ?>

    <?= $form->field($model, 'pengurusan_jkk_jkp_id') ?>

    <?= $form->field($model, 'tarikh_program') ?>

    <?= $form->field($model, 'kategori_program') ?>

    <?= $form->field($model, 'nama_program') ?>

    <?php // echo $form->field($model, 'nama_pesserta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
