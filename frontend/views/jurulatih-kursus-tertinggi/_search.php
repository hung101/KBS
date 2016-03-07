<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JurulatihKursusTertinggiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-kursus-tertinggi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kursus_tertinggi_id') ?>

    <?= $form->field($model, 'jurulatih_id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'kursus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
