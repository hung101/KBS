<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\Ekemudahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ekemudahan-form">
    
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
                'kategori' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Kategori --'],'columnOptions'=>['colspan'=>3]],
                'jenis' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Jenis --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'lokasi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'dihubungi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
                'kadar_sewa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'url' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>200]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_perniagaan_perkhidmatan_organisasi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kapasiti_penggunaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>50]],
                'no_lesen_pendaftaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'kategori')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jenis')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'gambar')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'dihubungi')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'kadar_sewa')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'nama_perniagaan_perkhidmatan_organisasi')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'kapasiti_penggunaan')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'no_lesen_pendaftaran')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
