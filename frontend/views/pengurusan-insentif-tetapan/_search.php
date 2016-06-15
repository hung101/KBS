<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanInsentifTetapanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-insentif-tetapan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_insentif_tetapan_id') ?>

    <?= $form->field($model, 'sgar') ?>

    <?= $form->field($model, 'sikap') ?>

    <?= $form->field($model, 'siso_olimpik') ?>

    <?= $form->field($model, 'siso_paralimpik') ?>

    <?php // echo $form->field($model, 'sito_emas') ?>

    <?php // echo $form->field($model, 'sito_perak') ?>

    <?php // echo $form->field($model, 'sito_gangsa') ?>

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
