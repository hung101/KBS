<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-sukan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sukan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_sukan') ?>

    <?= $form->field($model, 'acara') ?>

    <?= $form->field($model, 'tahun_umur_permulaan') ?>

    <?php // echo $form->field($model, 'tahun_menyertai_program_msn') ?>

    <?php // echo $form->field($model, 'program_semasa') ?>

    <?php // echo $form->field($model, 'no_lesen_sukan') ?>

    <?php // echo $form->field($model, 'atlet_persekutuan_dunia_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
