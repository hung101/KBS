<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJantina;
use app\models\RefDarjah;
use app\models\RefSekolah;
use app\models\RefBangsa;
use app\models\RefSukan;
use app\models\RefMaklumatProgram;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\UjianSaringan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ujian-saringan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    <?php
    if(!$readonly){
        echo $form->field($model, 'tarikh_lahir')->hiddenInput()->label(false);
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
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'maklumat_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-maklumat-program/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefMaklumatProgram::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::maklumatProgram],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12, 'id'=>'noKadPengenalanId', 'class'=>'integer']],
                
            ],
        ],
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
                    'columnOptions'=>['colspan'=>3]],
                'sekolah' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sekolah/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSekolah::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sekolah],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'darjah' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-darjah/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefDarjah::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::darjah],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_negeri' => [
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
                'alamat_bandar' => [
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
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'umur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>3, 'disabled'=>true, 'id'=>'umurId']],
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
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tinggi_duduk' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'class'=>'number']],
                'panjang_depa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'class'=>'number']],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
    ?>
    
    <h3><?=GeneralLabel::ujian_ujian?></h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::antropometrik?></strong>
        </div>
        <div class="panel-body">
            <?php
                if(!$readonly){
                    echo FormGrid::widget([
                        'model' => $model,
                        'form' => $form,
                        'autoGenerateColumns' => true,
                        'rows' => [
                            [
                                'columns'=>12,
                                'autoGenerateColumns'=>false, // override columns setting
                                'attributes' => [
                                    'antropometrik_tidak_mengambil_bahagian' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3],'options'=>['id'=>'antropometrikCheckId']],
                                ]
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
                                'berat_badan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'id'=>'beratBadanId', 'class'=>'number calculateBMI'],'hint'=>'Sila masukkan titik perpuluhan tepat (cth: 67.32)'],
                                'ketinggian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'id'=>'ketinggianId', 'class'=>'number calculateBMI'],'hint'=>'Sila masukkan titik perpuluhan tepat (cth: 183.5)'],
                                'body_mass_index' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'id'=>'BMIId', 'class'=>'number', 'disabled'=>true]],
                            ],
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?=GeneralLabel::koordinasi?></strong>
                </div>
                <div class="panel-body">
                    <?php
                    if(!$readonly){
                        echo FormGrid::widget([
                            'model' => $model,
                            'form' => $form,
                            'autoGenerateColumns' => true,
                            'rows' => [
                                [
                                    'columns'=>12,
                                    'autoGenerateColumns'=>false, // override columns setting
                                    'attributes' => [
                                        'koordinasi_tidak_mengambil_bahagian' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3],'options'=>['id'=>'koordinasiCheckId']],
                                    ]
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
                                        'melontar_dan_menerima' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>2, 'id'=>'melontarDanMenerimaId']],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?=GeneralLabel::kuasa?></strong>
                </div>
                <div class="panel-body">
                    <?php
                    if(!$readonly){
                        echo FormGrid::widget([
                            'model' => $model,
                            'form' => $form,
                            'autoGenerateColumns' => true,
                            'rows' => [
                                [
                                    'columns'=>12,
                                    'autoGenerateColumns'=>false, // override columns setting
                                    'attributes' => [
                                        'kuasa_tidak_mengambil_bahagian' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3],'options'=>['id'=>'kuasaCheckId']],
                                    ]
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
                                        'lompat_jauh_berdiri' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'id'=>'lompatJauhBerdiriId']],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?=GeneralLabel::kelenturan?></strong>
                </div>
                <div class="panel-body">
                    <?php
                    if(!$readonly){
                        echo FormGrid::widget([
                            'model' => $model,
                            'form' => $form,
                            'autoGenerateColumns' => true,
                            'rows' => [
                                [
                                    'columns'=>12,
                                    'autoGenerateColumns'=>false, // override columns setting
                                    'attributes' => [
                                        'kelenturan_tidak_mengambil_bahagian' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3],'options'=>['id'=>'kelenturanCheckId']],
                                    ]
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
                                        'jangkauan_meluntur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'id'=>'jangkauanMelunturId'],'hint'=>'Sila masukkan titik perpuluhan tepat (cth: 54.5)'],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?=GeneralLabel::kepantasan?></strong>
                </div>
                <div class="panel-body">
                    
                    <?php
                    if(!$readonly){
                        echo FormGrid::widget([
                            'model' => $model,
                            'form' => $form,
                            'autoGenerateColumns' => true,
                            'rows' => [
                                [
                                    'columns'=>12,
                                    'autoGenerateColumns'=>false, // override columns setting
                                    'attributes' => [
                                        'kepantasan_tidak_mengambil_bahagian' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3],'options'=>['id'=>'kepantasanCheckId']],
                                    ]
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
                                        'lari_pecut_20_meter' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'id'=>'lariPecut20MeterId'],'hint'=>'Sila masukkan titik perpuluhan tepat (cth: 8.25)'],
                                    ],
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$LELAKI_CODE = RefJantina::LELAKI;
$PEREMPUAN_CODE = RefJantina::PEREMPUAN;

$script = <<< JS
        
    $(document).ready(function(){
        if($("#noKadPengenalanId").val() != ""){
            getAgeFromICNo($("#noKadPengenalanId").val());
        }
        
        $( "#antropometrikCheckId" ).trigger( "click" );
        $( "#antropometrikCheckId" ).trigger( "click" );
        
        $( "#koordinasiCheckId" ).trigger( "click" );
        $( "#koordinasiCheckId" ).trigger( "click" );
        
        $( "#kuasaCheckId" ).trigger( "click" );
        $( "#kuasaCheckId" ).trigger( "click" );
        
        $( "#kelenturanCheckId" ).trigger( "click" );
        $( "#kelenturanCheckId" ).trigger( "click" );
        
        $( "#kepantasanCheckId" ).trigger( "click" );
        $( "#kepantasanCheckId" ).trigger( "click" );
    });
        
    $(".calculateBMI").keyup(function (e) {
        if($("#beratBadanId").val() > 0 && $("#ketinggianId").val() > 0){
            var height = $("#ketinggianId").val() / 100; //convert to meter
            var height2 = height * height;
            var BMI = $("#beratBadanId").val() / height2;
            $("#BMIId").val(BMI.toFixed(1));
        }
    }); 
        
    $("#noKadPengenalanId").focusout(function(){
        getAgeFromICNo(this.value);
    });
        
    function getAgeFromICNo(ICNo){
        var DOBVal = "";

        if(ICNo != ""){
            DOBVal = getDOBFromICNo(ICNo);
        
            $("#ujiansaringan-tarikh_lahir").val(DOBVal);  
        
            if(isEven(ICNo)){
                // if IC No is even then is woman
                $("#ujiansaringan-jantina").val('$PEREMPUAN_CODE').trigger("change");
            } else {
                // if IC No is odd then is guy
                $("#ujiansaringan-jantina").val('$LELAKI_CODE').trigger("change");
            }
        }

        $("#umurId").val(calculateAge(formatSaveDate(DOBVal)));
    }
 
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {

        var form = $(this);
        
        $("form#{$model->formName()} input").prop("disabled", false);
    });
        
    $("#antropometrikCheckId").click( function(){
        if( $(this).is(':checked') ) {
            //$("#beratBadanId").val("");
            //$("#ketinggianId").val("");
            //$("#BMIId").val("");
            $("#beratBadanId").prop("disabled", true);
            $("#ketinggianId").prop("disabled", true);
        } else {
            $("#beratBadanId").prop("disabled", false);
            $("#ketinggianId").prop("disabled", false);
        }
    });
        
    $("#koordinasiCheckId").click( function(){
        if( $(this).is(':checked') ) {
            //$("#melontarDanMenerimaId").val("");
            $("#melontarDanMenerimaId").prop("disabled", true);
        } else {
            $("#melontarDanMenerimaId").prop("disabled", false);
        }
    });
        
    $("#kuasaCheckId").click( function(){
        if( $(this).is(':checked') ) {
            //$("#lompatJauhBerdiriId").val("");
            $("#lompatJauhBerdiriId").prop("disabled", true);
        } else {
            $("#lompatJauhBerdiriId").prop("disabled", false);
        }
    });
        
    $("#kelenturanCheckId").click( function(){
        if( $(this).is(':checked') ) {
            //("#jangkauanMelunturId").val("");
            $("#jangkauanMelunturId").prop("disabled", true);
        } else {
            $("#jangkauanMelunturId").prop("disabled", false);
        }
    });
        
    $("#kepantasanCheckId").click( function(){
        if( $(this).is(':checked') ) {
            //$("#lariPecut20MeterId").val("");
            $("#lariPecut20MeterId").prop("disabled", true);
        } else {
            $("#lariPecut20MeterId").prop("disabled", false);
        }
    });
        
JS;
        
$this->registerJs($script);
?>
