<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanMediaProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-media-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_media_program_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'nama_program') ?>

    <?= $form->field($model, 'tempat') ?>

    <?= $form->field($model, 'cawangan') ?>

    <?php // echo $form->field($model, 'maklumat_msn_negeri') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
