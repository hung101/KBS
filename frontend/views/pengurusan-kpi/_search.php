<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKpiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kpi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kpi_id') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?= $form->field($model, 'nama_acara') ?>

    <?= $form->field($model, 'jumlah_sasaran_pingat') ?>

    <?= $form->field($model, 'jumlah_pingat_yang_telah_dimenangi') ?>

    <?php // echo $form->field($model, 'rekod_baru_yang_dicipta') ?>

    <?php // echo $form->field($model, 'senarai_atlet_yang_memenangi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
