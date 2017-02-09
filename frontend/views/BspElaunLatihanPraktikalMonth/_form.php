<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikalMonth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-elaun-latihan-praktikal-month-form">

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
                'bulan' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                 'jumlah_hari' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'bsp_elaun_latihan_praktikal_id')->textInput() ?>

    <?= $form->field($model, 'bulan')->textInput() ?>

    <?= $form->field($model, 'jumlah_hari')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
