<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use \kartik\datecontrol\Module;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\DatePicker;

// table reference
use app\models\RefTarafPerkahwinan;
use app\models\RefSukan;
use app\models\RefJantina;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefAgama;
use app\models\RefBangsa;
use app\models\RefKawasanTemuduga;
use app\models\RefKategoriOkuEBiasiswa;
use app\models\RefKategoriPengajianEBiasiswa;
use app\models\RefStatusPermohonanEBiasiswa;
use app\models\RefProgramPengajian;
use app\models\RefSemesterTerkini;
use app\models\RefSemesterBaki;
use app\models\RefUniversitiInstitusiEBiasiswa;
use app\models\AdminEBiasiswa;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebiasiswa-form">
    
    <?php
        if(!$model->isNewRecord):
    ?>
    <?php
        if(($model->status_permohonan && $model->status_permohonan == RefStatusPermohonanEBiasiswa::STATUS_SEDANG_DI_SEMAK) || $model->status_permohonan_id  == RefStatusPermohonanEBiasiswa::STATUS_SEDANG_DI_SEMAK):
    ?>
    
    <div class="alert alert-success">
        <strong><?=GeneralLabel::tahniah?>!</strong><?=GeneralLabel::pendaftaran_permohonan_anda_telah_berjaya_dihantar?>
    </div>
    
    <?php
        endif;
    ?>
    
    <?php
        if(($model->status_permohonan && $model->status_permohonan == RefStatusPermohonanEBiasiswa::STATUS_LAYAK_TEMUDUGA) || $model->status_permohonan_id  == RefStatusPermohonanEBiasiswa::STATUS_LAYAK_TEMUDUGA):
    ?>
    
    <div class="alert alert-success">
        <strong><?=GeneralLabel::tahniah?>! </strong><?=GeneralLabel::anda_layak_untuk_temuduga_sila_muat_turun_slip?> <?php echo '&nbsp;&nbsp;' . Html::a(GeneralLabel::muat_turun_slip_layak_temuduga, ['print', 'id' => $model->permohonan_e_biasiswa_id, 'template' => 'SLIP_PANGGILAN_TEMUDUGA'], ['class' => 'btn btn-warning', 'target' => '_blank']);?>
    </div>
    
    <?php
        endif;
    ?>
    
    <?php
        if(($model->status_permohonan && $model->status_permohonan == RefStatusPermohonanEBiasiswa::STATUS_BERJAYA) || $model->status_permohonan_id  == RefStatusPermohonanEBiasiswa::STATUS_BERJAYA):
    ?>
    
    <div class="alert alert-success">
        <strong><?=GeneralLabel::tahniah?>! </strong><?=GeneralLabel::sukacita_dimaklumkan_bahawa_tuan_puan_telah_berjaya_untuk_ditawarkan?> 
            <?php echo '&nbsp;&nbsp;' . Html::a(GeneralLabel::muat_turun_borangborang, Url::to(['/bsp-borang-borang/load', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning']);?>
        <?= Html::a(GeneralLabel::muat_turun_surat_tawaran_biasiswa, ['print', 'id' => $model->permohonan_e_biasiswa_id, 'template' => 'SLIP_BERJAYA_DAPAT_BIASISWA'], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </div>
    
    <?php
        endif;
    ?>
    
    
    
    <?php
        if(($model->status_permohonan && $model->status_permohonan == RefStatusPermohonanEBiasiswa::STATUS_GAGAL) || $model->status_permohonan_id  == RefStatusPermohonanEBiasiswa::STATUS_GAGAL):
    ?>
    
    <div class="alert alert-danger">
        Dukacita dimaklumkan bahawa tuan/puan tidak berjaya untuk ditawarkan Biasiswa Sukan Persekutuan Kementerian Belia dan Sukan Sesi 2017.
    </div>
    
    <?php
        endif;
    ?>
    
    <?php
        endif;
    ?>

    <div class="panel panel-danger">
        <div class="panel-body">
            <strong><?= GeneralLabel::arahan?></strong>
        </div>
        <ul >
            <li ><?= GeneralLabel::sila_lengkapkan_borang_denga_betul?></li>
            <li ><?= GeneralLabel::maklumat_yang_lengkap_sahaja_yang_akan_diproses?></li>
            <li ><?= GeneralLabel::pengemaskinian_maklumat_permohonan_baru_yang_dihantar_akan_membatalkan_permohonan_yang_terdahulu?></li>
            <li ><?= GeneralLabel::pemohon_yang_telah_menerima_biasiswa_tajaan_daripada_agensi_lain_tidak_dibenarkan_memohon?></li>
          </ul>
    </div>
    
    <?php 
        $modelAdminEBiasiswa = null;
        $admin_e_biasiswa_id = null;
        
        if($model->admin_e_biasiswa_read_id && $readonly){
            $admin_e_biasiswa_id = $model->admin_e_biasiswa_read_id;
        } else if($model->admin_e_biasiswa_id){
            $admin_e_biasiswa_id = $model->admin_e_biasiswa_id;
        }
        
        if (($modelAdminEBiasiswa = AdminEBiasiswa::findOne($admin_e_biasiswa_id)) !== null) :
    ?>
        <div class="alert alert-warning">
            <strong><?= GeneralLabel::perhatian?> - </strong> <?= GeneralLabel::permohonan_hanya_terbuka_kepada_atlet_yang_memenuhi_syarat?> <?php echo '&nbsp;&nbsp;' . Html::a(GeneralLabel::muat_turun_syarat_kelayakan, 'javascript:void(0);', ['class'=>'btn btn-warning', 'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/'.$modelAdminEBiasiswa->muat_naik_syarat_kelayakan.'");']);?>
        </div>
    
    <?php endif; ?>
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>
    
    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data'], 'id'=>$model->formName()]); ?>
    
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
                'admin_e_biasiswa_id' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(AdminEBiasiswa::find()->where(['=', 'aktif', 1])->andwhere(['>=', 'tarikh_tamat', date(GeneralVariable::saveDateFormat)])->andwhere(['<=', 'tarikh_mula', date(GeneralVariable::saveDateFormat)])->orderBy('tarikh_tamat')->all(),'admin_e_biasiswa_id', 'nama'),
                        'options' => ['placeholder' => Placeholder::sesiPermohonan, 'disabled'=>true,],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <pre style="text-align: center"><strong><?= strtoupper(GeneralLabel::butiran_peribadi)?></strong></pre>
    
    <?php
    if($model->muat_naik_gambar){
        echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->muat_naik_gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        if(!$readonly){
            echo Html::a(GeneralLabel::removeImage, ['deleteupload', 'id'=>$model->permohonan_e_biasiswa_id, 'field'=> 'muat_naik_gambar'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br><br>';
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
                        'muat_naik_gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['accept' => 'image/*'], 'pluginOptions' => ['previewFileType' => 'image']],
                    ],
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
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'no_kad_pengenalan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12, 'id'=>'NoICID']],
                'tarikh_lahir' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options' => ['id'=>'TarikhLahirID'],
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'umur' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>3, 'disabled'=>true, 'id'=>'UmurID']],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jantina' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefJantina::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jantina],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'keturunan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefBangsa::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bangsa],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'agama' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefAgama::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agama],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'taraf_perkahwinan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefTarafPerkahwinan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tarafPerkahwinan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
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
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                /*'alamat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],*/
                'alamat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>''],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            //'initialize' => true,
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
                'no_tel_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14], 'hint'=>'Keutamaan No Tel Bimbit'],
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
                'kawasan_temuduga_anda' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKawasanTemuduga::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kawasanTemuduga],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                /*'tarikh_temuduga' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],*/
            ]
        ],
        
        
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?= strtoupper(GeneralLabel::butiran_calon_orang_kurang_upaya_oku)?></strong></pre>
    
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
                'no_pendaftaran_oku' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'kategori_oku' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKategoriOkuEBiasiswa::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriOKU, 'id'=>'kategoriOKU'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'oku_lain_lain' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80, 'id'=>'OKULainlain']],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?= strtoupper(GeneralLabel::butiran_pengajian_terkini)?></strong></pre>
    
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
                'no_matriks' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'universiti_institusi' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefUniversitiInstitusiEBiasiswa::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::universitiInstitusi],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'program_pengajian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefProgramPengajian::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::programPengajian],
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
                'kursus_bidang_pengajian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'falkulti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'kategori' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKategoriPengajianEBiasiswa::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
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
                'semester_terkini' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefSemesterTerkini::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::semesterTerkini],
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
                'baki_semester_yang_tinggal' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefSemesterBaki::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::semesterBaki],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'png_semasa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
                'pngk_semasa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                
                //'mendapat_pembiayaan_pendidikan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                /*'mendapat_pembiayaan_pendidikan_bool' =>  [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],*/
                'nyatakan_nama_penaja' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?= strtoupper(GeneralLabel::butiran_pencapaian_sukan_kejohanan)?></strong></pre>
    
    <?php
       /* echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ]
        ],
    ]
]);*/
    ?>
    <br>
    <h3><?= GeneralLabel::penyertaan_kejohanan?></h3>
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong><?= GeneralLabel::arahan?></strong>
  </div>
        <ul >
            <!--<li >Sila pilih tahun untuk memulakan maklumat.</li>-->
            <li ><?= GeneralLabel::pastikan_anda_menyenaraikan_maklumat_kejohanan_sukan?></li>
            <li ><?= GeneralLabel::setiap_kejohanan_yang_dinyatakan_perlu_ada_sijil_penyertaan?></li>
          </ul>
    </div>
  
    <br>
    
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
    
    <?php Pjax::begin(['id' => 'permohonanEBiasiswaPenyertaanKejohananGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanEBiasiswaPenyertaanKejohanan,
        //'filterModel' => $searchModelPermohonanEBiasiswaPenyertaanKejohanan,
        'id' => 'permohonanEBiasiswaPenyertaanKejohananGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyertaan_kejohanan_id',
            //'permohonan_e_biasiswa_id',
            //'sukan',
            [
                'attribute' => 'sukan',
                'value' => 'refSukan.desc'
            ],
            //'tarikh_mula',
            [
                'attribute' => 'tarikh_mula',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula);
                },
            ],
            [
                'attribute' => 'tarikh_akhir',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_akhir);
                },
            ],
            'anjuran',
            //'kejohanan_mewakili',
            [
                'attribute' => 'kejohanan_mewakili',
                'value' => 'refKejohananDiwakili.desc'
            ],
            //'acara',
            [
                'attribute' => 'acara',
                'value' => 'refAcara.desc'
            ],
             'nama_kejohanan',
             'tempat',
            //'pencapaian',
            [
                'attribute' => 'pencapaian',
                'value' => 'refKejohananPencapaian.desc'
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-e-biasiswa-penyertaan-kejohanan/delete', 'id' => $model->penyertaan_kejohanan_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanEBiasiswaPenyertaanKejohananGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-biasiswa-penyertaan-kejohanan/update', 'id' => $model->penyertaan_kejohanan_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::penyertaan_kejohanan . '");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-biasiswa-penyertaan-kejohanan/view', 'id' => $model->penyertaan_kejohanan_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::penyertaan_kejohanan . '");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); 
    ?>
    
    <?php Pjax::end(); ?>
    
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $permohonan_e_biasiswa_id = "";
        
        if(isset($model->permohonan_e_biasiswa_id)){
            $permohonan_e_biasiswa_id = $model->permohonan_e_biasiswa_id;
        }
        
        echo Html::a(GeneralLabel::contoh, 'javascript:void(0);', ['onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/contoh.jpg");']);
        echo '<br>';
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-biasiswa-penyertaan-kejohanan/create', 'permohonan_e_biasiswa_id' => $permohonan_e_biasiswa_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::penyertaan_kejohanan . '");',
                        'class' => 'btn btn-success',
                        ]);
        
        ?>
    </p>
    <?php endif; ?>
    
    <br>
    
   
    <?php
       if($model->isNewRecord){
            echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                'columns'=>12,
                'autoGenerateColumns'=>false, // override columns setting
                'attributes' => [
                    'perakuan_pemohon' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
                ],
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
                'kelulusan' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);*/
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
                        'status_permohonan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2', 
                            'options'=>[
                                'data'=>ArrayHelper::map(RefStatusPermohonanEBiasiswa::find()->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::statusPermohonan],],
                            'columnOptions'=>['colspan'=>4]],
                    ]
                ],
            ]
        ]);
    }
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
                'tarikh_temuduga' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tempat_temuduga' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>90]],
            ]
        ],
        
        
    ]
]);
    }
    ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        
        <?php
            if(($model->status_permohonan && $model->status_permohonan == RefStatusPermohonanEBiasiswa::STATUS_SEDANG_DI_SEMAK) || $model->status_permohonan_id  == RefStatusPermohonanEBiasiswa::STATUS_SEDANG_DI_SEMAK || $model->isNewRecord){
                echo Html::submitButton($model->isNewRecord ? GeneralLabel::send : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
            }
        ?>
        <?php endif; ?>
        <?php
        if(!$model->isNewRecord){
            //echo '&nbsp;&nbsp;' . Html::a('Penjamin Biasiswa Sukan Persekutuan', Url::to(['/bsp-penjamin/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            //echo '&nbsp;&nbsp;' . Html::a('Prestasi Akademik', Url::to(['/bsp-prestasi-akademik/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning']);
            //echo '&nbsp;&nbsp;' . Html::a('Tuntutan Elaun Tesis', Url::to(['/bsp-tuntutan-elaun-tesis/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            //echo '&nbsp;&nbsp;' . Html::a('Elaun Latihan Praktikal', Url::to(['/bsp-elaun-latihan-praktikal/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            //echo '&nbsp;&nbsp;' . Html::a('Elaun Perjalanan Udara', Url::to(['/bsp-elaun-perjalanan-udara/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            //echo '&nbsp;&nbsp;' . Html::a('Pelanjutan', Url::to(['/bsp-perlanjutan/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            //echo '&nbsp;&nbsp;' . Html::a('Pertukaran Program Pengajian', Url::to(['/bsp-pertukaran-program-pengajian/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            //echo '&nbsp;&nbsp;' . Html::a('Pembayaran Biasiswa Sukan Persekutuan', Url::to(['/bsp-pembayaran/index', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            if(($model->status_permohonan && $model->status_permohonan == RefStatusPermohonanEBiasiswa::STATUS_BERJAYA) || $model->status_permohonan_id  == RefStatusPermohonanEBiasiswa::STATUS_BERJAYA){
                echo '&nbsp;&nbsp;' . Html::a(GeneralLabel::muat_turun_borangborang, Url::to(['/bsp-borang-borang/load', 'bsp_pemohon_id' => $model->permohonan_e_biasiswa_id]), ['class'=>'btn btn-warning']);
            }
            if(($model->status_permohonan && $model->status_permohonan == RefStatusPermohonanEBiasiswa::STATUS_LAYAK_TEMUDUGA) || $model->status_permohonan_id  == RefStatusPermohonanEBiasiswa::STATUS_LAYAK_TEMUDUGA){
                echo '&nbsp;&nbsp;' . Html::a( GeneralLabel::muat_turun_slip_layak_temuduga, 'javascript:void(0);', ['class'=>'btn btn-warning', 'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/slip_panggilan_temuduga.pdf");']);
            }
        }
        ?>
    </div>
    
    <?php
        if(!$readonly){
            echo Html::a(GeneralLabel::kembali, ['site/e-biasiswa-home'], ['class' => 'btn btn-warning']);
        }
    ?>

    <?php ActiveForm::end(); ?>

</div>

<?php

$OKULainLain = RefKategoriOkuEBiasiswa::OKU_LAIN_LAIN;
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$(document).ready(function(){
    hideShowOKULainLain($( "#kategoriOKU" ).val());
        
    if($("#NoICID").val() != ""){
        callDOBFromICNo($("#NoICID").val());
    }
        
    if($("#TarikhLahirID").val() != ""){
        $("#UmurID").val(calculateAge($("#TarikhLahirID").val()));
    }
});
        
$('#kategoriOKU').change(function(){
    hideShowOKULainLain(this.value);
});
        
$("#NoICID").focusout(function(){
    callDOBFromICNo(this.value);
});
        
function callDOBFromICNo(value){
    var DOBVal = "";
    
    if(value != ""){
        DOBVal = getDOBFromICNo(value);
    }
    
        
    $("#TarikhLahirID-disp").val(formatDisplayDate(DOBVal));
    $("#TarikhLahirID").val(formatSaveDate(DOBVal));
        
       /* $('#TarikhLahirID').kvDatepicker({
                format: 'mm/dd/yyyy',
                startDate: '-3d'
            });*/
        
    $("#UmurID").val(calculateAge(formatSaveDate(DOBVal)));
        
        
    $("#TarikhLahirID").kvDatepicker("$DateDisplayFormat", new Date(DOBVal)).kvDatepicker({
        format: "$DateDisplayFormat"
    });
}
        
$('#TarikhLahirID').change(function(){
    $("#UmurID").val(calculateAge(this.value));
});
        
function hideShowOKULainLain(value){
    var readonly = '$readonly';
        
    var OKULainLainVal = "$OKULainLain";
        
    if(readonly){
        value = '$model->kategori_oku_id';
    }
        
    //alert(value);
    if(value !== OKULainLainVal){
        $( ".field-OKULainlain" ).hide();
    } else {
        $( ".field-OKULainlain" ).show();
    }
}
        
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {
        if(document.getElementById("permohonanebiasiswa-perakuan_pemohon").checked){
            var form = $(this);
        
            $("form#{$model->formName()} input").prop("disabled", false);
        } else {
            alert('Sila tanda "Perakuan Pemohon"');
            
            return false;
        }
    });
        
JS;
        
$this->registerJs($script);
?>
