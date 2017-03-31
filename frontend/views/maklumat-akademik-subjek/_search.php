<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MaklumatAkademikSubjekSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-akademik-subjek-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'maklumat_akademik_subjek_id') ?>

    <?= $form->field($model, 'maklumat_akademik_id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'kod_subjek') ?>

    <?= $form->field($model, 'subjek') ?>

    <?php // echo $form->field($model, 'bil_kredit') ?>

    <?php // echo $form->field($model, 'nama_pensyarah') ?>

    <?php // echo $form->field($model, 'no_telefon') ?>

    <?php // echo $form->field($model, 'email') ?>

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
