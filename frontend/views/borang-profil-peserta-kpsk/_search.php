<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorangProfilPesertaKpskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-profil-peserta-kpsk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borang_profil_peserta_kpsk_id') ?>

    <?= $form->field($model, 'penganjur_kursus') ?>

    <?= $form->field($model, 'kod_kursus') ?>

    <?= $form->field($model, 'tarikh_kursus') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
