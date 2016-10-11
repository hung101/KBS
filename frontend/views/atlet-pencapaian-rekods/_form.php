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
use app\models\RefJenisRekod;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianRekods */
/* @var $form yii\widgets\ActiveForm */

//filter by Sukan from parent form
$session = new Session;
$session->open();

$jenis_rekod_list = null;

if(isset($session['atlet-pencapaian_sukan_id']) && $session['atlet-pencapaian_sukan_id']){
    $jenis_rekod_list = RefJenisRekod::find()->where(['=', 'aktif', 1])->andWhere(['=', 'ref_sukan_id', $session['atlet-pencapaian_sukan_id']])->all();
} else {
    $jenis_rekod_list = RefJenisRekod::find()->where(['=', 'aktif', 1])->all();
}

$session->close();
?>

<div class="atlet-pencapaian-rekods-form">

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
                'tarikh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                //'peringkat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>100]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'opponent' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
                
                'venue' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_rekod' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-rekod/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($jenis_rekod_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisRekod],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'result' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ],
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'pencapaian_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'peringkat')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'opponent')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'venue')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'personal_best')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'season_best')->textInput(['maxlength' => 100]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
                var resArr = response.split("/pipe?");
               
                if(resArr[0] != 1){
                    $('#modalContent').html(resArr[1]);
                } else {
                    $(document).find('#modal').modal('hide');
                    form.trigger("reset");
                    //$.pjax.defaults.timeout = 100000;
                    //$.pjax.reload({container:'#keputusanGrid'});
                    $('#keputusanGrid').html(resArr[1]);
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
