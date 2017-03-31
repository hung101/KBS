<?php
use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\web\Session;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikSubjek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-akademik-subjek-form">
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
						'kod_subjek' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
						'subjek' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>7],'options'=>['maxlength'=>true]],
						'bil_kredit' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
						'nama_pensyarah' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
						'no_telefon' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
						'email' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>7],'options'=>['maxlength'=>true]],
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
                    $.pjax.reload({container:'#maklumatAkademikSubjekGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>