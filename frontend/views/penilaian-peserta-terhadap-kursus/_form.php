<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\PengurusanPermohonanKursusPersatuan;
use app\models\RefTahapKpsk;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPesertaTerhadapKursus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-peserta-terhadap-kursus-form">
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
			$hint = "Apakah cadangan anda untuk meningkatkan lagi mutu kursus ini";
        } else {
            $template = '{view}';
			$hint = "";
        }
    ?>

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
                'pengurusan_permohonan_kursus_persatuan_id' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/pengurusan-permohonan-kursus-persatuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanPermohonanKursusPersatuan::find()->all(),'pengurusan_permohonan_kursus_persatuan_id', 'agensi'),
                        'options' => ['placeholder' => Placeholder::agensi, 'id'=>'kursusId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
				'nama_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80,'value'=>'Kursus Pengurusan Sukan Kebangsaan (KPSK)', 'disabled'=>true]],
				'tahap' => [
					'type'=>Form::INPUT_WIDGET, 
					'widgetClass'=>'\kartik\widgets\Select2',
					'options'=>[
						'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
						[
							'append' => [
								'content' => Html::a(Html::icon('edit'), ['/ref-tahap-kpsk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
								'asButton' => true
							]
						] : null,
						'data'=>ArrayHelper::map(RefTahapKpsk::find()->all(),'id', 'desc'),
						'options' => ['placeholder' => Placeholder::tahap],
'pluginOptions' => [
							'allowClear' => true
						],],
					'columnOptions'=>['colspan'=>3]],
                'kod_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>30]],
            ],
        ],
		[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                 'tarikh_kursus' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
				'tarikh_tamat_kursus' => [
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
                'nama_penyelaras' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                 
            ],
        ],
    ]
]);
        ?>
    
    
    <h3><?php echo GeneralLabel::soalan_penilaian; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'penilaianPesertaKursusSoalanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenilaianPesertaTerhadapKursusSoalan,
        //'filterModel' => $searchModelPenilaianPesertaTerhadapKursusSoalan,
        'id' => 'penilaianPesertaKursusSoalanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penilaian_peserta_terhadap_kursus_soalan_id',
            //'penilaian_peserta_terhadap_kursus_id',
            //'kategori_soalan',
            [
                'attribute' => 'kategori_soalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_soalan,
                ],
                'value' => 'refKategoriSoalanPeserta.desc'
            ],
            //'soalan',
            [
                'attribute' => 'soalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::soalan,
                ],
                'value' => 'refSoalanPeserta.desc'
            ],
            //'skala',
            [
                'attribute' => 'skala',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::skala,
                ],
                'value' => 'refRatingSoalan.desc'
            ],
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penilaian-peserta-terhadap-kursus-soalan/delete', 'id' => $model->penilaian_peserta_terhadap_kursus_soalan_id]).'", "'.GeneralMessage::confirmDelete.'", "penilaianPesertaKursusSoalanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-peserta-terhadap-kursus-soalan/update', 'id' => $model->penilaian_peserta_terhadap_kursus_soalan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::soalan_penilaian.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-peserta-terhadap-kursus-soalan/view', 'id' => $model->penilaian_peserta_terhadap_kursus_soalan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::soalan_penilaian.'");',
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
        $penilaian_peserta_terhadap_kursus_id = "";
        
        if(isset($model->penilaian_peserta_terhadap_kursus_id)){
            $penilaian_peserta_terhadap_kursus_id = $model->penilaian_peserta_terhadap_kursus_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-peserta-terhadap-kursus-soalan/create', 'penilaian_peserta_terhadap_kursus_id' => $penilaian_peserta_terhadap_kursus_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::soalan_penilaian.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>

    <h3><?php echo GeneralLabel::lain_lain; ?></h3>
	<?= $form->field($model, 'lain_lain1')->label("1. Adakah anda ingin memperakukan kursus ini kepada orang lain?")->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>
	<?= $form->field($model, 'lain_lain2')->label("2. Adakah anda akan menggunakan pengetahuan dan kemahiran yang diperolehi sebagai rujukan kerja?")->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>
	<br>
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
						'kelemahan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'hint' => $hint],
						 
					],
				],
			]
		]);
        ?>

    <!--<?= $form->field($model, 'pengurusan_permohonan_kursus_persatuan_id')->textInput() ?>

    <?= $form->field($model, 'tarikh_kursus')->textInput() ?>

    <?= $form->field($model, 'nama_penganjur_kursus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kod_kursus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_kursus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_penyelaras')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

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
$URLKursus = Url::to(['/pengurusan-permohonan-kursus-persatuan/get-kursus']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('#kursusId').change(function(){
    
    $.get('$URLKursus',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#penilaianpesertaterhadapkursus-kod_kursus').attr('value',data.kod_kursus);
            $('#penilaianpesertaterhadapkursus-tempat_kursus').attr('value',data.tempat);
            //$('#penilaianpesertaterhadapkursus-nama_penganjur_kursus').attr('value',data.nama_penganjur);
			$('#penilaianpesertaterhadapkursus-nama_penyelaras').attr('value',data.nama);
            $("#penilaianpesertaterhadapkursus-tarikh_kursus-disp").val(formatDisplayDate(data.tarikh_kursus));
            $("#penilaianpesertaterhadapkursus-tarikh_kursus").val(data.tarikh_kursus);
            $("#penilaianpesertaterhadapkursus-tarikh_kursus").kvDatepicker("$DateDisplayFormat", new Date(data.tarikh_kursus)).kvDatepicker({
                format: "$DateDisplayFormat"
            });
			$("#penilaianpesertaterhadapkursus-tarikh_tamat_kursus-disp").val(formatDisplayDate(data.tarikh_tamat_kursus));
            $("#penilaianpesertaterhadapkursus-tarikh_tamat_kursus").val(data.tarikh_tamat_kursus);
            $("#penilaianpesertaterhadapkursus-tarikh_tamat_kursus").kvDatepicker("$DateDisplayFormat", new Date(data.tarikh_tamat_kursus)).kvDatepicker({
                format: "$DateDisplayFormat"
            });
			$('#penilaianpesertaterhadapkursus-tahap').val(data.tahap).trigger("change");
        }
    });
});
     
function clearForm(){
    $('#penilaianpesertaterhadapkursus-kod_kursus').attr('value','');
    $('#penilaianpesertaterhadapkursus-tempat_kursus').attr('value','');
    //$('#penilaianpesertaterhadapkursus-nama_penganjur_kursus').attr('value','');
    $('#penilaianpesertaterhadapkursus-tarikh_kursus').attr('value','');
    $('#penilaianpesertaterhadapkursus-tarikh_kursus-disp').attr('value','');
	$('#penilaianpesertaterhadapkursus-tarikh_tamat_kursus').attr('value','');
    $('#penilaianpesertaterhadapkursus-tarikh_tamat_kursus-disp').attr('value','');
	$('#penilaianpesertaterhadapkursus-tahap').val('').trigger("change");
	$('#penilaianpesertaterhadapkursus-nama_penyelaras').attr('value','');
}

$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>
