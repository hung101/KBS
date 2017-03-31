<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\Atlet;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefSukan;
use app\models\RefJenisTuntutan;
use app\models\RefStatusPermohonanInsuran;
use app\models\RefBank;
use app\models\RefStatusTawaran;
use app\models\RefKelulusanJkb;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-insuran-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

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
                'pegawai_yang_bertanggungjawab' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                 
            ],
        ], 
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'atlet_id' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Atlet::find()->where('tawaran = :tawaran', [':tawaran' => RefStatusTawaran::LULUS_TAWARAN])->all(),'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::atlet, 'id'=>'atletId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'ic_no' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>12]],
            ],
        ],  
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sukan' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'program' =>  [
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
                    'columnOptions'=>['colspan'=>4]],
                 
            ],
        ],         
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_bank' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bank/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBank::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisBank],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],   
                'no_acc' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>30]],
                 
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_insuran' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'no_polisi' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>30]], 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_kejadian' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'jenis_tuntutan' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-tuntutan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisTuntutan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisTuntutan, 'id' => 'jenisTuntutanID'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah_tuntutan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'butiran_kemalangan' =>  ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
        ?>
    
    <h3><?php echo GeneralLabel::lampiran; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'pengurusanInsuranLampiranGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanInsuranLampiran,
        //'filterModel' => $searchModelPengurusanInsuranLampiran,
        'id' => 'pengurusanInsuranLampiranGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_insuran_lampiran_id',
            //'pengurusan_insuran_id',
            //'lampiran',
			[
                'attribute' => 'nama_dokumen',
                'value' => 'refDokumenPengurusanInsurans.desc',
            ],
            [
                'attribute' => 'lampiran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::lampiran,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->lampiran){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->lampiran .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-insuran-lampiran/delete', 'id' => $model->pengurusan_insuran_lampiran_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanInsuranLampiranGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-insuran-lampiran/update', 'id' => $model->pengurusan_insuran_lampiran_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::lampiran.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-insuran-lampiran/view', 'id' => $model->pengurusan_insuran_lampiran_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::lampiran.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        $pengurusan_insuran_id = "";
        
        if(isset($model->pengurusan_insuran_id)){
            $pengurusan_insuran_id = $model->pengurusan_insuran_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-insuran-lampiran/create', 'pengurusan_insuran_id' => $pengurusan_insuran_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::lampiran.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php // Lampiran
    /*if($model->lampiran){
        echo "<label>" . $model->getAttributeLabel('lampiran') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->lampiran , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->pengurusan_insuran_id, 'field'=> 'lampiran'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
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
                        'lampiran' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'hint'=>'Note: Senarai disemak Laporan Dokumen, Laporan Polis dan Resit.'],
                    ],
                ],
            ]
        ]);
    }*/
    ?>
    <br>
    
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
                                        'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-insuran/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefStatusPermohonanInsuran::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::statusPermohonan],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        'tarikh_pembayaran' =>  [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>3]
                            ,'hint'=>'(Sila masukkan Tarikh Pembayaran, Jika Status Permohonan "Selesai")'],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'bilangan_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                        'tarikh_jkb' =>  [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>3]],
                        'kelulusan_jkb' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-kelulusan-jkb/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefKelulusanJkb::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::kelulusanJkb],
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
                        'catatan' =>  ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'tindakan_rujukan_memo' =>  ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],

                    ],
                ],
            ]
        ]);
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
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::send : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URL = Url::to(['/atlet/get-atlet']);
$URLSetTuntutan = Url::to(['/pengurusan-insuran/set-tuntutan']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('#atletId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#pengurusaninsuran-ic_no').val(data.ic_no);
        
            if(data.refAtletSukan[0] !== null){ 
                $('#pengurusaninsuran-program').val(data.refAtletSukan[0].program_semasa).trigger("change");
                $('#pengurusaninsuran-sukan').val(data.refAtletSukan[0].nama_sukan).trigger("change");
            }
            
            if(data.refAtletKewanganAkaun !== null){ 
                $('#pengurusaninsuran-jenis_bank').val(data.refAtletKewanganAkaun[0].nama_bank).trigger("change");
                $('#pengurusaninsuran-no_acc').val(data.refAtletKewanganAkaun[0].no_akaun);
            }
        }
    });
});

$('#jenisTuntutanID').change(function(){
	setTuntutan();
});

function setTuntutan(){
	$.get('$URLSetTuntutan',{tuntutan_id:$('#jenisTuntutanID').val()},function(data){
    });
}

     
function clearForm(){
    $("#pengurusaninsuran-ic_no").val('');
    $("#pengurusaninsuran-program").val('').trigger("change");
    $("#pengurusaninsuran-sukan").val('').trigger("change");
    $('#pengurusaninsuran-jenis_bank').val('').trigger("change");
    $("#pengurusaninsuran-no_acc").val('');
}
        
JS;
        
$this->registerJs($script);
?>
