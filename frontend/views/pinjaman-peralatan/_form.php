<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

// table reference
use app\models\Atlet;
use app\models\RefPeralatanPinjaman;
use app\models\RefSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PinjamanPeralatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pinjaman-peralatan-form">

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
                 'nama_pegawai' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                /*'atlet_id' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::atlet],],
                    'columnOptions'=>['colspan'=>4]],*/
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
                    'columnOptions'=>['colspan'=>4]],
                'nama_peralatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peralatan-pinjaman/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeralatanPinjaman::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peralatan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kuantiti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>11]],
                'tarikh_diberi' => [
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
                'tarikh_dipulang' => [
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
                'tempoh_pinjaman' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>50,'id'=>'tempohPinjamanId','disabled'=>true]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
				'tarikh_pulang_sebenar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
						'options' => ['id'=>'tarikhPulangSebenarId',],
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
				'tempoh_lewat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>50,'id'=>'tempohLewatId','disabled'=>true]],
                'pulang' => [
                            'type'=>Form::INPUT_RADIO_LIST, 
                            'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                            'value'=>false,
                            'options'=>['inline'=>true],
                            'columnOptions'=>['colspan'=>12]],
                
            ],
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'nama_peralatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kuantiti')->textInput() ?>

    <?= $form->field($model, 'tarikh_diberi')->textInput() ?>

    <?= $form->field($model, 'tarikh_dipulang')->textInput() ?>

    <?= $form->field($model, 'tempoh_pinjaman')->textInput(['maxlength' => 50]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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

$("#tarikhPulangSebenarId").change(function(){
    setTempohLambat();
});

        
$("#tarikhDipulangId").change(function(){
    setDuration();
});

function setTempohLambat(){
	$("#tempohLewatId").val('');
	if($("#tarikhDipulangId").val() != '' && $("#tarikhPulangSebenarId").val() != ''){
		var fromDatetime = $("#tarikhPulangSebenarId").val();
		var toDatetime = $("#tarikhDipulangId").val();
			
		var fromDatetimeMoment = moment(fromDatetime,'YYYY-MM-DD');
		var toDatetimeMoment = moment(toDatetime,'YYYY-MM-DD');

		if(fromDatetime != "" && toDatetime != ""){
			if(fromDatetimeMoment.isAfter(toDatetimeMoment)){
				//if(fromDatetimeMoment.diff(toDatetime, "days") > 0){
					$("#tempohLewatId").val(fromDatetimeMoment.diff(toDatetime, "days")+1);
				//}
			}
		}
	}
}
        
function setDuration(){
    var fromDatetime = $("#tarikhDiberiId").val();
    var toDatetime = $("#tarikhDipulangId").val();
        
    var fromDatetimeMoment = moment(fromDatetime,'YYYY-MM-DD HH:mm:ss');
    var toDatetimeMoment = moment(toDatetime,'YYYY-MM-DD HH:mm:ss');
        
    if(fromDatetime != "" && toDatetime != ""){
        $("#tempohPinjamanId").val(getDurationBetweenDatetime(fromDatetimeMoment,toDatetimeMoment));
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
