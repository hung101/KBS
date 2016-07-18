<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPendidikanKursusPengajianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-pendidikan-kursus-pengajian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_pendidikan_kursus_pengajian_id') ?>

    <?= $form->field($model, 'permohonan_pendidikan_id') ?>

    <?= $form->field($model, 'kursus_pengajian') ?>

    <?= $form->field($model, 'universiti') ?>

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
