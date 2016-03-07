<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumSeminarPersidanganDiLuarNegaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-seminar-persidangan-di-luar-negara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'forum_seminar_persidangan_di_luar_negara_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'amaun') ?>

    <?= $form->field($model, 'negara') ?>

    <?= $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
