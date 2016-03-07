<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiAktivitiProjek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-senarai-aktiviti-projek-form">

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
                'nama_aktiviti_projek' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>5]],
                'keterangan_ringkas' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>5]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kejayaan_yang_dicapai' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>5]],
            ],
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'permohonan_e_bantuan_id')->textInput() ?>

    <?= $form->field($model, 'nama_aktiviti_projek')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'keterangan_ringkas')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'kejayaan_yang_dicapai')->textInput(['maxlength' => 100]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
