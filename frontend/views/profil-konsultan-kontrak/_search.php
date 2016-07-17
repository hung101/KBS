<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfilKonsultanKontrakSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-konsultan-kontrak-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'profil_konsultan_kontrak_id') ?>

    <?= $form->field($model, 'profil_konsultan_id') ?>

    <?= $form->field($model, 'tarikh_kontrak_mula') ?>

    <?= $form->field($model, 'tarikh_kontrak_akhir') ?>

    <?= $form->field($model, 'session_id') ?>

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
