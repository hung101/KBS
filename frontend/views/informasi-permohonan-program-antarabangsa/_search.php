<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\InformasiPermohonanProgramAntarabangsaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="informasi-permohonan-program-antarabangsa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'informasi_permohonan_id') ?>

    <?= $form->field($model, 'butiran_permohonan') ?>

    <?= $form->field($model, 'amaun') ?>

    <?= $form->field($model, 'muatnaik_dokumen') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
