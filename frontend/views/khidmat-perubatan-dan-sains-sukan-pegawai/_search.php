<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KhidmatPerubatanDanSainsSukanPegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khidmat-perubatan-dan-sains-sukan-pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'khidmat_perubatan_dan_sains_sukan_pegawai_id') ?>

    <?= $form->field($model, 'khidmat_perubatan_dan_sains_sukan_id') ?>

    <?= $form->field($model, 'nama_pegawai') ?>

    <?= $form->field($model, 'jawatan') ?>

    <?= $form->field($model, 'agensi') ?>

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
