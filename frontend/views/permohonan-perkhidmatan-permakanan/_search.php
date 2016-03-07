<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PermohonanPerkhidmatanPermakananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-perkhidmatan-permakanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_perkhidmatan_permakanan_id') ?>

    <?= $form->field($model, 'atlet_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'sukan') ?>

    <?= $form->field($model, 'tujuan') ?>

    <?php // echo $form->field($model, 'kategori_permohonan') ?>

    <?php // echo $form->field($model, 'jenis_perkhidmatan') ?>

    <?php // echo $form->field($model, 'kelulusan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
