<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PsikologiProfilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="psikologi-profil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'psikologi_profil_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'pangkat') ?>

    <?= $form->field($model, 'no_kad_pengenalan') ?>

    <?= $form->field($model, 'tarikh_lahir') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'alamat_1') ?>

    <?php // echo $form->field($model, 'alamat_2') ?>

    <?php // echo $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'no_tel_bimbit') ?>

    <?php // echo $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
