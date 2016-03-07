<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KelayakanSukanSpesifikAkkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelayakan-sukan-spesifik-akk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kelayakan_sukan_spesifik_akk_id') ?>

    <?= $form->field($model, 'akademi_akk_id') ?>

    <?= $form->field($model, 'nama_kursus') ?>

    <?= $form->field($model, 'tahap') ?>

    <?= $form->field($model, 'tahun_lulus') ?>

    <?php // echo $form->field($model, 'persatuan_sukan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
