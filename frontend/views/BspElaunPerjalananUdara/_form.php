<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunPerjalananUdara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-elaun-perjalanan-udara-form">
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong>Arahan</strong>
  </div>
        <ul>
            <li >Borang ini hanya untuk kegunaan Penerima Biasiswa Sukan Persekutuan Kementerian Belia dan Sukan Malaysia.</li>
            <li >Syarat-syarat tuntutan tambang kapal terbang adalah berikut:</li>
            <ul>
                <li >Sekali setiap tahun pengajian;</li>
                <li >Pelajar Semananjung yang pelajar di Sabah atau Sarawak dan sebaliknya;</li>
                <li >Pelajar Sarawak yang belajar di Sabah dan sebaliknya;</li>
                <li >Pelajar Labuan yang belajar di Sarawak, Sabah dan Semenanjung;</li>
                <li >Mendapat pengesahan dari IPT; dan</li>
                <li >Tuntutan dibuat pada tahun semasa</li>
            </ul>
        </ul>
    </div>

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
                'tarikh' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'destinasi_pergi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                'tarikh_pergi' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'destinasi_balik' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                'tarikh_balik' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>90]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'destinasi_pergi')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'tarikh_pergi')->textInput() ?>

    <?= $form->field($model, 'destinasi_balik')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'tarikh_balik')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
