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
use app\models\RefElemenBantuanPenganjuranKejohanan;
use app\models\RefSubElemenBantuanPenganjuranKejohanan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananElemen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penyertaan-pegawai-teknikal-elemen-form">

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
                'elemen_bantuan' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-elemen-bantuan-penganjuran-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefElemenBantuanPenganjuranKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::elemen],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'sub_elemen' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-sub-elemen-bantuan-penganjuran-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefSubElemenBantuanPenganjuranKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'elemen_bantuan')],
                            'placeholder' => Placeholder::subElemen,
                            'url'=>Url::to(['/ref-sub-elemen-bantuan-penganjuran-kejohanan/sub-elemens'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                
            ],
        ],
        
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kadar' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'bilangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                'hari' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                'jumlah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
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
                    $.pjax.reload({container:'#bantuanPenyertaanPegawaiTeknikalElemenGrid'});
                }
          }
     });
     return false;
});

$('#bantuanpenyertaanpegawaiteknikalelemen-kadar').on("keyup", function(){calculateJumlah();});
$('#bantuanpenyertaanpegawaiteknikalelemen-bilangan').on("keyup", function(){calculateJumlah();});
$('#bantuanpenyertaanpegawaiteknikalelemen-hari').on("keyup", function(){calculateJumlah();});
        
function calculateJumlah(){
    var kadar = 0;
    var bilangan = 0;
    var hari = 0;
    var jumlah = 0;
        
    if($('#bantuanpenyertaanpegawaiteknikalelemen-kadar').val() > 0){kadar = parseFloat($('#bantuanpenyertaanpegawaiteknikalelemen-kadar').val());}
    if($('#bantuanpenyertaanpegawaiteknikalelemen-bilangan').val() > 0){bilangan = parseInt($('#bantuanpenyertaanpegawaiteknikalelemen-bilangan').val());}
    if($('#bantuanpenyertaanpegawaiteknikalelemen-hari').val() > 0){hari = parseInt($('#bantuanpenyertaanpegawaiteknikalelemen-hari').val());}
    
    // Jumlah formula
    jumlah = kadar * bilangan * hari;
        
    //display at fields accordingly
    $('#bantuanpenyertaanpegawaiteknikalelemen-jumlah').val(jumlah);
}  
     

JS;
        
$this->registerJs($script);
?>
