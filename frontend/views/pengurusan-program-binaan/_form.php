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

// table reference
use app\models\RefKategoriPermohonanProgramBinaan;
use app\models\RefJenisPermohonanProgramBinaan;
use app\models\RefSukan;
use app\models\RefAtletTahap;
use app\models\RefNegeri;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefStatusPermohonanProgramBinaan;
use app\models\RefJenisPermohonan;
use app\models\RefTahapProgramBinaan;
use app\models\RefKategoriProgramBinaan;
use app\models\RefJantina;
use app\models\RefBahagianProgramBinaan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaan */
/* @var $form yii\widgets\ActiveForm */

//set jenis_permohonan by default to id 1 (not USPTN) if empty
if(!isset($model->jenis_permohonan) || $model->jenis_permohonan === null)
{
    $disableJenisPermohonan = false;
    
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['psk'])){
        $model->jenis_permohonan = RefJenisPermohonan::PSK;
        $disableJenisPermohonan = true;
    } else if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['usptn'])){
        $model->jenis_permohonan = RefJenisPermohonan::USPTN;
        $disableJenisPermohonan = true;
    } else {
        $model->jenis_permohonan = RefJenisPermohonan::MAJLIS_SUKAN_NEGARA;
    }
}

//default usptn-content-wrap style
$usptnStyle = 'display:none';
$nonUsptnStyle = 'display:block';
if(isset($model->jenis_permohonan))
{
	$ref = RefJenisPermohonan::findOne($model->jenis_permohonan);
    $jenisPermohonan = $ref['desc'];
    if($jenisPermohonan === 'USPTN')
    {
        $usptnStyle = 'display:block';
        $nonUsptnStyle = "display:none";
    }
    if($readonly)
    {
        $model->jenis_permohonan = $jenisPermohonan;
    }
}
?>

<div class="pengurusan-program-binaan-form">

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
                            'jenis_permohonan' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=>'\kartik\widgets\Select2',
                                'options'=>[
                                    'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                    [
                                        'append' => [
                                            'content' => Html::a(Html::icon('edit'), ['/ref-jenis-permohonan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                            'asButton' => true
                                        ]
                                    ] : null,
                                    'data'=>ArrayHelper::map(RefJenisPermohonan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                    'options' => ['placeholder' => Placeholder::bahagian],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                    'pluginEvents' => [
                                        "change" => "function() { 
                                            if($(this).select2('data')[0].text === 'USPTN'){
                                                $('.usptn-content-wrap').show();
                                                $('.non-usptn-content-wrap').hide();
                                            } else {
                                               $('.usptn-content-wrap').hide();
                                               $('.non-usptn-content-wrap').show();
                                            }
                                        }"
                                    ],
                                    'disabled' => $disableJenisPermohonan
                                    ],
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
                                'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::program],
        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        
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
                                'options' => ['placeholder' => Placeholder::negeri],
        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        /*'sukan' => [
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
                            'columnOptions'=>['colspan'=>3]],*/
                        //'jabatan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
						'bahagian' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefBahagianProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::bahagian],],
                            'columnOptions'=>['colspan'=>3]],
                        'bilangan_peserta' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                    ],
                ],
/*                 [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'sukan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'id' => 'pengurusanprogrambinaan-sukan',
                            'name' => 'PengurusanProgramBinaan[sukan]',
                            //'value' => $sukan_selected, // initial value
                            'options'=>[
                                'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::sukan, 'multiple' => true],
                            'pluginOptions' => [
                                    'tags' => true,
                                    'maximumInputLength' => 10
                                ],
                            'disabled' => $readonly
                            ],
                        'columnOptions'=>['colspan'=>3]],
                    ],
                ], */
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        /*'aktiviti' =>[
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'data'=>ArrayHelper::map(PerancanganProgram::find()->where('jenis_aktiviti = :id1', [':id1' => RefJenisAktiviti::PROGRAM_BINAAN])->all(),'perancangan_program_id', 'nama_program'),
                                'options' => ['placeholder' => Placeholder::program],],
                            'columnOptions'=>['colspan'=>3]],*/
                        'jenis_aktiviti' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-jenis-permohonan-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefJenisPermohonanProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::jenisAktiviti],
        'pluginOptions' => [
                                    'allowClear' => true,
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        'nama_aktiviti' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        
                        'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>7],'options'=>['maxlength'=>90]],
                    ],
                ],
                /*[
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                       'tahap' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-atlet-tahap/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefAtletTahap::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::tahapAtlet],],
                            'columnOptions'=>['colspan'=>3]],
                        
                        'daerah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>40]],
                    ],
                ],*/
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
    <!--USPTN content start-->
    <div class="usptn-content-wrap" style="<?= $usptnStyle ?>">
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
                       'usptn_tahap' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-tahap-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefTahapProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::tahap],],
                            'columnOptions'=>['colspan'=>3]],
/*                         'usptn_kategori' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-kategori-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefKategoriProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::kategori],],
                            'columnOptions'=>['colspan'=>3]], */
                ],
            ],
        ]
    ]); 
    ?>
     
    <?php // Upload
    
    $label = $model->getAttributeLabel('usptn_bajet');
    
    if($model->usptn_bajet){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('usptn_bajet') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->usptn_bajet , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'usptn_bajet' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
        echo "<br>";
    }
        
    ?>
    
    <?php // Upload
    
    $label = $model->getAttributeLabel('usptn_jadual');
    
    if($model->usptn_jadual){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('usptn_jadual') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->usptn_jadual , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'usptn_jadual' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
        //echo "<br>";
    }
        
    ?>
    
    </div>
    <!--USPTN content end-->
    
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
        $pengurusan_program_binaan_id = "";
        
        if(isset($model->pengurusan_program_binaan_id)){
            $pengurusan_program_binaan_id = $model->pengurusan_program_binaan_id;
        }
    ?>
    <?php endif; ?>
    
    <h3><?php echo GeneralLabel::sukan; ?></h3>
    
    <?php Pjax::begin(['id' => 'pengurusanProgramBinaanSukanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanProgramBinaanSukan,
        //'filterModel' => $searchModelPengurusanProgramBinaanAtlet,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'pengurusanProgramBinaanSukanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'sukan',
                'value' => 'refSukan.desc'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-sukan/delete', 'id' => $model->pengurusan_program_binaan_sukan_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanProgramBinaanSukanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-sukan/update', 'id' => $model->pengurusan_program_binaan_sukan_id]).'", "'.GeneralLabel::updateTitle . ' Sukan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-sukan/view', 'id' => $model->pengurusan_program_binaan_sukan_id]).'", "'.GeneralLabel::viewTitle . ' Sukan");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-sukan/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' Sukan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <div class="usptn-content-wrap" style="<?= $usptnStyle ?>">
    
    <h3><?php echo GeneralLabel::kategori; ?></h3>
    
    <?php Pjax::begin(['id' => 'pengurusanProgramBinaanKategoriGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanProgramBinaanKategori,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'pengurusanProgramBinaanKategoriGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'kategori',
                'value' => 'refKategoriProgramBinaan.desc'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-kategori/delete', 'id' => $model->pengurusan_program_binaan_kategori_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanProgramBinaanKategoriGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-kategori/update', 'id' => $model->pengurusan_program_binaan_kategori_id]).'", "'.GeneralLabel::updateTitle . ' Kategori");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-kategori/view', 'id' => $model->pengurusan_program_binaan_kategori_id]).'", "'.GeneralLabel::viewTitle . ' Kategori");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-kategori/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' Kategori");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    </div>
    
    <h3><?php echo GeneralLabel::perbelanjaan; ?></h3>
    
    <?php Pjax::begin(['id' => 'programBinaanKosGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProgramBinaanKos,
        //'filterModel' => $searchModelProgramBinaanKos,
        'id' => 'programBinaanKosGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_program_binaan_kos_id',
            //'pengurusan_program_binaan_id',
            //'kategori_kos',
            [
                'attribute' => 'perbelanjaan_dipohon',
            ],
            [
                'label' => GeneralLabel::jumlah_dipohon.' (RM)',
                'attribute' => 'jumlah_dipohon',
            ],
            [
                'label' =>GeneralLabel::jumlah_cadangan,
                'attribute' => 'anggaran_perbelanjaan',
            ],
            // 'approved_kos_per_kategori',
            // 'catatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-kos/delete', 'id' => $model->pengurusan_program_binaan_kos_id]).'", "'.GeneralMessage::confirmDelete.'", "programBinaanKosGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-kos/update', 'id' => $model->pengurusan_program_binaan_kos_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::perbelanjaan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-kos/view', 'id' => $model->pengurusan_program_binaan_kos_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::perbelanjaan.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $jumlah_dipohon = 0.00;
		$jumlah_dicadang = 0.00;
        foreach($dataProviderProgramBinaanKos->models as $PBKmodel){
            $jumlah_dipohon += $PBKmodel->jumlah_dipohon;
			$jumlah_dicadang += $PBKmodel->anggaran_perbelanjaan;
        }
    ?>
    
    <h4><?= GeneralLabel::jumlah_yang_dipohon ?> (RM): <?php echo number_format($jumlah_dipohon, 2);?></h4>
    <h4><?= GeneralLabel::jumlah_dicadang ?> (RM): <?php echo number_format($jumlah_dicadang, 2);?></h4>
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        // $pengurusan_program_binaan_id = "";
        
        // if(isset($model->pengurusan_program_binaan_id)){
            // $pengurusan_program_binaan_id = $model->pengurusan_program_binaan_id;
        // }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-kos/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::perbelanjaan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::pegawai; ?></h3>
    
    <?php Pjax::begin(['id' => 'programBinaanPesertaGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProgramBinaanPeserta,
        //'filterModel' => $searchModelProgramBinaanPeserta,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'programBinaanPesertaGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_program_binaan_peserta_id',
            //'pengurusan_program_binaan_id',
            //'kategori_peserta',
            /*[
                'attribute' => 'kategori_peserta',
                'value' => 'refKategoriPesertaProgramBinaan.desc'
            ],*/
            //'atlet_id',
            /*[
                'attribute' => 'atlet_id',
                'value' => 'refAtlet.name_penuh'
            ],*/
            //'jurulatih_id',
            /*[
                'attribute' => 'jurulatih_id',
                'value' => 'refJurulatih.nama'
            ],*/
            'nama_peserta',
            //'jantina',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-peserta/delete', 'id' => $model->pengurusan_program_binaan_peserta_id]).'", "'.GeneralMessage::confirmDelete.'", "programBinaanPesertaGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-peserta/update', 'id' => $model->pengurusan_program_binaan_peserta_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pegawai.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-peserta/view', 'id' => $model->pengurusan_program_binaan_peserta_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pegawai.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-peserta/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pegawai.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::atlet; ?></h3>
    
    <?php Pjax::begin(['id' => 'pengurusanProgramBinaanAtletGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanProgramBinaanAtlet,
        //'filterModel' => $searchModelPengurusanProgramBinaanAtlet,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'pengurusanProgramBinaanAtletGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'atlet_id',
                'value' => 'refAtlet.name_penuh'
            ],
            [
				'label' => GeneralLabel::jantina,
				'value' => function ($data) {
                    $query = RefJantina::findOne(['id' => $data->refAtlet->jantina]);
                    $ref = $query['desc'];
					return $ref;
				},
			],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-atlet/delete', 'id' => $model->pengurusan_program_binaan_atlet_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanProgramBinaanAtletGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-atlet/update', 'id' => $model->pengurusan_program_binaan_atlet_id]).'", "'.GeneralLabel::updateTitle . ' Atlet");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-atlet/view', 'id' => $model->pengurusan_program_binaan_atlet_id]).'", "'.GeneralLabel::viewTitle . ' Atlet");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-atlet/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' Atlet");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::jurulatih; ?></h3>
    
    
    <?php Pjax::begin(['id' => 'pengurusanProgramBinaanJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanProgramBinaanJurulatih,
        //'filterModel' => $searchModelPengurusanProgramBinaanJurulatih,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'pengurusanProgramBinaanJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'jurulatih_id',
                'value' => 'refJurulatih.nama'
            ],
            [
				'label' => GeneralLabel::jantina,
				'value' => function ($data) {
					if(isset($data->refJurulatih->jantina) && $data->refJurulatih->jantina != null){
						$query = RefJantina::findOne(['id' => $data->refJurulatih->jantina]);
						$ref = $query['desc'];
						return $ref;
					} else return null;
				},
			],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-jurulatih/delete', 'id' => $model->pengurusan_program_binaan_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanProgramBinaanJurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-jurulatih/update', 'id' => $model->pengurusan_program_binaan_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::jurulatih.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-jurulatih/view', 'id' => $model->pengurusan_program_binaan_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::jurulatih.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-jurulatih/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jurulatih.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <!--<div class="usptn-content-wrap">-->
    <br>
    
    <h3><?php echo GeneralLabel::teknikal; ?></h3>
    
    <?php Pjax::begin(['id' => 'programBinaanTeknikalGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProgramBinaanTeknikal,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'programBinaanTeknikalGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-teknikal/delete', 'id' => $model->pengurusan_program_binaan_teknikal_id]).'", "'.GeneralMessage::confirmDelete.'", "programBinaanTeknikalGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-teknikal/update', 'id' => $model->pengurusan_program_binaan_teknikal_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::teknikal.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-teknikal/view', 'id' => $model->pengurusan_program_binaan_teknikal_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::teknikal.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-teknikal/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::teknikal.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::urusetia; ?></h3>
    
    <?php Pjax::begin(['id' => 'programBinaanUrusetiaGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProgramBinaanUrusetia,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'programBinaanUrusetiaGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-urusetia/delete', 'id' => $model->pengurusan_program_binaan_urusetia_id]).'", "'.GeneralMessage::confirmDelete.'", "programBinaanUrusetiaGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-urusetia/update', 'id' => $model->pengurusan_program_binaan_urusetia_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::urusetia.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-urusetia/view', 'id' => $model->pengurusan_program_binaan_urusetia_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::urusetia.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-urusetia/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::urusetia.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>

    <!--</div>-->
    <br>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['sokongan_pn']) || $readonly): ?>
    <?php
/*         echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'sokongan_pn' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],
                    ]
                ],
            ]
        ]); */
    ?>
    <?php endif; ?>
    
    <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['kelulusan']) || $readonly) && $model->hantar_flag == 1): ?>
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
                    'jumlah_yang_diluluskan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                ]
            ],
/*             [
                'columns'=>12,
                'autoGenerateColumns'=>false, // override columns setting
                'attributes' => [
                   'bilangan_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
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
            ], */
        ]
    ]);
    ?>
    <?php endif; ?>
    
    
    <div class="usptn-content-wrap" style="<?= $usptnStyle ?>">
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['sokongan_pn']) || 
                isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['kelulusan']) || 
                $readonly): ?>
        
        <div class="non-usptn-content-wrap" style="<?= $nonUsptnStyle ?>">
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
                   'bilangan_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
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
                    'usptn_kuota_lap' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    'usptn_lap_tertunggak' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                ],
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
					'tarikh_sokongan' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=> DateControl::classname(),
                        'ajaxConversion'=>false,
                        'options'=>[
                            'pluginOptions' => [
                                'autoclose'=>true,
                            ]
                        ],
                    'columnOptions'=>['colspan'=>3]],
                    'usptn_sokongan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    //'usptn_kelulusan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    //'usptn_kuota_lap' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                ],
            ],
        ]
    ]);
    
    ?>
    <?php endif; ?>
        
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['kelulusan']) || $readonly): ?> 
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
                    'tarikh_lulus' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=> DateControl::classname(),
                        'ajaxConversion'=>false,
                        'options'=>[
                            'pluginOptions' => [
                                'autoclose'=>true,
                            ]
                        ],
                    'columnOptions'=>['colspan'=>3]],
					'usptn_kelulusan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                ],
            ],
        ]
    ]);
    ?>
    <?php endif; ?>
        </div>
    

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
$URL_SET_PROGRAM = Url::to(['/pengurusan-program-binaan/set-program']);
$URL_SET_SUKAN = Url::to(['/pengurusan-program-binaan/set-sukan']);
$URL_SET_BAHAGIAN = Url::to(['/pengurusan-program-binaan/set-bahagian']);

$script = <<< JS
        
$(document).ready(function(){
    // changeSukan();
    changeProgram();
	changeBahagian();
});
        
// $('#pengurusanprogrambinaan-sukan').change(function(){
    // changeSukan();
// });
        
$('#pengurusanprogrambinaan-program').change(function(){
    changeProgram();
});

$('#pengurusanprogrambinaan-bahagian').change(function(){
    changeBahagian();
});
        
function changeSukan(){
    $.get('$URL_SET_SUKAN',{sukan_id:$('#pengurusanprogrambinaan-sukan').val()},function(data){
    });
}
        
function changeProgram(){
    $.get('$URL_SET_PROGRAM',{program_id:$('#pengurusanprogrambinaan-program').val()},function(data){
    });
}

function changeBahagian(){
	if($('#pengurusanprogrambinaan-bahagian').val() != ''){		
		$.get('$URL_SET_BAHAGIAN',{bahagian_id:$('#pengurusanprogrambinaan-bahagian').val()},function(data){
		});
	}
}

        
JS;
        
$this->registerJs($script);
?>
