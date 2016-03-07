<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanAnjuranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-anjuran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_anjuran_id') ?>

    <?= $form->field($model, 'nama_program_anjuran') ?>

    <?= $form->field($model, 'tarikh_program_anjuran') ?>

    <?= $form->field($model, 'nama_badan_sukan_antarabangsa') ?>

    <?= $form->field($model, 'nama_delegasi') ?>

    <?php // echo $form->field($model, 'negara') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
