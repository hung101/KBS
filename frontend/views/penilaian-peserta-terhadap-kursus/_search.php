<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenilaianPenganjurKursusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-peserta-terhadap-kursus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penilaian_peserta_terhadap_kursus_id') ?>

    <?= $form->field($model, 'pengurusan_permohonan_kursus_persatuan_id') ?>

    <?= $form->field($model, 'tarikh_kursus') ?>

    <?= $form->field($model, 'nama_penganjur_kursus') ?>

    <?= $form->field($model, 'kod_kursus') ?>

    <?php // echo $form->field($model, 'tempat_kursus') ?>

    <?php // echo $form->field($model, 'nama_penyelaras') ?>

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
