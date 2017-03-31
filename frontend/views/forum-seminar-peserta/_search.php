<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumSeminarPesertaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-seminar-peserta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'forum_seminar_peserta_id') ?>

    <?= $form->field($model, 'forum_seminar_persidangan_di_luar_negara_id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jawatan') ?>

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
