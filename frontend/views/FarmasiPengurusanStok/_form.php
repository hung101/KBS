<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPengurusanStok */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="farmasi-pengurusan-stok-form">

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
                'nama_ubat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'dos' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2]],
                'kuantiti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'harga' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'jumlah_harga' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'nama_ubat')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'dos')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'harga')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'kuantiti')->textInput() ?>

    <?= $form->field($model, 'jumlah_harga')->textInput(['maxlength' => 10]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
