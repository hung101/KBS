<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanPenilaianPendidikanPenganjurIntructorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-penilaian-pendidikan-penganjur-intructor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_penilaian_pendidikan_penganjur_intructor_id') ?>

    <?= $form->field($model, 'nama_penganjuran_kursus') ?>

    <?= $form->field($model, 'kod_kursus') ?>

    <?= $form->field($model, 'tarikh_kursus') ?>

    <?= $form->field($model, 'instructor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
