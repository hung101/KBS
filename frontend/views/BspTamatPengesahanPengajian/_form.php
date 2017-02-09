<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-tamat-pengesahan-pengajian-form">

    
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
                'nama_ipts' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>12]],
                'pengajian' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Pengajian --'],'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bidang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>12]],
                'cgpa_pngk' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'tarikh_tamat' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>90]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'nama_ipts')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'pengajian')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'bidang')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'cgpa_pngk')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tarikh_tamat')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
