<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerkhidmatanAnalisaPerlawananBiomekanikSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perkhidmatan-analisa-perlawanan-biomekanik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'perkhidmatan_analisa_perlawanan_biomekanik_id') ?>

    <?= $form->field($model, 'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id') ?>

    <?= $form->field($model, 'perkhidmatan') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?php // echo $form->field($model, 'status_ujian') ?>

    <?php // echo $form->field($model, 'catitan_ringkas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
