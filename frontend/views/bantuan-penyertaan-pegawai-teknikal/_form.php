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
use app\models\RefStatusBantuanPenyertaanPegawaiTeknikal;
use app\models\RefPeringkatBantuanPenyertaanPegawaiTeknikal;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penyertaan-pegawai-teknikal-form">
    
    <?php 
    if($model->status_permohonan_id && $model->status_permohonan_id==RefStatusBantuanPenyertaanPegawaiTeknikal::LULUS){
        echo Html::a('Laporan Teknikal & Kepegawaian', ['bantuan-penganjuran-kursus-pegawai-teknikal-laporan/load-bantuan-penyertaan', 'bantuan_penyertaan_pegawai_teknikal_id' =>$model->bantuan_penyertaan_pegawai_teknikal_id], ['class' => 'btn btn-warning', 'target' => '_blank']); 
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

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php $disablePersatuanInfo = true;?>
    <pre style="text-align: center"><strong>MAKLUMAT BADAN SUKAN</strong></pre>
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
                        'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
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
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                            'disabled'=>$disablePersatuanInfo,
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
                        'data'=>ArrayHelper::map(RefBank::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
    <pre style="text-align: center"><strong>MAKLUMAT KEJOHANAN</strong></pre>
    
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
                'nama_kejohanan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'peringkat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peringkat-bantuan-penyertaan-pegawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeringkatBantuanPenyertaanPegawaiTeknikal::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkat],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'peringkat_lain_lain' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
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
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                'negara' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'attributes' => [
                'tujuan' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
    ]
]);
        ?>
    
    <?php // Upload
    if($model->surat_rasmi_badan_sukan_ms_negeri){
        echo "<label>" . $model->getAttributeLabel('surat_rasmi_badan_sukan_ms_negeri') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_rasmi_badan_sukan_ms_negeri , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penyertaan_pegawai_teknikal_id, 'field'=> 'surat_rasmi_badan_sukan_ms_negeri'], 
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
    if($model->surat_jemputan_lantikan_daripada_pengelola){
        echo "<label>" . $model->getAttributeLabel('surat_jemputan_lantikan_daripada_pengelola') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_jemputan_lantikan_daripada_pengelola , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penyertaan_pegawai_teknikal_id, 'field'=> 'surat_jemputan_lantikan_daripada_pengelola'], 
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
                        'surat_jemputan_lantikan_daripada_pengelola' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
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
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penyertaan_pegawai_teknikal_id, 'field'=> 'butiran_perbelanjaan'], 
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
    if($model->salinan_passport){
        echo "<label>" . $model->getAttributeLabel('salinan_passport') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_passport , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penyertaan_pegawai_teknikal_id, 'field'=> 'salinan_passport'], 
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
                        'salinan_passport' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
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
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penyertaan_pegawai_teknikal_id, 'field'=> 'maklumat_lain_sokongan'], 
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
    
    <h3>Senarai Nama Pegawai Teknikal Yang Dicadangkan</h3>
    
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
    
    <?php Pjax::begin(['id' => 'bantuanPenyertaanPegawaiTeknikalDicadangkanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenyertaanPegawaiTeknikalDicadangkan,
        //'filterModel' => $searchModelBantuanPenyertaanPegawaiTeknikalDicadangkan,
        'id' => 'bantuanPenyertaanPegawaiTeknikalDicadangkanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_penceramah_id',
            //'bantuan_penyertaan_pegawai_teknikal_id',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-dicadangkan/delete', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenyertaanPegawaiTeknikalDicadangkanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-dicadangkan/update', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id]).'", "'.GeneralLabel::updateTitle . ' Nama Pegawai Teknikal Yang Dicadangkan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-dicadangkan/view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id]).'", "'.GeneralLabel::viewTitle . ' Nama Pegawai Teknikal Yang Dicadangkan");',
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
        $bantuan_penyertaan_pegawai_teknikal_id = "";
        
        if(isset($model->bantuan_penyertaan_pegawai_teknikal_id)){
            $bantuan_penyertaan_pegawai_teknikal_id = $model->bantuan_penyertaan_pegawai_teknikal_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-dicadangkan/create', 'bantuan_penyertaan_pegawai_teknikal_id' => $bantuan_penyertaan_pegawai_teknikal_id]).'", "Nama Pegawai Teknikal Yang Dicadangkan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <!--<h3>Maklumat Kejohanan Yang Telah Disertai Oleh Pegawai Yang Dicadangkan Di Atas (Tahun Semasa & Tahun Sebelum)</h3>-->
    <h3>Maklumat Kejohanan Yang Telah Disertai Oleh Pegawai</h3>
    
    <?php Pjax::begin(['id' => 'bantuanPenyertaanPegawaiTeknikalDisertaiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenyertaanPegawaiTeknikalDisertai,
        //'filterModel' => $searchModelBantuanPenyertaanPegawaiTeknikalDisertai,
        'id' => 'bantuanPenyertaanPegawaiTeknikalDisertaiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penyertaan_pegawai_teknikal_dicadangkan_id',
            //'bantuan_penyertaan_pegawai_teknikal_id',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-disertai/delete', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenyertaanPegawaiTeknikalDisertaiGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-disertai/update', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id]).'", "'.GeneralLabel::updateTitle . ' Maklumat Kejohanan Yang Telah Disertai Oleh Pegawai Yang Dicadangkan Di Atas (Tahun Semasa & Tahun Sebelum)");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-disertai/view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_dicadangkan_id]).'", "'.GeneralLabel::viewTitle . ' Maklumat Kejohanan Yang Telah Disertai Oleh Pegawai Yang Dicadangkan Di Atas (Tahun Semasa & Tahun Sebelum)");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-disertai/create', 'bantuan_penyertaan_pegawai_teknikal_id' => $bantuan_penyertaan_pegawai_teknikal_id]).'", "'.GeneralLabel::createTitle . ' Maklumat Kejohanan Yang Telah Disertai Oleh Pegawai Yang Dicadangkan Di Atas (Tahun Semasa & Tahun Sebelum)");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3>Bantuan Penyertaan Pegawai Teknikal Ke Kejohanan Dalam Dan Luar Negara Oleh MSN (Tahun Semasa & Tahun Sebelum)</h3>
    
    
    <?php Pjax::begin(['id' => 'bantuanPenyertaanPegawaiTeknikalOlehMsnGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenyertaanPegawaiTeknikalOlehMsn,
        //'filterModel' => $searchModelBantuanPenyertaanPegawaiTeknikalOlehMsn,
        'id' => 'bantuanPenyertaanPegawaiTeknikalOlehMsnGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penyertaan_pegawai_teknikal_oleh_msn_id',
            //'bantuan_penyertaan_pegawai_teknikal_id',
            'kejohanan',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'jumlah_bantuan',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-oleh-msn/delete', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenyertaanPegawaiTeknikalOlehMsnGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-oleh-msn/update', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id]).'", "'.GeneralLabel::updateTitle . ' Bantuan Penyertaan Pegawai Teknikal Ke Kejohanan Dalam Dan Luar Negara Oleh MSN (Tahun Semasa & Tahun Sebelum)");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-oleh-msn/view', 'id' => $model->bantuan_penyertaan_pegawai_teknikal_oleh_msn_id]).'", "'.GeneralLabel::viewTitle . ' Bantuan Penyertaan Pegawai Teknikal Ke Kejohanan Dalam Dan Luar Negara Oleh MSN (Tahun Semasa & Tahun Sebelum)");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penyertaan-pegawai-teknikal-oleh-msn/create', 'bantuan_penyertaan_pegawai_teknikal_id' => $bantuan_penyertaan_pegawai_teknikal_id]).'", "'.GeneralLabel::createTitle . ' Bantuan Penyertaan Pegawai Teknikal Ke Kejohanan Dalam Dan Luar Negara Oleh MSN (Tahun Semasa & Tahun Sebelum)");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>JUMLAH BANTUAN YANG DIPOHON</strong>
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
    
    <?php
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penyertaan-pegawai-teknikal']['kelulusan'])){
        echo '<br>
            <hr>
                <pre style="text-align: center"><strong>KEGUNAAN MSN</strong></pre>';
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-bantuan-penyertaan-pegawai-teknikal/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusBantuanPenyertaanPegawaiTeknikal::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
            ]
        ]);
    }
    ?>
    

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
    $("#bantuanpenyertaanpegawaiteknikal-sukan").prop("disabled", false);
    $("#bantuanpenyertaanpegawaiteknikal-alamat_negeri").prop("disabled", false);
    $("#bantuanpenyertaanpegawaiteknikal-alamat_bandar").prop("disabled", false);
    //$("#bantuanpenganjurankejohanan-nama_bank").prop("disabled", false);
});
        
$('#persatuanId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#bantuanpenyertaanpegawaiteknikal-sukan').val(data.jenis_sukan).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikal-no_pendaftaran').attr('value',data.no_pendaftaran);
            $('#bantuanpenyertaanpegawaiteknikal-alamat_1').attr('value',data.alamat_tetap_badan_sukan_1);
            $('#bantuanpenyertaanpegawaiteknikal-alamat_2').attr('value',data.alamat_tetap_badan_sukan_2);
            $('#bantuanpenyertaanpegawaiteknikal-alamat_3').attr('value',data.alamat_tetap_badan_sukan_3);
            $('#bantuanpenyertaanpegawaiteknikal-alamat_negeri').val(data.alamat_tetap_badan_sukan_negeri).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikal-alamat_bandar').val(data.alamat_tetap_badan_sukan_bandar).trigger("change");
            $('#bantuanpenyertaanpegawaiteknikal-alamat_poskod').attr('value',data.alamat_tetap_badan_sukan_poskod);
            $('#bantuanpenyertaanpegawaiteknikal-no_telefon').attr('value',data.no_telefon_pejabat);
            $('#bantuanpenyertaanpegawaiteknikal-no_faks').attr('value',data.no_faks_pejabat);
        }
    });
});
     
function clearForm(){
    $('#bantuanpenyertaanpegawaiteknikal-sukan').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikal-no_pendaftaran').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikal-alamat_1').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikal-alamat_2').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikal-alamat_3').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikal-alamat_negeri').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikal-alamat_bandar').val('').trigger("change");
    $('#bantuanpenyertaanpegawaiteknikal-alamat_poskod').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikal-no_telefon').attr('value','');
    $('#bantuanpenyertaanpegawaiteknikal-no_faks').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
