<?php

use kartik\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\DepDrop;
use kartik\datecontrol\DateControl;

use yii\helpers\ArrayHelper;

// table reference
use app\models\RefJantina;
use app\models\RefAtletTahap;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefJenisLesenMemandu;
use app\models\RefBahasa;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-form">
    <h1>Peribadi</h1>
    
    <?php if($readonly): ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->atlet_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->atlet_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
    <?php endif; ?>
    <br>
    <br>
    <?php endif; ?>
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,
            'staticOnly'=>$readonly,
            'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
    if($model->gambar){
        echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        if(!$readonly){
            echo Html::a(GeneralLabel::removeImage, ['deleteimg', 'id'=>$model->atlet_id, 'field'=> 'gambar'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br><br>';
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['accept' => 'image/*'], 'pluginOptions' => ['previewFileType' => 'image']],
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
                //'atlet_id' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
                'name_penuh' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'tahap' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-atlet-tahap/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAtletTahap::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tahapAtlet],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>2]],
                'tid' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>'Ya', false=>'Tidak'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]],
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
                    'columnOptions'=>['colspan'=>2]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jantina' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jantina/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJantina::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jantina],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_lahir' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tempat_lahir_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tempat_lahir_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'tempat_lahir_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'umur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'bangsa' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bangsa/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBangsa::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bangsa],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'agama' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agama/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAgama::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agama],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'taraf_perkahwinan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-taraf-perkahwinan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTarafPerkahwinan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tarafPerkahwinan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tinggi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6]],
                'berat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6]],
                'bahasa_ibu' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bahasa/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBahasa::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bahasa],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_sijil_lahir' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>15]],
                'ic_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'ic_no_lama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>8]],
                'ic_tentera' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'passport_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'passport_tamat_tempoh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'passport_tempat_dikeluarkan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'lesen_memandu_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'lesen_tamat_tempoh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'jenis_lesen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-lesen-memandu/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisLesenMemandu::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisLesenMemandu],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tel_bimbit_no_1' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'tel_bimbit_no_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'tel_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'facebook' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'twitter' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'attributes' => [
                'alamat_rumah_1' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_rumah_2' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_rumah_3' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_rumah_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_rumah_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_rumah_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_rumah_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_1' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_2' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_3' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_surat_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'dari_bahagian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'sumber' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'negeri_diwakili' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Negeri --'],'columnOptions'=>['colspan'=>3]],
                'kumpulan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Kumpulan --'],'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>Maklumat Perhubungan Kecemasan</strong></pre>
    
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
                'nama_kecemasan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>9]],
            ]
        ]
        ,
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pertalian_kecemasan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'tel_no_kecemasan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'tel_bimbit_no_kecemasan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tawaran' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ]
    ]
]);
    ?>
    
    

    <!--<?= $form->field($model, 'atlet_id', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'name_penuh', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_lahir', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'umur', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'tempat_lahir_bandar', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tempat_lahir_negeri', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'bangsa', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'agama', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'jantina', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'taraf_perkahwinan', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'tinggi', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'berat', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'bahasa_ibu', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'no_sijil_lahir', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'ic_no', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'ic_no_lama', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'passport_no', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'passport_tempat_dikeluarkan', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'lesen_memandu_no', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'lesen_tamat_tempoh', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'jenis_lesen', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tel_bimbit_no_1', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'tel_bimbit_no_2', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'tel_no', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'emel', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'facebook', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'twitter', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'alamat_rumah_1', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_1', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'kumpulan', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'dari_bahagian', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sumber', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'negeri_diwakili', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'nama_kecemasan', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'pertalian_kecemasan', ['addClass' => 'form-control input-sm'])->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'tel_no_kecemasan', ['addClass' => 'form-control input-sm'])->textInput() ?>

    <?= $form->field($model, 'tel_bimbit_no_kecemasan', ['addClass' => 'form-control input-sm'])->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

