<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanInsentifTetapanShakamShakarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-insentif-tetapan-shakam-shakar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_insentif_tetapan_shakam_shakar_id') ?>

    <?= $form->field($model, 'pengurusan_insentif_tetapan_id') ?>

    <?= $form->field($model, 'jenis_insentif') ?>

    <?= $form->field($model, 'pingat') ?>

    <?= $form->field($model, 'kumpulan_temasya_kejohanan') ?>

    <?php // echo $form->field($model, 'rekod_baharu') ?>

    <?php // echo $form->field($model, 'session_id') ?>

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
