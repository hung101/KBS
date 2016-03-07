<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanInsuransSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-perubatan-insurans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'insurans_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'syarikat_insurans') ?>

    <?= $form->field($model, 'no_polisi_hayat') ?>

    <?= $form->field($model, 'no_polisi_kad_perubatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
