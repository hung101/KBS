<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\GajiJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gaji-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gaji_jurulatih_id') ?>

    <?= $form->field($model, 'gaji_dan_elaun_jurulatih_id') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'tarikh_mula') ?>

    <?= $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'session_id') ?>

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
