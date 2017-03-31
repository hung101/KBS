<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use yii\web\Session;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

use app\models\RefHari;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikJadual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-akademik-jadual-form">
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
						/* 'tarikh' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> DateControl::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>4]], */
						'hari' => [
								'type'=>Form::INPUT_WIDGET, 
								'widgetClass'=>'\kartik\widgets\Select2',
								'options'=>[
									'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
									[
										'append' => [
											'content' => Html::a(Html::icon('edit'), ['/ref-hari/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
											'asButton' => true
										]
									] : null,
									'data'=>ArrayHelper::map(RefHari::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
									'options' => ['placeholder' => Placeholder::hari],
			'pluginOptions' => [
										'allowClear' => true
									],],
								'columnOptions'=>['colspan'=>4]],
						'masa_dari' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> TimePicker::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
						'masa_hingga' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> TimePicker::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
						'perkara' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
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
                    $.pjax.reload({container:'#maklumatAkademikJadualGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
