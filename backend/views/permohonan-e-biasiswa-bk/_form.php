<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

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

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebiasiswa-form">

    <div class="panel panel-danger">
        <div class="panel-body">
            <strong>Arahan</strong>
  </div>
        <ul >
            <li >Sila lengkapkan borang dengan betul.</li>
            <li >Maklumat yang lengkap sahaja yang akan diproses.</li>
            <li >Pengemaskinian maklumat permohonan baru yang dihantar akan membatalkan permohonan yang terdahulu.</li>
            <li >Pemohon yang telah menerima Biasiswa/Tajaan daripada agensi lain tidak dibenarkan memohon.</li>
          </ul>
    </div>
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>
    
    <br>
    <pre style="text-align: center"><strong>BUTIRAN PERIBADI</strong></pre>
    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->errorSummary($model); ?>
    
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
                'no_kad_pengenalan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'tarikh_lahir' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'umur' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>3]],
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
                        'options' => ['placeholder' => Placeholder::jantina],],
                    'columnOptions'=>['colspan'=>3]],
                'keturunan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefBangsa::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bangsa],],
                    'columnOptions'=>['colspan'=>3]],
                'agama' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefAgama::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agama],],
                    'columnOptions'=>['colspan'=>3]],
                'taraf_perkahwinan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefTarafPerkahwinan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tarafPerkahwinan],],
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
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
                'alamat_bandar' => [
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
                    'columnOptions'=>['colspan'=>3]],
                'alamat_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_tel_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kawasan_temuduga_anda' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKawasanTemuduga::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kawasanTemuduga],],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_temuduga' => [
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
    <br>
    <br>
    <pre style="text-align: center"><strong>BUTIRAN CALON ORANG KURANG UPAYA (OKU)</strong></pre>
    
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
                        'options' => ['placeholder' => Placeholder::kategoriOKU],],
                    'columnOptions'=>['colspan'=>3]],
                'oku_lain_lain' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>BUTIRAN PENGAJIAN TERKINI</strong></pre>
    
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
                'universiti_institusi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'program_pengajian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
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
                        'options' => ['placeholder' => Placeholder::kategori],],
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
                'semester_terkini' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'baki_semester_yang_tinggal' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'png_semasa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
                'pngk_semasa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                
                //'mendapat_pembiayaan_pendidikan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                'mendapat_pembiayaan_pendidikan_bool' =>  [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],
                'nyatakan_nama_penaja' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
            ]
        ],
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>BUTIRAN PENCAPAIAN SUKAN / KEJOHANAN</strong></pre>
    
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
                'sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>5]],
            ]
        ],
    ]
]);
    ?>
    <br>
    <h3>Penyertaan Kejohanan</h3>
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong>Arahan</strong>
  </div>
        <ul >
            <li >Sila pilih tahun untuk memulakan maklumat.</li>
            <li >Pastikan anda menyenaraikan maklumat kejohanan sukan mengikut susunan tarikh & tahun.</li>
            <li >Setiap kejohanan yang dinyatakan perlu ada sijil penyertaan / surat pengesahan sebagai bukti penyertaan bagi temuduga nanti.</li>
          </ul>
    </div>
  
    <br>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
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
            'tarikh',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-biasiswa-penyertaan-kejohanan/update', 'id' => $model->penyertaan_kejohanan_id]).'", "'.GeneralLabel::updateTitle . ' Penyertaan Kejohanan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-biasiswa-penyertaan-kejohanan/view', 'id' => $model->penyertaan_kejohanan_id]).'", "'.GeneralLabel::viewTitle . ' Penyertaan Kejohanan");',
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
        $permohonan_e_biasiswa_id = "";
        
        if(isset($model->permohonan_e_biasiswa_id)){
            $permohonan_e_biasiswa_id = $model->permohonan_e_biasiswa_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-e-biasiswa-penyertaan-kejohanan/create', 'permohonan_e_biasiswa_id' => $permohonan_e_biasiswa_id]).'", "'.GeneralLabel::createTitle . ' Penyertaan Kejohanan");',
                        'class' => 'btn btn-success',
                        ]);?>
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
                            //'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4]],
                            'contoh' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>4]],
                        ]
                    ],
                ]
            ]);
    }
    
    
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

    <!--<?= $form->field($model, 'muat_naik_gambar')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_kad_pengenalan')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'jantina')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'keturunan')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'agama')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'taraf_perkahwinan')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'kawasan_temuduga_anda')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_1')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_2')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_3')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'no_tel_bimbit')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'no_pendaftaran_oku')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'kategori_oku')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'oku_lain_lain')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'universiti_institusi')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'program_pengajian')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kursus_bidang_pengajian')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'falkulti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kategori')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tarikh_tamat')->textInput() ?>

    <?= $form->field($model, 'semester_terkini')->textInput() ?>

    <?= $form->field($model, 'baki_semester_yang_tinggal')->textInput() ?>

    <?= $form->field($model, 'no_matriks')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'mendapat_pembiayaan_pendidikan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'sukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'perakuan_pemohon')->textInput() ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>

    <?= $form->field($model, 'status_permohonan')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?= Html::a('Kembali', ['site/e-biasiswa-home'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
