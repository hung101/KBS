<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefJenisKewangan;
use app\models\RefJenisKewanganSumber;
use app\models\ProfilBadanSukan;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSumberKewangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-sumber-kewangan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    
    <?php
    if(!Yii::$app->user->identity->profil_badan_sukan || $readonly){
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'profil_badan_sukan_id' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2', 
                            'options'=>[
                                'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                                'options' => ['placeholder' => Placeholder::badanSukan],],
                            'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
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
                'jenis' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefJenisKewangan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisKewangan],],
                    'columnOptions'=>['colspan'=>4]],
                'sumber' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefJenisKewanganSumber::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisKewanganSumber],],
                    'columnOptions'=>['colspan'=>4]],
                'jumlah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'jenis')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'sumber')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => 10]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
