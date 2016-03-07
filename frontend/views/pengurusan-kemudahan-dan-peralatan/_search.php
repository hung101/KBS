<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKemudahanDanPeralatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kemudahan-dan-peralatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kemudahan_dan_peralatan_id') ?>

    <?= $form->field($model, 'kerja') ?>

    <?= $form->field($model, 'masa') ?>

    <?= $form->field($model, 'catatan_ringkas') ?>

    <?= $form->field($model, 'tindakan_yang_diambil') ?>

    <?php // echo $form->field($model, 'hasil') ?>

    <?php // echo $form->field($model, 'ketidakpatuhan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
