<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-pertukaran-program-pengajian-form">

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
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bidang_pengajian_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'fakulti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula_pengajian' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tarikh_tamat_pengajian' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tempoh_perlanjutan_semester' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'bidang_pengajian_kursus')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'fakulti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_mula_pengajian')->textInput() ?>

    <?= $form->field($model, 'tarikh_tamat_pengajian')->textInput() ?>

    <?= $form->field($model, 'tempoh_perlanjutan_semester')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
