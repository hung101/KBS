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
use app\models\RefPeringkatBantuanPenganjuranKejohanan;
use app\models\ProfilBadanSukan;
use app\models\RefStatusBantuanPenganjuranKejohanan;
use app\models\UserPeranan;
use common\models\User;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkit */
/* @var $form yii\widgets\ActiveForm */

// auto populate info if is PPN login
$disable_ppn_info = false;

if(Yii::$app->user->identity->peranan && Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_PPN && !$readonly){
    //$model->nama_pengurus_sukan = Yii::$app->user->identity->id;
    //$model->nama_sukan = Yii::$app->user->identity->ppn_sukan;
    $model->negeri_penyertaan = Yii::$app->user->identity->ppn_negeri;
    
    $disable_ppn_info = true;
}
?>

<div class="bantuan-penganjuran-kejohanan-sirkit-form">
    
    <?php 
    //if($model->status_permohonan_id && $model->status_permohonan_id==RefStatusBantuanPenganjuranKejohanan::LULUS){
    if($model->status_permohonan_id && $model->status_permohonan_id==RefStatusBantuanPenganjuranKejohanan::LULUS &&
        ((isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan-sirkit']['kelulusan']) && $model->laporan_hantar_flag == 1) ||
        !isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan-sirkit']['kelulusan']))){
        echo Html::a('Laporan Penyertaan Kejohanan', ['bantuan-penganjuran-kejohanan-sirkit-laporan/load', 'bantuan_penganjuran_kejohanan_id' =>$model->bantuan_penganjuran_kejohanan_id], ['class' => 'btn btn-warning', 'target' => '_blank']); 
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
    <?php //echo $form->errorSummary($model); ?>
    <!--<pre style="text-align: center"><strong>MAKLUMAT BADAN SUKAN</strong></pre>-->
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
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],
                'no_pendaftaran' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                 
            ],
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
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
                        'options' => ['placeholder' => Placeholder::negeri],
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
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'no_faks' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'laman_sesawang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                'facebook' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                'twitter' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
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
]);*/
        ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_penyertaan_cap; ?></strong></pre>
    
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
                'nama_kejohanan_pertandingan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                'peringkat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peringkat-bantuan-penganjuran-kejohanan-sirkit/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeringkatBantuanPenganjuranKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkat],
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
                        'options' => ['placeholder' => Placeholder::sukan, 'disabled'=>$disable_ppn_info],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],      */          
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'negeri_penyertaan' => [
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
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>false]],
                'tujuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>false]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bil_pasukan' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'bil_peserta' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                //'bil_pengadil_hakim' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bil_pegawai_teknikal' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'bilangan_pembantu' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'anggaran_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>10]],
            ]
        ],
    ]
]);
        ?>
    
    <?php // Upload
    
    /*$label = $model->getAttributeLabel('kertas_kerja');
    
    if($model->kertas_kerja){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('kertas_kerja') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->kertas_kerja , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'kertas_kerja' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }*/
        
    ?>
    
    <?php // Upload
    
    /*$label = $model->getAttributeLabel('surat_rasmi_badan_sukan_ms_negeri');
    
    if($model->surat_rasmi_badan_sukan_ms_negeri){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('surat_rasmi_badan_sukan_ms_negeri') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_rasmi_badan_sukan_ms_negeri , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'surat_rasmi_badan_sukan_ms_negeri' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }*/
        
    ?>
    
    <?php // Upload
    /*if($model->kertas_kerja){
        echo "<label>" . $model->getAttributeLabel('kertas_kerja') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->kertas_kerja , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kejohanan_id, 'field'=> 'kertas_kerja'], 
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
    }*/
    ?>
    
    <?php // Upload
    /*if($model->surat_rasmi_badan_sukan_ms_negeri){
        echo "<label>" . $model->getAttributeLabel('surat_rasmi_badan_sukan_ms_negeri') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_rasmi_badan_sukan_ms_negeri , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kejohanan_id, 'field'=> 'surat_rasmi_badan_sukan_ms_negeri'], 
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
    }*/
    ?>
    
    
    <?php // Upload
    /*if($model->permohonan_rasmi_dari_ahli_gabungan){
        echo "<label>" . $model->getAttributeLabel('permohonan_rasmi_dari_ahli_gabungan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->permohonan_rasmi_dari_ahli_gabungan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kejohanan_id, 'field'=> 'permohonan_rasmi_dari_ahli_gabungan'], 
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
                        'permohonan_rasmi_dari_ahli_gabungan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }*/
    ?>
    
    
    <?php // Upload
    /*if($model->maklumat_lain_sokongan){
        echo "<label>" . $model->getAttributeLabel('maklumat_lain_sokongan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->maklumat_lain_sokongan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kejohanan_id, 'field'=> 'maklumat_lain_sokongan'], 
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
    }*/
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
    
    <h3><?php echo GeneralLabel::sukan; ?></h3>
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKejohananSirkitSukanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKejohananSirkitSukan,
        //'filterModel' => $searchModelBantuanPenganjuranKejohananSirkitSukan,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'bantuanPenganjuranKejohananSirkitSukanGrid',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-sukan/delete', 'id' => $model->bantuan_penganjuran_kejohanan_sirkit_sukan_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKejohananSirkitSukanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-sukan/update', 'id' => $model->bantuan_penganjuran_kejohanan_sirkit_sukan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::sukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-sukan/view', 'id' => $model->bantuan_penganjuran_kejohanan_sirkit_sukan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::sukan.'");',
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
        $bantuan_penganjuran_kejohanan_id = "";
        
        if(isset($model->bantuan_penganjuran_kejohanan_id)){
            $bantuan_penganjuran_kejohanan_id = $model->bantuan_penganjuran_kejohanan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-sukan/create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::sukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <h3><?php echo GeneralLabel::sumber_sumber_kewangan_lain_untuk_kejohanan_pertandingan; ?></h3>

    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKejohananKewanganGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKejohananSirkitKewangan,
        //'filterModel' => $searchModelBantuanPenganjuranKejohananSirkitKewangan,
        'id' => 'bantuanPenganjuranKejohananKewanganGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kejohanan_kewangan_id',
            //'bantuan_penganjuran_kejohanan_id',
            //'sumber_kewangan',
            [
                'attribute' => 'sumber_kewangan',
                'value' => 'refSumberKewanganBantuanPenganjuranKejohanan.desc'
            ],
            'lain_lain',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-kewangan/delete', 'id' => $model->bantuan_penganjuran_kejohanan_kewangan_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKejohananKewanganGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-kewangan/update', 'id' => $model->bantuan_penganjuran_kejohanan_kewangan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::sumber_sumber_kewangan_lain_untuk_kejohanan_pertandingan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-kewangan/view', 'id' => $model->bantuan_penganjuran_kejohanan_kewangan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::sumber_sumber_kewangan_lain_untuk_kejohanan_pertandingan.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $jumlah_sumber_kewangan = 0.00;
        foreach($dataProviderBantuanPenganjuranKejohananSirkitKewangan->models as $PTLmodel){
            $jumlah_sumber_kewangan += $PTLmodel->jumlah;
        }
    ?>
    
    <h4>Jumlah: RM <?=$jumlah_sumber_kewangan?></h4>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-kewangan/create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::sumber_sumber_kewangan_lain_untuk_kejohanan_pertandingan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::bayaran_penyertaan_kejohanan_pertandingan_yang_dikenakan_kepada_peserta_pasukan; ?></h3>
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKejohananBayaranGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKejohananSirkitBayaran,
        //'filterModel' => $searchModelBantuanPenganjuranKejohananSirkitBayaran,
        'id' => 'bantuanPenganjuranKejohananBayaranGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kejohanan_bayaran_id',
            //'bantuan_penganjuran_kejohanan_id',
            //'jenis_bayaran',
            [
                'attribute' => 'jenis_bayaran',
                'value' => 'refJenisBayaranBantuanPenganjuranKejohanan.desc'
            ],
            'lain_lain',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-bayaran/delete', 'id' => $model->bantuan_penganjuran_kejohanan_bayaran_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKejohananBayaranGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-bayaran/update', 'id' => $model->bantuan_penganjuran_kejohanan_bayaran_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::bayaran_penyertaan_kejohanan_pertandingan_yang_dikenakan_kepada_peserta_pasukan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-bayaran/view', 'id' => $model->bantuan_penganjuran_kejohanan_bayaran_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::bayaran_penyertaan_kejohanan_pertandingan_yang_dikenakan_kepada_peserta_pasukan.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $jumlah_bayaran = 0.00;
        foreach($dataProviderBantuanPenganjuranKejohananSirkitBayaran->models as $PTLmodel){
            $jumlah_bayaran += $PTLmodel->jumlah;
        }
    ?>
    
    <h4>Jumlah: RM <?=$jumlah_bayaran?></h4>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-bayaran/create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::bayaran_penyertaan_kejohanan_pertandingan_yang_dikenakan_kepada_peserta_pasukan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3><?php echo GeneralLabel::anggaran_perbelanjaan_penganjuran; ?></h3>
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKejohananElemenGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKejohananSirkitElemen,
        //'filterModel' => $searchModelBantuanPenganjuranKejohananSirkitElemen,
        'id' => 'bantuanPenganjuranKejohananElemenGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kejohanan_elemen_id',
            //'bantuan_penganjuran_kejohanan_id',
            //'elemen_bantuan',
            [
                'attribute' => 'elemen_bantuan',
                'value' => 'refElemenBantuanPenganjuranKejohanan.desc'
            ],
            //'sub_elemen',
            [
                'attribute' => 'sub_elemen',
                'value' => 'refSubElemenBantuanPenganjuranKejohanan.desc'
            ],
            'kadar',
            'bilangan',
            'hari',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-elemen/delete', 'id' => $model->bantuan_penganjuran_kejohanan_elemen_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKejohananElemenGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-elemen/update', 'id' => $model->bantuan_penganjuran_kejohanan_elemen_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::anggaran_perbelanjaan_penganjuran.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-elemen/view', 'id' => $model->bantuan_penganjuran_kejohanan_elemen_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::anggaran_perbelanjaan_penganjuran.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $jumlah_elemen = 0.00;
        foreach($dataProviderBantuanPenganjuranKejohananSirkitElemen->models as $PTLmodel){
            $jumlah_elemen += $PTLmodel->jumlah;
        }
    ?>
    
    <h4>Jumlah: RM <?=$jumlah_elemen?></h4>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-elemen/create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::anggaran_perbelanjaan_penganjuran.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::kejohanan_yang_telah_dianjurkan_tahun_semasa_tahun_sebelum; ?></strong></pre>
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKejohananDianjurkanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKejohananSirkitDianjurkan,
        //'filterModel' => $searchModelBantuanPenganjuranKejohananSirkitDianjurkan,
        'id' => 'bantuanPenganjuranKejohananDianjurkanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kejohanan_dianjurkan_id',
            //'bantuan_penganjuran_kejohanan_id',
            'kejohanan',
            [
                'attribute' => 'tarikh_mula',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'tarikh_tamat',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);
                },
            ],
            'tempat',
            //'peringkat_penganjuran',
            [
                'attribute' => 'peringkat_penganjuran',
                'value' => 'refPeringkatBantuanPenganjuranKejohananDianjurkan.desc'
            ],
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-dianjurkan/delete', 'id' => $model->bantuan_penganjuran_kejohanan_dianjurkan_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKejohananDianjurkanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-dianjurkan/update', 'id' => $model->bantuan_penganjuran_kejohanan_dianjurkan_id]).'", "'.GeneralLabel::updateTitle . ' Kejohanan Yang Telah Dianjurkan (Tahun Semasa & Tahun Sebelum)");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-dianjurkan/view', 'id' => $model->bantuan_penganjuran_kejohanan_dianjurkan_id]).'", "'.GeneralLabel::viewTitle . ' Kejohanan Yang Telah Dianjurkan (Tahun Semasa & Tahun Sebelum)");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-dianjurkan/create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]).'", "Kejohanan Yang Telah Dianjurkan (Tahun Semasa & Tahun Sebelum)");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::bantuan_geran_penganjuran_oleh_msn_tahun_semasa_tahun_sebelum; ?></strong></pre>
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKejohananOlehMsnGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKejohananSirkitOlehMsn,
        //'filterModel' => $searchModelBantuanPenganjuranKejohananSirkitOlehMsn,
        'id' => 'bantuanPenganjuranKejohananOlehMsnGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kejohanan_oleh_msn_id',
            //'bantuan_penganjuran_kejohanan_id',
            'kejohanan',
            [
                'attribute' => 'tarikh_mula',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'tarikh_tamat',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);
                },
            ],
            'tempat',
            //'peringkat_penganjuran',
            [
                'attribute' => 'peringkat_penganjuran',
                'value' => 'refPeringkatBantuanPenganjuranKejohananDianjurkan.desc'
            ],
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-oleh-msn/delete', 'id' => $model->bantuan_penganjuran_kejohanan_oleh_msn_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKejohananOlehMsnGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-oleh-msn/update', 'id' => $model->bantuan_penganjuran_kejohanan_oleh_msn_id]).'", "'.GeneralLabel::updateTitle . ' Bantuan Geran Penganjuran Oleh MSN (Tahun Semasa & Tahun Sebelum)");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-oleh-msn/view', 'id' => $model->bantuan_penganjuran_kejohanan_oleh_msn_id]).'", "'.GeneralLabel::viewTitle . ' Bantuan Geran Penganjuran Oleh MSN (Tahun Semasa & Tahun Sebelum)");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kejohanan-sirkit-oleh-msn/create', 'bantuan_penganjuran_kejohanan_id' => $bantuan_penganjuran_kejohanan_id]).'", "'.GeneralLabel::createTitle . ' Bantuan Geran Penganjuran Oleh MSN (Tahun Semasa & Tahun Sebelum)");',
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
                'jumlah_bantuan_yang_dipohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
                 
            ],
        ],
    ]
]);
        ?>
                </div>
            </div>
    
    <hr>
    <?php
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['bantuan-penganjuran-kejohanan-sirkit']['kelulusan']) || $readonly){
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-bantuan-penganjuran-kejohanan-sirkit/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusBantuanPenganjuranKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
                'catatan' =>  ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_dilulus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
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
 
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#bantuanpenganjurankejohanansirkit-negeri_penyertaan").prop("disabled", false);
});
        
$('#persatuanId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#bantuanpenganjurankejohanansirkit-sukan').val(data.jenis_sukan).trigger("change");
            $('#bantuanpenganjurankejohanansirkit-no_pendaftaran').attr('value',data.no_pendaftaran);
            $('#bantuanpenganjurankejohanansirkit-alamat_1').attr('value',data.alamat_tetap_badan_sukan_1);
            $('#bantuanpenganjurankejohanansirkit-alamat_2').attr('value',data.alamat_tetap_badan_sukan_2);
            $('#bantuanpenganjurankejohanansirkit-alamat_3').attr('value',data.alamat_tetap_badan_sukan_3);
            $('#bantuanpenganjurankejohanansirkit-alamat_negeri').val(data.alamat_tetap_badan_sukan_negeri).trigger("change");
            $('#bantuanpenganjurankejohanansirkit-alamat_bandar').val(data.alamat_tetap_badan_sukan_bandar).trigger("change");
            $('#bantuanpenganjurankejohanansirkit-alamat_poskod').attr('value',data.alamat_tetap_badan_sukan_poskod);
            $('#bantuanpenganjurankejohanansirkit-no_telefon').attr('value',data.no_telefon_pejabat);
            $('#bantuanpenganjurankejohanansirkit-no_faks').attr('value',data.no_faks_pejabat);
        }
    });
});
     
function clearForm(){
    $('#bantuanpenganjurankejohanansirkit-sukan').val('').trigger("change");
    $('#bantuanpenganjurankejohanansirkit-no_pendaftaran').attr('value','');
    $('#bantuanpenganjurankejohanansirkit-alamat_1').attr('value','');
    $('#bantuanpenganjurankejohanansirkit-alamat_2').attr('value','');
    $('#bantuanpenganjurankejohanansirkit-alamat_3').attr('value','');
    $('#bantuanpenganjurankejohanansirkit-alamat_negeri').val('').trigger("change");
    $('#bantuanpenganjurankejohanansirkit-alamat_bandar').val('').trigger("change");
    $('#bantuanpenganjurankejohanansirkit-alamat_poskod').attr('value','');
    $('#bantuanpenganjurankejohanansirkit-no_telefon').attr('value','');
    $('#bantuanpenganjurankejohanansirkit-no_faks').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>

