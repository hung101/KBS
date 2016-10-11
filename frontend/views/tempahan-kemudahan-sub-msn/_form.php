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
use yii\web\Session;

// table reference
use app\models\PengurusanKemudahanVenueMsn;
use app\models\PengurusanKemudahanSediaAdaMsn;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJenisKadarKemudahanMsn;
use app\models\RefStatusTempahanKemudahan;
use app\models\TempahanKemudahanMsn;
use app\models\RefAgensiKemudahan;


// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKemudahan */
/* @var $form yii\widgets\ActiveForm */


//filter by Agensi and Venue from parent form
$session = new Session;
$session->open();

$kemudahan_list = null;

/*if((isset($session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']) && $session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id'])){
    echo "<br>Venue ID = " . $session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id'];
}

if((isset($session['tempahan-kemudahan-msn-agensi_id']) && $session['tempahan-kemudahan-msn-agensi_id'])){
    echo "<br>Agensi ID = " . $session['tempahan-kemudahan-msn-agensi_id'];
}*/

if((isset($session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']) && $session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']) &&
        (isset($session['tempahan-kemudahan-msn-agensi_id']) && $session['tempahan-kemudahan-msn-agensi_id'])){
    $kemudahan_list = PengurusanKemudahanSediaAdaMsn::find()->joinWith(['refJenisKemudahan'])->where(['pengurusan_kemudahan_venue_id'=>$session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']])
                                                                                            ->andWhere(['agensi'=>$session['tempahan-kemudahan-msn-agensi_id']])->all();
} elseif(isset($session['tempahan-kemudahan-msn-agensi_id']) && $session['tempahan-kemudahan-msn-agensi_id']) {
    $kemudahan_list = PengurusanKemudahanSediaAdaMsn::find()->joinWith(['refJenisKemudahan'])->where(['agensi'=>$session['tempahan-kemudahan-msn-agensi_id']])->all();
}  elseif(isset($session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']) && $session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']) {
    $kemudahan_list = PengurusanKemudahanSediaAdaMsn::find()->joinWith(['refJenisKemudahan'])
                        ->where(['pengurusan_kemudahan_venue_id'=>$session['tempahan-kemudahan-msn-pengurusan_kemudahan_venue_id']])->all();
} else {
    $kemudahan_list = PengurusanKemudahanSediaAdaMsn::find()->joinWith(['refJenisKemudahan'])->all();
}


?>

<div class="tempahan-kemudahan-sub-msn-form">

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
                /*'venue' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/pengurusan-kemudahan-venue-msn/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanKemudahanVenueMsn::find()->joinWith(['refKategoriHakmilik'])->where(['status'=>1])->orderBy(['alamat_negeri' => SORT_ASC])->all(),'pengurusan_kemudahan_venue_id', 'nameAndState'),
                        'options' => ['placeholder' => Placeholder::venue],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],*/
                /*'agensi' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agensi-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAgensiKemudahan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agensi],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],*/
                'kemudahan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agensi-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($kemudahan_list,'pengurusan_kemudahan_sedia_ada_id', 'sukanRekreasiDanJenisKemudahan'),
                        'options' => ['placeholder' => Placeholder::kemudahan, 'id'=>'kemudahanID'],
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
                            'depends'=>[Html::getInputId($model, 'agensi')],
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
    <div id="tempahanSubDetails" style="<?=$readonly?"":"display: none;"?>">
        
    <span id="imgSubSpan"></span>
    
    <br>
    <br>
    <!--<pre style="text-align: center"><strong>BUTIRAN KADAR</strong></pre>-->
    <legend>BUTIRAN KADAR</legend>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::kadar?></strong>
        </div>
        <div class="panel-body">
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
                //'kadar_sewaan_seminggu_siang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                //'kadar_sewaan_sebulan_siang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 
                'kadar_sewaan_sejam_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_sehari_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                //'kadar_sewaan_seminggu_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                //'kadar_sewaan_sebulan_malam' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
            ],
        ],
    ]
]);
        ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::kadar_cuti_umum_sabtu_ahad?></strong>
        </div>
        <div class="panel-body">
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
                 
                'kadar_sewaan_sejam_siang_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_sehari_siang_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                //'kadar_sewaan_seminggu_siang_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                //'kadar_sewaan_sebulan_siang_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 
                'kadar_sewaan_sejam_malam_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                'kadar_sewaan_sehari_malam_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                //'kadar_sewaan_seminggu_malam_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
                //'kadar_sewaan_sebulan_malam_cuti_umum' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'disabled'=>true]],
            ],
        ],
    ]
]);
        ?>
        </div>
    </div>
    
    
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
        /*[
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
        ],*/
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-kadar-kemudahan-msn/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisKadarKemudahanMsn::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
    
    <br>
    <br>
    
    <?php
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan-msn']['kelulusan']) || $readonly){
        echo '<hr>';
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-tempahan-kemudahan-sub-msn/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
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
    }
        ?>
    
    <br>
    <br>
    

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>
    
    </div>
    <?php ActiveForm::end(); ?>
    </div>
    
    <br>
    <br>
    <br>
    <br>
</div>

<?php
$BASE_URL = \Yii::$app->request->BaseUrl;
$URLKemudahan = Url::to(['/pengurusan-kemudahan-sedia-ada-msn/get-kemudahan']);
$URLVenue = Url::to(['/pengurusan-kemudahan-venue-msn/get-venue']);

$IS_NEW_RECORD = $model->isNewRecord;

$SEJAM_SIANG = TempahanKemudahanMsn::SEJAM_SIANG;
$SEHARI_SIANG = TempahanKemudahanMsn::SEHARI_SIANG;
$SEJAM_MALAM = TempahanKemudahanMsn::SEJAM_MALAM;
$SEHARI_MALAM = TempahanKemudahanMsn::SEHARI_MALAM;
$SEJAM_SIANG_CUTI_UMUM = TempahanKemudahanMsn::SEJAM_SIANG_CUTI_UMUM;
$SEHARI_SIANG_CUTI_UMUM = TempahanKemudahanMsn::SEHARI_SIANG_CUTI_UMUM;
$SEJAM_MALAM_CUTI_UMUM = TempahanKemudahanMsn::SEJAM_MALAM_CUTI_UMUM;
$SEHARI_MALAM_CUTI_UMUM = TempahanKemudahanMsn::SEHARI_MALAM_CUTI_UMUM;


$script = <<< JS
        
$(document).ready(function(){
    var is_new_record = '$IS_NEW_RECORD';
        
    if(!is_new_record){
        $( "#tempahanSubDetails" ).show();
    }
}); 

$('#kemudahanID').change(function(){
    //alert(this.value);
        if(this.value != ""){
            $( "#tempahanSubDetails" ).show("slow");
        } else {
            $( "#tempahanSubDetails" ).hide("slow");
        }
        
    $.get('$URLKemudahan',{id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        //Clear form
        $('#tempahankemudahansubmsn-kadar_sewaan_sejam_siang').attr('value','');
        $('#tempahankemudahansubmsn-kadar_sewaan_sehari_siang').attr('value','');
        $('#tempahankemudahansubmsn-kadar_sewaan_seminggu_siang').attr('value','');
        $('#tempahankemudahansubmsn-kadar_sewaan_sebulan_siang').attr('value','');
        $('#tempahankemudahansubmsn-kadar_sewaan_sejam_malam').attr('value','');
        $('#tempahankemudahansubmsn-kadar_sewaan_sehari_malam').attr('value','');
        $('#tempahankemudahansubmsn-kadar_sewaan_seminggu_malam').attr('value','');
        $('#tempahankemudahansubmsn-kadar_sewaan_sebulan_malam').attr('value','');
        
        if(data !== null){
            $('#tempahankemudahansubmsn-kadar_sewaan_sejam_siang').attr('value',data.kadar_sewaan_sejam_siang);
            $('#tempahankemudahansubmsn-kadar_sewaan_sehari_siang').attr('value',data.kadar_sewaan_sehari_siang);
            $('#tempahankemudahansubmsn-kadar_sewaan_seminggu_siang').attr('value',data.kadar_sewaan_seminggu_siang);
            $('#tempahankemudahansubmsn-kadar_sewaan_sebulan_siang').attr('value',data.kadar_sewaan_sebulan_siang);
            $('#tempahankemudahansubmsn-kadar_sewaan_sejam_malam').attr('value',data.kadar_sewaan_sejam_malam);
            $('#tempahankemudahansubmsn-kadar_sewaan_sehari_malam').attr('value',data.kadar_sewaan_sehari_malam);
            $('#tempahankemudahansubmsn-kadar_sewaan_seminggu_malam').attr('value',data.kadar_sewaan_seminggu_malam);
            $('#tempahankemudahansubmsn-kadar_sewaan_sebulan_malam').attr('value',data.kadar_sewaan_sebulan_malam);
        
            $('#tempahankemudahansubmsn-kadar_sewaan_sejam_siang_cuti_umum').attr('value',data.kadar_sewaan_sejam_siang_cuti_umum);
            $('#tempahankemudahansubmsn-kadar_sewaan_sehari_siang_cuti_umum').attr('value',data.kadar_sewaan_sehari_siang_cuti_umum);
            $('#tempahankemudahansubmsn-kadar_sewaan_seminggu_siang_cuti_umum').attr('value',data.kadar_sewaan_seminggu_siang_cuti_umum);
            $('#tempahankemudahansubmsn-kadar_sewaan_sebulan_siang_cuti_umum').attr('value',data.kadar_sewaan_sebulan_siang_cuti_umum);
            $('#tempahankemudahansubmsn-kadar_sewaan_sejam_malam_cuti_umum').attr('value',data.kadar_sewaan_sejam_malam_cuti_umum);
            $('#tempahankemudahansubmsn-kadar_sewaan_sehari_malam_cuti_umum').attr('value',data.kadar_sewaan_sehari_malam_cuti_umum);
            $('#tempahankemudahansubmsn-kadar_sewaan_seminggu_malam_cuti_umum').attr('value',data.kadar_sewaan_seminggu_malam_cuti_umum);
            $('#tempahankemudahansubmsn-kadar_sewaan_sebulan_malam_cuti_umum').attr('value',data.kadar_sewaan_sebulan_malam_cuti_umum);
        
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
        
            $('#imgSubSpan').html(imgHTML);
        }
        
        calculateBayaranSewa();
    });
});
        
$('#tempahankemudahansubmsn-venue').change(function(){
    //alert(this.value);
      
    $.get('$URLVenue',{id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        //Clear form
        $('#tempahankemudahansubmsn-location_alamat_1').attr('value','');
        $('#tempahankemudahansubmsn-location_alamat_2').attr('value','');
        $('#tempahankemudahansubmsn-location_alamat_3').attr('value','');
        $('#tempahankemudahansubmsn-location_alamat_poskod').attr('value','');
        $("#tempahankemudahansubmsn-location_alamat_negeri").val('').trigger("change");
        $("#tempahankemudahansubmsn-location_alamat_bandar").val('').trigger("change");
        $("#tempahankemudahansubmsn-kategori_hakmilik").attr('value','');

        $('#tempahankemudahansubmsn-public_user_pemilik_id').attr('value','');
        $('#tempahankemudahansubmsn-nama_pemilik').attr('value','');
        $('#tempahankemudahansubmsn-tel_bimbit_no_pemilik').attr('value','');
        $('#tempahankemudahansubmsn-fax_no_pemilik').attr('value','');
        $('#tempahankemudahansubmsn-email_pemilik').attr('value','');
        
        if(data !== null){
            $('#tempahankemudahansubmsn-location_alamat_1').attr('value',data.alamat_1);
            $('#tempahankemudahansubmsn-location_alamat_2').attr('value',data.alamat_2);
            $('#tempahankemudahansubmsn-location_alamat_3').attr('value',data.alamat_3);
            $('#tempahankemudahansubmsn-location_alamat_poskod').attr('value',data.alamat_poskod);
            $("#tempahankemudahansubmsn-location_alamat_negeri").val(data.alamat_negeri).trigger("change");
            $("#tempahankemudahansubmsn-location_alamat_bandar").val(data.alamat_bandar).trigger("change");
            $("#tempahankemudahansubmsn-kategori_hakmilik").attr('value',data.kategori_hakmilik);
        
            $('#tempahankemudahansubmsn-public_user_pemilik_id').attr('value',data.public_user_id);
            $('#tempahankemudahansubmsn-nama_pemilik').attr('value',data.pemilik);
            $('#tempahankemudahansubmsn-tel_bimbit_no_pemilik').attr('value',data.no_telefon);
            $('#tempahankemudahansubmsn-fax_no_pemilik').attr('value',data.no_faks);
            $('#tempahankemudahansubmsn-email_pemilik').attr('value',data.emel);
        
            if(data.refKategoriHakmilik !== null){ 
                if(data.refKategoriHakmilik.tempahan_display_flag == "0"){
                    //$( "#butiranTempahan" ).hide();
                } else {
                    //$( "#butiranTempahan" ).show();
                }
            }
        }
        
    });
});
     
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {

        var form = $(this);
        
        $("form#{$model->formName()} input").prop("disabled", false);
        $("#tempahankemudahansubmsn-location_alamat_negeri").prop("disabled", false);
        $("#tempahankemudahansubmsn-location_alamat_bandar").prop("disabled", false);
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
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sejam_siang').val());
            } else if(jenis_kadar == "$SEHARI_SIANG"){
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sehari_siang').val());
            } else if(jenis_kadar == "$SEJAM_MALAM"){
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sejam_malam').val());
            } else if(jenis_kadar == "$SEHARI_MALAM"){
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sehari_malam').val());
            } else if(jenis_kadar == "$SEJAM_SIANG_CUTI_UMUM"){
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sejam_siang_cuti_umum').val());
            } else if(jenis_kadar == "$SEHARI_SIANG_CUTI_UMUM"){
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sehari_siang_cuti_umum').val());
            } else if(jenis_kadar == "$SEJAM_MALAM_CUTI_UMUM"){
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sejam_malam_cuti_umum').val());
            } else if(jenis_kadar == "$SEHARI_MALAM_CUTI_UMUM"){
                kadar = parseFloat($('#tempahankemudahansubmsn-kadar_sewaan_sehari_malam_cuti_umum').val());
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
                
                
                
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);
     
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
                    $.pjax.defaults.timeout = 106000;
                    $.pjax.reload({container:'#tempahanKemudahanSubMsnGrid'});
                }
          }
     });
     return false;
});

JS;
        
$this->registerJs($script);

$session->close();
?>
