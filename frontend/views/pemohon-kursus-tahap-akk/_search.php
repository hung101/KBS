<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PemohonKursusTahapAkkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemohon-kursus-tahap-akk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pemohon_kursus_tahap_akk_id') ?>

    <?= $form->field($model, 'akademi_akk_id') ?>

    <?= $form->field($model, 'tahap') ?>

    <?= $form->field($model, 'tahun_lulus') ?>

    <?= $form->field($model, 'no_sijil') ?>

    <?php // echo $form->field($model, 'kod_kursus') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'muatnaik_sijil') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
