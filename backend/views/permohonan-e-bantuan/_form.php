<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

// table reference
use app\models\RefKategoriPersatuan;
use app\models\RefKategoriProgram;
use app\models\RefSokongan;
use app\models\RefBank;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefLaporanEBantuan;
use app\models\RefNegeriSokonganEBantuan;
use app\models\RefKelulusanHqEBantuan;
use app\models\RefStatusPermohonanEBantuan;
use app\models\RefPeringkatProgram;
use app\models\RefPejabatYangMendaftarkan;
use app\models\RefParlimen;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
        
        $disablePersatuanInfo = false;
        
        if($model->profil_badan_sukan_id && $model->profil_badan_sukan_id > 0){
            $disablePersatuanInfo = true;
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php
        if(($model->kelulusan_id && $model->kelulusan_id == RefKelulusanHqEBantuan::STATUS_LULUS) || ($model->negeri_sokongan_id && $model->negeri_sokongan_id == RefNegeriSokonganEBantuan::STATUS_LULUS)):
    ?>
    
    <div class="alert alert-success">
        <strong>Tahniah!</strong> Dimaklumkan permohonan anda telah diluluskan. Surat kelulusan 
akan dihantar ke alamat surat menyurat. Sila muat turun borang Surat Setuju Terima (PB-4) dan 
kemukakan kepada urus setia dalam tempoh 14 hari dari tarikh penerimaan surat kelulusan untuk 
tujuan penyelarasan dan pembayaran. Kegagalan mengemukakan dokumen tersebut di dalam tempoh yang 
ditetapkan akan menyebabkan kelulusan ini terbatal.
        <?php //echo '&nbsp;&nbsp;' . Html::a('Muat Turun PB-4', 'javascript:void(0);', ['class'=>'btn btn-warning', 'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/downloads/permohonan-e-bantuan/pb4.pdf");']);?>
        <?= Html::a('Muat Turun PB-4', ['print', 'id' => $model->permohonan_e_bantuan_id, 'template' => 'SURAT_SETUJU_TERIMA_BANTUAN'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </div>
    
    <div class="alert alert-warning">
            <strong>Perhatian - </strong> Sila muat turun borang Laporan Pelaksanaan Program (PB-6) dan 
penyata perbelanjaan seperti dilampir yang berkaitan dengan program yang dilaksanakan dibawah 
peruntukan ini sama ada dalam bentuk resit pembelian barangan yang lengkap, bil terperinci 
(itemised bill), laporan program, gambar program atau lain-lain bentuk laporan yang disahkan yang 
menggambarkan penggunaan peruntukan ini secara sah, berhemah dan berintegriti. Dokumen tersebut 
perlu dikemukakan kepada urus setia Pengurusan Pemberian Bantuan JBSN dan muat naik dalam tempoh 
14 hari selepas program dijalankan atau 14 hari selepas peruntukan bantuan ini dikeluarkan, yang 
mana terdahulu. &nbsp;&nbsp;<?= Html::a('Muat Turun PB-6', ['print', 'id' => $model->permohonan_e_bantuan_id, 'template' => 'LAPORAN_PELAKSANAAN_PROGRAM'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>&nbsp;&nbsp;<?= Html::a('Isi e-Laporan', ['elaporan-pelaksanaan/load', 'permohonan_e_bantuan_id' => $model->permohonan_e_bantuan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?><?php //echo '&nbsp;&nbsp;' . Html::a('Muat Turun PB-6', 'javascript:void(0);', ['class'=>'btn btn-warning', 'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/downloads/permohonan-e-bantuan/pb6.pdf");']);?>
    </div>
    
    <?php
        endif;
    ?>
    
    <?php
    if($readonly){
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'ebantuan_id' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ]
        ],
    ]
]);
    }
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
                 //'ebantuan_id' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'nama_pertubuhan_persatuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80, 'disabled'=>$disablePersatuanInfo]],
                'kategori_persatuan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKategoriPersatuan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriPersatuan, 'disabled'=>$disablePersatuanInfo],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'kategori_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKategoriProgram::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriProgram, 'disabled'=>$disablePersatuanInfo],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'peringkat_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefPeringkatProgram::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkatProgram, 'disabled'=>$disablePersatuanInfo],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'no_pendaftaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30, 'disabled'=>$disablePersatuanInfo]],
                 'tarikh_didaftarkan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                        , 'disabled'=>$disablePersatuanInfo
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'pejabat_yang_mendaftarkan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefPejabatYangMendaftarkan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::pejabatYangMendaftarkan, 'disabled'=>$disablePersatuanInfo],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disablePersatuanInfo]],
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
                        'select2Options'=> [
                            'disabled'=>$disablePersatuanInfo,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5, 'disabled'=>$disablePersatuanInfo]],
                'alamat_parlimen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'select2Options'=> [
                            'disabled'=>$disablePersatuanInfo,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data'=>ArrayHelper::map(RefParlimen::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::parlimen,
                            'url'=>Url::to(['/ref-parlimen/subparlimens'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    
    <?php if(!$readonly):?>
    <input type="checkbox" id="sama_alamat"> <strong><?=GeneralLabel::alamat_surat_sama_dengan_alamat_berdaftar?></strong> <br>
    <?php endif;?>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'alamat_surat_menyurat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_surat_menyurat_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri, 'disabled'=>$disablePersatuanInfo],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'select2Options'=> [
                            'disabled'=>$disablePersatuanInfo,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_menyurat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5, 'disabled'=>$disablePersatuanInfo]],
                'alamat_surat_menyurat_parlimen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'select2Options'=> [
                            'disabled'=>$disablePersatuanInfo,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data'=>ArrayHelper::map(RefParlimen::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_menyurat_negeri')],
                            'placeholder' => Placeholder::parlimen,
                            'url'=>Url::to(['/ref-parlimen/subparlimens'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disablePersatuanInfo]],
                'no_telefon_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disablePersatuanInfo]],
                'no_fax' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'email' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>100, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bilangan_keahlian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'bilangan_cawangan_badan_gabungan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
        ],
        [
            'attributes' => [
                'aktiviti_dan_kejayaan_yang_dicapai' => ['type'=>Form::INPUT_TEXTAREA],
            ]
        ],
        
        [
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    
    <h3><?=GeneralLabel::jawatankuasa_kerja_yang_terkini?></h3>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'jawatankuasa_penaung' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_pegerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_timbalan_pengerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_naib_pengerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_setiausaha' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_bendahari' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disablePersatuanInfo]],
            ]
        ],
    ]
]);
    ?>
    
    <h4><?=GeneralLabel::ahli_jawatankuasa?></h4>
    
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
    
    <?php Pjax::begin(['id' => 'jawatanKuasaGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderJawatankuasa,
        //'filterModel' => $searchModelJawatankuasa,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jawatankuasa_id',
            //'permohonan_e_bantuan_id',
            //'jawatan',
            /*[
                'attribute' => 'jawatan',
                'value' => 'refJawatanEBantuan.desc'
            ],*/
            'nama',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-e-bantuan-jawatankuasa/delete', 'id' => $model->jawatankuasa_id]).'", "'.GeneralMessage::confirmDelete.'", "jawatanKuasaGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-jawatankuasa/update', 'id' => $model->jawatankuasa_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::jawatankuasa_kerja_yang_terkini . '");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-jawatankuasa/view', 'id' => $model->jawatankuasa_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::jawatankuasa_kerja_yang_terkini . '");',
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
        $permohonan_e_bantuan_id = "";
        
        if(isset($model->permohonan_e_bantuan_id)){
            $permohonan_e_bantuan_id = $model->permohonan_e_bantuan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-jawatankuasa/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::jawatankuasa_kerja_yang_terkini . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    
    <h3><?=GeneralLabel::objektif_pertubuhan?></h3>
    

    <?php Pjax::begin(['id' => 'objektifPertubuhanGrid', 'timeout' => 100000]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProviderOP,
        //'filterModel' => $searchModelOP,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'objektif_pertubuhan_id',
            //'permohonan_e_bantuan_id',
            'objektif',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-e-bantuan-objektif-pertubuhan/delete', 'id' => $model->objektif_pertubuhan_id]).'", "'.GeneralMessage::confirmDelete.'", "objektifPertubuhanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-objektif-pertubuhan/update', 'id' => $model->objektif_pertubuhan_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::objektif_pertubuhan . '");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-objektif-pertubuhan/view', 'id' => $model->objektif_pertubuhan_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::objektif_pertubuhan . '");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-objektif-pertubuhan/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::objektif_pertubuhan . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    
    <!--<h3>' . GeneralLabel::senarai_permohonan_yang_telah_diluluskan . '</h3>

    
    <?php Pjax::begin(['id' => 'senaraiPermohonanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonan,
        //'filterModel' => $searchModelPermohonan,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_permohonan_id',
            //'permohonan_e_bantuan_id',
            'nama_program',
            'tahun',
            'jumlah_kelulusan',
            //'penghantaran_laporan',
            [
                'attribute' => 'penghantaran_laporan',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->penghantaran_laporan){
                        //return Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->penghantaran_laporan , ['target'=>'_blank']);
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->penghantaran_laporan .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-e-bantuan-senarai-permohonan/delete', 'id' => $model->senarai_permohonan_id]).'", "'.GeneralMessage::confirmDelete.'", "senaraiPermohonanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-senarai-permohonan/update', 'id' => $model->senarai_permohonan_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::senarai_permohonan_yang_telah_diluluskan . '");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-senarai-permohonan/view', 'id' => $model->senarai_permohonan_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::senarai_permohonan_yang_telah_diluluskan . '");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-senarai-permohonan/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::senarai_permohonan_yang_telah_diluluskan . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>-->
    
    <br>
    <br>
    
    <h3><?=GeneralLabel::pendapatan_tahun_lepas?></h3>
    
    
    <?php Pjax::begin(['id' => 'pendapatanTahunLepasGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPTL,
        //'filterModel' => $searchModelPTL,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pendapatan_tahun_lepas_id',
            //'permohonan_e_bantuan_id',
            //'jenis_pendapatan',
            [
                'attribute' => 'jenis_pendapatan',
                'value' => 'refJenisPendapatan.desc'
            ],
            'butir_butir',
            'jumlah_pendapatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/delete', 'id' => $model->pendapatan_tahun_lepas_id]).'", "'.GeneralMessage::confirmDelete.'", "pendapatanTahunLepasGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/update', 'id' => $model->pendapatan_tahun_lepas_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::pendapatan_tahun_lepas . '");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/view', 'id' => $model->pendapatan_tahun_lepas_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::pendapatan_tahun_lepas . '");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::pendapatan_tahun_lepas . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    
    <?php 
        $calculate_jumlah_pendapatan = 0.00;
        foreach($dataProviderPTL->models as $PTLmodel){
            $calculate_jumlah_pendapatan += $PTLmodel->jumlah_pendapatan;
        }
    ?>
    
    <h4><?=GeneralLabel::jumlah_pendapatan_without_rm?>: RM <?=$calculate_jumlah_pendapatan?></h4>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'jumlah_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_akaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
                'nama_bank' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefBank::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bank],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'cawangan_dan_alamat_bank' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_program' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'tarikh_pelaksanaan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tempat_pelaksanaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bilangan_peserta' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'tujuan_program_aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>7],'options'=>['maxlength'=>100]],
            ]
        ],
    ]
]);
    ?>
    <br>
    <br>
    
    <h3><?=GeneralLabel::anggaran_perbelanjaan_program_aktiviti_yang_dipohon?></h3>
    
    <?php Pjax::begin(['id' => 'anggaranPerbelanjaanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAP,
        //'filterModel' => $searchModelAP,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'anggaran_perbelanjaan_id',
            //'permohonan_e_bantuan_id',
            'butir_butir_perbelanjaan',
            'jumlah_perbelanjaan',
            //'jumlah_disokong',
            //'jumlah_diperakuankan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/delete', 'id' => $model->anggaran_perbelanjaan_id]).'", "'.GeneralMessage::confirmDelete.'", "anggaranPerbelanjaanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/update', 'id' => $model->anggaran_perbelanjaan_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::anggaran_perbelanjaan_program_aktiviti_yang_dipohon . '");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/view', 'id' => $model->anggaran_perbelanjaan_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::anggaran_perbelanjaan_program_aktiviti_yang_dipohon . '");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::anggaran_perbelanjaan_program_aktiviti_yang_dipohon . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php 
        $calculate_jumlah_perbelanjaan = 0.00;
        $calculate_jumlah_disokong = 0.00;
        $calculate_jumlah_diperakuankan = 0.00;
        foreach($dataProviderAP->models as $APmodel){
            $calculate_jumlah_perbelanjaan += $APmodel->jumlah_perbelanjaan;
            $calculate_jumlah_disokong += $APmodel->jumlah_disokong;
            $calculate_jumlah_diperakuankan += $APmodel->jumlah_diperakuankan;
        }
    ?>
    
    <h4><?=GeneralLabel::jumlah_perbelanjaan_without_rm?>: RM <?=$calculate_jumlah_perbelanjaan?>, 
            <?=GeneralLabel::jumlah_disokong_without_rm?>: RM <?=$calculate_jumlah_disokong?>, 
            <?=GeneralLabel::jumlah_diperakuankan_without_rm?>: RM <?=$calculate_jumlah_diperakuankan?></h4>
    
    <?php Pjax::end(); ?>
    
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
                'pertubuhan_persatuan_sendiri' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
                'lain_lain_sumbangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
                'yuran_bayaran_penyertaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
            ]
        ],
    ]
]);
    ?>
    
    <?php Pjax::begin(['id' => 'anggaranPerbelanjaanTotal', 'timeout' => 100000]); ?>
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
                'jumlah_bantuan_yang_dipohon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10, 'disabled'=>true,'value'=>$calculate_jumlah_perbelanjaan]],
            ]
        ],
    ]
]);
    ?>
    
    <?php Pjax::end(); ?>
    
    <?php // Kertas Kerja
        if($model->kertas_kerja){
            echo "<label>" . $model->getAttributeLabel('kertas_kerja') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->kertas_kerja , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            if(!$readonly){
                echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->permohonan_e_bantuan_id, 'field'=> 'kertas_kerja'], 
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
    
    <?php if($readonly): ?>
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
                'sokongan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefSokongan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sokongan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
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
                'bil_mesyuarat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'tarikh_mesyuarat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'laporan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefLaporanEBantuan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::laporan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
        
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'negeri_sokongan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefNegeriSokonganEBantuan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeriSokongan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);*/
        
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKelulusanHqEBantuan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kelulusanHQ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
        
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan_admin' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
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
                'status_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefStatusPermohonanEBantuan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
    ]
]);
        
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'jumlah_diluluskan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10, 'id'=>'jumlahDiluluskan']],
                        'tarikh_bayar' => [
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
    
    <?php // Muat Naik PB-4
    if(($model->kelulusan_id && $model->kelulusan_id == RefKelulusanHqEBantuan::STATUS_LULUS) || ($model->negeri_sokongan_id && $model->negeri_sokongan_id == RefNegeriSokonganEBantuan::STATUS_LULUS)){
        if($model->muat_naik_pb4){
            echo "<label>" . $model->getAttributeLabel('muat_naik_pb4') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_pb4 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            if(!$readonly){
                echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->permohonan_e_bantuan_id, 'field'=> 'muat_naik_pb4'], 
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
                            'muat_naik_pb4' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                        ],
                    ],
                ]
            ]);
        }
    }
    ?>
    
    <?php // Muat Naik PB-5
    /*if($model->muat_naik_pb5){
        echo "<label>" . $model->getAttributeLabel('muat_naik_pb5') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_pb5 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->permohonan_e_bantuan_id, 'field'=> 'muat_naik_pb5'], 
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
                        'muat_naik_pb5' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }*/
    ?>
    
    <?php // Muat Naik PB-6
    if(($model->kelulusan_id && $model->kelulusan_id == RefKelulusanHqEBantuan::STATUS_LULUS) || ($model->negeri_sokongan_id && $model->negeri_sokongan_id == RefNegeriSokonganEBantuan::STATUS_LULUS)){
        if($model->muat_naik_pb6){
            echo "<label>" . $model->getAttributeLabel('muat_naik_pb6') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_pb6 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            if(!$readonly){
                echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->permohonan_e_bantuan_id, 'field'=> 'muat_naik_pb6'], 
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
                            'muat_naik_pb6' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                        ],
                    ],
                ]
            ]);
        }
    }
    ?>
    

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::save : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if(!$model->isNewRecord && $model->hantar_flag && $model->hantar_flag == 0): ?>
        <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->permohonan_e_bantuan_id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
            <?php if(!$model->isNewRecord): ?>
            <?php 
            /*if(!$model->isNewRecord){
                echo Html::a('Senarai Semak', 'javascript:void(0);', [
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-senarai-semak/load', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "Senarai Semak");',
                                'class' => 'btn btn-success',
                                ]);
            }*/
            ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php
            if(!$readonly){
                echo Html::a(GeneralLabel::backToList, ['site/e-bantuan-home'], ['class' => 'btn btn-warning']);
            }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$STATUS_PERMOHONAN_LULUS = RefStatusPermohonanEBantuan::STATUS_LULUS;
$STATUS_PERMOHONAN_TOLAK = RefStatusPermohonanEBantuan::STATUS_TOLAK;
$STATUS_PERMOHONAN_TAK_LENGKAP = RefStatusPermohonanEBantuan::STATUS_TAK_LENGKAP;

$NEGERI_SOKONGAN_LULUS = RefNegeriSokonganEBantuan::STATUS_LULUS;
$NEGERI_SOKONGAN_TOLAK = RefNegeriSokonganEBantuan::STATUS_TOLAK;
$NEGERI_SOKONGAN_HANTAR_KE_HQ = RefNegeriSokonganEBantuan::STATUS_HANTAR_KE_HQ;

$KELULUSAN_HQ_LULUS = RefKelulusanHqEBantuan::STATUS_LULUS;
$KELULUSAN_HQ_TOLAK = RefKelulusanHqEBantuan::STATUS_TOLAK;

$script = <<< JS
        
$(document).ready(function(){
    var readonly = '$readonly';
        
    if(!readonly){
        if($( "#permohonanebantuan-status_permohonan" ).val() !== '$STATUS_PERMOHONAN_LULUS'){
            $( ".field-permohonanebantuan-jumlah_diluluskan" ).hide();
            $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
        }
        
        if($( "#permohonanebantuan-negeri_sokongan" ).val() !== '$NEGERI_SOKONGAN_HANTAR_KE_HQ'){
            $( ".field-permohonanebantuan-kelulusan" ).hide();
        }
    }
});
        
        
$('#permohonanebantuan-negeri_sokongan').change(function(){
    if(this.value === '$NEGERI_SOKONGAN_LULUS'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_LULUS').trigger("change");
        $( ".field-permohonanebantuan-kelulusan" ).hide();
        $( ".field-permohonanebantuan-jumlah_diluluskan" ).show();
        $( ".field-permohonanebantuan-tarikh_bayar" ).show();
    } else if(this.value === '$NEGERI_SOKONGAN_TOLAK'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_TOLAK').trigger("change");
        $( ".field-permohonanebantuan-kelulusan" ).hide();
        $( ".field-permohonanebantuan-jumlah_diluluskan" ).hide();
            $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    } else if(this.value === '$NEGERI_SOKONGAN_HANTAR_KE_HQ'){
        //$( ".field-permohonanebantuan-kelulusan" ).show();
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_TAK_LENGKAP').trigger("change");
        $( ".field-permohonanebantuan-jumlah_diluluskan" ).hide();
        $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    }
});
        
$('#permohonanebantuan-kelulusan').change(function(){
    if(this.value === '$KELULUSAN_HQ_LULUS'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_LULUS').trigger("change");
        
        //show jumlah lulus and tarikh bayar
        $( ".field-permohonanebantuan-jumlah_diluluskan" ).show();
        $( ".field-permohonanebantuan-tarikh_bayar" ).show();
    } else if(this.value === '$KELULUSAN_HQ_TOLAK'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_TOLAK').trigger("change");
        
        //hide jumlah lulus and tarikh bayar
        $( ".field-permohonanebantuan-jumlah_diluluskan" ).hide();
        $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    }
});
        
$('#permohonanebantuan-status_permohonan').change(function(){
    if(this.value === '$STATUS_PERMOHONAN_LULUS'){
        //show jumlah lulus and tarikh bayar
        $( ".field-permohonanebantuan-jumlah_diluluskan" ).show();
        $( ".field-permohonanebantuan-tarikh_bayar" ).show();
    } else {
        //hide jumlah lulus and tarikh bayar
        $( ".field-permohonanebantuan-jumlah_diluluskan" ).hide();
        $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    }
});
        
$("#sama_alamat").change(function() {
    if(this.checked) {
        $("#permohonanebantuan-alamat_surat_menyurat_1").val($("#permohonanebantuan-alamat_1").val());
        $("#permohonanebantuan-alamat_surat_menyurat_2").val($("#permohonanebantuan-alamat_2").val());
        $("#permohonanebantuan-alamat_surat_menyurat_3").val($("#permohonanebantuan-alamat_3").val());
        $("#permohonanebantuan-alamat_surat_menyurat_negeri").val($("#permohonanebantuan-alamat_negeri").val()).trigger("change");
        $("#permohonanebantuan-alamat_surat_menyurat_bandar").val($("#permohonanebantuan-alamat_bandar").val()).trigger("change");
        $("#permohonanebantuan-alamat_surat_menyurat_poskod").val($("#permohonanebantuan-alamat_poskod").val());
        $("#permohonanebantuan-alamat_surat_menyurat_parlimen").val($("#permohonanebantuan-alamat_parlimen").val()).trigger("change");
    }
});
        
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#permohonanebantuan-kategori_persatuan").prop("disabled", false);
    $("#permohonanebantuan-kategori_program").prop("disabled", false);
    $("#permohonanebantuan-peringkat_program").prop("disabled", false);
    $("#permohonanebantuan-pejabat_yang_mendaftarkan").prop("disabled", false);
    $("#permohonanebantuan-alamat_negeri").prop("disabled", false);
    $("#permohonanebantuan-alamat_bandar").prop("disabled", false);
    $("#permohonanebantuan-alamat_parlimen").prop("disabled", false);
    $("#permohonanebantuan-alamat_surat_menyurat_negeri").prop("disabled", false);
    $("#permohonanebantuan-alamat_surat_menyurat_bandar").prop("disabled", false);
    $("#permohonanebantuan-alamat_surat_menyurat_parlimen").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>

