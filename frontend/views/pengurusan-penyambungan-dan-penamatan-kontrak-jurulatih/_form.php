<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

// table reference
use app\models\Jurulatih;
use app\models\RefStatusPermohonanKontrakJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefGajiElaunJurulatih;
use app\models\RefJenisPermohonanKontrakJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data'], 'id'=>$model->formName()]); ?>
    <?php
    
    $disabled = false;
    
    if(!$readonly && !$model->isNewRecord){
        $disabled = true;
    }
    
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'], 'disabled'=>$disabled,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
    ]
]);
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
                'program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgramJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_mula_lantikan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat_lantikan' => [
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
                'gaji_elaun' => [
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
                        'data'=>ArrayHelper::map(RefGajiElaunJurulatih::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::gajiElaun],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah_gaji_elaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-permohonan-kontrak-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisPermohonanKontrakJurulatih::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisPermohonan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                 
            ],
        ],
    ]
]);
        ?>
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Cadangan Tempoh Kontrak</strong>
                </div>
                <div class="panel-body">
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
                                        'program_baru' => [
                                            'type'=>Form::INPUT_WIDGET, 
                                            'widgetClass'=>'\kartik\widgets\Select2',
                                            'options'=>[
                                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                                [
                                                    'append' => [
                                                        'content' => Html::a(Html::icon('edit'), ['/ref-program-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                        'asButton' => true
                                                    ]
                                                ] : null,
                                                'data'=>ArrayHelper::map(RefProgramJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                                'options' => ['placeholder' => Placeholder::program],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],],
                                            'columnOptions'=>['colspan'=>3]],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
    
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Cadangan Elaun / Gaji</strong>
                </div>
                <div class="panel-body">
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
                                        'cadangan_gaji_elaun' => [
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
                                                'data'=>ArrayHelper::map(RefGajiElaunJurulatih::find()->all(),'id', 'desc'),
                                                'options' => ['placeholder' => Placeholder::gajiElaun],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],],
                                            'columnOptions'=>['colspan'=>3]],
                                        'cadangan_jumlah_gaji_elaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                                    ],
                                ],
                                [
                                    'columns'=>12,
                                    'autoGenerateColumns'=>false, // override columns setting
                                    'attributes' => [
                                        'sebab' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
     
     <?php // Muat Naik Dokumen
    /*if($model->muat_naik_document){
        echo "<label>" . $model->getAttributeLabel('muat_naik_document') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_document , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id, 'field'=> 'muat_naik_document'], 
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
                        'muat_naik_document' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }*/
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
                                        'penamatan_tarikh_berkuatkuasa' => [
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
                    ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['status_permohonan']) || $readonly): ?>
    <hr>
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-kontrak-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanKontrakJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bil_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'tarikh_jkb' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <!--<?= $form->field($model, 'jurulatih')->textInput(['maxlength' => 80]) ?>

    
    <?= $form->field($model, 'status_permohonan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'muat_naik_document')->textInput(['maxlength' => 100]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?= Html::a(GeneralLabel::backToList, ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$DateDisplayFormat = GeneralVariable::displayDateFormat;
$URLJurulatihSukan = Url::to(['/jurulatih-sukan/get-jurulatih-sukan-acara']);

$script = <<< JS
        
// enable all the disabled field before submit
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#jurulatihId").prop("disabled", false);
    //$("#tempahankemudahan-location_alamat_bandar").prop("disabled", false);
});
        
$('#jurulatihId').change(function(){
        
    $.get('$URLJurulatihSukan',{jurulatih_id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-program").val(data.program).trigger("change");
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-gaji_elaun").val(data.gaji_elaun).trigger("change");
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-jumlah_gaji_elaun").attr('value',data.jumlah);
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_mula_lantikan").attr('value',data.tarikh_mula_lantikan);
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_tamat_lantikan").attr('value',data.tarikh_tamat_lantikan);
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_mula_lantikan-disp").val(formatDisplayDate(data.tarikh_mula_lantikan));
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_tamat_lantikan-disp").val(formatDisplayDate(data.tarikh_tamat_lantikan));
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_mula_lantika").kvDatepicker("$DateDisplayFormat", new Date(data.tarikh_mula_lantikan)).kvDatepicker({
                format: "$DateDisplayFormat"
            });
            $("#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_tamat_lantikan").kvDatepicker("$DateDisplayFormat", new Date(data.tarikh_tamat_lantikan)).kvDatepicker({
                format: "$DateDisplayFormat"
            });
        }
    });
});
     
function clearForm(){
    $('#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_mula_lantikan').attr('value','');
    $("#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_mula_lantikan-disp").val('');
    $('#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_tamat_lantikan').attr('value','');
    $('#pengurusanpenyambungandanpenamatankontrakjurulatih-tarikh_tamat_lantikan-disp').attr('value','');
    $('#pengurusanpenyambungandanpenamatankontrakjurulatih-jumlah_gaji_elaun').attr('value','');
    $("#pengurusanpenyambungandanpenamatankontrakjurulatih-program").val('').trigger("change");
    $("#pengurusanpenyambungandanpenamatankontrakjurulatih-gaji_elaun").val('').trigger("change");
}
        
JS;
        
$this->registerJs($script);
?>
