<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BajetPenyelidikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bajet-penyelidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bajet_penyelidikan_id') ?>

    <?= $form->field($model, 'permohonana_penyelidikan_id') ?>

    <?= $form->field($model, 'jenis_bajet') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'jumlah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
