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
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\AtletSukan;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanAtlet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khidmat-perubatan-dan-sains-sukan-atlet-form">

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
                        'program' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-program-semasa-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::program],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
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
                                'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::sukan],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
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
                                'data'=>ArrayHelper::map(AtletSukan::find()->joinWith(['refAtlet'])->asArray()->all(),'atlet_id', 'nameAndIC'),
                                'options'=>['prompt'=>'', 'id' => 'atletId',],
                                'pluginOptions' => [
                                    'depends'=>[Html::getInputId($model, 'sukan')],
                                    'initialize' => true,
                                    'placeholder' => Placeholder::atlet,
                                    'url'=>Url::to(['/atlet-sukan/atlets-by-sukan']),
                                    'params'=>['input-type-1', 'input-type-2']]
                                ],
                            'columnOptions'=>['colspan'=>6]],
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
                    $.pjax.reload({container:'#atletGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
