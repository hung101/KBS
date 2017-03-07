<?php

use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranElaunTransaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-kemudahan-ticket-kapal-terbang-pegawai-form">

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
                        'tarikh_pembayaran' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>4]],
                        'jumlah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['maxlength'=>true,'colspan'=>4]],
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
                    $.pjax.defaults.timeout = 106000;
                    $.pjax.reload({container:'#pembayaranElaunTransaksiGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>



