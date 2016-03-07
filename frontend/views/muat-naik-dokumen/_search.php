<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MuatNaikDokumenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="muat-naik-dokumen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'muat_naik_dokumen_id') ?>

    <?= $form->field($model, 'kategori_muat_naik') ?>

    <?= $form->field($model, 'muat_naik_dokumen') ?>

    <?= $form->field($model, 'tarikh_muat_naik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
