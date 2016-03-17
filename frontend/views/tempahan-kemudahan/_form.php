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
use app\models\PengurusanKemudahanVenue;
use app\models\PengurusanKemudahanSediaAda;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJenisKadarKemudahan;
use app\models\RefStatusTempahanKemudahan;
use app\models\TempahanKemudahan;


// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tempahan-kemudahan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    <?php //echo $form->errorSummary($model); ?>
    <?php 
        if($model->isNewRecord){
            
        } else {
            
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/pengurusan-kemudahan-venue/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanKemudahanVenue::find()->joinWith(['refKategoriHakmilik'])->where(['status'=>1])->orderBy(['alamat_negeri' => SORT_ASC])->all(),'pengurusan_kemudahan_venue_id', 'nameAndState'),
                        'options' => ['placeholder' => Placeholder::venue],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'kemudahan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/pengurusan-kemudahan-sedia-ada/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(PengurusanKemudahanSediaAda::find()->joinWith(['refJenisKemudahan'])->all(),'pengurusan_kemudahan_sedia_ada_id', 'sukanRekreasiDanJenisKemudahan'),
                        'options'=>['prompt'=>'', 'id'=>'kemudahanID'],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'venue')],
                            'initialize' => true,
                            'placeholder' => Placeholder::kemudahan,
                            'url'=>Url::to(['/pengurusan-kemudahan-sedia-ada/subkemudahans'])],
                        ],
                    'columnOptions'=>['colspan'=>4]],
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
    <legend>BUTIRAN VENUE</legend>
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri], 'disabled'=>true],
                    'columnOptions'=>['colspan'=>3]],
                'location_alamat_bandar' => [
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
    <legend>BUTIRAN PEMILIK</legend>
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
    
    <br>
    <br>
    <!--<pre style="text-align: center"><strong>BUTIRAN KADAR</strong></pre>-->
    <legend>BUTIRAN KADAR</legend>
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
]);
        ?>
    
    <div id="butiranTempahan">
    <br>
    <br>
    <!--<pre style="text-align: center"><strong>BUTIRAN TEMPAHAN</strong></pre>-->
    <legend>BUTIRAN TEMPAHAN</legend>
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
                'no_tel' =>   ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
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
            ],
        ],
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-tempahan-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
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
$URLKemudahan = Url::to(['/pengurusan-kemudahan-sedia-ada/get-kemudahan']);
$URLVenue = Url::to(['/pengurusan-kemudahan-venue/get-venue']);

$SEJAM_SIANG = TempahanKemudahan::SEJAM_SIANG;
$SEHARI_SIANG = TempahanKemudahan::SEHARI_SIANG;
$SEMINGGU_SIANG = TempahanKemudahan::SEMINGGU_SIANG;
$SEBULAN_SIANG = TempahanKemudahan::SEBULAN_SIANG;
$SEJAM_MALAM = TempahanKemudahan::SEJAM_MALAM;
$SEHARI_MALAM = TempahanKemudahan::SEHARI_MALAM;
$SEMINGGU_MALAM = TempahanKemudahan::SEMINGGU_MALAM;
$SEBULAN_MALAM = TempahanKemudahan::SEBULAN_MALAM;

$script = <<< JS
        
$(document).ready(function(){
    var readonly = '$readonly';
        
    if(!readonly)
        $( "#tempahanDetails" ).hide();
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
        $('#tempahankemudahan-kadar_sewaan_sejam_siang').attr('value','');
        $('#tempahankemudahan-kadar_sewaan_sehari_siang').attr('value','');
        $('#tempahankemudahan-kadar_sewaan_seminggu_siang').attr('value','');
        $('#tempahankemudahan-kadar_sewaan_sebulan_siang').attr('value','');
        $('#tempahankemudahan-kadar_sewaan_sejam_malam').attr('value','');
        $('#tempahankemudahan-kadar_sewaan_sehari_malam').attr('value','');
        $('#tempahankemudahan-kadar_sewaan_seminggu_malam').attr('value','');
        $('#tempahankemudahan-kadar_sewaan_sebulan_malam').attr('value','');
        
        if(data !== null){
            $('#tempahankemudahan-kadar_sewaan_sejam_siang').attr('value',data.kadar_sewaan_sejam_siang);
            $('#tempahankemudahan-kadar_sewaan_sehari_siang').attr('value',data.kadar_sewaan_sehari_siang);
            $('#tempahankemudahan-kadar_sewaan_seminggu_siang').attr('value',data.kadar_sewaan_seminggu_siang);
            $('#tempahankemudahan-kadar_sewaan_sebulan_siang').attr('value',data.kadar_sewaan_sebulan_siang);
            $('#tempahankemudahan-kadar_sewaan_sejam_malam').attr('value',data.kadar_sewaan_sejam_malam);
            $('#tempahankemudahan-kadar_sewaan_sehari_malam').attr('value',data.kadar_sewaan_sehari_malam);
            $('#tempahankemudahan-kadar_sewaan_seminggu_malam').attr('value',data.kadar_sewaan_seminggu_malam);
            $('#tempahankemudahan-kadar_sewaan_sebulan_malam').attr('value',data.kadar_sewaan_sebulan_malam);
        
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
        
$('#tempahankemudahan-venue').change(function(){
    //alert(this.value);
      
    $.get('$URLVenue',{id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        //Clear form
        $('#tempahankemudahan-location_alamat_1').attr('value','');
        $('#tempahankemudahan-location_alamat_2').attr('value','');
        $('#tempahankemudahan-location_alamat_3').attr('value','');
        $('#tempahankemudahan-location_alamat_poskod').attr('value','');
        $("#tempahankemudahan-location_alamat_negeri").val('').trigger("change");
        $("#tempahankemudahan-location_alamat_bandar").val('').trigger("change");
        $("#tempahankemudahan-kategori_hakmilik").attr('value','');

        $('#tempahankemudahan-public_user_pemilik_id').attr('value','');
        $('#tempahankemudahan-nama_pemilik').attr('value','');
        $('#tempahankemudahan-tel_bimbit_no_pemilik').attr('value','');
        $('#tempahankemudahan-fax_no_pemilik').attr('value','');
        $('#tempahankemudahan-email_pemilik').attr('value','');
        
        if(data !== null){
            $('#tempahankemudahan-location_alamat_1').attr('value',data.alamat_1);
            $('#tempahankemudahan-location_alamat_2').attr('value',data.alamat_2);
            $('#tempahankemudahan-location_alamat_3').attr('value',data.alamat_3);
            $('#tempahankemudahan-location_alamat_poskod').attr('value',data.alamat_poskod);
            $("#tempahankemudahan-location_alamat_negeri").val(data.alamat_negeri).trigger("change");
            $("#tempahankemudahan-location_alamat_bandar").val(data.alamat_bandar).trigger("change");
            $("#tempahankemudahan-kategori_hakmilik").attr('value',data.kategori_hakmilik);
        
            $('#tempahankemudahan-public_user_pemilik_id').attr('value',data.public_user_id);
            $('#tempahankemudahan-nama_pemilik').attr('value',data.pemilik);
            $('#tempahankemudahan-tel_bimbit_no_pemilik').attr('value',data.no_telefon);
            $('#tempahankemudahan-fax_no_pemilik').attr('value',data.no_faks);
            $('#tempahankemudahan-email_pemilik').attr('value',data.emel);
        
            if(data.refKategoriHakmilik !== null){ 
                if(data.refKategoriHakmilik.tempahan_display_flag == "0"){
                    $( "#butiranTempahan" ).hide();
                } else {
                    $( "#butiranTempahan" ).show();
                }
            }
        }
    });
});
     
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {

        var form = $(this);
        
        $("form#{$model->formName()} input").prop("disabled", false);
        $("#tempahankemudahan-location_alamat_negeri").prop("disabled", false);
        $("#tempahankemudahan-location_alamat_bandar").prop("disabled", false);
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
        
        
        if(jenis_kadar != "" && quantity_kadar > 0){
            if(jenis_kadar == "$SEJAM_SIANG"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_sejam_siang').val());
            } else if(jenis_kadar == "$SEHARI_SIANG"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_sehari_siang').val());
            } else if(jenis_kadar == "$SEMINGGU_SIANG"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_seminggu_siang').val());
            } else if(jenis_kadar == "$SEBULAN_SIANG"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_sebulan_siang').val());
            } else if(jenis_kadar == "$SEJAM_MALAM"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_sejam_malam').val());
            } else if(jenis_kadar == "$SEHARI_MALAM"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_sehari_malam').val());
            } else if(jenis_kadar == "$SEMINGGU_MALAM"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_seminggu_malam').val());
            } else if(jenis_kadar == "$SEBULAN_MALAM"){
                kadar = parseFloat($('#tempahankemudahan-kadar_sewaan_sebulan_malam').val());
            }
            
            if(kadar > 0 && kadar != "NaN"){
                jumlah_bayaran_sewa = kadar * quantity_kadar;
            }
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
JS;
        
$this->registerJs($script);
?>
