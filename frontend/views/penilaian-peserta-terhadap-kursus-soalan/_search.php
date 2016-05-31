<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PenilaianPenganjurKursusSoalanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-peserta-terhadap-kursus-soalan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penilaian_peserta_terhadap_kursus_soalan_id') ?>

    <?= $form->field($model, 'penilaian_peserta_terhadap_kursus_id') ?>

    <?= $form->field($model, 'kategori_soalan') ?>

    <?= $form->field($model, 'soalan') ?>

    <?= $form->field($model, 'skala') ?>

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
