<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AtletPencapaianRekodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pencapaian-rekods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pencapaian_rekods_id') ?>

    <?= $form->field($model, 'pencapaian_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'peringkat') ?>

    <?= $form->field($model, 'opponent') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'venue') ?>

    <?php // echo $form->field($model, 'personal_best') ?>

    <?php // echo $form->field($model, 'season_best') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
