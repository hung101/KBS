<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JenisKebajikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenis-kebajikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jenis_kebajikan_id') ?>

    <?= $form->field($model, 'jenis_kebajikan') ?>

    <?= $form->field($model, 'perkara') ?>

    <?= $form->field($model, 'sukan_sea_para_asean') ?>

    <?= $form->field($model, 'sukan_asia_komenwel_para_asia_ead') ?>

    <?php // echo $form->field($model, 'sukan_olimpik_paralimpik') ?>

    <?php // echo $form->field($model, 'kejohanan_asia_dunia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
