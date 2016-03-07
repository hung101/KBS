<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\CadanganElaun */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cadangan-elaun-form">

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
                'atlet' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Atlet --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'elaun_semasa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'elaun_cadangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'tarikh_mula' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tarikh_tamat' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'ulasan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_kelulusan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Jenis Kelulusan --'],'columnOptions'=>['colspan'=>3]],
                'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>6]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'atlet')->textInput() ?>

    <?= $form->field($model, 'elaun_semasa')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'elaun_cadangan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'tarikh_mula')->textInput() ?>

    <?= $form->field($model, 'tarikh_tamat')->textInput() ?>

    <?= $form->field($model, 'ulasan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'jenis_kelulusan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'muat_naik')->textInput(['maxlength' => 100]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
