<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfilWartawanSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-wartawan-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profil_wartawan_sukan_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'emel') ?>

    <?= $form->field($model, 'agensi') ?>

    <?= $form->field($model, 'no_tel') ?>

    <?php // echo $form->field($model, 'aktif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
