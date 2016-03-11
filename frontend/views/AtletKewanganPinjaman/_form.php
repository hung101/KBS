<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganPinjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-kewangan-pinjaman-form">
    
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
                'nama_bank' =>  ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Nama Bank --'],'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_pinjaman' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Jenis Pinjaman --'],'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_akaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>20]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nilai_pinjaman' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tahun_permulaan' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tahun_tamat' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'nama_bank')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'jenis_pinjaman')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'no_akaun')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'nilai_pinjaman')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'tahun_tamat')->textInput() ?>

    <?= $form->field($model, 'tahun_permulaan')->textInput(['maxlength' => 4]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
