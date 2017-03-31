<?php
use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

use app\models\Atlet;
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademik */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maklumat-akademik-form">
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
	<pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_atlet_title; ?></strong></pre>
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
							'atlet' => [
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
									'options' => ['placeholder' => Placeholder::atlet, 'id' => 'atletID'],
			'pluginOptions' => [
										'allowClear' => true
									],],
								'columnOptions'=>['colspan'=>6]],
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
									'options' => ['placeholder' => Placeholder::sukan, 'id' => 'sukanID'],
			'pluginOptions' => [
										'allowClear' => true
									],],
								'columnOptions'=>['colspan'=>6]],
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
									'options' => ['placeholder' => Placeholder::program, 'id' => 'programID'],
			'pluginOptions' => [
										'allowClear' => true
									],],
								'columnOptions'=>['colspan'=>6]],
							'no_matrik' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
							'fakulti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
							'atlet_no_tel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
							'atlet_hp_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                        ],
                    ],
                
            ]
        ]);
    ?>
	<pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_penasihat_akademik; ?></strong></pre>
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
							'penasihat_akademik' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
							'penasihat_no_tel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
							'penasihat_hp_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                        ],
                    ],
                
            ]
        ]);
    ?>
	<pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_pengajian; ?></strong></pre>
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
							'semester' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
							'jumlah_semester' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
							'jumlah_tahun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
							'tahun_kemasukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                        ],
                    ],
                
            ]
        ]);
    ?>
	
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
    
    <?php if(!$readonly): ?>
        <?php 
        $maklumat_akademik_id = "";
        
        if(isset($model->maklumat_akademik_id)){
            $maklumat_akademik_id = $model->maklumat_akademik_id;
        }
    ?>
    <?php endif; ?>
	
	<h3><?php echo GeneralLabel::jadual ?></h3>
	
	<?php Pjax::begin(['id' => 'maklumatAkademikJadualGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderMaklumatAkademikJadual,
        //'filterModel' => $searchModelPengurusanProgramBinaanAtlet,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'maklumatAkademikJadualGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
/*             [
                'attribute' => 'tarikh',
                'value' => function ($model) {
									return  date('d-m-Y', strtotime($model->tarikh));
							   },
            ], */
			[
                'attribute' => 'hari',
                'value' => 'refHari.desc',
            ],
			'masa_dari',
			'masa_hingga',
			'perkara',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['maklumat-akademik-jadual/delete', 'id' => $model->maklumat_akademik_jadual_id]).'", "'.GeneralMessage::confirmDelete.'", "maklumatAkademikJadualGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-akademik-jadual/update', 'id' => $model->maklumat_akademik_jadual_id]).'", "'.GeneralLabel::updateTitle .' '.GeneralLabel::jadual.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-akademik-jadual/view', 'id' => $model->maklumat_akademik_jadual_id]).'", "'.GeneralLabel::viewTitle .' '.GeneralLabel::jadual.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-akademik-jadual/create', 'maklumat_akademik_id' => $maklumat_akademik_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jadual.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
	
	<h3><?php echo GeneralLabel::subjek ?></h3>
	
	<?php Pjax::begin(['id' => 'maklumatAkademikSubjekGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderMaklumatAkademikSubjek,
        //'filterModel' => $searchModelPengurusanProgramBinaanAtlet,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'maklumatAkademikSubjekGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'kod_subjek',
			'subjek',
			'bil_kredit',
			'nama_pensyarah',
			'no_telefon',
			'email',
            // [
                // 'attribute' => 'sukan',
                // 'value' => 'refSukan.desc'
            // ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['maklumat-akademik-subjek/delete', 'id' => $model->maklumat_akademik_subjek_id]).'", "'.GeneralMessage::confirmDelete.'", "maklumatAkademikSubjekGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-akademik-subjek/update', 'id' => $model->maklumat_akademik_subjek_id]).'", "'.GeneralLabel::updateTitle .' '.GeneralLabel::subjek.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-akademik-subjek/view', 'id' => $model->maklumat_akademik_subjek_id]).'", "'.GeneralLabel::viewTitle .' '.GeneralLabel::subjek.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['maklumat-akademik-subjek/create', 'maklumat_akademik_id' => $maklumat_akademik_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::subjek.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
	
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
$URLAtlet = Url::to(['/atlet/get-atlet']);

$script = <<< JS
        
$('#atletID').change(function(){
    
    $.get('$URLAtlet',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
			$('#sukanID').val(data['refAtletSukan'][0]['nama_sukan']).trigger("change");
			$('#programID').val(data['refAtletSukan'][0]['program_semasa']).trigger("change");
            $('#maklumatakademik-atlet_no_tel').val(data.tel_no);
			$('#maklumatakademik-atlet_hp_no').val(data.tel_bimbit_no_1);
        }
    });
    
});
     
function clearForm(){
    $('#sukanID').val('').trigger("change");
	$('#programID').val('').trigger("change");
	$('#maklumatakademik-atlet_no_tel').val('');
	$('#maklumatakademik-atlet_hp_no').val('');
}
        
$(document).ready(function(){

});
        
JS;
        
$this->registerJs($script);
?>
