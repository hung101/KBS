<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-perubatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'perubatan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'kumpulan_darah') ?>

    <?= $form->field($model, 'alergi_makanan') ?>

    <?= $form->field($model, 'alergi_perubatan') ?>

    <?php // echo $form->field($model, 'alergi_jenis_lain') ?>

    <?php // echo $form->field($model, 'penyakit_semula_jadi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
