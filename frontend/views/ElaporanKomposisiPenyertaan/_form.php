<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKomposisiPenyertaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-komposisi-penyertaan-form">

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
                'kumpulan_penyertaan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Kumpulan Penyertaan --'],'columnOptions'=>['colspan'=>3]],
                'jenis_komposisi' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Komposisi --'],'columnOptions'=>['colspan'=>3]],
                'bilangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
            ],
        ],
        
    ]
]);
    ?>

    <!--<?= $form->field($model, 'elaporan_pelaksaan_id')->textInput() ?>

    <?= $form->field($model, 'kumpulan_penyertaan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jenis_komposisi')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'bilangan')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
