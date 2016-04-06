<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use yii\helpers\Json;

// table reference
use app\models\Atlet;
use app\models\RefSukan;
use app\models\AtletSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranGym */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pendaftaran-gym-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
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
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],
                /*'atlet_id' => [
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
                        ],
                        'data'=>ArrayHelper::map(AtletSukan::find()->joinWith(['refAtlet'])->asArray()->all(),'atlet_id', 'nameAndIC'),
                        'options'=>['prompt'=>'', 'multiple' => true],
                        'select2Options'=>[
                            'pluginOptions'=>['allowClear'=>true],
                        ],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'sukan')],
                            'initialize' => true,
                            'placeholder' => Placeholder::atlet,
                            'url'=>Url::to(['/atlet-sukan/atlets-by-sukan']),
                            'params'=>['input-type-1', 'input-type-2']]
                        ],
                    'columnOptions'=>['colspan'=>4]],*/
                'tarikh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                                    'todayBtn' => true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        
    ]
]);
       
    // Additional input fields passed as params to the child dropdown's pluginOptions
    echo Html::hiddenInput('atlet_list_param', $model->atlet_id, ['id'=>'atlet_list_param']);
    
    echo $form->field($model, 'atlet_id')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'data'=>ArrayHelper::map(AtletSukan::find()->joinWith(['refAtlet'])->asArray()->all(),'atlet_id', 'nameAndIC'),
        'options'=>['prompt'=>'', 'multiple' => true, 'id'=>'atletListID'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>[Html::getInputId($model, 'sukan')],
            'initialize' => true,
            'placeholder' => Placeholder::atlet,
            'url'=>Url::to(['/atlet-sukan/atlets-by-sukan']),
            'params'=>['atlet_list_param']
        ]
    ]);
    ?>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'sukan')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
if($model->atlet_id){
    $AtletListID = explode(',',$model->atlet_id);
    $AtletListID = Json::encode($AtletListID);
    
    $this->registerJs("
    $('#atletListID').on('depdrop.change', function(event) {
        $('#atletListID').val($AtletListID);
    });
    ");
}
?>
