<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\PeningkatanKerjayaJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peningkatan-kerjaya-jurulatih-form">

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
                'nama_jurulatih' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Jurulatih--'],'columnOptions'=>['colspan'=>6]],
            ],
        ],
       [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'cawangan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Cawangan --'],'columnOptions'=>['colspan'=>3]],
                'sub_cawangan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Sub Cawangan --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'lain_lain_program' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Lain-lain Program --'],'columnOptions'=>['colspan'=>4]],
                 'pusat_latihan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'nama_sukan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Sukan --'],'columnOptions'=>['colspan'=>5]],
                'nama_acara' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Acara --'],'columnOptions'=>['colspan'=>5]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'nama_jurulatih')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'cawangan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'sub_cawangan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'program_msn')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'lain_lain_program')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'pusat_latihan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_sukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_acara')->textInput(['maxlength' => 80]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
