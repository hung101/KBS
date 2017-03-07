<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\web\Session;

// table reference
use app\models\RefAcara;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihSukanAcara */
/* @var $form yii\widgets\ActiveForm */


//filter by Sukan from parent form
$session = new Session;
$session->open();

$acara_list = null;

if(isset($session['jurulatih-sukan_sukan_id']) && $session['jurulatih-sukan_sukan_id']){
    $acara_list = RefAcara::find()->where(['=', 'aktif', 1])->andWhere(['=', 'ref_sukan_id', $session['jurulatih-sukan_sukan_id']])->all();
} else {
    $acara_list = RefAcara::find()->where(['=', 'aktif', 1])->all();
}

$session->close();
?>

<div class="jurulatih-sukan-acara-form">

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
                'acara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-acara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($acara_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::acara],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
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
$modelTitleID = GeneralVariable::jurulatihSukanTabModalTitle;
$modelID = GeneralVariable::jurulatihSukanTabModal;
$modelContentID = GeneralVariable::jurulatihSukanTabModalContent;
    
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
                var resArr = response.split("/pipe?");
               
                if(resArr[0] != 1){
                    $('#$modelContentID').html(resArr[1]);
                } else {
                    $(document).find('#$modelID').modal('hide');
                    form.trigger("reset");
                    //$.pjax.defaults.timeout = 100000;
                    //$.pjax.reload({container:'#acaraGrid'});
                    $('#acaraGrid').html(resArr[1]);
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>

