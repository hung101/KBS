<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\RefAcara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-acara-form">

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
                'ref_sukan_id' =>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Sukan --'],'columnOptions'=>['colspan'=>4]],
                'desc' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6]],
                'aktif' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>'Ya', false=>'Tidak'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]],
            ],
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'ref_sukan_id')->textInput() ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => 80]) ?>

    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
    <?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
