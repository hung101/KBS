<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ElaunJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaun-jurulatih-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'elaun_jurulatih_id') ?>

    <?= $form->field($model, 'gaji_dan_elaun_jurulatih_id') ?>

    <?= $form->field($model, 'jenis_elaun') ?>

    <?= $form->field($model, 'jumlah_elaun') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
