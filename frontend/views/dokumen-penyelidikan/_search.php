<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DokumenPenyelidikanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dokumen-penyelidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dokumen_penyelidikan_id') ?>

    <?= $form->field($model, 'permohonana_penyelidikan_id') ?>

    <?= $form->field($model, 'nama_dokumen') ?>

    <?= $form->field($model, 'muat_naik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
