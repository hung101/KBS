<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;
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
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\PerancanganProgramPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perancangan-program-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
	
	<?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
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
						 'cawangan' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-cawangan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefCawangan::find()->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::cawangan],
								'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>3]],
					],
				],
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
								'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::program],
								'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>6]],
						'sukan' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\DepDrop', 
							'options'=>[
								'type'=>DepDrop::TYPE_SELECT2,
								'select2Options'=> [
									'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
									[
										'append' => [
											'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
											'asButton' => true
										]
									] : null,
									'pluginOptions'=>['allowClear'=>true]
								],
								'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options'=>['prompt'=>'',],
								'pluginOptions' => [
									//'initialize' => true,
									'depends'=>[Html::getInputId($model, 'cawangan')],
									'placeholder' => Placeholder::sukan,
									'url'=>Url::to(['/ref-sukan/subsukan'])],
								],
							'columnOptions'=>['colspan'=>6]],
					],
				],
			]
		]);
    ?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong><?= GeneralLabel::tempoh ?></strong>
		</div>
		<div class="panel-body">
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
				]
			]);
			?>
		</div>
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
						'sasaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
					],
				],
			]
		]);
	?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>Phase Target</strong>
		</div>
		<div class="panel-body">
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
							'kejohanan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
							'target' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
							'remarks' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['rows'=>2],'columnOptions'=>['colspan'=>12]],
						],
					],
				]
			]);
			?>
		</div>
	</div>
	
	<h3><?php echo GeneralLabel::pelan; ?></h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'perancanganProgramPlanItemGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPerancanganProgramPlanItem,
        'id' => 'perancanganProgramPlanItemGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // [
                // 'attribute' => 'atlet',
                // 'filterInputOptions' => [
                    // 'class'       => 'form-control',
                    // 'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet,
                // ],
                // 'value' => 'refAtlet.name_penuh'
            // ],
            [
                'attribute' => 'bahagian',
                'value' => 'refKategoriPelan.desc'
            ],
			[
                'attribute' => 'jenis_aktiviti',
                'value' => 'refJenisPelan.desc'
            ],
			'nama_program',
			[
                'attribute' => 'status_program',
                'value' => 'refKedudukanKejohanan.desc'
            ],
            //'tarikh_mula',
            [
                'attribute' => 'tarikh_mula',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula);
                },
            ],
            //'tarikh_tamat',
            [
                'attribute' => 'tarikh_tamat',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat);
                },
            ],
            'tempat',
            [
                'attribute' => 'status_permohonan',
                'value' => 'refStatusPermohonanProgramBinaan.desc'
            ],
            //'keputusan_acara',
            // 'jumlah_pingat',
            // 'rekod_baru',
            // 'catatan_rekod_baru',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['perancangan-program-plan-item/delete', 'id' => $model->perancangan_program_id]).'", "'.GeneralMessage::confirmDelete.'", "perancanganProgramPlanItemGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['perancangan-program-plan-item/update', 'id' => $model->perancangan_program_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pelan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['perancangan-program-plan-item/view', 'id' => $model->perancangan_program_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pelan.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $perancangan_program_plan_master_id = "";
        
        if(isset($model->perancangan_program_plan_master_id)){
            $perancangan_program_plan_master_id = $model->perancangan_program_plan_master_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['perancangan-program-plan-item/create', 'perancangan_program_plan_master_id' => $perancangan_program_plan_master_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pelan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
        <?php //echo Html::a(GeneralLabel::backToList, ['index'], ['class' => 'btn btn-warning']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
