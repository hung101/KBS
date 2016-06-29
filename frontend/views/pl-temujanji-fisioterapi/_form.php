<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\Atlet;
use app\models\RefJenisTemujanjiFisioterapi;
use app\models\RefStatusTemujanjiFisioterapi;
use app\models\RefPegawaiPerubatanFisioterapi;
use app\models\RefNamaFisioterapi;
use app\models\RefKategoriPesakitLuar;
use app\models\RefTindakanSelanjutnyaFisioterapi;
use app\models\RefKategoriRawatan;
use app\models\RefSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PlTemujanjiFisioterapi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pl-temujanji-form">

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
                
                'kategori_pesakit_luar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-pesakit-luar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPesakitLuar::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'jenis_sukan' => [
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
                    'columnOptions'=>['colspan'=>3]],
                'atlet_id' => [
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
                        'options' => ['placeholder' => Placeholder::atlet],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                
                //'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                //'nama_pesakit_luar' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                
                
                'tarikh_temujanji' => [
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
                'kategori_rawatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-rawatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriRawatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
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
                'makmal_perubatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-temujanji-fisioterapi/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisTemujanjiFisioterapi::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisTemujanji],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'status_temujanji' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-temujanji-fisioterapi/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusTemujanjiFisioterapi::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusTemujanji],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tindakan_selanjutnya' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-tindakan-selanjutnya-fisioterapi/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTindakanSelanjutnyaFisioterapi::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tindakanSelanjutnya],
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
                'nama_fisioterapi' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-nama-fisioterapi/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNamaFisioterapi::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::namaFisioterapi],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
                'pegawai_yang_bertanggungjawab' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-pegawai-perubatan-fisioterapi/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPegawaiPerubatanFisioterapi::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::pegawai],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catitan_ringkas' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'maklumbalas' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
    ?>
    
    <?php // Muat Naik Upload
    if($model->muat_naik){
        echo "<label>" . $model->getAttributeLabel('muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->pl_temujanji_id, 'field'=> 'muat_naik'], 
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
                        'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <h3><?=GeneralLabel::fisioterapi_diagnosis?></h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => Modal::SIZE_LARGE,
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'diagnosisPreskripsiPemeriksaanPenyiasatanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi,
        //'filterModel' => $searchModelPlDiagnosisPreskripsiPemeriksaanFisioterapi,
        'id' => 'diagnosisPreskripsiPemeriksaanPenyiasatanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pl_diagnosis_preskripsi_pemeriksaan_id',
            //'pl_temujanji_id',
            //'jenis_diagnosis_preskripsi_pemeriksaan',
            [
                'attribute' => 'bahagian_kecederaan',
                'value' => 'refBahagianKecederaan.desc'
            ],
            'status_diagnosis_preskripsi_pemeriksaan',
            [
                'attribute' => 'rawatan_fisioterapi',
                'value' => 'refRawatanFisioterapi.desc'
            ],
            //'catitan_ringkas',
            'harga',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pl-diagnosis-preskripsi-pemeriksaan-fisioterapi/delete', 'id' => $model->pl_diagnosis_preskripsi_pemeriksaan_id]).'", "'.GeneralMessage::confirmDelete.'", "diagnosisPreskripsiPemeriksaanPenyiasatanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pl-diagnosis-preskripsi-pemeriksaan-fisioterapi/update', 'id' => $model->pl_diagnosis_preskripsi_pemeriksaan_id]).'", "'.GeneralLabel::updateTitle . ' ' . GeneralLabel::fisioterapi_diagnosis .'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pl-diagnosis-preskripsi-pemeriksaan-fisioterapi/view', 'id' => $model->pl_diagnosis_preskripsi_pemeriksaan_id]).'", "'.GeneralLabel::viewTitle . ' ' . GeneralLabel::fisioterapi_diagnosis .'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $calculate_jumlah_caj_fi = 0.00;
        foreach($dataProviderPlDiagnosisPreskripsiPemeriksaanFisioterapi->models as $APmodel){
            $calculate_jumlah_caj_fi += $APmodel->harga;
        }
    ?>
    
    <h4>Jumlah Caj / Fi : RM <?=$calculate_jumlah_caj_fi?></h4>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $pl_temujanji_id = "";
        
        if(isset($model->pl_temujanji_id)){
            $pl_temujanji_id = $model->pl_temujanji_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pl-diagnosis-preskripsi-pemeriksaan-fisioterapi/create', 'pl_temujanji_id' => $pl_temujanji_id]).'", "'.GeneralLabel::createTitle . ' ' . GeneralLabel::fisioterapi_diagnosis .'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'tarikh_temujanji')->textInput() ?>

    <?= $form->field($model, 'doktor_pegawai_perubatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'makmal_perubatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'status_temujanji')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'catitan_ringkas')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
