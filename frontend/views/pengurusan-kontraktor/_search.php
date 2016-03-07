<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKontraktorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kontraktor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kontraktor_id') ?>

    <?= $form->field($model, 'nama_kontraktor') ?>

    <?= $form->field($model, 'alamat_1') ?>

    <?= $form->field($model, 'alamat_2') ?>

    <?= $form->field($model, 'alamat_3') ?>

    <?php // echo $form->field($model, 'alamat_negeri') ?>

    <?php // echo $form->field($model, 'alamat_bandar') ?>

    <?php // echo $form->field($model, 'alamat_poskod') ?>

    <?php // echo $form->field($model, 'telefon_pejabat') ?>

    <?php // echo $form->field($model, 'telefon_bimbit') ?>

    <?php // echo $form->field($model, 'peralatan_yang_dibekal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
