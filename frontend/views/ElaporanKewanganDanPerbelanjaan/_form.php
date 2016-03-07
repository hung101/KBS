<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKewanganDanPerbelanjaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-kewangan-dan-perbelanjaan-form">

    <p class="text-muted"><span style="color: red">*</span> lapangan mandatori</p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'program_aktiviti_butir' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>20]],
                'jenis_kewangan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Komposisi --'],'columnOptions'=>['colspan'=>3]],
                'jumlah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
            ],
        ],
        
    ]
]);
    ?>

    <!--<?= $form->field($model, 'elaporan_pelaksaan_id')->textInput() ?>

    <?= $form->field($model, 'program_aktiviti_butir')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jenis_kewangan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => 10]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
