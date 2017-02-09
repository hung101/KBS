<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-perlanjutan-form">

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
                'tarikh' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tempoh_mohon_perlanjutan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'permohonan_pelanjutan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Permohonan Pelanjutan --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'tempoh_mohon_perlanjutan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'permohonan_pelanjutan')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
