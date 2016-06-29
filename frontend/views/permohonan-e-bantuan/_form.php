<?php

use kartik\helpers\Html;
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
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php //echo $form->errorSummary($model); ?>
    <?php
        if(($model->kelulusan_id && $model->kelulusan_id == RefKelulusanHqEBantuan::STATUS_LULUS) || ($model->negeri_sokongan_id && $model->negeri_sokongan_id == RefNegeriSokonganEBantuan::STATUS_LULUS)):
    ?>
    
    <div class="alert alert-success">
        <strong>Tahniah!</strong> Permohonan anda diluluskan. Surat kelulusan 
akan dihantar ke alamat surat menyurat. Sila muat turun borang Surat Setuju Terima (PB-4) dan 
kemukakan kepada urus setia dalam tempoh 14 hari dari tarikh penerimaan surat kelulusan untuk 
tujuan penyelarasan dan pembayaran. Kegagalan mengemukakan dokumen tersebut di dalam tempoh yang 
ditetapkan akan menyebabkan kelulusan ini terbatal.
        <?php //echo '&nbsp;&nbsp;' . Html::a('Muat Turun PB-4', 'javascript:void(0);', ['class'=>'btn btn-warning', 'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/downloads/permohonan-e-bantuan/pb4.pdf");']);?>
        <?= Html::a('Muat Turun PB-4', ['print', 'id' => $model->permohonan_e_bantuan_id, 'template' => 'SURAT_SETUJU_TERIMA_BANTUAN'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </div>
    
    <div class="alert alert-warning">
            <strong>Perhatian - </strong> Sila muat turun borang Laporan Pelaksanaan Program (PB-6) dan 
penyata perbelanjaan seperti dilampirkan yang berkaitan dengan program yang dilaksanakan dibawah 
peruntukan ini sama ada dalam bentuk resit pembelian barangan yang lengkap, bil terperinci 
(<i>itemised bill</i>), laporan program, gambar program atau lain-lain bentuk laporan yang disahkan yang 
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
                'nama_pertubuhan_persatuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                'kategori_persatuan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-persatuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPersatuan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriPersatuan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'kategori_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-program/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriProgram::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriProgram],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'peringkat_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peringkat-program/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeringkatProgram::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkatProgram],
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
                 'no_pendaftaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                 'tarikh_didaftarkan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'pejabat_yang_mendaftarkan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-pejabat-yang-mendaftarkan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPejabatYangMendaftarkan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::pejabatYangMendaftarkan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
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
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'alamat_parlimen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-parlimen/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
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
    <input type="checkbox" id="sama_alamat"> <strong> <?=GeneralLabel::alamat_surat_sama_dengan_alamat_berdaftar?></strong> <br>
    <?php endif;?>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'alamat_surat_menyurat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
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
                'alamat_surat_menyurat_bandar' => [
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
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_menyurat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'alamat_surat_menyurat_parlimen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-parlimen/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
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
                'no_telefon_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_telefon_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_fax' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
            ]
        ],
        [
            'attributes' => [
                'email' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>100]],
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
                'aktiviti_dan_kejayaan_yang_dicapai' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        
        [
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    
    <h3>Jawatankuasa Kerja Yang Terkini</h3>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'jawatankuasa_penaung' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_pegerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_timbalan_pengerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_naib_pengerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_setiausaha' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_bendahari' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80]],
            ]
        ],
    ]
]);
    ?>
    
    <h4>Ahli Jawatankuasa</h4>
    
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-jawatankuasa/update', 'id' => $model->jawatankuasa_id]).'", "'.GeneralLabel::updateTitle . ' Jawatankuasa Kerja Yang Terkini");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-jawatankuasa/view', 'id' => $model->jawatankuasa_id]).'", "'.GeneralLabel::viewTitle . ' Jawatankuasa Kerja Yang Terkini");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-jawatankuasa/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' Jawatankuasa Kerja Yang Terkini");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    
    <h3>Objektif Pertubuhan</h3>
    

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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-objektif-pertubuhan/update', 'id' => $model->objektif_pertubuhan_id]).'", "'.GeneralLabel::updateTitle . ' Objektif Pertubuhan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-objektif-pertubuhan/view', 'id' => $model->objektif_pertubuhan_id]).'", "'.GeneralLabel::viewTitle . ' Objektif Pertubuhan");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-objektif-pertubuhan/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' Objektif Pertubuhan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    
    <!--<h3>Senarai Permohonan Yang Telah Diluluskan</h3>

    
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-senarai-permohonan/update', 'id' => $model->senarai_permohonan_id]).'", "'.GeneralLabel::updateTitle . ' Senarai Permohonan Yang Telah Diluluskan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-senarai-permohonan/view', 'id' => $model->senarai_permohonan_id]).'", "'.GeneralLabel::viewTitle . ' Senarai Permohonan Yang Telah Diluluskan");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-senarai-permohonan/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' Senarai Permohonan Yang Telah Diluluskan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>-->
    
    <br>
    <br>
    
    <h3>Pendapatan Tahun Lepas</h3>
    
    
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/update', 'id' => $model->pendapatan_tahun_lepas_id]).'", "'.GeneralLabel::updateTitle . ' Pendapatan Tahun Lepas");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/view', 'id' => $model->pendapatan_tahun_lepas_id]).'", "'.GeneralLabel::viewTitle . ' Pendapatan Tahun Lepas");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' Pendapatan Tahun Lepas");',
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
    
    <h4>Jumlah Pendapatan: RM <?=$calculate_jumlah_pendapatan?></h4>
    
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
    
    <h3>Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon</h3>
    
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
            'jumlah_disokong',
            'jumlah_diperakuankan',

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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/update', 'id' => $model->anggaran_perbelanjaan_id]).'", "'.GeneralLabel::updateTitle . ' Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/view', 'id' => $model->anggaran_perbelanjaan_id]).'", "'.GeneralLabel::viewTitle . ' Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php 
        $calculate_jumlah_perbelanjaan = 0.00;
        foreach($dataProviderAP->models as $APmodel){
            $calculate_jumlah_perbelanjaan += $APmodel->jumlah_perbelanjaan;
        }
    ?>
    
    <h4>Jumlah Perbelanjaan: RM <?=$calculate_jumlah_perbelanjaan?></h4>
    
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
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_bantuan_yang_dipohon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
            ]
        ],
    ]
]);
    ?>
    
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
    
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['sokongan']) || $readonly): ?>
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sokongan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
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
    <?php endif; ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['kelulusan']) || $readonly): ?>
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-laporan-e-bantuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
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
        
        echo FormGrid::widget([
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri-sokongan-e-bantuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeriSokonganEBantuan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeriSokongan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
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
                'kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kelulusan-hq-e-bantuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
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
        
        echo FormGrid::widget([
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
                'status_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-e-bantuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
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
    if($model->muat_naik_pb5){
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
    }
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
    
    

    <!--<?= $form->field($model, 'nama_pertubuhan_persatuan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_pendaftaran')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tarikh_didaftarkan')->textInput() ?>

    <?= $form->field($model, 'pejabat_yang_mendaftarkan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'alamat_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'no_telefon_pejabat')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'no_telefon_bimbit')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'no_fax')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'bilangan_keahlian')->textInput() ?>

    <?= $form->field($model, 'bilangan_cawangan_badan_gabungan')->textInput() ?>

    <?= $form->field($model, 'objektif_pertubuhan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'aktiviti_dan_kejayaan_yang_dicapai')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
        
        <?php if(!$model->isNewRecord): ?>
            <?php //echo '&nbsp;&nbsp;' . Html::a('Muat Turun PB-5', 'javascript:void(0);', ['class'=>'btn btn-warning', 'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/downloads/permohonan-e-bantuan/pb5.pdf");']);?>
            <?php echo '&nbsp;&nbsp;' . Html::a('Muat Turun PB-5', ['print', 'id' => $model->permohonan_e_bantuan_id, 'template' => 'PERAKUAN_PERMOHONAN_PEMBERIAN_BANTUAN'], ['class' => 'btn btn-warning', 'target' => '_blank']);?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$STATUS_PERMOHONAN_LULUS = RefStatusPermohonanEBantuan::STATUS_LULUS;
$STATUS_PERMOHONAN_TOLAK = RefStatusPermohonanEBantuan::STATUS_TOLAK;
$STATUS_PERMOHONAN_TAK_LENGKAP = RefStatusPermohonanEBantuan::STATUS_TAK_LENGKAP;
$STATUS_PERMOHONAN_SEDANG_DISEMAKAN = RefStatusPermohonanEBantuan::STATUS_SEDANG_DI_SEMAK;

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
            $( ".field-jumlahDiluluskan" ).hide();
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
        $( ".field-jumlahDiluluskan" ).show();
        $( ".field-permohonanebantuan-tarikh_bayar" ).show();
    } else if(this.value === '$NEGERI_SOKONGAN_TOLAK'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_TOLAK').trigger("change");
        $( ".field-permohonanebantuan-kelulusan" ).hide();
        $( ".field-jumlahDiluluskan" ).hide();
            $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    } else if(this.value === '$NEGERI_SOKONGAN_HANTAR_KE_HQ'){
        //$( ".field-permohonanebantuan-kelulusan" ).show();
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_SEDANG_DISEMAKAN').trigger("change");
        $( ".field-jumlahDiluluskan" ).hide();
        $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    }
});
        
$('#permohonanebantuan-kelulusan').change(function(){
    if(this.value === '$KELULUSAN_HQ_LULUS'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_LULUS').trigger("change");
        
        //show jumlah lulus and tarikh bayar
        $( ".field-jumlahDiluluskan" ).show();
        $( ".field-permohonanebantuan-tarikh_bayar" ).show();
    } else if(this.value === '$KELULUSAN_HQ_TOLAK'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_TOLAK').trigger("change");
        
        //hide jumlah lulus and tarikh bayar
        $( ".field-jumlahDiluluskan" ).hide();
        $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    }
});
        
$('#permohonanebantuan-status_permohonan').change(function(){
    if(this.value === '$STATUS_PERMOHONAN_LULUS'){
        //show jumlah lulus and tarikh bayar
        $( ".field-jumlahDiluluskan" ).show();
        $( ".field-permohonanebantuan-tarikh_bayar" ).show();
    } else {
        //hide jumlah lulus and tarikh bayar
        $( ".field-jumlahDiluluskan" ).hide();
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
        
JS;
        
$this->registerJs($script);
?>
