<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PengurusanKelayakanJaringanAntarabangsaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-kelayakan-jaringan-antarabangsa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pengurusan_kelayakan_jaringan_antarabangsa_id') ?>

    <?= $form->field($model, 'pengurusan_jaringan_antarabangsa_id') ?>

    <?= $form->field($model, 'nama_kursus') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'tahap_kelayakan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
