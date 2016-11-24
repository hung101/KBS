<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefStatusPermohonanMembaikiPeralatan;
use app\models\RefPeralatanPermohonanMembaiki;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanMembaikiPeralatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-membaiki-peralatan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
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
                'tarikh_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'pemohon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_peralatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peralatan-permohonan-membaiki/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeralatanPermohonanMembaiki::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peralatan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'model' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>40]],
                'nombor_siri' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>40]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_diterima' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_dipulang' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'attributes' => [
                'kerosakan' => ['type'=>Form::INPUT_TEXTAREA],
            ]
        ],
        [
            'attributes' => [
                'simptom_kerosakan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'komponen_utama' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'proses_pemeriksaan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'pembaikan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'cadangan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
           'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pegawai_yang_bertanggungjawab' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'attributes' => [
                'catitan_ringkas' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        
    ]
]);
    ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-membaiki-peralatan']['status_permohonan']) || $readonly): ?>
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
                'status_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-membaiki-peralatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanMembaikiPeralatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <!--<?= $form->field($model, 'tarikh_permohonan')->textInput() ?>

    <?= $form->field($model, 'pemohon')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_peralatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'nombor_siri')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'tarikh_diterima')->textInput() ?>

    <?= $form->field($model, 'tarikh_dipulang')->textInput() ?>

    <?= $form->field($model, 'kerosakan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'simptom_kerosakan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'komponen_utama')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'proses_pemeriksaan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'pembaikan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'cadangan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'catitan_ringkas')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status_permohonan')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
