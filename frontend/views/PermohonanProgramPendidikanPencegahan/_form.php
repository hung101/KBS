<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanPencegahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-program-pendidikan-pencegahan-form">

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
                 'program' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Program Pendidikan Pencegahan --'],'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_permohonan' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'status_permohonan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Status Permohonan --'],'columnOptions'=>['colspan'=>3]],
                'kategori_permohonan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Kategori Permohonan --'],'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'catitan_ringkas' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'kelulusan' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>'Ya', false=>'Tidak'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'atlet_id_staff_id')->textInput() ?>

    <?= $form->field($model, 'program')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_permohonan')->textInput() ?>

    <?= $form->field($model, 'status_permohonan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'kategori_permohonan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'catitan_ringkas')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
