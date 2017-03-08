<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBank;
use app\models\ProfilBadanSukan;
use app\models\RefStatusBantuanPenganjuranKursus;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penganjuran-kursus-form">
    
    <?php 
    if($model->status_permohonan_id && $model->status_permohonan_id==RefStatusBantuanPenganjuranKursus::LULUS){
        echo Html::a('Laporan Teknikal & Kepegawaian', ['bantuan-penganjuran-kursus-pegawai-teknikal-laporan/load-bantuan-penganjuran', 'bantuan_penganjuran_kursus_id' =>$model->bantuan_penganjuran_kursus_id], ['class' => 'btn btn-warning', 'target' => '_blank']); 
        echo '<br><br>';
    }
    ?>

   <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
   <?php
    if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
   ?>
   
   <?php 
    $disablePersatuan = false; // default
    if(!Yii::$app->user->isGuest && Yii::$app->user->identity->profil_badan_sukan){
        $disablePersatuan = true;
    }
    ?>
   <?php $disablePersatuanInfo = true;?>
    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
   
   <?php //echo $form->errorSummary($model); ?>
    
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_badan_sukan_cap; ?></strong></pre>
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
               'badan_sukan' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/profil-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(GeneralFunction::getProfilBadanSukan(),'profil_badan_sukan', 'nama_badan_sukan'),
                        'options' => ['placeholder' => Placeholder::badanSukan, 'disabled'=>$disablePersatuan, 'id'=>'persatuanId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
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
                        'options' => ['placeholder' => Placeholder::sukan, 'disabled'=>$disablePersatuanInfo],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'no_pendaftaran' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
                 
            ],
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_negeri' => [
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
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri, 'disabled'=>$disablePersatuanInfo],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                            'disabled'=>$disablePersatuanInfo
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
                'no_faks' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'laman_sesawang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
                'facebook' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
                'twitter' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_bank' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bank/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBank::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bank],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'no_akaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
    ]
]);
        ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_kursus_seminar_bengkel_cap; ?></strong></pre>
    
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
                'nama_kursus_seminar_bengkel' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'tarikh' => [
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
            'attributes' => [
                'tempat' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'attributes' => [
                'tujuan' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'attributes' => [
                'bil_penceramah' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
                'bil_peserta' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
                'bil_urusetia' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'anggaran_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
    ]
]);
        ?>
    
    <?php // Upload
    if($model->kertas_kerja){
        echo "<label>" . $model->getAttributeLabel('kertas_kerja') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->kertas_kerja , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_id, 'field'=> 'kertas_kerja'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'kertas_kerja' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    if($model->surat_rasmi_badan_sukan_ms_negeri){
        echo "<label>" . $model->getAttributeLabel('surat_rasmi_badan_sukan_ms_negeri') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_rasmi_badan_sukan_ms_negeri , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_id, 'field'=> 'surat_rasmi_badan_sukan_ms_negeri'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'surat_rasmi_badan_sukan_ms_negeri' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    if($model->butiran_perbelanjaan){
        echo "<label>" . $model->getAttributeLabel('butiran_perbelanjaan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->butiran_perbelanjaan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_id, 'field'=> 'butiran_perbelanjaan'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'butiran_perbelanjaan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    if($model->maklumat_lain_sokongan){
        echo "<label>" . $model->getAttributeLabel('maklumat_lain_sokongan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->maklumat_lain_sokongan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_id, 'field'=> 'maklumat_lain_sokongan'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'maklumat_lain_sokongan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    
    
    <h3><?php echo GeneralLabel::senarai_nama_penceramah_yang_dicadangkan; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKursusPenceramahGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKursusPenceramah,
        //'filterModel' => $searchModelBantuanPenganjuranKursusPenceramah,
        'id' => 'bantuanPenganjuranKursusPenceramahGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_penceramah_id',
            //'bantuan_penganjuran_kursus_id',
            //'badan_sukan',
            //'sukan',
            'nama',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_kad_pengenalan',
            // 'umur',
            // 'no_passport',
            // 'jantina',
            // 'no_telefon',
            // 'alamat_e_mail',
            // 'tahap_kelayakan_sukan_peringkat_kebangsaan',
            // 'tahap_kelayakan_sukan_peringkat_antarabangsa',
             'nama_majikan',
            // 'no_telefon_majikan',
            // 'no_faks',
             'jawatan',
            // 'tahap_akademik',
            // 'gred',
            // 'nama_kejohanan_kursus',
            // 'tarikh_mula',
            // 'tarikh_tamat',
            // 'tempat',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kursus-penceramah/delete', 'id' => $model->bantuan_penganjuran_kursus_penceramah_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKursusPenceramahGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-penceramah/update', 'id' => $model->bantuan_penganjuran_kursus_penceramah_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::senarai_nama_penceramah_yang_dicadangkan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-penceramah/view', 'id' => $model->bantuan_penganjuran_kursus_penceramah_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::senarai_nama_penceramah_yang_dicadangkan.'");',
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
        $bantuan_penganjuran_kursus_id = "";
        
        if(isset($model->bantuan_penganjuran_kursus_id)){
            $bantuan_penganjuran_kursus_id = $model->bantuan_penganjuran_kursus_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-penceramah/create', 'bantuan_penganjuran_kursus_id' => $bantuan_penganjuran_kursus_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::senarai_nama_penceramah_yang_dicadangkan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::maklumat_kursus_seminar_bengkel_yang_telah_disertai_oleh_penceramah; ?></h3>
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKursusDisertaiPenceramahGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKursusDisertaiPenceramah,
        //'filterModel' => $searchModelBantuanPenganjuranKursusDisertaiPenceramah,
        'id' => 'bantuanPenganjuranKursusDisertaiPenceramahGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_disertai_penceramah_id',
            //'bantuan_penganjuran_kursus_id',
            'kursus_seminar_bengkel',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'anjuran',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kursus-disertai-penceramah/delete', 'id' => $model->bantuan_penganjuran_kursus_disertai_penceramah_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKursusDisertaiPenceramahGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-disertai-penceramah/update', 'id' => $model->bantuan_penganjuran_kursus_disertai_penceramah_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::maklumat_kursus_seminar_bengkel_yang_telah_disertai_oleh_penceramah.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-disertai-penceramah/view', 'id' => $model->bantuan_penganjuran_kursus_disertai_penceramah_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::maklumat_kursus_seminar_bengkel_yang_telah_disertai_oleh_penceramah.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-disertai-penceramah/create', 'bantuan_penganjuran_kursus_id' => $bantuan_penganjuran_kursus_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::maklumat_kursus_seminar_bengkel_yang_telah_disertai_oleh_penceramah.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::bantuan_geran_penganjuran_kursus_seminar_bengkel_oleh_msn_tahun_semasa_tahun_sebelum; ?></h3>
    
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKursusOlehMsnGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKursusOlehMsn,
        //'filterModel' => $searchModelBantuanPenganjuranKursusOlehMsn,
        'id' => 'bantuanPenganjuranKursusOlehMsnGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_oleh_msn_id',
            //'bantuan_penganjuran_kursus_id',
            'kursus_seminar_bengkel',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'jumlah_bantuan',
            //'laporan_dikemukakan',
            [
                'attribute' => 'laporan_dikemukakan',
                'value' => 'refKelulusan.desc'
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kursus-oleh-msn/delete', 'id' => $model->bantuan_penganjuran_kursus_oleh_msn_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKursusOlehMsnGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-oleh-msn/update', 'id' => $model->bantuan_penganjuran_kursus_oleh_msn_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::bantuan_geran_penganjuran_kursus_seminar_bengkel_oleh_msn_tahun_semasa_tahun_sebelum.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-oleh-msn/view', 'id' => $model->bantuan_penganjuran_kursus_oleh_msn_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::bantuan_geran_penganjuran_kursus_seminar_bengkel_oleh_msn_tahun_semasa_tahun_sebelum.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-oleh-msn/create', 'bantuan_penganjuran_kursus_id' => $bantuan_penganjuran_kursus_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::bantuan_geran_penganjuran_kursus_seminar_bengkel_oleh_msn_tahun_semasa_tahun_sebelum.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?php echo GeneralLabel::jumlah_bantuan_yang_dipohon_cap; ?></strong>
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
                'jumlah_bantuan_yang_dipohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                 
            ],
        ],
    ]
]);
        ?>
                </div>
            </div>
    
    <hr>
    <?php
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kursus']['kelulusan'])){
        echo '<br>
                <pre style="text-align: center"><strong>'.GeneralLabel::kegunaan_msn.'</strong></pre>';
        
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-bantuan-penganjuran-kursus/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusBantuanPenganjuranKursus::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'tarikh_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
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
                'catatan' =>  ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_dilulus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
               'jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'tarikh_jkb' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
            ]
        ]);
        
        
        
        if($model->surat_kelulusan){
        echo "<label>" . $model->getAttributeLabel('surat_kelulusan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_kelulusan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_id, 'field'=> 'surat_kelulusan'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'surat_kelulusan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
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
$URL = Url::to(['/profil-badan-sukan/get-badan-sukan']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS

$.fn.modal.Constructor.prototype.enforceFocus = function () {};
 
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#bantuanpenganjurankursus-sukan").prop("disabled", false);
    $("#bantuanpenganjurankursus-alamat_negeri").prop("disabled", false);
    $("#bantuanpenganjurankursus-alamat_bandar").prop("disabled", false);
    //$("#bantuanpenganjurankursus-nama_bank").prop("disabled", false);
});
        
$('#persatuanId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#bantuanpenganjurankursus-sukan').val(data.jenis_sukan).trigger("change");
            $('#bantuanpenganjurankursus-no_pendaftaran').attr('value',data.no_pendaftaran);
            $('#bantuanpenganjurankursus-alamat_1').attr('value',data.alamat_tetap_badan_sukan_1);
            $('#bantuanpenganjurankursus-alamat_2').attr('value',data.alamat_tetap_badan_sukan_2);
            $('#bantuanpenganjurankursus-alamat_3').attr('value',data.alamat_tetap_badan_sukan_3);
            $('#bantuanpenganjurankursus-alamat_negeri').val(data.alamat_tetap_badan_sukan_negeri).trigger("change");
            $('#bantuanpenganjurankursus-alamat_bandar').val(data.alamat_tetap_badan_sukan_bandar).trigger("change");
            $('#bantuanpenganjurankursus-alamat_poskod').attr('value',data.alamat_tetap_badan_sukan_poskod);
            $('#bantuanpenganjurankursus-no_telefon').attr('value',data.no_telefon_pejabat);
            $('#bantuanpenganjurankursus-no_faks').attr('value',data.no_faks_pejabat);
        }
    });
});
     
function clearForm(){
    $('#bantuanpenganjurankursus-sukan').val('').trigger("change");
    $('#bantuanpenganjurankursus-no_pendaftaran').attr('value','');
    $('#bantuanpenganjurankursus-alamat_1').attr('value','');
    $('#bantuanpenganjurankursus-alamat_2').attr('value','');
    $('#bantuanpenganjurankursus-alamat_3').attr('value','');
    $('#bantuanpenganjurankursus-alamat_negeri').val('').trigger("change");
    $('#bantuanpenganjurankursus-alamat_bandar').val('').trigger("change");
    $('#bantuanpenganjurankursus-alamat_poskod').attr('value','');
    $('#bantuanpenganjurankursus-no_telefon').attr('value','');
    $('#bantuanpenganjurankursus-no_faks').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
