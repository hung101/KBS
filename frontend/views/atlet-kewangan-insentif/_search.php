<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganInsentifSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-kewangan-insentif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'insentif_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'jenis_insentif') ?>

    <?= $form->field($model, 'nilai') ?>

    <?php // echo $form->field($model, 'pertandingan') ?>

    <?php // echo $form->field($model, 'pencapaian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
