<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerkhidmatanPermakananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perkhidmatan-permakanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'perkhidmatan_permakanan_id') ?>

    <?= $form->field($model, 'permohonan_perkhidmatan_permakanan_id') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab') ?>

    <?= $form->field($model, 'catitan_ringkas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
