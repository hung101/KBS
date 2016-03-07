<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-prestasi-form">

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
                 
                'laporan_ulasan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>5]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 
                'nyatakan_sebab_sebab_tidak_menyertai_kejohanan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>5]],
                 
            ],
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'laporan_ulasan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nyatakan_sebab_sebab_tidak_menyertai_kejohanan')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
