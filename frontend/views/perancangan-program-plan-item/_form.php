<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\web\Session;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// table reference
use app\models\RefJenisProgram;
use app\models\RefBahagianProgram;
use app\models\RefCawangan;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefJenisAktiviti;
use app\models\RefStatusProgram;
use app\models\RefSukan;
use app\models\RefKategoriPelan;
use app\models\RefJenisPelan;
use app\models\RefKedudukanKejohanan;
use app\models\RefStatusPermohonanProgramBinaan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAcara */
/* @var $form yii\widgets\ActiveForm */

if($model->bahagian === 1 || $model->bahagian === 'Kejohanan'||
        $model->bahagian === 7 || $model->bahagian === 'Latihan' ||
        $model->bahagian === 8 || $model->bahagian === 'Temasya'){
	echo '<script> var isKejohananFlag = true; </script>';
} else {
	echo '<script> var isKejohananFlag = false; </script>';
}

if($model->bahagian === 1 || $model->bahagian === 'Kejohanan'||
        $model->bahagian === 6 || $model->bahagian === 'Management' ||
        $model->bahagian === 7 || $model->bahagian === 'Latihan' ||
        $model->bahagian === 8 || $model->bahagian === 'Temasya' ){
	echo '<script> var isCampFlag = true; </script>';
} else {
	echo '<script> var isCampFlag = false; </script>';
}

?>

<div class="penyertaan-sukan-acara-form">

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
						 'bahagian' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-kategori-pelan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefKategoriPelan::find()->where(['=', 'aktif', 1])->orderBy('sort')->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::kategori, 'id' => 'kategoriID'],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>4]],
                                            'jenis_aktiviti' => [
                                                    'type'=>Form::INPUT_WIDGET, 
                                                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                                                    'options'=>[
                                                            'type'=>DepDrop::TYPE_SELECT2,
                                                            'select2Options'=> [
                                                                    'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                                                    [
                                                                            'append' => [
                                                                                    'content' => Html::a(Html::icon('edit'), ['/ref-jenis-pelan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                                                    'asButton' => true
                                                                            ]
                                                                    ] : null,
                                                                    'pluginOptions'=>['allowClear'=>true]
                                                            ],
                                                            'data'=>ArrayHelper::map(RefJenisPelan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                                            'options'=>['prompt'=>'',],
                                                            'pluginOptions' => [
                                                                    'initialize' => true,
                                                                    'depends'=>['kategoriID'],
                                                                    'placeholder' => Placeholder::jenis,
                                                                    'url'=>Url::to(['/ref-jenis-pelan/subjenis'])],
                                                            ],
                                                    'columnOptions'=>['colspan'=>4]],
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'nama_program' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
/* 						'status_program' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-kedudukan-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefKedudukanKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => '-- Pilih Rating -- '],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>3]], */
					],
				],
/* 				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'tarikh_mula' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> DateControl::classname(),
							'ajaxConversion'=>false,
							'options'=>[
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
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
						 
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
					   'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
					   'anggaran_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
						'perbelanjaan_diluluskan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
					   'bilangan_jkk_jkp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
						'tarikh_jkk_jkp' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> DateControl::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
						'status_permohonan' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefStatusPermohonanProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::statusPermohonan],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>4]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
					   'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
					]
				], */
			]
		]);
    ?>
	<div class="isKejohanan">	
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
						'status_program' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-kedudukan-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefKedudukanKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => '-- Pilih Rating -- '],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>3]],
					],
				],
			]
		]);
        ?>
	</div>
	
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
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
						 
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
					   'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
					]
				],
			]
		]);
    ?>
    
    <div class="isCamp">	
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
                       'jumlah_atlet' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                       'jumlah_jurulatih' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                        'jumlah_pegawai' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                    ]
                ],
            ]
        ]);
    ?>
	</div>
	
	<div class="isKejohanan">	
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
					   'anggaran_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
						'perbelanjaan_diluluskan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
					   'bilangan_jkk_jkp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
						'tarikh_jkk_jkp' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> DateControl::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
						'status_permohonan' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefStatusPermohonanProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::statusPermohonan],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>4]],
					]
				],
			]
		]);
    ?>
	</div>
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
						'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
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
                    $.pjax.reload({container:'#perancanganProgramPlanItemGrid'});
                }
          }
     });
     return false;
});

if(isKejohananFlag === true){
	$('.isKejohanan').show();
} else {
	$('.isKejohanan').hide();
}

if(isCampFlag === true){
	$('.isCamp').show();
} else {
	$('.isCamp').hide();
}

$('#kategoriID').change(function(){
	var selected = $(this).val();
	if(selected != '1' && selected != '7' && selected != '8'){
		$('.isKejohanan').hide();
	} else {
		$('.isKejohanan').show();
	}

    // Jumlah Atlet, Jumlah Jurulatih, Jumlah Pegawai
    if(selected != '1' && selected != '7' && selected != '8' && selected != '6'){
		$('.isCamp').hide();
	} else {
		$('.isCamp').show();
	}
});

     

JS;
        
$this->registerJs($script);
?>
