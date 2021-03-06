<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\web\Session;

use app\models\RefDokumenPengurusanInsurans;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsuranLampiran */
/* @var $form yii\widgets\ActiveForm */
$session = new Session;
$session->open();

if(isset($session['pengurusan-insuran-tuntutan_id']) && $session['pengurusan-insuran-tuntutan_id']){
	if($session['pengurusan-insuran-tuntutan_id'] === '1'){
		$dokumen_list = RefDokumenPengurusanInsurans::find()->where(['parent_id' => 1, 'aktif' => 1])->all();
	} else {
		$dokumen_list = RefDokumenPengurusanInsurans::find()->where(['parent_id' => 2, 'aktif' => 1])->all();
	}
} else {
	$dokumen_list = RefDokumenPengurusanInsurans::find()->where(['aktif' => 1])->all();
}

$session->close();
?>

<div class="pengurusan-insuran-lampiran-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); 
	
	echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
						'nama_dokumen' =>  [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-dokumen-pengurusan-insurans/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map($dokumen_list,'id', 'desc'),
								'options' => ['placeholder' => Placeholder::nama_dokumen],
								'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>4]],
                    ],
                ],
            ]
        ]);
	
	?>

    <?php // Lampiran Upload
    
    $label = $model->getAttributeLabel('lampiran');
    
    if($model->lampiran){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('lampiran') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->lampiran , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'lampiran' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label,'hint'=>'Note: Senarai disemak Laporan Dokumen, Laporan Polis dan Resit.'],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
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
                    $.pjax.reload({container:'#pengurusanInsuranLampiranGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
