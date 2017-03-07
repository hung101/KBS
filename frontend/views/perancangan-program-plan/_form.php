<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// table reference
use app\models\RefJenisProgram;
use app\models\RefBahagianProgram;
use app\models\RefCawangan;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefJenisAktiviti;
use app\models\RefStatusProgram;
use app\models\RefSukan;
use app\models\RefKategoriPelan;
use app\models\RefJenisPelan;
use app\models\RefKedudukanKejohanan;
use app\models\RefStatusPermohonanProgramBinaan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PerancanganProgramPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perancangan-program-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
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
                 
                 'cawangan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-cawangan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefCawangan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::cawangan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'jenis_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-semasa-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            //'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'cawangan')],
                            'placeholder' => Placeholder::sukan,
                            'url'=>Url::to(['/ref-sukan/subsukan'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'bahagian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-pelan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPelan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                 /*'jenis_aktiviti' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-pelan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisPelan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenis],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],*/
                'jenis_aktiviti' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-jenis-pelan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefJenisPelan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            //'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'bahagian')],
                            'placeholder' => Placeholder::jenis,
                            'url'=>Url::to(['/ref-jenis-pelan/subjenis'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                
                'nama_program' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'status_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kedudukan-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKedudukanKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => '-- Pilih Kedudukan Kejohanan -- '],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>2]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 'tarikh_tamat' => [
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
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'anggaran_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'perbelanjaan_diluluskan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'bilangan_jkk_jkp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'tarikh_jkk_jkp' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'status_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'tarikh_mula')->textInput() ?>

    <?= $form->field($model, 'nama_program')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'muat_naik')->textInput(['maxlength' => 100]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
        <?php //echo Html::a(GeneralLabel::backToList, ['index'], ['class' => 'btn btn-warning']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
