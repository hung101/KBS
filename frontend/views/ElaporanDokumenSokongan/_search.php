<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ElaporanDokumenSokonganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-dokumen-sokongan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'elaporan_dokumen_sokongan_id') ?>

    <?= $form->field($model, 'elaporan_pelaksaan_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'muat_nail') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
