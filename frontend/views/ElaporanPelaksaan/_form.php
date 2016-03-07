<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-pelaksaan-form">

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
                'nama_projek_program_aktiviti_kejohanan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'nama_persatuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_bantuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
                'no_cek_eft' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'tarikh_cek_eft' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'objektif_pelaksaan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_dilaksanakan' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'dirasmikan_oleh' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'jumlah_penyertaan_keseluruhan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'keberkesanan_pelaksaan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>15]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'nama_projek_program_aktiviti_kejohanan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_persatuan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jumlah_bantuan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'no_cek_eft')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'tarikh_cek_eft')->textInput() ?>

    <?= $form->field($model, 'objektif_pelaksaan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'tarikh_dilaksanakan')->textInput() ?>

    <?= $form->field($model, 'tempat')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'dirasmikan_oleh')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jumlah_penyertaan_keseluruhan')->textInput() ?>

    <?= $form->field($model, 'keberkesanan_pelaksaan')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
