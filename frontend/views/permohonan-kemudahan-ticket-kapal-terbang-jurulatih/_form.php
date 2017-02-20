<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

// table reference
use app\models\Jurulatih;

use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbangJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-kemudahan-ticket-kapal-terbang-jurulatih-form">

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
                'jurulatih' => [
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
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'passport_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['maxlength'=>100,'colspan'=>4]],
                'ic_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['maxlength'=>100,'colspan'=>4]],
                'hp_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['maxlength'=>20,'colspan'=>4]],
            ],
        ],
    ]
]);
    ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::pergi?></strong>
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
                            'tarikh_pergi' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> DateControl::classname(),
                                'ajaxConversion'=>false,
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                'columnOptions'=>['colspan'=>3]],
                            'flight_no_pergi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            'masa_pergi' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> TimePicker::classname(),
                                'ajaxConversion'=>false,
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                'columnOptions'=>['colspan'=>3]],
                            'destinasi_pergi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                        ]
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::balik?></strong>
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
                            'tarikh_balik' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> DateControl::classname(),
                                'ajaxConversion'=>false,
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                'columnOptions'=>['colspan'=>3]],
                            'flight_no_balik' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                            'masa_balik' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=> TimePicker::classname(),
                                'ajaxConversion'=>false,
                                'options'=>[
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                    ]
                                ],
                                'columnOptions'=>['colspan'=>3]],
                            'destinasi_balik' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>90],'columnOptions'=>['colspan'=>3]],
                        ]
                    ],
                ]
            ]);
            ?>
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
                        'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['maxlength'=>255,'colspan'=>4]],
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
$URLJurulatih = Url::to(['/permohonan-kemudahan-ticket-kapal-terbang-jurulatih/get-jurulatih']);

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
                    $.pjax.defaults.timeout = 106000;
                    $.pjax.reload({container:'#permohonanKemudahanTicketKapalTerbangJurulatihGrid'});
                }
          }
     });
     return false;
});

$('#jurulatihId').change(function(){
    $.get('$URLJurulatih',{jurulatih_id:$(this).val()},function(data){
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $("#permohonankemudahanticketkapalterbangjurulatih-passport_no").attr('value',data.passport_no);
            $("#permohonankemudahanticketkapalterbangjurulatih-ic_no").attr('value',data.ic_no);
            $("#permohonankemudahanticketkapalterbangjurulatih-hp_no").attr('value',data.no_telefon_bimbit);
        }
    });
});
    
JS;
        
$this->registerJs($script);
?>
