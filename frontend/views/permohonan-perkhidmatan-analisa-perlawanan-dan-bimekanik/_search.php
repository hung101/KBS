<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanikSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'tujuan') ?>

    <?php // echo $form->field($model, 'perkhidmatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
