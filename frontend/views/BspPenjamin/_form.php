<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspPenjamin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-penjamin-form">

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
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
            ],
        ],
        [
            'attributes' => [
                'alamat_tetap_1' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_tetap_2' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_tetap_3' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'alamat_bandar' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Bandar --'],'columnOptions'=>['colspan'=>3]],
                'alamat_negeri' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Negeri --'],'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_1' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_2' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_3' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_surat_menyurat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'alamat_surat_menyurat_bandar' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Bandar --'],'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_negeri' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Negeri --'],'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon_rumah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_telefon_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'email' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'attributes' => [
                'alamat_pejabat_1' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_pejabat_2' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_pejabat_3' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_pejabat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'alamat_pejabat_bandar' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Bandar --'],'columnOptions'=>['colspan'=>3]],
                'alamat_pejabat_negeri' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Negeri --'],'columnOptions'=>['colspan'=>3]],
            ]
        ]
    ]
]);
        ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_kad_pengenalan')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'alamat_tetap_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_tetap_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_tetap_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'no_telefon_rumah')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'no_telefon_pejabat')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'no_telefon_bimbit')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'alamat_pejabat_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_pejabat_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_pejabat_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_pejabat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_pejabat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_pejabat_poskod')->textInput(['maxlength' => 5]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
