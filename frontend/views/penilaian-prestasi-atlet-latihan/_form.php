<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;

// table reference
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefNegeri;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtletLatihan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-prestasi-atlet-latihan-form">
    
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
                'tarikh_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'options' => ['id'=>'tarikhDiberiId',],
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
                        'type'=>DateControl::FORMAT_DATETIME,
                        'options' => ['id'=>'tarikhDipulangId',],
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tempoh' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30,'id'=>'tempohId','disabled'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'keterangan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6]],
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
        
$(document).ready(function(){
});
        
$("#tarikhDiberiId").change(function(){
    setDuration();
});
        
$("#tarikhDipulangId").change(function(){
    setDuration();
});
        
function setDuration(){
    var fromDatetime = $("#tarikhDiberiId").val();
    var toDatetime = $("#tarikhDipulangId").val();
        
    var fromDatetimeMoment = moment(fromDatetime,'YYYY-MM-DD HH:mm:ss');
    var toDatetimeMoment = moment(toDatetime,'YYYY-MM-DD HH:mm:ss');
        
    if(fromDatetime != "" && toDatetime != ""){
        $("#tempohId").val(getDurationBetweenDatetime(fromDatetimeMoment,toDatetimeMoment));
    }
}
        
// enable all the disabled field before submit
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>
