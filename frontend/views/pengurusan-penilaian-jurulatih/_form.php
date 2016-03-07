<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-penilaian-jurulatih-form">

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
                'penilaian_oleh' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Jawatan --'],'columnOptions'=>['colspan'=>4]],
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5]],
                'tarikh_dinilai' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5]],
            ],
        ],
       
    ]
]);
        ?>

    <!--<?= $form->field($model, 'pengurusan_pemantauan_dan_penilaian_jurulatih_id')->textInput() ?>

    <?= $form->field($model, 'penilaian_oleh')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_dinilai')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
