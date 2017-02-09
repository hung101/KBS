<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BspPerlanjutanDokumenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-perlanjutan-dokumen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bsp_perlanjutan_dokumen_id') ?>

    <?= $form->field($model, 'bsp_perlanjutan_id') ?>

    <?= $form->field($model, 'nama_dokumen') ?>

    <?= $form->field($model, 'upload') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
