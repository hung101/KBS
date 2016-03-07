<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganElaunSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-kewangan-elaun-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'elaun_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'jumlah_elaun') ?>

    <?= $form->field($model, 'tarikh') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
