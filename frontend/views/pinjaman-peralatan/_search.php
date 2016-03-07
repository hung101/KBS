<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PinjamanPeralatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pinjaman-peralatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pinjaman_peralatan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'nama_peralatan') ?>

    <?= $form->field($model, 'kuantiti') ?>

    <?= $form->field($model, 'tarikh_diberi') ?>

    <?php // echo $form->field($model, 'tarikh_dipulang') ?>

    <?php // echo $form->field($model, 'tempoh_pinjaman') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
