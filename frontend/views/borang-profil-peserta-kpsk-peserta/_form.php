<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use yii\web\Session;

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJantina;
use app\models\RefKeputusanKpsk;
use app\models\RefAkademikKpsk;
use app\models\RefBangsa;
use app\models\RefAgama;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

$penilaian =  ['objektif' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>2]],
                'esei' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>2]],
				'laporan_projek' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>2]],
				'penilaian_refleksi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>2]],
                'jumlah' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>3, 'disabled'=>true]]];
// Session
$session = new Session;
$session->open();

if(isset($session['borang_profil_peserta_kpsk_tahap_id']) && $session['borang_profil_peserta_kpsk_tahap_id'] === '1'){
	$penilaian = ['objektif' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>2]],
                'esei' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>2]],
				'penilaian_refleksi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>2]],
                'jumlah' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>3, 'disabled'=>true]]];
}
$session->close();
/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpskPeserta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-profil-peserta-kpsk-peserta-form">

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
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12, 'id'=>'NoICID']],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_lahir' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options' => ['id'=>'TarikhLahirID', 'disabled'=>true],
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'umur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>3, 'disabled'=>true, 'id'=>'UmurID']],
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
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
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
                'agama' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agama/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAgama::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agama],
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
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
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
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_telefon_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
                'facebook' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'akademik' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-akademik-kpsk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAkademikKpsk::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::akademik],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'pekerjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                'nama_majikan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kehadiran' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],'options'=>['inline'=>true],		'columnOptions'=>['colspan'=>6]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::pembahagian_markah_cap; ?></strong></pre>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => $penilaian
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
				'gred' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                'keputusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-keputusan-kpsk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKeputusanKpsk::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::keputusan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>30]],
            ]
        ],
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

$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var \$form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);

     $.post(
        \$form.attr("action"), //serialize Yii2 form
        \$form.serialize()
    )
    .done( function(result) {
            if(result != 1){
                $('#modalContent').html(result);
            } else {
                $(document).find('#modal').modal('hide');
                $(\$form).trigger("reset");
                $.pjax.defaults.timeout = 100000;
                $.pjax.reload({container:'#borangProfilPesertaKpskPesertaGrid'});
            }
        }).fail(function()
        {
            console.log("server error");
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
    
        
    $("#TarikhLahirID-disp").val(formatSaveDate(DOBVal));
    $("#TarikhLahirID").val(formatSaveDate(DOBVal));
        
       /* $('#TarikhLahirID').kvDatepicker({
                format: 'mm/dd/yyyy',
                startDate: '-3d'
            });*/
        
    $("#UmurID").val(calculateAge(formatSaveDate(DOBVal)));
        
        
    $("#TarikhLahirID").kvDatepicker("$DateDisplayFormat", new Date(DOBVal)).kvDatepicker({
        format: "$DateDisplayFormat"
    });
});
        
$('#TarikhLahirID').change(function(){
    $("#UmurID").val(calculateAge(this.value));
});
            
$('#borangprofilpesertakpskpeserta-objektif').on("keyup", function(){calculateJumlahMarkah();});
$('#borangprofilpesertakpskpeserta-laporan_projek').on("keyup", function(){calculateJumlahMarkah();});
$('#borangprofilpesertakpskpeserta-penilaian_refleksi').on("keyup", function(){calculateJumlahMarkah();});
$('#borangprofilpesertakpskpeserta-esei').on("keyup", function(){calculateJumlahMarkah();});
        
function calculateJumlahMarkah(){
    var objektif = 0;
    var laporan_projek = 0;
    var esei = 0;
	var penilaian_refleksi = 0;
    var jumlah_markah = 0;
        
    if($('#borangprofilpesertakpskpeserta-objektif').val() > 0){objektif = parseInt($('#borangprofilpesertakpskpeserta-objektif').val());}
    if($('#borangprofilpesertakpskpeserta-laporan_projek').val() > 0){laporan_projek = parseInt($('#borangprofilpesertakpskpeserta-laporan_projek').val());}
    if($('#borangprofilpesertakpskpeserta-esei').val() > 0){esei = parseInt($('#borangprofilpesertakpskpeserta-esei').val());}
    if($('#borangprofilpesertakpskpeserta-penilaian_refleksi').val() > 0){penilaian_refleksi = parseInt($('#borangprofilpesertakpskpeserta-penilaian_refleksi').val());}
        
    if(objektif > 0 || laporan_projek >0 || esei >0 || penilaian_refleksi > 0){
        // Total Yuran
        jumlah_markah = objektif + laporan_projek + esei + penilaian_refleksi;
		if(jumlah_markah > 100){
			alert('Jumlah markah tidak boleh lebih daripada 100');
		}
        //display at fields accordingly
        $('#borangprofilpesertakpskpeserta-jumlah').val(jumlah_markah);
    }
}

JS;
        
$this->registerJs($script);
?>
