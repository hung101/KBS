<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KursusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kursus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kursus_id') ?>

    <?= $form->field($model, 'nama_kursus') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'penganjur') ?>

    <?php // echo $form->field($model, 'kod_kursus') ?>

    <?php // echo $form->field($model, 'pengkhususan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
