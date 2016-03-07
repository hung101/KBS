<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKejohananTemasyaMainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kejohanan-temasya-main-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kejohanan_temasya_main_id') ?>

    <?= $form->field($model, 'nama_temasya') ?>

    <?= $form->field($model, 'nama_pertandingan') ?>

    <?= $form->field($model, 'tarikh') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
