<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenjadualanUjianFisiologiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjadualan-ujian-fisiologi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penjadualan_ujian_fisiologi_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'perkhidmatan') ?>

    <?= $form->field($model, 'tarikh_masa') ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?php // echo $form->field($model, 'catitan_ringkas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
