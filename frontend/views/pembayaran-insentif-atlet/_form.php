<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\web\Session;
use yii\helpers\Url;
use kartik\widgets\DepDrop;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\Atlet;
use app\models\RefAcara;
use app\models\RefSukan;
use app\models\PengurusanInsentifTetapanShakamShakar;
use app\models\RefPembayaranKepada;
use app\models\RefAcaraInsentif;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifAtlet */
/* @var $form yii\widgets\ActiveForm */


    // Session
    $session = new Session;
    $session->open();
    
    if(isset($session['pembayaran_insentif_sukan_id']) && $session['pembayaran_insentif_sukan_id']){
        $acara_list = RefAcara::find()->where(['=', 'aktif', 1])->andWhere(['=', 'ref_sukan_id', $session['pembayaran_insentif_sukan_id']])->all();
    } else {
        $acara_list = RefAcara::find()->where(['=', 'aktif', 1])->all();
    }
        
    $session->close();
?>

<div class="pembayaran-insentif-atlet-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
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
                        'data'=>ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'kelayakan_pingat' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-acara-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefAcaraInsentif::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::acara],
                                'pluginOptions'=>['allowClear'=>true]],
                            'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'atlet' => [
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
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'sukan')],
                            'placeholder' => Placeholder::atlet,
                            'url'=>Url::to(['/atlet/sub-atlets-sukan'])],
                        ],
                    'columnOptions'=>['colspan'=>6]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'acara' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-acara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefAcara::find()->where(['=', 'aktif', 1])->all(),'id', 'disciplineAcara'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'pingat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanInsentifTetapanShakamShakar::find()->groupBy('pingat')->all(),'pingat', 'refPingatInsentif.desc'),
                        'options' => ['placeholder' => Placeholder::pingat],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'negara' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>3],'hint'=>'cth: 3 negara'],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nilai' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'rekod_baru' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'insentif_khas' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pembayaran_kepada' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-pembayaran-kepada/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPembayaranKepada::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::pembayaranKepada],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'negara' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>3],'hint'=>'cth: 3 negara'],
                'nilai' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],*/
    ]
]);
    ?>

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
$JENIS_INSENTIF = "";
$KEJOHANAN = "";
$PERINGKAT = "";
$KELAS = "";
$URL = Url::to(['/pengurusan-insentif-tetapan-shakam-shakar/get-jumlah']);
$NEW_RECORD = $model->isNewRecord;

$ACARA_INDIVIDU = RefAcaraInsentif::INDIVIDU;
$ACARA_BERPASUKAN_KURANG_5_ORANG = RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG;
$ACARA_BERPASUKAN_LEBIH_5_ORANG = RefAcaraInsentif::BERPASUKAN_LEBIH_5_ORANG;

if(isset($session['pembayaran_insentif_jenis_insentif_id']) && $session['pembayaran_insentif_jenis_insentif_id']){
    $JENIS_INSENTIF = $session['pembayaran_insentif_jenis_insentif_id'];
}

if(isset($session['pembayaran_insentif_kejohanan_id']) && $session['pembayaran_insentif_kejohanan_id']){
    $KEJOHANAN = $session['pembayaran_insentif_kejohanan_id'];
}

if(isset($session['pembayaran_insentif_peringkat_id']) && $session['pembayaran_insentif_peringkat_id']){
    $PERINGKAT = $session['pembayaran_insentif_peringkat_id'];
}

if(isset($session['pembayaran_insentif_kelas_id']) && $session['pembayaran_insentif_kelas_id']){
    $KELAS = $session['pembayaran_insentif_kelas_id'];
}

$script = <<< JS
        
var nilai_individu = 0;
var nilai_berpasukan_kurang_5_orang = 0;
var nilai_berpasukan_lebih_5_orang = 0;
var nilai_insentif = 0;
var bil_penyertaan = 0;
var peratus_sikap = 0;
var peratus_sgar = 0;
var is_new_record = '$NEW_RECORD';
        
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
                    $('#modalContent').html(response.replace("0:", ""));
                } else {
                    $(document).find('#modal').modal('hide');
                    form.trigger("reset");
                    $.pjax.defaults.timeout = 100000;
                    $.pjax.reload({container:'#pembayaranInsentifAtletGrid'});
                }
          }
     });
     return false;
});
     
function getJumlah(){
    if($('#pembayaraninsentifatlet-pingat').val() !== ''){
        
        $.get('$URL',{
            jenis_insentif:"$JENIS_INSENTIF", 
            kejohanan:"$KEJOHANAN",
            pingat:$('#pembayaraninsentifatlet-pingat').val(),
            peringkat:"$PERINGKAT",
            kelas:"$KELAS",
            },
            function(data){
            clearForm();

            var data = $.parseJSON(data);

            if(data !== null){
                // SIKAP & SGAR value
                if(data.refPengurusanInsentifTetapan !== null){
                    peratus_sikap = data.refPengurusanInsentifTetapan.sikap;
                    peratus_sgar = data.refPengurusanInsentifTetapan.sgar;
                }
        
                nilai_individu = data.nilai_individu;
                nilai_berpasukan_kurang_5_orang = data.nilai_berpasukan_kurang_5;
                nilai_berpasukan_lebih_5_orang = data.nilai_berpasukan_lebih_5;
        
                /*if($('#pembayaraninsentif-acara').val() !== ''){
                    changeAcara();
                }*/
                $('#pembayaraninsentifatlet-rekod_baru').attr('value',data.rekod_baharu);
        
                if($('#pembayaraninsentifatlet-kelayakan_pingat').val() == $ACARA_INDIVIDU){
                    nilai_insentif = nilai_individu;
                } else if($('#pembayaraninsentifatlet-kelayakan_pingat').val() == $ACARA_BERPASUKAN_KURANG_5_ORANG){
                    nilai_insentif = nilai_berpasukan_kurang_5_orang;
                } else if($('#pembayaraninsentifatlet-kelayakan_pingat').val() == $ACARA_BERPASUKAN_LEBIH_5_ORANG){
                    nilai_insentif = nilai_berpasukan_lebih_5_orang;
                }
        
                bil_penyertaan = $('#pembayaraninsentifatlet-negara').val();
        
                if(bil_penyertaan < 8){ // less than bilangan 8 negara then got proportion only
                    nilai_insentif = (bil_penyertaan/8) * nilai_insentif;
                }
        
                $('#pembayaraninsentifatlet-nilai').attr('value',nilai_insentif);
            }
        });
    }
}
        
function clearForm(){
    $('#pembayaraninsentifatlet-nilai').attr('value','');
    $('#pembayaraninsentifatlet-rekod_baru').attr('value','');
}
        
$('#pembayaraninsentifatlet-pingat').change(function(){
    //if(is_new_record == '1'){
        getJumlah();
    //}
});
        
$('#pembayaraninsentifatlet-kelayakan_pingat').change(function(){
    //if(is_new_record == '1'){
        getJumlah();
    //}
});
        
$("#pembayaraninsentifatlet-negara").keyup(function(){
    //if(is_new_record == '1'){
        getJumlah();
    //}
});

JS;
        
$this->registerJs($script);


$session->close();
?>
