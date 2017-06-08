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
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\PengurusanKemudahanVenueMsn;
use app\models\PengurusanKemudahanSediaAdaMsn;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJenisKadarKemudahan;
use app\models\RefStatusTempahanKemudahan;
use app\models\TempahanKemudahanMsn;
use app\models\RefAgensiKemudahan;
use app\models\RefJenisKemudahan;


// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tempahan-kemudahan-msn-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    <?php //echo $form->errorSummary($model); ?>
    <?php 
        if($model->isNewRecord){
            
        } else {
            
        }
    ?>
    
    <?php
    if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
   ?>
    
    <?php
       /* echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'negeri_search' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/controllers/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri]],
                    'columnOptions'=>['colspan'=>3]],
                'kategori_hakmilik_search' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/controllers/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanKemudahanVenue::find()->where(['=', 'status', 1])->all(),'pengurusan_kemudahan_venue_id', 'nama_venue'),
                        'options' => ['placeholder' => Placeholder::kategoriHakmilik],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);*/
        ?>
    <?php
        if($readonly){
            echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempahan_kemudahan_id' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true, 'disabled'=>true]],
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
                'venue' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/pengurusan-kemudahan-venue-msn/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,*/
                        'data'=>ArrayHelper::map(PengurusanKemudahanVenueMsn::find()->joinWith(['refKategoriHakmilik'])->where(['status'=>1])->orderBy(['nama_venue' => SORT_ASC])->all(),'pengurusan_kemudahan_venue_id', 'nama_venue'),
                        'options' => ['placeholder' => Placeholder::venue],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'agensi' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agensi-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,*/
                        'data'=>ArrayHelper::map(RefAgensiKemudahan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agensi],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                /*'kemudahan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/pengurusan-kemudahan-sedia-ada/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,*/
                            /*'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(PengurusanKemudahanSediaAdaMsn::find()->joinWith(['refJenisKemudahan'])->all(),'pengurusan_kemudahan_sedia_ada_id', 'sukanRekreasiDanJenisKemudahan'),
                        'options'=>['prompt'=>'', 'id'=>'kemudahanID'],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'venue')],
                            'initialize' => true,
                            'placeholder' => Placeholder::kemudahan,
                            'url'=>Url::to(['/pengurusan-kemudahan-sedia-ada-msn/subkemudahans'])],
                        ],
                    'columnOptions'=>['colspan'=>4]],*/
            ],
        ],
    ]
]);
        ?>
    <div id="tempahanDetails" style="<?=$readonly?"":"display: none;"?>">
        
    <span id="imgSpan"></span>
    
    <br>
    <br>
    <!--<pre style="text-align: center"><strong>BUTIRAN VENUE</strong></pre>-->
    <legend><?= strtoupper(GeneralLabel::butiran_venue)?></legend>
    <?php // Venue info
    
        if(!$readonly){
            echo $form->field($model, 'kategori_hakmilik')->hiddenInput()->label(false);
        }
        
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'location_alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>true]],
            ]
        ],
        [
            'attributes' => [
                'location_alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>true]],
            ]
        ],
        [
            'attributes' => [
                'location_alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'location_alamat_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,*/
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri], 'disabled'=>true],
                    'columnOptions'=>['colspan'=>3]],
                'location_alamat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,*/
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'', 'disabled'=>true],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'location_alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5, 'disabled'=>true]],
            ]
        ],
    ]
]);
        ?>
    
    <br>
    <br>
    <!--<pre style="text-align: center"><strong>BUTIRAN PEMILIK</strong></pre>-->
    <legend><?= strtoupper(GeneralLabel::butiran_pemilik)?></legend>
    <?php
        if(!$readonly){
            echo $form->field($model, 'public_user_pemilik_id')->hiddenInput()->label(false);
        }
    ?>
    <?php // Kemudahan Kadar info
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_pemilik' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80, 'disabled'=>true]],
                'tel_bimbit_no_pemilik' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>true]],
                'fax_no_pemilik' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>true]],
                'email_pemilik' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100, 'disabled'=>true]],
            ],
        ],
    ]
]);
        ?>
    
    <!--<br>
    <br>-->
    <!--<pre style="text-align: center"><strong>BUTIRAN KADAR</strong></pre>-->
    <!--<legend>BUTIRAN KADAR</legend>-->
    <?php // Kemudahan Kadar info
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 
                'kadar_sewaan_sejam_siang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_sehari_siang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_seminggu_siang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_sebulan_siang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 
                'kadar_sewaan_sejam_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_sehari_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_seminggu_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_sebulan_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
            ],
        ],
    ]
]);*/
        ?>
    
    <div id="butiranTempahan">
    <br>
    <br>
    <!--<pre style="text-align: center"><strong>BUTIRAN TEMPAHAN</strong></pre>-->
    <legend><?= strtoupper(GeneralLabel::butiran_tempahan)?></legend>
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
                'nama' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'no_kad_pengenalan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'majikan' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_majikan' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>90]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bahagian' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                'emel' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
                'no_tel' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_tel_bimbit' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_pemohon' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>90]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_program' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
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
                        //'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_akhir' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        //'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah_orang' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ],
        ],
       /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'jenis_kadar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-kadar-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisKadarKemudahan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisKadar, 'id'=>'jenisKadar'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'quantity_kadar' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>11, 'id'=>'quantityKadar']],
                'bayaran_sewa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'id'=>'bayaranSewa', 'disabled'=>true]],
                /*'tarikh_akhir' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DateTimePicker',
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd hh:ii:00',
                            'todayHighlight' => true
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],*/
            /*],
        ],*/
        /*
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'lelaki' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'wanita' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'melayu' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'cina' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'india' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'lain_lain' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_orang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
        ],*/
    ]
]);
        ?>
    
        <?php 
        $tempahan_kemudahan_id = "";
        
        if(isset($model->tempahan_kemudahan_id)){
            $tempahan_kemudahan_id = $model->tempahan_kemudahan_id;
        }
        
        ?>
    
    
     <h3>Fasiliti Yang Ingin Digunakan &nbsp <?php if(!$readonly): ?><?=Html::a('Senarai Kemudahan', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['tempahan-kemudahan-sub-msn/create', 'tempahan_kemudahan_id' => $tempahan_kemudahan_id]).'", "Senarai Kemudahan");',
                        'class' => 'btn btn-success',
                        ]);?><?php endif; ?></h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'tempahanKemudahanSubMsnGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderTempahanKemudahanSubMsn,
        //'filterModel' => $searchModelTempahanKemudahanSubMsn,
        'id' => 'tempahanKemudahanSubMsnGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*[
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],*/
            //'no_kad_pengenalan',
            //'location_alamat_1',
            //'venue',
            /*[
                'attribute' => 'venue',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::venue,
                ],
                'value' => 'refPengurusanKemudahanVenue.nama_venue'
            ],*/
            //'tarikh_mula',
            /*[
                'attribute' => 'agensi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::agensi,
                ],
                'value' => 'refAgensiKemudahan.desc'
            ],*/
            [
                'attribute' => 'kemudahan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kemudahan,
                ],
                'value' => 'refPengurusanKemudahanSediaAdaMsn.jenis_kemudahan',
                'value'=>function ($model) {
                    $ref = RefJenisKemudahan::findOne(['id' => $model['refPengurusanKemudahanSediaAdaMsn']['jenis_kemudahan']]);
                    return $ref['desc'];
                },
            ],
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ],
                /*'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATETIME);
                },*/
            ],
            [
                'attribute' => 'jenis_kadar',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_kadar,
                ],
                'value' => 'refJenisKadarKemudahan.desc'
            ],
            [
                'attribute' => 'quantity_kadar',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::quantity_kadar,
                ]
            ],
            [
                'attribute' => 'bayaran_sewa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bayaran_sewa,
                ]
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refStatusTempahanKemudahan.desc'
            ],
            //'tarikh_akhir',
            // 'catatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['tempahan-kemudahan-sub-msn/delete', 'id' => $model->tempahan_kemudahan_sub_msn_id]).'", "'.GeneralMessage::confirmDelete.'", "tempahanKemudahanSubMsnGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['tempahan-kemudahan-sub-msn/update', 'id' => $model->tempahan_kemudahan_sub_msn_id]).'", "Senarai Kemudahan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['tempahan-kemudahan-sub-msn/view', 'id' => $model->tempahan_kemudahan_sub_msn_id]).'", "Senarai Kemudahan");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $jumlah_bayaran_sewa = 0.00;
        foreach($dataProviderTempahanKemudahanSubMsn->models as $PTLmodel){
            $jumlah_bayaran_sewa += $PTLmodel->bayaran_sewa;
        }
    ?>
    
    <h4>Jumlah Bayaran Sewa: RM <?php echo $jumlah_bayaran_sewa;?></h4>
    
    <?php Pjax::end(); ?>
    
    <br>
    <br>
    
    <?php
    if($readonly){
        echo "<hr>";
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'status' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-tempahan-kemudahan-msn/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,*/
                        'data'=>ArrayHelper::map(RefStatusTempahanKemudahan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status,],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
    }
        ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>
    
    </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$BASE_URL = \Yii::$app->request->BaseUrl;
$URLKemudahan = Url::to(['/pengurusan-kemudahan-sedia-ada-msn/get-kemudahan']);
$URLVenue = Url::to(['/pengurusan-kemudahan-venue-msn/get-venue']);
$URLSetVenue = Url::to(['/pengurusan-kemudahan-venue-msn/set-venue']);
$URLVenueAgensi = Url::to(['/pengurusan-kemudahan-venue-msn/set-agensi']);

$IS_NEW_RECORD = $model->isNewRecord;

$script = <<< JS
        
$(document).ready(function(){
    var is_new_record = '$IS_NEW_RECORD';
        
    if(!is_new_record){
        $( "#tempahanDetails" ).show();
    }
        
        setAgensi();
        setVenue();
}); 

$('#kemudahanID').change(function(){
    //alert(this.value);
        if(this.value != ""){
            $( "#tempahanDetails" ).show("slow");
        } else {
            $( "#tempahanDetails" ).hide("slow");
        }
        
    $.get('$URLKemudahan',{id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        //Clear form
        $('#tempahankemudahanmsn-kadar_sewaan_sejam_siang').attr('value','');
        $('#tempahankemudahanmsn-kadar_sewaan_sehari_siang').attr('value','');
        $('#tempahankemudahanmsn-kadar_sewaan_seminggu_siang').attr('value','');
        $('#tempahankemudahanmsn-kadar_sewaan_sebulan_siang').attr('value','');
        $('#tempahankemudahanmsn-kadar_sewaan_sejam_malam').attr('value','');
        $('#tempahankemudahanmsn-kadar_sewaan_sehari_malam').attr('value','');
        $('#tempahankemudahanmsn-kadar_sewaan_seminggu_malam').attr('value','');
        $('#tempahankemudahanmsn-kadar_sewaan_sebulan_malam').attr('value','');
        
        if(data !== null){
            $('#tempahankemudahanmsn-kadar_sewaan_sejam_siang').attr('value',data.kadar_sewaan_sejam_siang);
            $('#tempahankemudahanmsn-kadar_sewaan_sehari_siang').attr('value',data.kadar_sewaan_sehari_siang);
            $('#tempahankemudahanmsn-kadar_sewaan_seminggu_siang').attr('value',data.kadar_sewaan_seminggu_siang);
            $('#tempahankemudahanmsn-kadar_sewaan_sebulan_siang').attr('value',data.kadar_sewaan_sebulan_siang);
            $('#tempahankemudahanmsn-kadar_sewaan_sejam_malam').attr('value',data.kadar_sewaan_sejam_malam);
            $('#tempahankemudahanmsn-kadar_sewaan_sehari_malam').attr('value',data.kadar_sewaan_sehari_malam);
            $('#tempahankemudahanmsn-kadar_sewaan_seminggu_malam').attr('value',data.kadar_sewaan_seminggu_malam);
            $('#tempahankemudahanmsn-kadar_sewaan_sebulan_malam').attr('value',data.kadar_sewaan_sebulan_malam);
        
            var imgHTML = "";
        
            if(data.gambar_1 != ""){
                imgHTML += '<img src="$BASE_URL/'+data.gambar_1+'" width="200px">&nbsp;&nbsp;&nbsp;';
            }
        
            if(data.gambar_2 != ""){
                imgHTML += '<img src="$BASE_URL/'+data.gambar_2+'" width="200px">&nbsp;&nbsp;&nbsp;';
            }
        
            if(data.gambar_3 != ""){
                imgHTML += '<img src="$BASE_URL/'+data.gambar_3+'" width="200px">&nbsp;&nbsp;&nbsp;';
            }
        
            if(data.gambar_4 != ""){
                imgHTML += '<img src="$BASE_URL/'+data.gambar_4+'" width="200px">&nbsp;&nbsp;&nbsp;';
            }
        
            if(data.gambar_5 != ""){
                imgHTML += '<img src="$BASE_URL/'+data.gambar_5+'" width="200px">&nbsp;&nbsp;&nbsp;';
            }
        
            $('#imgSpan').html(imgHTML);
        }
    });
});
        
$('#tempahankemudahanmsn-venue').change(function(){
    //alert(this.value);
      
    $.get('$URLVenue',{id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        //Clear form
        $('#tempahankemudahanmsn-location_alamat_1').attr('value','');
        $('#tempahankemudahanmsn-location_alamat_2').attr('value','');
        $('#tempahankemudahanmsn-location_alamat_3').attr('value','');
        $('#tempahankemudahanmsn-location_alamat_poskod').attr('value','');
        $("#tempahankemudahanmsn-location_alamat_negeri").val('').trigger("change");
        $("#tempahankemudahanmsn-location_alamat_bandar").val('').trigger("change");
        $("#tempahankemudahanmsn-kategori_hakmilik").attr('value','');

        $('#tempahankemudahanmsn-public_user_pemilik_id').attr('value','');
        $('#tempahankemudahanmsn-nama_pemilik').attr('value','');
        $('#tempahankemudahanmsn-tel_bimbit_no_pemilik').attr('value','');
        $('#tempahankemudahanmsn-fax_no_pemilik').attr('value','');
        $('#tempahankemudahanmsn-email_pemilik').attr('value','');
        
        if(data !== null){
            $('#tempahankemudahanmsn-location_alamat_1').attr('value',data.alamat_1);
            $('#tempahankemudahanmsn-location_alamat_2').attr('value',data.alamat_2);
            $('#tempahankemudahanmsn-location_alamat_3').attr('value',data.alamat_3);
            $('#tempahankemudahanmsn-location_alamat_poskod').attr('value',data.alamat_poskod);
            $("#tempahankemudahanmsn-location_alamat_negeri").val(data.alamat_negeri).trigger("change");
            $("#tempahankemudahanmsn-location_alamat_bandar").val(data.alamat_bandar).trigger("change");
            $("#tempahankemudahanmsn-kategori_hakmilik").attr('value',data.kategori_hakmilik);
        
            $('#tempahankemudahanmsn-public_user_pemilik_id').attr('value',data.public_user_id);
            $('#tempahankemudahanmsn-nama_pemilik').attr('value',data.pemilik);
            $('#tempahankemudahanmsn-tel_bimbit_no_pemilik').attr('value',data.no_telefon);
            $('#tempahankemudahanmsn-fax_no_pemilik').attr('value',data.no_faks);
            $('#tempahankemudahanmsn-email_pemilik').attr('value',data.emel);
        
            if(data.refKategoriHakmilik !== null){ 
                if(data.refKategoriHakmilik.tempahan_display_flag == "0"){
                    //$( "#butiranTempahan" ).hide();
                } else {
                    //$( "#butiranTempahan" ).show();
                }
            }
        }
    });
        
    if(this.value != ""){
            $( "#tempahanDetails" ).show("slow");
        } else {
            $( "#tempahanDetails" ).hide("slow");
        }
});
     
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {

        var form = $(this);
        
        $("form#{$model->formName()} input").prop("disabled", false);
        $("#tempahankemudahanmsn-location_alamat_negeri").prop("disabled", false);
        $("#tempahankemudahanmsn-location_alamat_bandar").prop("disabled", false);
    });
        
    $('#jenisKadar').change(function(){
        calculateBayaranSewa();
    });
        
    $('#quantityKadar').on("keyup", function(){calculateBayaranSewa();});
        
    function calculateBayaranSewa(){
        //alert("calculate");
        var quantity_kadar = 0;
        var kadar = 0.0;
        var jumlah_bayaran_sewa = 0.0;
        var jenis_kadar = $('#jenisKadar').val();
        
        if($('#quantityKadar').val() != ""){
            quantity_kadar = parseInt($('#quantityKadar').val());
        }
        
        //round up 2 decimals
        jumlah_bayaran_sewa = Math.round(jumlah_bayaran_sewa * 100) / 100;
                
        $('#bayaranSewa').val(jumlah_bayaran_sewa)
    }
    
    // only allow number key in
    $("#quantityKadar").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        //alert(e.keyCode);
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
        
        
$('#tempahankemudahanmsn-agensi').change(function(){
    setAgensi();
});
        
function setAgensi(){
    $.get('$URLVenueAgensi',{id:$('#tempahankemudahanmsn-agensi').val()},function(data){
    });
}
                
function setVenue(){
    $.get('$URLSetVenue',{id:$('#tempahankemudahanmsn-venue').val()},function(data){
    });
}
JS;
        
$this->registerJs($script);
?>
