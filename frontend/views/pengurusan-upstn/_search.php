<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanUpstnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-upstn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_upstn_id') ?>

    <?= $form->field($model, 'nama_pengurus_sukan') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?= $form->field($model, 'tarikh_lawatan') ?>

    <?= $form->field($model, 'masa') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'kehadiran') ?>

    <?php // echo $form->field($model, 'isu') ?>

    <?php // echo $form->field($model, 'ulasan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
