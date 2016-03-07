<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\GajiDanElaunJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gaji-dan-elaun-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gaji_dan_elaun_jurulatih_id') ?>

    <?= $form->field($model, 'nama_jurulatih') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'no_passport') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'tempoh_bayaran') ?>

    <?php // echo $form->field($model, 'bank') ?>

    <?php // echo $form->field($model, 'no_akaun') ?>

    <?php // echo $form->field($model, 'cawangan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
