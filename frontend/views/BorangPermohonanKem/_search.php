<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorangPermohonanKemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-permohonan-kem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borang_permohonan_kem_id') ?>

    <?= $form->field($model, 'nama_program') ?>

    <?= $form->field($model, 'tarikh_program') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'objektif') ?>

    <?php // echo $form->field($model, 'cadangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
