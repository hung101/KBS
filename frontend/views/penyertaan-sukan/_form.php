<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefKategoriPenilaian;
use app\models\RefSukan;
use app\models\Atlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefTemasya;
use app\models\RefStatusPermohonanProgramBinaan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyertaan-sukan-form">

    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    
    <?php //echo $form->errorSummary($model); ?>
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
                'nama_kejohanan_temasya' => [
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    // 'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                    // [
                        // 'append' => [
                            // 'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                            // 'asButton' => true
                        // ]
                    // ] : null,
                    'data'=>ArrayHelper::map(\app\models\PerancanganProgramPlan::find()->joinWith('refKategoriPelan')
							->where(['IS NOT', 'perancangan_program_plan_master_id', NULL])
                            ->andWhere(['LIKE', 'desc', 'kejohanan'])->all(),'perancangan_program_id', 'nama_program'),
                    'options' => ['placeholder' => Placeholder::kejohanan_temasya, 'id' => 'kejohananTemasya'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],],
                'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_sukan' => [
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
                        'data'=>ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan, 'id'=>'sukanId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
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
                        'options' => ['placeholder' => Placeholder::program, 'id'=>'programId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'kategori_penilaian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-penilaian/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPenilaian::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriPenilaian],],
                    'columnOptions'=>['colspan'=>4]],
                'nama_kejohanan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-penilaian/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PerancanganProgram::find()->where('jenis_aktiviti = :id1 OR jenis_aktiviti = :id2', [':id1' => RefJenisAktiviti::KEJOHANAN_DALAM_NEGARA, ':id2' => RefJenisAktiviti::KEJOHANAN_LUAR_NEGARA])->all(),'perancangan_program_id', 'nama_program'),
                        'options' => ['placeholder' => Placeholder::kejohanan, 'id'=>'kejohananId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
                //'nama_temasya' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'nama_temasya' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-temasya/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTemasya::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::temasya],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                
            ],
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 
                'tempat_penginapan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
            ],
        ],
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
                'peringkat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peringkat-kejohanan-temasya/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeringkatKejohananTemasya::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkat],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'tempat_latihan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                /*'nama_atlet' => [
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
                    'columnOptions'=>['colspan'=>6]],*/
            ],
        ],
        // [
            // 'columns'=>12,
            // 'autoGenerateColumns'=>false, // override columns setting
            // 'attributes' => [
               
                 // 'nama_pegawai' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                // 'jawatan_pegawai' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            // ],
        // ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                //'nama_pengurus_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'sasaran_kejohanan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                //'nama_sukarelawan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
            ],
        ],
    ]
]);
        ?>
    
    <h3><?php echo GeneralLabel::atlet; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'penyertaanSukanAcaraGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenyertaanSukanAcara,
        //'filterModel' => $searchModelPenyertaanSukanAcara,
        'id' => 'penyertaanSukanAcaraGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

             //'penyertaan_sukan_acara_id',
            //'penyertaan_sukan_id',
            //'nama_acara',
            [
                'attribute' => 'atlet',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            [
                'attribute' => 'nama_acara',
                'value' => 'refAcara.desc'
            ],
            'tarikh_acara',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penyertaan-sukan-acara/delete', 'id' => $model->penyertaan_sukan_acara_id]).'", "'.GeneralMessage::confirmDelete.'", "penyertaanSukanAcaraGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-acara/update', 'id' => $model->penyertaan_sukan_acara_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::penyertaan_acara_sukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-acara/view', 'id' => $model->penyertaan_sukan_acara_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::penyertaan_acara_sukan.'");',
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
        $penyertaan_sukan_id = "";
        
        if(isset($model->penyertaan_sukan_id)){
            $penyertaan_sukan_id = $model->penyertaan_sukan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-acara/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::penyertaan_acara_sukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::jurulatih; ?></h3>
    
    
    <?php Pjax::begin(['id' => 'penyertaanSukanJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenyertaanSukanJurulatih,
        //'filterModel' => $searchModelPengurusanProgramBinaanJurulatih,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'penyertaanSukanJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'jurulatih_id',
                'value' => 'refJurulatih.nama'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penyertaan-sukan-jurulatih/delete', 'id' => $model->penyertaan_sukan_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "penyertaanSukanJurulatihGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-jurulatih/update', 'id' => $model->penyertaan_sukan_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::jurulatih.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-jurulatih/view', 'id' => $model->penyertaan_sukan_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::jurulatih.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-jurulatih/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jurulatih.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br />
    
    <h3><?php echo GeneralLabel::pegawai; ?></h3>
    
    
    <?php Pjax::begin(['id' => 'penyertaanSukanPegawaiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenyertaanSukanPegawai,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'penyertaanSukanPegawaiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            'jawatan',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penyertaan-sukan-pegawai/delete', 'id' => $model->penyertaan_sukan_pegawai_id]).'", "'.GeneralMessage::confirmDelete.'", "penyertaanSukanPegawaiGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-pegawai/update', 'id' => $model->penyertaan_sukan_pegawai_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pegawai.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-pegawai/view', 'id' => $model->penyertaan_sukan_pegawai_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pegawai.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-pegawai/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pegawai.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br />
    
    <h3><?php echo GeneralLabel::pengurus_sukan; ?></h3>
    
    
    <?php Pjax::begin(['id' => 'penyertaanSukanPengurusGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenyertaanSukanPengurus,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'penyertaanSukanPengurusGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penyertaan-sukan-pengurus/delete', 'id' => $model->penyertaan_sukan_pengurus_id]).'", "'.GeneralMessage::confirmDelete.'", "penyertaanSukanPengurusGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-pengurus/update', 'id' => $model->penyertaan_sukan_pengurus_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pengurus_sukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-pengurus/view', 'id' => $model->penyertaan_sukan_pengurus_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pengurus_sukan.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-pengurus/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pengurus_sukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
	
	<br />
	
	<h3><?php echo GeneralLabel::perbelanjaan; ?></h3>
    
    <?php Pjax::begin(['id' => 'penyertaanSukanPerbelanjaanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenyertaanSukanPerbelanjaan,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'penyertaanSukanPerbelanjaanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => GeneralLabel::kategori,
                'attribute' => 'refKategoriPerbelanjaanSukan.desc',
            ],
			'perkara',
			[
                'label' => GeneralLabel::jumlah_permohonan,
                'attribute' => 'jumlah_pohon',
            ],
			[
                'label' => GeneralLabel::jumlah_cadang,
                'attribute' => 'jumlah_cadang',
            ],
			[
                'label' => GeneralLabel::jumlah_kelulusan.' (RM)',
                'attribute' => 'jumlah_lulus',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penyertaan-sukan-perbelanjaan/delete', 'id' => $model->penyertaan_sukan_perbelanjaan_id]).'", "'.GeneralMessage::confirmDelete.'", "penyertaanSukanPerbelanjaanGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-perbelanjaan/update', 'id' => $model->penyertaan_sukan_perbelanjaan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::perbelanjaan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-perbelanjaan/view', 'id' => $model->penyertaan_sukan_perbelanjaan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::perbelanjaan.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
	
	<?php 
        $jumlah_dipohon = 0.00;
        foreach($dataProviderPenyertaanSukanPerbelanjaan->models as $PBKmodel){
            $jumlah_dipohon += $PBKmodel->jumlah_pohon;
        }
    ?>
    
    <h4><?= GeneralLabel::jumlah_yang_dipohon ?> (RM): <?php echo number_format($jumlah_dipohon, 2);?></h4>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyertaan-sukan-perbelanjaan/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::perbelanjaan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>

    <br />
	
	<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['kelulusan']) || $readonly): ?>
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
                    'jkb_status_permohonan' => [
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
                    'jkb_jumlah_diluluskan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                ]
            ],
			[
                'columns'=>12,
                'autoGenerateColumns'=>false, // override columns setting
                'attributes' => [  
                   'bilangan_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    'tarikh_jkb' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=> DateControl::classname(),
                        'ajaxConversion'=>false,
                        'options'=>[
                            'pluginOptions' => [
                                'autoclose'=>true,
                            ]
                        ],
                    'columnOptions'=>['colspan'=>4]],
                ],
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
$URL = Url::to(['/perancangan-program/get-program']);
$URLGetKejohanan = Url::to(['/perancangan-program-plan/get-program-plan']);
$URLSetSukan = Url::to(['/penyertaan-sukan/set-sukan']);

$script = <<< JS
        
var sukan_Id = "";
        
$('#kejohananId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#penyertaansukan-tempat_penginapan').attr('value',data.lokasi);
            $("#penyertaansukan-tarikh_mula-disp").val(formatDisplayDate(data.tarikh_mula));
            $("#penyertaansukan-tarikh_mula").val(formatSaveDate(data.tarikh_mula));
            $("#penyertaansukan-tarikh_tamat-disp").val(formatDisplayDate(data.tarikh_tamat));
            $("#penyertaansukan-tarikh_tamat").val(formatSaveDate(data.tarikh_tamat));
        }
    });
    
});

$('#kejohananTemasya').on('select2:select', function (evt) {
    $.get('$URLGetKejohanan', {id:$(this).val()}, function(data){
        if(data !== null){
            $('#penyertaansukan-tempat_penginapan').val(data.tempat);
            // $('#sukanId').select2().val(data.sukan).trigger("change");
            // $('#programId').select2().val(data.jenis_program).trigger("change");
			$('#sukanId').val(data.sukan).trigger("change");
            $('#programId').val(data.program).trigger("change");
            $("#penyertaansukan-tarikh_mula-disp").val(formatDisplayDate(data.tarikh_mula));
            $("#penyertaansukan-tarikh_tamat-disp").val(formatDisplayDate(data.tarikh_tamat));
            $("#penyertaansukan-tarikh_mula").val(data.tarikh_mula);
            $("#penyertaansukan-tarikh_tamat").val(data.tarikh_tamat);
        }
    });
});
              
$('#sukanId').change(function(){
    setSukan();
});
        
function setSukan(){
    $.get('$URLSetSukan',{sukan_id:$('#sukanId').val()},function(data){
    });
}
     
function clearForm(){
    $('#penyertaansukan-tempat_penginapan').attr('value','');
        
    $("#penyertaansukan-tarikh_mula-disp").val('');
    $("#penyertaansukan-tarikh_mula").val('');
        
    $("#penyertaansukan-tarikh_tamat-disp").val('');
    $("#penyertaansukan-tarikh_tamat").val('');
}
        
$(document).ready(function(){
    setSukan();
});
        
JS;
        
$this->registerJs($script);
?>
