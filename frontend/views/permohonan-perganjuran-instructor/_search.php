<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPerganjuranInstructorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-perganjuran-instructor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_perganjuran_instructor_id') ?>

    <?= $form->field($model, 'permohonan_perganjuran_id') ?>

    <?= $form->field($model, 'nama_instructor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
