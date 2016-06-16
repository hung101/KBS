<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AnugerahAhliJawantankuasaPemilihanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-ahli-jawantankuasa-pemilihan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'anugerah_ahli_jawantankuasa_pemilihan_id') ?>

    <?= $form->field($model, 'perwakilan') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jawatan') ?>

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
