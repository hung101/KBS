<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\Rehabilitasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rehabilitasi-form">

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
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kesan_klinikal' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'masalah_yang_dikenal_pasti' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'potensi_rehabilitasi' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'matlamat_rehabilitasi' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'pl_diagnosis_preskripsi_pemeriksaan_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'kesan_klinikal')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'masalah_yang_dikenal_pasti')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'potensi_rehabilitasi')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'matlamat_rehabilitasi')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
