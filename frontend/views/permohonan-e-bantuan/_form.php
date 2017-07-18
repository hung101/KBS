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
use app\models\ProfilBadanSukan;
use app\models\UserPeranan;
use app\models\RefKategoriUrusetia;

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
    $disablePersatuan = false; // default
    if(Yii::$app->user->identity->profil_badan_sukan){
        $disablePersatuan = true;
    }
    
    $disabled_fields = false;
    // is Urusetia Negeri not allow to edit
    if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_KBS_E_BANTUAN_URUSETIA && Yii::$app->user->identity->urusetia_kategori_urusetia_e_bantuan != RefKategoriUrusetia::INDUK_JBSN){
        $disabled_fields = true;
    }
    
    $disableUrusetia = false;
    if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_KBS_E_BANTUAN_URUSETIA && 
            Yii::$app->user->identity->urusetia_kategori_urusetia_e_bantuan != RefKategoriUrusetia::INDUK_JBSN &&
            Yii::$app->user->identity->urusetia_kategori_urusetia_e_bantuan != RefKategoriUrusetia::BAHAGIAN_JBSN &&
            $model->sokongan == RefSokongan::DISOKONG_INDUK){
        $disableUrusetia = true;
    }
    
    $isUrusetiaBahagian = false;
            
    if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_KBS_E_BANTUAN_URUSETIA && 
       Yii::$app->user->identity->urusetia_kategori_urusetia_e_bantuan == RefKategoriUrusetia::BAHAGIAN_JBSN){
        $isUrusetiaBahagian = true;
    }
    
    ?>
    
    <?php
        if(!$readonly && !$disabled_fields){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
        
        
        if(!$readonly){
            $template_perakauan = '{view} {update} {delete}';
        } else {
            $template_perakauan = '{view}';
        }
        
        if($isUrusetiaBahagian){
            $template_perakauan = '{view} {update} {delete}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data'], 'id'=>$model->formName()]); ?>
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
            <strong>Perhatian - </strong> Sila muat turun borang Laporan Pelaksanaan Program (PB-6) dan kemukakan borang PB-6 yang telah lengkap berserta
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
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'profil_badan_sukan_id' => [
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
            ]
        ],
    ]
]);*/
    ?>
    
    <br>
    <pre style="text-align: center"><strong>A. MAKLUMAT MENGENAI NGO</strong></pre>
    
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
                'nama_pertubuhan_persatuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
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
                        'options' => ['placeholder' => Placeholder::kategoriPersatuan
                , 'disabled'=>$disabled_fields],
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
                        'options' => ['placeholder' => Placeholder::kategoriProgram
                , 'disabled'=>$disabled_fields],
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
                        'options' => ['placeholder' => Placeholder::peringkatProgram
                , 'disabled'=>$disabled_fields],
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
                 'no_pendaftaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'disabled'=>$disabled_fields]],
                 'tarikh_didaftarkan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ], 'disabled'=>$disabled_fields
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
                        'options' => ['placeholder' => Placeholder::pejabatYangMendaftarkan
                , 'disabled'=>$disabled_fields],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disabled_fields]],
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
                        'options' => ['placeholder' => Placeholder::negeri
                , 'disabled'=>$disabled_fields],
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
                            'pluginOptions'=>['allowClear'=>true, 'disabled'=>$disabled_fields]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5, 'disabled'=>$disabled_fields]],
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
                            'pluginOptions'=>['allowClear'=>true, 'disabled'=>$disabled_fields]
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
    
    <?php if(!$readonly && !$disabled_fields):?>
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
                'alamat_surat_menyurat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disabled_fields,]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disabled_fields,]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disabled_fields,]],
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
                        'options' => ['placeholder' => Placeholder::negeri, 'disabled'=>$disabled_fields],
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
                            'pluginOptions'=>['allowClear'=>true, 'disabled'=>$disabled_fields]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_menyurat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5, 'disabled'=>$disabled_fields]],
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
                            'pluginOptions'=>['allowClear'=>true, 'disabled'=>$disabled_fields]
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
                'no_telefon_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disabled_fields]],
                'no_telefon_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disabled_fields]],
                'no_fax' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'email' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>100, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bilangan_keahlian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'disabled'=>$disabled_fields]],
                'bilangan_cawangan_badan_gabungan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'aktiviti_dan_kejayaan_yang_dicapai' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['disabled'=>$disabled_fields]],
            ]
        ],
        
        [
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['disabled'=>$disabled_fields]],
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
                'jawatankuasa_penaung' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_pegerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_timbalan_pengerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_naib_pengerusi' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_setiausaha' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'attributes' => [
                'jawatankuasa_bendahari' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
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
    
    <?php if(!$readonly  && !$disabled_fields): ?>
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
    
    <?php if(!$readonly  && !$disabled_fields): ?>
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
    
    <?php if(!$readonly  && !$disabled_fields): ?>
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
    <pre style="text-align: center"><strong>B. MAKLUMAT MENGENAI KEDUDUKAN KEWANGAN</strong></pre>
    
    <h3><?=GeneralLabel::pendapatan_tahun_lepas?></h3>
    
    
    <?php Pjax::begin(['id' => 'pendapatanTahunLepasGrid', 'timeout' => 100000]); ?>
    
    <?php 
        $calculate_jumlah_pendapatan = 0.00;
        foreach($dataProviderPTL->models as $PTLmodel){
            $calculate_jumlah_pendapatan += $PTLmodel->jumlah_pendapatan;
        }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPTL,
        //'filterModel' => $searchModelPTL,
        'showFooter' =>true,
        'footerRowOptions'=>['style'=>'font-weight:bold;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pendapatan_tahun_lepas_id',
            //'permohonan_e_bantuan_id',
            //'jenis_pendapatan',
            [
                'attribute' => 'jenis_pendapatan',
                'value' => 'refJenisPendapatan.desc'
            ],
            //'butir_butir',
            [
                'attribute' => 'butir_butir',
                'footer' => GeneralLabel::jumlah
            ],
            [
                'attribute' => 'jumlah_pendapatan',
                'footer' => sprintf('%0.2f',$calculate_jumlah_pendapatan)
            ],
            //'jumlah_pendapatan',

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
    
    <?php if(!$readonly  && !$disabled_fields): ?>
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-pendapatan-tahun-lepas/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::pendapatan_tahun_lepas . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <!--<h4><?=GeneralLabel::jumlah_pendapatan_without_rm?>: RM <?=$calculate_jumlah_pendapatan?></h4>-->
    
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
                'jumlah_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10, 'disabled'=>true,'value'=>$calculate_jumlah_pendapatan]],
            ]
        ],
    ]
]);
    ?>
    
    <?php Pjax::end(); ?>
    
    
    
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
                'no_akaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20, 'disabled'=>$disabled_fields]],
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
                        'options' => ['placeholder' => Placeholder::bank, 'disabled'=>$disabled_fields],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'cawangan_dan_alamat_bank' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90, 'disabled'=>$disabled_fields]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>C. MAKLUMAT MENGENAI PROGRAM/AKTIVITI</strong></pre>
    
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
                'nama_program' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80, 'disabled'=>$disabled_fields]],
                'tarikh_pelaksanaan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ], 'disabled'=>$disabled_fields
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_pelaksanaan_tamat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ], 'disabled'=>$disabled_fields
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat_pelaksanaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>90, 'disabled'=>$disabled_fields]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bilangan_peserta' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'disabled'=>$disabled_fields]],
                'tujuan_program_aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>7],'options'=>['maxlength'=>100, 'disabled'=>$disabled_fields]],
            ]
        ],
    ]
]);
    ?>
    <br>
    <br>
    <br>
    <pre style="text-align: center"><strong><?= strtoupper(GeneralLabel::sokongan_perakuan)?></strong></pre>
    
    <h3><?=GeneralLabel::anggaran_perbelanjaan_program_aktiviti_yang_dipohon?></h3>
    
    <?php Pjax::begin(['id' => 'anggaranPerbelanjaanGrid', 'timeout' => 100000]); ?>
    
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

    <?= GridView::widget([
        'dataProvider' => $dataProviderAP,
        //'filterModel' => $searchModelAP,
        'showFooter' =>true,
        'footerRowOptions'=>['style'=>'font-weight:bold;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'anggaran_perbelanjaan_id',
            //'permohonan_e_bantuan_id',
            [
                'attribute' => 'butir_butir_perbelanjaan',
                'footer' => GeneralLabel::jumlah
            ],
            //'jumlah_perbelanjaan',
            [
                'attribute' => 'jumlah_perbelanjaan',
                'footer' => sprintf('%0.2f',$calculate_jumlah_perbelanjaan)
            ],
            //'jumlah_disokong',
            [
                'attribute' => 'jumlah_disokong',
                'footer' => sprintf('%0.2f',$calculate_jumlah_disokong)
            ],
            //'jumlah_diperakuankan',
            [
                'attribute' => 'jumlah_diperakuankan',
                'footer' => sprintf('%0.2f',$calculate_jumlah_diperakuankan)
            ],

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
                'template' => $template_perakauan,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly && !$disabled_fields): ?>
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-bantuan-anggaran-perbelanjaan/create', 'permohonan_id' => $permohonan_e_bantuan_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::anggaran_perbelanjaan_program_aktiviti_yang_dipohon . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <!--<h4><?=GeneralLabel::jumlah_perbelanjaan_without_rm?>: RM <?=$calculate_jumlah_perbelanjaan?>, 
            <?=GeneralLabel::jumlah_disokong_without_rm?>: RM <?=$calculate_jumlah_disokong?>, 
            <?=GeneralLabel::jumlah_diperakuankan_without_rm?>: RM <?=$calculate_jumlah_diperakuankan?></h4>-->
    
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
                'pertubuhan_persatuan_sendiri' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10, 'disabled'=>$disabled_fields]],
                'lain_lain_sumbangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10, 'disabled'=>$disabled_fields]],
                'yuran_bayaran_penyertaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10, 'disabled'=>$disabled_fields]],
            ]
        ],
    ]
]);
    ?>
    
    <?php
    // Pjax::begin(['id' => 'anggaranPerbelanjaanTotal', 'timeout' => 100000]);
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_bantuan_yang_dipohon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10, 'disabled'=>true]],
            ]
        ],
    ]
]);
        // Pjax::end();
    ?>
    
    <?php // Kertas Kerja
    echo "<label>" . $model->getAttributeLabel('kertas_kerja') . "</label><br>";
        if($model->kertas_kerja){
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->kertas_kerja , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        } else {
            echo '(Tiada)';
        }
        echo '<br>';
    ?>
    
    <?php // Sijil Pendaftaran persatuan
    echo "<label>" . $model->getAttributeLabel('sijil_pendaftaran_persatuan') . "</label><br>";
        if($model->sijil_pendaftaran_persatuan){
            
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->sijil_pendaftaran_persatuan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        } else {
            echo '(Tiada)';
        }
        echo '<br>';
    ?>
    
    <?php // Salinan Perlembagaan Persatuan (Jika terdapat pindaan)
    echo "<label>" . $model->getAttributeLabel('salinan_perlembagaan_persatuan') . "</label><br>";
        if($model->salinan_perlembagaan_persatuan){
            
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_perlembagaan_persatuan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";

        } else {
            echo '(Tiada)';
        }
        echo '<br>';
    ?>
    
    <?php // Senarai Ahli Jawatankuasa Persatuan yang lengkap dan terkini
    echo "<label>" . $model->getAttributeLabel('senarai_ahli_jawatankuasa_persatuan') . "</label><br>";
        if($model->senarai_ahli_jawatankuasa_persatuan){
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->senarai_ahli_jawatankuasa_persatuan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        }  else {
            echo '(Tiada)';
        }
        echo '<br>';
    ?>
    
    <?php // Salinan Akaun Bank Persatuan yang terkini
    echo "<label>" . $model->getAttributeLabel('salinan_akaun_bank_persatuan') . "</label><br>";
        if($model->salinan_akaun_bank_persatuan){
            
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_akaun_bank_persatuan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        }  else {
            echo '(Tiada)';
        }
        echo '<br>';
    ?>
    
    <?php // Laporan Penyata Kewangan Tahunan (Bantuan Pentadbiran)
    echo "<label>" . $model->getAttributeLabel('laporan_penyata_kewangan_tahunan') . "</label><br>";
        if($model->laporan_penyata_kewangan_tahunan){
            
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->laporan_penyata_kewangan_tahunan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        }  else {
            echo '(Tiada)';
        }
        echo '<br>';
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
                            'allowClear' => true,
                            'disabled'=>$disableUrusetia
                        ],],
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
                'ulasan_negeri' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['disabled'=>$isUrusetiaBahagian]],
            ]
        ],
    ]
]);
    ?>
    
    <?php endif; ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['permohonan-e-bantuan']['kelulusan']) || $readonly): ?>
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
]);*/
        
        
    if(Yii::$app->user->identity->peranan != UserPeranan::PERANAN_KBS_E_BANTUAN_URUSETIA || 
            Yii::$app->user->identity->urusetia_kategori_urusetia_e_bantuan == RefKategoriUrusetia::BAHAGIAN_JBSN || 
            Yii::$app->user->identity->urusetia_kategori_urusetia_e_bantuan == RefKategoriUrusetia::INDUK_JBSN){
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan_admin' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4]],
            ]
        ],
    ]
]);
    }
    ?>
    
    
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?= strtoupper(GeneralLabel::keputusan_permohonan_bantuan)?></strong></pre>
    
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
                        'options' => ['placeholder' => Placeholder::kelulusan],
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
                        'options' => ['placeholder' => Placeholder::statusPermohonan,'disabled'=>!$isUrusetiaBahagian],
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
    
    <?php // Muat Naik PB-4
    if(($model->kelulusan_id && $model->kelulusan_id == RefKelulusanHqEBantuan::STATUS_LULUS) || ($model->negeri_sokongan_id && $model->negeri_sokongan_id == RefNegeriSokonganEBantuan::STATUS_LULUS)){
        if($model->muat_naik_pb4){
            echo "<label>" . $model->getAttributeLabel('muat_naik_pb4') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_pb4 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            if(!$readonly && !$disabled_fields){
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
        if(!$readonly && !$disableUrusetia){
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
        if(!$readonly && !$disableUrusetia){
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
    }
    ?>
    
    <?php // Muat Naik PB-6
    if(($model->kelulusan_id && $model->kelulusan_id == RefKelulusanHqEBantuan::STATUS_LULUS) || ($model->negeri_sokongan_id && $model->negeri_sokongan_id == RefNegeriSokonganEBantuan::STATUS_LULUS)){
        if($model->muat_naik_pb6){
            echo "<label>" . $model->getAttributeLabel('muat_naik_pb6') . "</label><br>";
            echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_pb6 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
            if(!$readonly && !$disabled_fields){
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
    
    <br>
     <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h2><?=strtoupper(GeneralLabel::akuan_penerima)?> (PB-2)</h2>
            <strong><?=GeneralLabel::senarai_semak_check_list?> <br><?=GeneralLabel::permohonan_bantuan?></strong>
        </div>
        <div class="panel-body">
            <strong><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Lengkap</strong>
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_borang_permohonan_bantuan" name="PermohonanEBantuan[semak_borang_permohonan_bantuan]" '.
                        (($model->semak_borang_permohonan_bantuan=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_borang_permohonan_bantuan').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_borang_permohonan_bantuan')->checkbox(); 
                    echo '</div>';
                }
            ?>
            
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_kertas_kerja_program" name="PermohonanEBantuan[semak_kertas_kerja_program]" '.
                        (($model->semak_kertas_kerja_program=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_kertas_kerja_program').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_kertas_kerja_program')->checkbox(); 
                    echo '</div>';
                }
            ?>
            
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_salinan_sijil_pendaftaran_persatuan" name="PermohonanEBantuan[semak_salinan_sijil_pendaftaran_persatuan]" '.
                        (($model->semak_salinan_sijil_pendaftaran_persatuan=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_salinan_sijil_pendaftaran_persatuan').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_salinan_sijil_pendaftaran_persatuan')->checkbox(); 
                    echo '</div>';
                }
            ?>
            
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_salinan_perlembagaan_persatuan" name="PermohonanEBantuan[semak_salinan_perlembagaan_persatuan]" '.
                        (($model->semak_salinan_perlembagaan_persatuan=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_salinan_perlembagaan_persatuan').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_salinan_perlembagaan_persatuan')->checkbox(); 
                    echo '</div>';
                }
            ?>
            
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_senarai_ahli_jawatankuasa_persatuan" name="PermohonanEBantuan[semak_senarai_ahli_jawatankuasa_persatuan]" '.
                        (($model->semak_senarai_ahli_jawatankuasa_persatuan=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_senarai_ahli_jawatankuasa_persatuan').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_senarai_ahli_jawatankuasa_persatuan')->checkbox(); 
                    echo '</div>';
                }
            ?>
            
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_buku_bank_penyata_bank_kewangan_persatuan" name="PermohonanEBantuan[semak_buku_bank_penyata_bank_kewangan_persatuan]" '.
                        (($model->semak_buku_bank_penyata_bank_kewangan_persatuan=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_buku_bank_penyata_bank_kewangan_persatuan').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_buku_bank_penyata_bank_kewangan_persatuan')->checkbox(); 
                    echo '</div>';
                }
            ?>
            
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_laporan_pelaksaaan_program_terdahulu" name="PermohonanEBantuan[semak_laporan_pelaksaaan_program_terdahulu]" '.
                        (($model->semak_laporan_pelaksaaan_program_terdahulu=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_laporan_pelaksaaan_program_terdahulu').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_laporan_pelaksaaan_program_terdahulu')->checkbox(); 
                    echo '</div>';
                }
            ?>
            
            <?php 
                echo '<div class="checkbox checkbox_read">
                        <label>
                            <input id="permohonanebantuan-semak_surat_setuju_terima_pb_4" name="PermohonanEBantuan[semak_surat_setuju_terima_pb_4]" '.
                        (($model->semak_surat_setuju_terima_pb_4=='1')?'checked':'').' type="checkbox" disabled> 
                            '.$model->getAttributeLabel('semak_surat_setuju_terima_pb_4').'
                        </label>
                    </div>';
                if(!$readonly){
                    echo '<div class="checkbox_update">';
                    echo $form->field($model, 'semak_surat_setuju_terima_pb_4')->checkbox(); 
                    echo '</div>';
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
                                    'catatan_pemohon' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4]],
                                ]
                            ],
                        ]
                    ]);
                ?>
            
        </div>
        <div class="panel-footer">*Sila kemaskini dokumen berkaitan dalam tempoh <strong>14 hari.</strong> Permohonan yang tidak lengkap <strong>tidak akan dipertimbangkan.</strong></div>
    </div>
    

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

$SOKONGAN_NEGERI = RefSokongan::DISOKONG_NEGERI;
$SOKONGAN_INDUK = RefSokongan::DISOKONG_INDUK;
$SOKONGAN_TAK_LENGKAP = RefSokongan::TAK_LENGKAP;

$PARANAN_URUSETIA = UserPeranan::PERANAN_KBS_E_BANTUAN_URUSETIA;
$PARANAN_PENGGUNA = Yii::$app->user->identity->peranan;

$KATEGORI_URUSETIA_PENGGUNA = Yii::$app->user->identity->urusetia_kategori_urusetia_e_bantuan;

$KATEGORI_URUSETIA_JBS_NEGERI = RefKategoriUrusetia::JBS_NEGERI;
$KATEGORI_URUSETIA_INDUK_JBS_NEGERI = RefKategoriUrusetia::INDUK_JBS_NEGERI;
$KATEGORI_URUSETIA_BAHAGIAN_JBSN = RefKategoriUrusetia::BAHAGIAN_JBSN;
$KATEGORI_URUSETIA_INDUK_JBSN = RefKategoriUrusetia::INDUK_JBSN;

$URL = Url::to(['/profil-badan-sukan/get-badan-sukan']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#permohonanebantuan-laporan").prop("disabled", false);
    $("#permohonanebantuan-kelulusan").prop("disabled", false);
    $("#permohonanebantuan-status_permohonan").prop("disabled", false);
});
        
$(document).ready(function(){
    var readonly = '$readonly';
        
    if(!readonly){
        if($( "#permohonanebantuan-kelulusan" ).val() !== '$KELULUSAN_HQ_LULUS'){
            $( ".field-jumlahDiluluskan" ).hide();
            $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
        }
            
        checkSokongan();
    }
    
});
            
$('#permohonanebantuan-sokongan').change(function(){
    clearKelulusan();
    checkSokongan();
});
           
function hideUpdateCheckboxes(){
    $(".checkbox_update").hide();
}
            
function showUpdateCheckboxes(){
    $(".checkbox_update").show();
}
            
function hideReadCheckboxes(){
    $(".checkbox_read").hide();
}
            
function showReadCheckboxes(){
    $(".checkbox_read").show();
}
            
function checkSokongan() {
    showUpdateCheckboxes(); 
    hideReadCheckboxes();
            
    if($('#permohonanebantuan-sokongan').val() == '$SOKONGAN_NEGERI' && 
        '$PARANAN_PENGGUNA' == '$PARANAN_URUSETIA' &&
       // '$KATEGORI_URUSETIA_PENGGUNA' != '$KATEGORI_URUSETIA_BAHAGIAN_JBSN' &&
        '$KATEGORI_URUSETIA_PENGGUNA' != '$KATEGORI_URUSETIA_INDUK_JBSN'){
        $("#permohonanebantuan-bil_mesyuarat").prop("disabled", false);
        $("#permohonanebantuan-tarikh_mesyuarat-disp").prop("disabled", false);
        $("#permohonanebantuan-laporan").prop("disabled", false);
        $("#permohonanebantuan-kelulusan").prop("disabled", false);
        $("#permohonanebantuan-catatan_pemohon").prop("disabled", false);
    } else if($('#permohonanebantuan-sokongan').val() == '$SOKONGAN_INDUK' && 
        '$PARANAN_PENGGUNA' == '$PARANAN_URUSETIA' && 
       // '$KATEGORI_URUSETIA_PENGGUNA' != '$KATEGORI_URUSETIA_BAHAGIAN_JBSN' &&
        '$KATEGORI_URUSETIA_PENGGUNA' != '$KATEGORI_URUSETIA_INDUK_JBSN'){
        $("#permohonanebantuan-bil_mesyuarat").prop("disabled", true);
        $("#permohonanebantuan-tarikh_mesyuarat-disp").prop("disabled", true);
        $("#permohonanebantuan-laporan").prop("disabled", true);
        $("#permohonanebantuan-kelulusan").prop("disabled", true);
        $("#permohonanebantuan-catatan_pemohon").prop("disabled", true);
        hideUpdateCheckboxes(); 
        showReadCheckboxes();
    } else if($('#permohonanebantuan-sokongan').val() == '$SOKONGAN_NEGERI' && '$PARANAN_PENGGUNA' == '$PARANAN_URUSETIA'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_SEDANG_DISEMAKAN').trigger("change");
        $( ".field-jumlahDiluluskan" ).hide();
        $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
    } else if($('#permohonanebantuan-sokongan').val() == '$SOKONGAN_TAK_LENGKAP'){
        $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_TAK_LENGKAP').trigger("change");
        $( ".field-jumlahDiluluskan" ).hide();
        $( ".field-permohonanebantuan-tarikh_bayar" ).hide();
        $("#permohonanebantuan-bil_mesyuarat").prop("disabled", true);
        $("#permohonanebantuan-tarikh_mesyuarat-disp").prop("disabled", true);
        $("#permohonanebantuan-laporan").prop("disabled", true);
        $("#permohonanebantuan-kelulusan").prop("disabled", true);
    } else if($('#permohonanebantuan-sokongan').val() == ''){
        $("#permohonanebantuan-bil_mesyuarat").prop("disabled", true);
        $("#permohonanebantuan-tarikh_mesyuarat-disp").prop("disabled", true);
        $("#permohonanebantuan-laporan").prop("disabled", true);
        $("#permohonanebantuan-kelulusan").prop("disabled", true);
    }
}
            
function clearKelulusan(){
    $('#permohonanebantuan-bil_mesyuarat').val('').trigger("change");
    $('#permohonanebantuan-tarikh_mesyuarat-disp').attr('value','');
    $('#permohonanebantuan-tarikh_mesyuarat').attr('value','');
    $('#permohonanebantuan-laporan').val('').trigger("change");
    $('#permohonanebantuan-kelulusan').val('').trigger("change");
    $("#permohonanebantuan-status_permohonan").val('$STATUS_PERMOHONAN_SEDANG_DISEMAKAN').trigger("change");
    $('#jumlahDiluluskan').val('');
    $('#permohonanebantuan-tarikh_bayar-disp').attr('value','');
    $('#permohonanebantuan-tarikh_bayar').attr('value','');
}
        
        
$('#permohonanebantuan-negeri_sokongan').change(function(){
    /*if(this.value === '$NEGERI_SOKONGAN_LULUS'){
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
    }*/
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
        
        
$('#persatuanId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
        $('#permohonanebantuan-nama_pertubuhan_persatuan').attr('value',data.nama_badan_sukan);
            $('#permohonanebantuan-kategori_persatuan').val(data.peringkat_badan_sukan).trigger("change");
            $('#permohonanebantuan-no_pendaftaran').attr('value',data.no_pendaftaran);
            $('#permohonanebantuan-alamat_1').attr('value',data.alamat_tetap_badan_sukan_1);
            $('#permohonanebantuan-alamat_2').attr('value',data.alamat_tetap_badan_sukan_2);
            $('#permohonanebantuan-alamat_3').attr('value',data.alamat_tetap_badan_sukan_3);
            $('#permohonanebantuan-alamat_negeri').val(data.alamat_tetap_badan_sukan_negeri).trigger("change");
            $('#permohonanebantuan-alamat_bandar').val(data.alamat_tetap_badan_sukan_bandar).trigger("change");
            $('#permohonanebantuan-alamat_poskod').attr('value',data.alamat_tetap_badan_sukan_poskod);
            $('#permohonanebantuan-no_telefon_pejabat').attr('value',data.no_telefon_pejabat);
            $('#permohonanebantuan-no_fax').attr('value',data.no_faks_pejabat);
        }
    });
});
     
function clearForm(){
        $('#permohonanebantuan-nama_pertubuhan_persatuan').attr('value','');
    $('#permohonanebantuan-kategori_persatuan').val('').trigger("change");
    $('#permohonanebantuan-no_pendaftaran').attr('value','');
    $('#permohonanebantuan-alamat_1').attr('value','');
    $('#permohonanebantuan-alamat_2').attr('value','');
    $('#permohonanebantuan-alamat_3').attr('value','');
    $('#permohonanebantuan-alamat_negeri').val('').trigger("change");
    $('#permohonanebantuan-alamat_bandar').val('').trigger("change");
    $('#permohonanebantuan-alamat_poskod').attr('value','');
    $('#permohonanebantuan-no_telefon_pejabat').attr('value','');
    $('#permohonanebantuan-no_fax').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
