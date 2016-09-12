<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;

// table reference
use app\models\RefJantina;
use app\models\RefSaizBajuSukarelawan;
use app\models\RefKelulusanAkademikSukarelawan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBidangDiminatiSukarelawan;
use app\models\RefWaktuKetikaDiperlukanSukarelawan;
use app\models\RefTarafPerkahwinan;
use app\models\RefBangsa;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\Sukarelawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sukarelawan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'staticOnly'=>$readonly,'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php // muatnaik upload
    if($model->muatnaik){
        echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->muatnaik.'" width="200px">&nbsp;&nbsp;&nbsp;';
        echo '<br>';
    } 
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'muatnaik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
    
    echo '<br>';
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
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12, 'id'=>'NoICID']],
                'tarikh_lahir' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options' => ['id'=>'TarikhLahirID'],
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 
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
                        'options' => ['placeholder' => Placeholder::jantina],],
                    'columnOptions'=>['colspan'=>2]],
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
                        'options' => ['placeholder' => Placeholder::negeri],],
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
                'no_tel_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'status' => [
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
                        'options' => ['placeholder' => Placeholder::tarafPerkahwinan],],
                    'columnOptions'=>['colspan'=>3]],
                'saiz_baju' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-saiz-baju-sukarelawan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSaizBajuSukarelawan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::saizBaju],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
                'facebook' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
            ]
        ],
         [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kebatasan_fizikal' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>2]],
                'menyatakan_jika_ada_kebatasan_fizikal' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ]
        ],
        
        
    ]
]);
        ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>MAKLUMAT AKADEMIK</strong></pre>
    
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
                        'kelulusan_akademi' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-kelulusan-akademik-sukarelawan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefKelulusanAkademikSukarelawan::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::kelulusanAkademik],],
                            'columnOptions'=>['colspan'=>4]],
                        
                    ]
                ],
            ]
        ]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>MAKLUMAT PEKERJAAN</strong></pre>
    
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
                        'pekerjaan_semasa' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                    ]
                ],
                        [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'nama_majikan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                    ]
                ],
                 [
                    'attributes' => [
                        'alamat_majikan_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
                    ]
                ],
                [
                    'attributes' => [
                        'alamat_majikan_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
                    ]
                ],
                [
                    'attributes' => [
                        'alamat_majikan_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'alamat_majikan_negeri' => [
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
                                'options' => ['placeholder' => Placeholder::negeri],],
                            'columnOptions'=>['colspan'=>3]],
                        'alamat_majikan_bandar' => [
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
                                'pluginOptions' => [
                                    'depends'=>[Html::getInputId($model, 'alamat_majikan_negeri')],
                                    'placeholder' => Placeholder::bandar,
                                    'url'=>Url::to(['/ref-bandar/subbandars'])],
                                ],
                            'columnOptions'=>['colspan'=>3]],
                        'alamat_majikan_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'pengalaman_sukarelawan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'bidang_diminati' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-bidang-diminati-sukarelawan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefBidangDiminatiSukarelawan::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::kecenderungan],],
                            'columnOptions'=>['colspan'=>3]],
                        'bidang_diminati_lain_lain' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'bidang_kepakaran' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'waktu_ketika_diperlukan' =>[
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-waktu-ketika-diperlukan-sukarelawan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefWaktuKetikaDiperlukanSukarelawan::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::waktuKetikaDiperlukan],],
                            'columnOptions'=>['colspan'=>3]],
                        'menyatakan_waktu_ketika_diperlukan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                    ]
                ],
            ]
        ]);
    ?>
    
    <?php // muatnaik upload
    if($model->isNewRecord){
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'clause' =>['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>3]],
                    ]
                ],
            ]
        ]);
    }
    ?>

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

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
          success: function (response) {
               // do something with response
               
                if(response != 1){
                    $('#modalContent').html(response);
                } else {
                    $(document).find('#modal').modal('hide');
                    form.trigger("reset");
                    $.pjax.defaults.timeout = 100000;
                    $.pjax.reload({container:'#ahliGrid'});
                }
          }
     });
     return false;
});
     
$(document).ready(function(){
    if($("#TarikhLahirID").val() != ""){
        $("#UmurID").val(calculateAge($("#TarikhLahirID").val()));
    }
});
        
$("#NoICID").focusout(function(){
    var DOBVal = "";
    
    if(this.value != ""){
        DOBVal = getDOBFromICNo(this.value);
    }
    
        
    $("#TarikhLahirID-disp").val(formatDisplayDate(DOBVal));
    $("#TarikhLahirID").val(formatSaveDate(DOBVal));
        
       /* $('#TarikhLahirID').kvDatepicker({
                format: 'mm/dd/yyyy',
                startDate: '-3d'
            });*/
        
    //$("#UmurID").val(calculateAge(formatSaveDate(DOBVal)));
        
        
    $("#TarikhLahirID").kvDatepicker("$DateDisplayFormat", new Date(DOBVal)).kvDatepicker({
        format: "$DateDisplayFormat"
    });
});
        
$('#TarikhLahirID').change(function(){
    //$("#UmurID").val(calculateAge(this.value));
});

JS;
        
$this->registerJs($script);
?>


