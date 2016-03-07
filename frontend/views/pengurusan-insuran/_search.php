<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanInsuranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-insuran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_insuran_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_insuran') ?>

    <?= $form->field($model, 'jumlah_tuntutan') ?>

    <?= $form->field($model, 'tarikh_tuntutan') ?>

    <?php // echo $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
