<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanJkkJkpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-jkk-jkp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_jkk_jkp_id') ?>

    <?= $form->field($model, 'nama_setiausaha_jkk_jkp') ?>

    <?= $form->field($model, 'tarikh_pelantikan_jkk_jkp') ?>

    <?= $form->field($model, 'tempoh_hak_jkk_jkp') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'nama_pegawai_coach') ?>

    <?php // echo $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'tarikh_pelantikan') ?>

    <?php // echo $form->field($model, 'tempoh_hak') ?>

    <?php // echo $form->field($model, 'nama_sukan') ?>

    <?php // echo $form->field($model, 'nama_acara') ?>

    <?php // echo $form->field($model, 'nama_atlet') ?>

    <?php // echo $form->field($model, 'status_pilihan') ?>

    <?php // echo $form->field($model, 'nama_jurulatih') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
