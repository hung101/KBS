<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsKejohananProgramAktivitiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-kejohanan-program-aktiviti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kejohanan_program_aktiviti_id') ?>

    <?= $form->field($model, 'nama_kejohanana_program_aktiviti_yang_disertai') ?>

    <?= $form->field($model, 'tarikh_kejohanan_program_aktiviti_yang_disertai') ?>

    <?= $form->field($model, 'bilangan_peserta_yang_menyertai') ?>

    <?= $form->field($model, 'kos_kejohanan_program_aktiviti_yang_disertai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
