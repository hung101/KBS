<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPendidikanKeputusanSpmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-pendidikan-keputusan-spm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_pendidikan_keputusan_spm_id') ?>

    <?= $form->field($model, 'permohonan_pendidikan_id') ?>

    <?= $form->field($model, 'subjek') ?>

    <?= $form->field($model, 'keputusan') ?>

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
