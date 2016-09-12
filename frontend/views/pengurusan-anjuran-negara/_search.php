<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanAnjuranNegaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-anjuran-negara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_anjuran_negara_id') ?>

    <?= $form->field($model, 'pengurusan_anjuran_id') ?>

    <?= $form->field($model, 'negara') ?>

    <?= $form->field($model, 'nama_delegasi_luar_negara') ?>

    <?= $form->field($model, 'session_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
