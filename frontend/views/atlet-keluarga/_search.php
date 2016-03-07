<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AtletKeluargaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-keluarga-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'keluarga_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'hubungan') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?php // echo $form->field($model, 'tarikh_lahir') ?>

    <?php // echo $form->field($model, 'pekerjaan') ?>

    <?php // echo $form->field($model, 'bangsa') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'no_tel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
