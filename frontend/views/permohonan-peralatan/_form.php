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
use kartik\widgets\DepDrop;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefCawangan;
use app\models\RefNegeri;
use app\models\RefSukan;
use app\models\RefProgram;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefKelulusanPeralatan;
use app\models\ProfilPusatLatihan;
use app\models\ProfilPusatLatihanProgram;
use app\models\UserPeranan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatan */
/* @var $form yii\widgets\ActiveForm */

// cawangan dropdown lists
$cawangan_list = GeneralFunction::getCawangan();
$disabled_negeri = false;

if(Yii::$app->user->identity->peranan && Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_PPN && !$readonly){
    //$model->nama_pengurus_sukan = Yii::$app->user->identity->id;
    //$model->nama_sukan = Yii::$app->user->identity->ppn_sukan;
    $model->negeri = Yii::$app->user->identity->ppn_negeri;

    $disabled_negeri = true;
}

$arr_program_list = ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->all(),'id', 'desc');

if($profil_pusat_latihan_id != null){
    if (($modelProfilPusatLatihan = ProfilPusatLatihan::findOne($profil_pusat_latihan_id)) !== null) {
        $model->negeri = $modelProfilPusatLatihan->alamat_negeri;
        
        $disabled_negeri = true;
    }
    
    if (($modelProfilPusatLatihan = ProfilPusatLatihanProgram::find()->where(['=', 'profil_pusat_latihan_id', $profil_pusat_latihan_id])->groupBy('program')->all()) !== null) {
        $arr_program_list = ArrayHelper::map(ProfilPusatLatihanProgram::find()
                ->where(['=', 'profil_pusat_latihan_id', $profil_pusat_latihan_id])
                ->groupBy('program')->all(),'program', 'refProgramSemasaSukanAtlet.desc');
    }
}
?>

<div class="permohonan-peralatan-form">

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
                        'data'=>ArrayHelper::map($cawangan_list,'ref_cawangan_id', 'refCawangan.desc'),
                        'options' => ['placeholder' => Placeholder::cawangan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri, 'disabled'=>$disabled_negeri],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
/*                 'sukan' => [
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
                        'data'=>ArrayHelper::map(GeneralFunction::getSukan(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]], */
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
								'pluginOptions'=>['multiple' => false,'allowClear'=>true]
							],
							'data'=>ArrayHelper::map(GeneralFunction::getSukan(),'id', 'desc'),
							'options'=>['prompt'=>'',],
							'pluginOptions' => [
								'depends'=>[Html::getInputId($model, 'cawangan')],
								'placeholder' => Placeholder::sukan,
								'url'=>Url::to(['/ref-sukan/subsukan'])],
							],
						'columnOptions'=>['colspan'=>4]],
					
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-program/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>$arr_program_list,
                        'options' => ['placeholder' => Placeholder::program],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
                'tarikh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                                    'todayBtn' => true,
                        ],
                        'options'=>['disabled'=>true]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                //'jumlah_peralatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
        ],
     ]
]);
    ?>
    
    <h3><?php echo GeneralLabel::peralatan; ?></h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>
    
    <?php Pjax::begin(['id' => 'peralatanGrid', 'timeout' => 100000]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'peralatan_id',
            //'permohonan_peralatan_id',
            'nama_peralatan',
            'harga_per_unit',
            'jumlah_unit',
            'jumlah',
            //'jumlah_cadangan',
            [
                'attribute' => 'jumlah_cadangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_cadangan,
                ]
            ],
            // 'catatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['peralatan/delete', 'id' => $model->peralatan_id]).'", "'.GeneralMessage::confirmDelete.'", "peralatanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['peralatan/update', 'id' => $model->peralatan_id]).'", "'.GeneralLabel::updateTitle . ' Peralatan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['peralatan/view', 'id' => $model->peralatan_id]).'", "'.GeneralLabel::viewTitle . ' Peralatan");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $calculate_jumlah_pendapatan = 0.00;
        $calculate_jumlah_cadangan = 0.00;
        foreach($dataProvider->models as $PTLmodel){
            $calculate_jumlah_pendapatan += $PTLmodel->jumlah;
            $calculate_jumlah_cadangan += $PTLmodel->jumlah_cadangan;
        }
    ?>
    
    <?php 
        echo "<label>" . $model->getAttributeLabel('jumlah_peralatan') . ": </label> &nbsp;" . $dataProvider->getTotalCount() . ", <label>".GeneralLabel::jumlah_keseluruhan.": </label> RM" . $calculate_jumlah_pendapatan . ", <label>".GeneralLabel::jumlah_cadangan_without_rm.": </label> RM" . $calculate_jumlah_cadangan;
    ?>
    <?php Pjax::end(); ?>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $permohonan_peralatan_id = "";
        
        if(isset($model->permohonan_peralatan_id)){
            $permohonan_peralatan_id = $model->permohonan_peralatan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', '#', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['peralatan/create', 'permohonan_id' => $permohonan_peralatan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::peralatan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <!--<h3>Penggunaan</h3>
    
    <?php Pjax::begin(['id' => 'permohonanPeralatanPenggunaanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanPeralatanPenggunaan,
        //'filterModel' => $searchModelPermohonanPeralatanPenggunaan,
        'id' => 'permohonanPeralatanPenggunaanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_peralatan_penggunaan_id',
            //'permohonan_peralatan_id',
            'nama_peralatan',
            'harga_per_unit',
            'jumlah_unit',
            'bilangan',
            'jumlah',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-peralatan-penggunaan/delete', 'id' => $model->permohonan_peralatan_penggunaan_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanPeralatanPenggunaanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-peralatan-penggunaan/update', 'id' => $model->permohonan_peralatan_penggunaan_id]).'", "'.GeneralLabel::updateTitle . ' Penggunaan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-peralatan-penggunaan/view', 'id' => $model->permohonan_peralatan_penggunaan_id]).'", "'.GeneralLabel::viewTitle . ' Penggunaan");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $jumlah = 0.00;
        foreach($dataProviderPermohonanPeralatanPenggunaan->models as $PTLmodel){
            $jumlah += $PTLmodel->jumlah;
        }
    ?>
    
    <?php 
        echo "<label>Jumlah Peralatan: </label> &nbsp;" . $dataProviderPermohonanPeralatanPenggunaan->getTotalCount() . ", <label>".GeneralLabel::jumlah_keseluruhan.": </label> RM" . $jumlah ;
    ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-peralatan-penggunaan/create', 'permohonan_peralatan_id' => $permohonan_peralatan_id]).'", "'.GeneralLabel::createTitle . ' Penggunaan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>-->
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['kelulusan']) || $readonly): ?>
    
    <?php
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan_cadangan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan_kelulusan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);*/
    ?>
    
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
                    'nota_urus_setia' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255]],
                ]
            ],
        ]
    ]);
    ?>
    
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
                'jumlah_diluluskan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kelulusan-peralatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKelulusanPeralatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kelulusan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'bil_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'tarikh_jkb' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>
    

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

    $("form#{$model->formName()} input").prop("disabled", false);
    
    $("#permohonanperalatan-negeri").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>
