<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanProgramBinaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-program-binaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_program_binaan_id') ?>

    <?= $form->field($model, 'nama_ppn') ?>

    <?= $form->field($model, 'pengurus_pn') ?>

    <?= $form->field($model, 'kategori_permohonan') ?>

    <?= $form->field($model, 'jenis_permohonan') ?>

    <?php // echo $form->field($model, 'sukan') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'tahap') ?>

    <?php // echo $form->field($model, 'negeri') ?>

    <?php // echo $form->field($model, 'daerah') ?>

    <?php // echo $form->field($model, 'tarikh_mula') ?>

    <?php // echo $form->field($model, 'tarikh_tamat') ?>

    <?php // echo $form->field($model, 'sokongan_pn') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
