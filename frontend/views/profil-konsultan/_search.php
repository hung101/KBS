<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfilKonsultanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-konsultan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profil_konsultan_id') ?>

    <?= $form->field($model, 'nama_konsultan') ?>

    <?= $form->field($model, 'ic_no') ?>

    <?= $form->field($model, 'emel') ?>

    <?= $form->field($model, 'no_bimbit') ?>

    <?php // echo $form->field($model, 'bidang_konsultansi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
