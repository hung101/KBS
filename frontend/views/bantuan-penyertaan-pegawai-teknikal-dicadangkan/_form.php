<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefTahapAkademikPegawaiTeknikal;
use app\models\MaklumatPegawaiTeknikal;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikalDicadangkan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penyertaan-pegawai-teknikal-dicadangkan-form">

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
                'maklumat_pegawai_teknikal_id' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/maklumat-pegawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(MaklumatPegawaiTeknikal::find()->all(),'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id', 'nama'),
                        'options' => ['placeholder' => Placeholder::pegawaiTeknikal, 'id'=>'pegawaiTeknikalId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'badan_sukan' =>[
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
                        'options' => ['placeholder' => Placeholder::persatuan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
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
                
            ],
        ],
    ]
]);
    ?>
    
    <pre style="text-align: center"><strong>MAKLUMAT DIRI</strong></pre>
    
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
                'nama' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>80]],
            ]
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
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
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
                'no_kad_pengenalan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'umur' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_passport' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'jantina' =>[
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
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'alamat_e_mail' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tahap_akademik' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-tahap-akademik-pegawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTahapAkademikPegawaiTeknikal::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tahapAkademik],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
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
                'tahap_kelayakan_sukan_peringkat_kebangsaan' =>  ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tahap_kelayakan_sukan_peringkat_antarabangsa' =>  ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
        ],
    ]
]);
    ?>
    <br>
    <br>
    <pre style="text-align: center"><strong>MAKLUMAT MAJIKAN</strong></pre>
    
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
                'nama_majikan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'no_telefon_majikan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'no_faks' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jawatan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'gred' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
            ],
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>MAKLUMAT KEJOHANAN / KURSUS</strong></pre>
    
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
                'nama_kejohanan_kursus' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'tarikh_mula' =>  [
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
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true],'hint'=>"cth: Burgas, Bulgaria"],
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

    <?php ActiveForm::end(); ?>

</div>

<?php
$URL = Url::to(['/maklumat-pegawai-teknikal/get-pegawai-teknikal']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

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
                    $.pjax.defaults.timeout = 100000;
                    $.pjax.reload({container:'#bantuanPenyertaanPegawaiTeknikalDicadangkanGrid'});
                }
          }
     });
     return false;
});

$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
        
$('#pegawaiTeknikalId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-badan_sukan').val(data.badan_sukan).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-sukan').val(data.sukan).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-nama').attr('value',data.nama);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_1').attr('value',data.alamat_1);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_2').attr('value',data.alamat_2);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_3').attr('value',data.alamat_3);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_negeri').val(data.alamat_negeri).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_bandar').val(data.alamat_bandar).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_poskod').attr('value',data.alamat_poskod);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_kad_pengenalan').attr('value',data.no_kad_pengenalan);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-umur').attr('value',data.umur);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_passport').attr('value',data.no_passport);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-jantina').val(data.jantina).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_telefon').attr('value',data.no_telefon);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_e_mail').attr('value',data.alamat_e_mail);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tahap_akademik').val(data.tahap_akademik).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-nama_majikan').attr('value',data.nama_majikan);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_telefon_majikan').attr('value',data.no_telefon_majikan);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_faks').attr('value',data.no_faks);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-jawatan').attr('value',data.jawatan);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-gred').attr('value',data.gred);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-nama_kejohanan_kursus').attr('value',data.nama_kejohanan_kursus);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_mula-disp').attr('value',data.tarikh_mula);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_mula').attr('value',data.tarikh_mula);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_tamat-disp').attr('value',data.tarikh_tamat);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_tamat').attr('value',data.tarikh_tamat);
            $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tempat').attr('value',data.tempat);
        }
    });
});
     
function clearForm(){
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-badan_sukan').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-sukan').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-nama').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_1').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_2').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_3').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_negeri').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_bandar').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_poskod').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_kad_pengenalan').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-umur').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_passport').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-jantina').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_telefon').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-alamat_e_mail').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tahap_akademik').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-nama_majikan').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_telefon_majikan').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-no_faks').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-jawatan').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-gred').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-nama_kejohanan_kursus').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_mula-disp').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_mula').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_tamat-disp').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tarikh_tamat').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikaldicadangkan-tempat').attr('value','');
            
}
     

JS;
        
$this->registerJs($script);
?>
