<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanProgramPendidikanPencegahanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-program-pendidikan-pencegahan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'program_pendidikan_pencegahan_id') ?>

    <?= $form->field($model, 'atlet_id_staff_id') ?>

    <?= $form->field($model, 'program') ?>

    <?= $form->field($model, 'tarikh_permohonan') ?>

    <?= $form->field($model, 'status_permohonan') ?>

    <?php // echo $form->field($model, 'kategori_permohonan') ?>

    <?php // echo $form->field($model, 'catitan_ringkas') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
