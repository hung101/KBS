<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanCadanganKertasKerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-cadangan-kertas-kerja-form">

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
                 'nama_cadangan_kertas_kerja' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6]],
                 'muat_naik' =>  ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>6]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'permohonan_e_bantuan_id')->textInput() ?>

    <?= $form->field($model, 'nama_cadangan_kertas_kerja')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'muat_naik')->textInput(['maxlength' => 100]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
