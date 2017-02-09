<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-kedudukan-kewangan-penjamin-form">

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
                'pendapatan_bulanan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'pinjaman_perumahan_baki_terkini' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'sebagai_penjamin_siberhutang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'lain_lain_pinjaman_tanggungan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        [
            'attributes' => [
                'perkerjaan' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'nama_alamat_majikan' => ['type'=>Form::INPUT_TEXTAREA],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_isteri_suami' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'no_kp_isteri_suami' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'jumlah_anak' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pertalian_keluarga_dengan_pelajar' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pelajar_lain_selain_daripada_penerima_di_atas' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'bsp_penjamin_id')->textInput() ?>

    <?= $form->field($model, 'pendapatan_bulanan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'pinjaman_perumahan_baki_terkini')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'sebagai_penjamin_siberhutang')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'lain_lain_pinjaman_tanggungan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'perkerjaan')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'nama_alamat_majikan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nama_isteri_suami')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_kp_isteri_suami')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'jumlah_anak')->textInput() ?>

    <?= $form->field($model, 'pertalian_keluarga_dengan_pelajar')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'pelajar_lain_selain_daripada_penerima_di_atas')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
