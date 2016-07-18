<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\DepDrop;

// table reference
use app\models\LtbsAhliJawatankuasaKecil;
use app\models\LtbsAhliJawatankuasaIndukKecil;
use app\models\ProfilBadanSukan;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgramPeserta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="latihan-dan-program-peserta-form">

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
                        'nama_badan_sukan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/profil-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                                'options' => ['placeholder' => Placeholder::badanSukan],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>4]],
                        'no_pendaftaran_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>30]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'jenis_jawatankuasa' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/profil-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>['1'=>'Induk','2'=>'Kecil / Biro'],
                                'options' => ['placeholder' => Placeholder::jenis],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>4]],
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
                        /*'ahli_jawatan_induk_id' => [
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
                                'data'=>ArrayHelper::map(LtbsAhliJawatankuasaIndukKecil::find()->all(),'ahli_jawatan_id', 'nama_penuh'),
                                'options' => ['placeholder' => Placeholder::ahliJawatankuasaInduk, 'id'=>'ahliJawatanInduk'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>4]],*/
                        'ahli_jawatan_induk_id' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\DepDrop', 
                            'options'=>[
                                'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ltbs-ahli-jawatankuasa-induk-kecil/get-ahli-jawatankuasa-induk-by-badansukan'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                                'data'=>ArrayHelper::map(LtbsAhliJawatankuasaIndukKecil::find()->all(),'ahli_jawatan_id', 'nama_penuh'),
                                'options'=>['prompt'=>'', 'id'=>'ahliJawatanInduk'],
                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                'pluginOptions' => [
                                    'depends'=>[Html::getInputId($model, 'nama_badan_sukan')],
                                    'placeholder' => Placeholder::ahliJawatankuasaInduk,
                                    'url'=>Url::to(['/ltbs-ahli-jawatankuasa-induk-kecil/get-ahli-jawatankuasa-induk-by-badansukan'])],
                                ],
                            'columnOptions'=>['colspan'=>4]],
                        /*'ahli_jawatan_kecil_id' => [
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
                                'data'=>ArrayHelper::map(LtbsAhliJawatankuasaKecil::find()->all(),'ahli_jawatan_id', 'nama_penuh'),
                                'options' => ['placeholder' => Placeholder::ahliJawatankuasaKecilBiro, 'id'=>'ahliJawatanKecilBiro'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>4]],*/
                        'ahli_jawatan_kecil_id' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\DepDrop', 
                            'options'=>[
                                'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ltbs-ahli-jawatankuasa-kecil/get-ahli-jawatankuasa-kecil-by-badansukan'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                                'data'=>ArrayHelper::map(LtbsAhliJawatankuasaKecil::find()->all(),'ahli_jawatan_id', 'nama_penuh'),
                                'options'=>['prompt'=>'', 'id'=>'ahliJawatanKecilBiro'],
                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                'pluginOptions' => [
                                    'depends'=>[Html::getInputId($model, 'nama_badan_sukan')],
                                    'placeholder' => Placeholder::ahliJawatankuasaKecilBiro,
                                    'url'=>Url::to(['/ltbs-ahli-jawatankuasa-kecil/get-ahli-jawatankuasa-kecil-by-badansukan'])],
                                ],
                            'columnOptions'=>['colspan'=>4]],
                    ],
                ],
            ]
        ]);
    
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_badan_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'no_pendaftaran_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'tempoh_memegang_jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_tel_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
            ]
        ],
    ]
]);
    ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$URLBadanSukan = Url::to(['/profil-badan-sukan/get-badan-sukan']);
$URLInduk = Url::to(['/ltbs-ahli-jawatankuasa-induk-kecil/get-ahli-jawatankuasa-induk']);
$URLKecil = Url::to(['/ltbs-ahli-jawatankuasa-kecil/get-ahli-jawatankuasa-kecil']);

$script = <<< JS
        
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
                    $.pjax.defaults.timeout = 6000;
                    $.pjax.reload({container:'#pesertaGrid'});
                }
          }
     });
     return false;
});

$('#ahliJawatanInduk').change(function(){
    
    $.get('$URLInduk',{id:$(this).val()},function(data){
        clearForm();
        //$('#ahliJawatanKecilBiro').select2("val", "");
        $('#ahliJawatanKecilBiro').attr('value','');
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#latihandanprogrampeserta-nama').attr('value',data.nama_penuh);
            $('#latihandanprogrampeserta-no_kad_pengenalan').attr('value',data.no_kad_pengenalan);
            $('#latihandanprogrampeserta-tempoh_memegang_jawatan').attr('value',data.tarikh_mula_memegang_jawatan);
            $('#latihandanprogrampeserta-no_tel_bimbit').attr('value',data.no_tel);
            $('#latihandanprogrampeserta-emel').attr('value',data.emel);
        
        
            if(data.badanSukan !== null){ 
                $('#latihandanprogrampeserta-nama_badan_sukan').attr('value',data.badanSukan.profil_badan_sukan);
                $('#latihandanprogrampeserta-no_pendaftaran_sukan').attr('value',data.badanSukan.no_pendaftaran);
            }

            if(data.refJawatanInduk !== null) 
                $('#latihandanprogrampeserta-jawatan').attr('value',data.refJawatanInduk.desc);

            }
        });
});
        
$('#ahliJawatanKecilBiro').change(function(){
    
    $.get('$URLKecil',{id:$(this).val()},function(data){
        clearForm();
        //$('#ahliJawatanInduk').select2("val", "");
        $('#ahliJawatanInduk').attr('value','');
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#latihandanprogrampeserta-nama').attr('value',data.nama_penuh);
            $('#latihandanprogrampeserta-no_kad_pengenalan').attr('value',data.no_kad_pengenalan);
            $('#latihandanprogrampeserta-tempoh_memegang_jawatan').attr('value',data.tarikh_mula_memegang_jawatan);
            $('#latihandanprogrampeserta-no_tel_bimbit').attr('value',data.no_tel);
            $('#latihandanprogrampeserta-emel').attr('value',data.emel);
        
        
            if(data.badanSukan !== null){ 
                $('#latihandanprogrampeserta-nama_badan_sukan').attr('value',data.badanSukan.profil_badan_sukan);
                $('#latihandanprogrampeserta-no_pendaftaran_sukan').attr('value',data.badanSukan.no_pendaftaran);
            }

            if(data.refJawatan !== null) 
                $('#latihandanprogrampeserta-jawatan').attr('value',data.refJawatan.desc);

            }
        });
});
        
$(document).ready(function(){
    $('.field-latihandanprogrampeserta-ahli_jawatan_induk_id').hide();
        $('.field-latihandanprogrampeserta-ahli_jawatan_kecil_id').hide();
});
        
$('#latihandanprogrampeserta-jenis_jawatankuasa').change(function(){
        if($(this).val() == '1'){
            $('.field-latihandanprogrampeserta-ahli_jawatan_induk_id').show();
            $('.field-latihandanprogrampeserta-ahli_jawatan_kecil_id').hide();
        } else {
            $('.field-latihandanprogrampeserta-ahli_jawatan_induk_id').hide();
            $('.field-latihandanprogrampeserta-ahli_jawatan_kecil_id').show();
        }
});
        
function clearForm(){
    $('#latihandanprogrampeserta-nama').attr('value','');
    $('#latihandanprogrampeserta-no_kad_pengenalan').attr('value','');
    //$('#latihandanprogrampeserta-nama_badan_sukan').attr('value','');
    //$('#latihandanprogrampeserta-no_pendaftaran_sukan').attr('value','');
    $('#latihandanprogrampeserta-jawatan').attr('value','');
    $('#latihandanprogrampeserta-tempoh_memegang_jawatan').attr('value','');
    $('#latihandanprogrampeserta-no_tel_bimbit').attr('value','');
    $('#latihandanprogrampeserta-emel').attr('value','');
}
        
$('#latihandanprogrampeserta-nama_badan_sukan').change(function(){
    
    $.get('$URLBadanSukan',{id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        $('#latihandanprogrampeserta-no_pendaftaran_sukan').attr('value','');
        
        if(data !== null){
            $('#latihandanprogrampeserta-no_pendaftaran_sukan').attr('value',data.no_pendaftaran);
        }
    });
});
     

JS;
        
$this->registerJs($script);
?>
