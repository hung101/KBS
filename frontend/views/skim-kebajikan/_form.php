<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

// table reference
use app\models\Atlet;
use app\models\RefJenisKebajikan;
use app\models\RefSukan;
use app\models\RefPerkara;
use app\models\RefSukanSkimKebajikan;
use app\models\RefJenisPermohonanSkim;
use app\models\RefBank;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\SkimKebajikan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skim-kebajikan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
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
                'jenis_bantuan_skak' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-kebajikan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisKebajikan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisBantuan,'id'=>'jenisBantuanId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'perkara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-perkara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPerkara::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::perkara,'id'=>'perkaraId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sukan-skim-kebajikan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSukanSkimKebajikan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::pencapaianTertinggi,'id'=>'sukanId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah_kos_perubatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-permohonan-skim/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisPermohonanSkim::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisPermohonan,'id'=>'jenisPermohonanId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
               'jumlah_bantuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'nama_pemohon' => [
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
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::atlet],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'nama_penerima' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'emel_penerima' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'bank_penerima' => [
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
                        'data'=>ArrayHelper::map(RefBank::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'no_akaun_penerima' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_sukan' => [
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
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'masalah_dihadapi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_kejadian' => [
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
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'lokasi_kejadian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_bantuan_lain_yang_diterima' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
    ?>
    
    <?php // Upload
    if($model->muat_naik){
        echo "<label>" . $model->getAttributeLabel('muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->skim_kebajikan_id, 'field'=> 'muat_naik'], 
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
                        'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3], 'hint'=>'cth: Memo Kelulusan Tarikh ...'],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['kelulusan']) || $readonly): ?>
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
                'tarikh_kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'kelulusan' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URL = Url::to(['/jenis-kebajikan/get-tetapan']);
$URLAtlet = Url::to(['/atlet/get-atlet']);

$JUMLAH = RefJenisPermohonanSkim::JUMLAH;
$MAKSIMUM = RefJenisPermohonanSkim::MAKSIMUM;
$PERATUSA_DARIPADA_KOS_PERUBATAN = RefJenisPermohonanSkim::PERATUSA_DARIPADA_KOS_PERUBATAN;

$script = <<< JS

    $('#jenisBantuanId').change(function(){
        calculateJumlahBantuan();
    });

    $('#perkaraId').change(function(){
        calculateJumlahBantuan();
    });
        
    $('#sukanId').change(function(){
        calculateJumlahBantuan();
    });
        
    $('#jenisPermohonanId').change(function(){
        calculateJumlahBantuan();
    });
     
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {

        var form = $(this);
        
        $("form#{$model->formName()} input").prop("disabled", false);
    });
        
    function calculateJumlahBantuan(){
        if($('#jenisBantuanId').val() != "" &&
            $('#perkaraId').val() != "" &&
            $('#sukanId').val() != "" &&
            $('#jenisPermohonanId').val() != ""){
        
            $.get('$URL',{jenisBantuanId:$('#jenisBantuanId').val(), perkaraId:$('#perkaraId').val(), sukanId:$('#sukanId').val()},function(data){

                var data = $.parseJSON(data);

                if(data !== null){
                    var jumlahBantuan = 0;
                    if($('#jenisPermohonanId').val() == $JUMLAH){
                        jumlahBantuan = data.jumlah;
                    } else if($('#jenisPermohonanId').val() == $MAKSIMUM){
                        if($('#skimkebajikan-jumlah_kos_perubatan').val() > data.maksimum){
                            jumlahBantuan = data.maksimum;
                        } else {
                            jumlahBantuan = $('#skimkebajikan-jumlah_kos_perubatan').val();
                        }
                    } else if($('#jenisPermohonanId').val() == $PERATUSA_DARIPADA_KOS_PERUBATAN){
                        jumlahBantuan = (data.peratus / 100) * $('#skimkebajikan-jumlah_kos_perubatan').val();
                    }
                
                    $('#skimkebajikan-jumlah_bantuan').attr('value',jumlahBantuan);
                } else {
                }
            });
        }
    }
                
    $('#skimkebajikan-nama_pemohon').change(function(){
            
    if($(this).val() != ''){
            
        $.get('$URLAtlet',{id:$(this).val()},function(data){
            clearForm();

            var data = $.parseJSON(data);

            if(data !== null){
                
                $('#skimkebajikan-nama_penerima').val(data.name_penuh);
                $('#skimkebajikan-emel_penerima').val(data.emel);
                
                if(data.refAtletKewanganAkaun !== null){ 
                    $('#skimkebajikan-bank_penerima').val(data.refAtletKewanganAkaun[0].nama_bank).trigger("change");
                    $('#skimkebajikan-no_akaun_penerima').val(data.refAtletKewanganAkaun[0].no_akaun);
                }
            
                if(data.refAtletSukan[0] !== null){ 
                    $('#skimkebajikan-jenis_sukan').val(data.refAtletSukan[0].nama_sukan).trigger("change");
                }
            
                if(data.refAtletPendidikan[0] !== null){ 
                    //$('#skimkebajikan-tahap_pendidikan').val(data.refAtletPendidikan[0].jenis_peringkatan_pendidikan).trigger("change");
                }
            }
        });
    }
                
    function clearForm(){
        $('#skimkebajikan-nama_penerima').val('');
        $('#skimkebajikan-emel_penerima').val('');
        $('#skimkebajikan-bank_penerima').val('').trigger("change");
        $('#skimkebajikan-no_akaun_penerima').val('');
        $('#skimkebajikan-jenis_sukan').val('').trigger("change");
    }
                
});
JS;
        
$this->registerJs($script);
?>

