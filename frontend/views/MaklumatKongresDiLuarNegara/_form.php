<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatKongresDiLuarNegara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-kongres-di-luar-negara-form">

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
                 'tajuk' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>5]],
                 'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>5]],
                 'masa' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_penerbangan' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tiket_penerbangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>5]],
                'jumlah_penerbangan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
         [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'lain_lain' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'jumlah_kos_lain_lain' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'nama_pegawai_terlibat' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>5]],
            ]
        ],
    ]
]);
        ?>


    <!--<?= $form->field($model, 'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id')->textInput() ?>

    <?= $form->field($model, 'tajuk')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tempat')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'masa')->textInput() ?>

    <?= $form->field($model, 'tarikh_penerbangan')->textInput() ?>

    <?= $form->field($model, 'tiket_penerbangan')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'jumlah_penerbangan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'lain_lain')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'jumlah_kos_lain_lain')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'nama_pegawai_terlibat')->textInput(['maxlength' => 80]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
