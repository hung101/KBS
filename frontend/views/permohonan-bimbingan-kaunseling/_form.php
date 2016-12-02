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
use app\models\RefStatusPermohonan;
use app\models\RefLatarbelakangKes;
use app\models\Atlet;
use app\models\ProfilBadanSukan;
use app\models\RefCawangan;
use app\models\Jurulatih;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefAgensiKaunseling;
use app\models\RefNegeri;
use app\models\RefSukan;
use app\models\RefJantina;
use app\models\RefTarafPerkahwinan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBimbinganKaunseling findOne()*/
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-bimbingan-kaunseling-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_pemohon_cap; ?></strong></pre>

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
                'agensi' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agensi-kaunseling/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAgensiKaunseling::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agensi, 'id'=>'agensiId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);
    ?>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>MSN</strong>
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
                                        'cawangan' => [
                                            'type'=>Form::INPUT_WIDGET, 
                                            'widgetClass'=>'\kartik\widgets\Select2',
                                            'options'=>[
                                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                                [
                                                    'append' => [
                                                        'content' => Html::a(Html::icon('edit'), ['/ref-latarbelakang-kes/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                        'asButton' => true
                                                    ]
                                                ] : null,
                                                'data'=>ArrayHelper::map(RefCawangan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                                'options' => ['placeholder' => Placeholder::cawangan],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],],
                                            'columnOptions'=>['colspan'=>3]],
                                    ]
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ISN</strong>
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
                                        'cawangan_isn' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>PSK</strong>
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
                                        'sukan' => [
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
                                            'columnOptions'=>['colspan'=>6]],
                                        'persatuan' => [
                                            'type'=>Form::INPUT_WIDGET, 
                                            'widgetClass'=>'\kartik\widgets\Select2',
                                            'options'=>[
                                                'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                                                'options' => ['placeholder' => Placeholder::persatuan],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],],
                                            'columnOptions'=>['colspan'=>6]],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Majlis Sukan Negeri</strong>
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
                                        'negeri' => [
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
                                                'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                                'options' => ['placeholder' => Placeholder::negeri],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],],
                                            'columnOptions'=>['colspan'=>3]],
                                    ]
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    
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
                'nama_pemohon_rujukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
            ],
        ],
        
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
            ],
        ],
    ]
]);
    ?>
    
     <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_klien_yang_dirujuk_atlet_jurulatih_cap; ?></strong></pre>
    
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-semasa-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'sukan_atlet_jurulatih' => [
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
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'atlet_id' => /*[
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
                        'options' => ['placeholder' => Placeholder::atlet, 'id'=>'atletId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],*/
                [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'name_penuh'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'sukan_atlet_jurulatih')],
                            'placeholder' => Placeholder::atlet,
                            'url'=>Url::to(['/atlet/sub-atlets-sukan'])],
                        ],
                    'columnOptions'=>['colspan'=>6]],
                'jurulatih' => /*[
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
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],*/
                [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nama'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'sukan_atlet_jurulatih')],
                            'placeholder' => Placeholder::jurulatih,
                            'url'=>Url::to(['/jurulatih/get-jurulatih-by-sukan'])],
                        ],
                    'columnOptions'=>['colspan'=>6]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'umur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>3]],
                'jantina' =>  [
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
                'taraf_perkahwinan' =>  [
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
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_temujanji' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'kes_latarbelakang' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-latarbelakang-kes/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefLatarbelakangKes::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::latarbelakangKes],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'no_rujukan_kes' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
        ],
    ]
]);
    ?>
    
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
                'diagnosis' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                'cadangan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                'tindakan_kaunselor' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'notis' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],*/
    ]
]);
    ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['kelulusan']) || $readonly): ?>
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
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                                    'todayBtn' => true,
                        ],
                        'options'=>['disabled'=>true]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'status_permohonan' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],
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
                'notis' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
    ?>
    <?php endif; ?>


    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::send : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);

$URLAtlet = Url::to(['/atlet/get-atlet']);

$AGENSI_MSN = RefAgensiKaunseling::MSN;
$AGENSI_ISN = RefAgensiKaunseling::ISN;
$AGENSI_PSK = RefAgensiKaunseling::PSK;
$AGENSI_MAJLIS_SUKAN_NEGERI = RefAgensiKaunseling::MAJLIS_SUKAN_NEGERI;

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
    
$('#jurulatihId').change(function(){
    if($(this).val() != ''){
        $("#atletId").val('').trigger("change");
    
        $.get('$URLJurulatih',{id:$(this).val()},function(data){
            clearForm();

            var data = $.parseJSON(data);

            if(data !== null){
                $('#permohonanbimbingankaunseling-umur').attr('value',calculateAge(data.tarikh_lahir));
                $("#permohonanbimbingankaunseling-jantina").val(data.jantina).trigger("change");
                $("#permohonanbimbingankaunseling-taraf_perkahwinan").val(data.taraf_perkahwinan).trigger("change");
            }
        });
    }
    
});
            
$('#atletId').change(function(){
            
    if($(this).val() != ''){
        $("#jurulatihId").val('').trigger("change");
            
        $.get('$URLAtlet',{id:$(this).val()},function(data){
            clearForm();

            var data = $.parseJSON(data);

            if(data !== null){
                $('#permohonanbimbingankaunseling-umur').attr('value',calculateAge(data.tarikh_lahir));
                $("#permohonanbimbingankaunseling-jantina").val(data.jantina).trigger("change");
                $("#permohonanbimbingankaunseling-taraf_perkahwinan").val(data.taraf_perkahwinan).trigger("change");
            }
        });
    }
});
         
function clearForm(){
    $('#permohonanbimbingankaunseling-umur').attr('value','');
    $("#permohonanbimbingankaunseling-jantina").val('').trigger("change");
    $("#permohonanbimbingankaunseling-taraf_perkahwinan").val('').trigger("change");
}
        
$('#agensiId').change(function(){
        $('#permohonanbimbingankaunseling-cawangan_isn').attr('value','');
        $('#permohonanbimbingankaunseling-cawangan').val('').trigger("change");
        $('#permohonanbimbingankaunseling-sukan').val('').trigger("change");
        $('#permohonanbimbingankaunseling-persatuan').val('').trigger("change");
        $('#permohonanbimbingankaunseling-negeri').val('').trigger("change");
        checkAgensi();
});
            
function checkAgensi(){
    if($('#agensiId')){
        $("#permohonanbimbingankaunseling-cawangan").prop('disabled', true);
        $("#permohonanbimbingankaunseling-cawangan_isn").prop('disabled', true);
        $("#permohonanbimbingankaunseling-sukan").prop('disabled', true);
        $("#permohonanbimbingankaunseling-persatuan").prop('disabled', true);
        $("#permohonanbimbingankaunseling-negeri").prop('disabled', true);
            
    
        if($('#agensiId').val() === "$AGENSI_MSN"){
            $("#permohonanbimbingankaunseling-cawangan").prop('disabled', false);
        } else if($('#agensiId').val() === "$AGENSI_ISN"){
            $("#permohonanbimbingankaunseling-cawangan_isn").prop('disabled', false);
        } else if($('#agensiId').val() === "$AGENSI_PSK"){
            $("#permohonanbimbingankaunseling-sukan").prop('disabled', false);
            $("#permohonanbimbingankaunseling-persatuan").prop('disabled', false);
        } else if($('#agensiId').val() === "$AGENSI_MAJLIS_SUKAN_NEGERI"){
            $("#permohonanbimbingankaunseling-negeri").prop('disabled', false);
        }
    }
}
        
$(document).ready(function(){
    checkAgensi();
});
        
JS;
        
$this->registerJs($script);
?>

