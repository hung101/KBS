<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefKategoriPersatuan;
use app\models\RefKategoriProgram;
use app\models\RefSokongan;
use app\models\RefBank;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJenisProjek;
use app\models\RefJenisPerkhidmatanAkademik;
use app\models\RefKursusAkademik;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenyelidikan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-penyelidikan-form">

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
                'nama_permohon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'tarikh_permohonan' => [
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
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tajuk_penyelidikan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'jenis_projek' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-projek/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisProjek::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisProjek],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'ringkasan_permohonan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
    ?>
    
    <h3><?=GeneralLabel::penyelidikan_komposisi_pasukan?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'penyelidikanKomposisiPasukanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenyelidikanKomposisiPasukan,
        //'filterModel' => $searchModelPenyelidikanKomposisiPasukan,
        'id' => 'penyelidikanKomposisiPasukanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyelidikan_komposisi_pasukan_id',
            //'permohonana_penyelidikan_id',
            'nama',
            //'pasukan',
            /*[
                'attribute' => 'pasukan',
                'value' => 'refPasukanPenyelidikan.desc'
            ],*/
            //'jawatan',
            [
                'attribute' => 'jawatan',
                'value' => 'refJawatanPasukanPenyelidikan.desc'
            ],
            // 'telefon_no',
            // 'emel',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            'institusi_universiti_syarikat',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penyelidikan-komposisi-pasukan/delete', 'id' => $model->penyelidikan_komposisi_pasukan_id]).'", "'.GeneralMessage::confirmDelete.'", "penyelidikanKomposisiPasukanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyelidikan-komposisi-pasukan/update', 'id' => $model->penyelidikan_komposisi_pasukan_id]).'", "'.GeneralLabel::updateTitle  . ' ' . GeneralLabel::penyelidikan_komposisi_pasukan .'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyelidikan-komposisi-pasukan/view', 'id' => $model->penyelidikan_komposisi_pasukan_id]).'", "'.GeneralLabel::viewTitle  . ' ' . GeneralLabel::penyelidikan_komposisi_pasukan .'");',
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
        $permohonana_penyelidikan_id = "";
        
        if(isset($model->permohonana_penyelidikan_id)){
            $permohonana_penyelidikan_id = $model->permohonana_penyelidikan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penyelidikan-komposisi-pasukan/create', 'permohonana_penyelidikan_id' => $permohonana_penyelidikan_id]).'", "'.GeneralLabel::createTitle  . ' ' . GeneralLabel::penyelidikan_komposisi_pasukan .'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::butiran_akademik?></strong>
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
                                'akademik_nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                                'akademik_ic_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                                'akademik_no_kakitangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                            ],
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'akademik_jenis_perkhidmatan' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2',
                                    'options'=>[
                                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                        [
                                            'append' => [
                                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-perkhidmatan-akademik/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                'asButton' => true
                                            ]
                                        ] : null,
                                        'data'=>ArrayHelper::map(RefJenisPerkhidmatanAkademik::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                        'options' => ['placeholder' => Placeholder::jenisPerkhidmatan],],
                                    'columnOptions'=>['colspan'=>3]],
                                'akademik_kontrak_tarikh_tamat' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'akademik_no_tel_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                                'akademik_emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                            ],
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'akademik_nama_yang_dicadangkan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                                'akademik_kursus' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2',
                                    'options'=>[
                                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                        [
                                            'append' => [
                                                'content' => Html::a(Html::icon('edit'), ['/ref-kursus-akademik/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                'asButton' => true
                                            ]
                                        ] : null,
                                        'data'=>ArrayHelper::map(RefKursusAkademik::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                        'options' => ['placeholder' => Placeholder::kursus],],
                                    'columnOptions'=>['colspan'=>3]],
                            ],
                        ],
                    ]
                ]);
            ?>
            
            <?php // Dokumen Sokongan Upload
    if($model->akademik_dokumen_sokongan){
        echo "<label>" . $model->getAttributeLabel('akademik_dokumen_sokongan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->akademik_dokumen_sokongan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->permohonana_penyelidikan_id, 'field'=> 'akademik_dokumen_sokongan'], 
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
                        'akademik_dokumen_sokongan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
            
        </div>
    </div>
    
    <br>
    
    <h3>Dokumen Penyelidikan</h3>
    
    <?php Pjax::begin(['id' => 'dokumenPenyelidikanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderDokumenPenyelidikan,
        //'filterModel' => $searchModelDokumenPenyelidikan,
        'id' => 'dokumenPenyelidikanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'dokumen_penyelidikan_id',
            //'permohonana_penyelidikan_id',
            'nama_dokumen',
            //'muat_naik',
            [
                'attribute' => 'muat_naik',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->muat_naik){
                        //return Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['target'=>'_blank']);
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->muat_naik .'");'
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['dokumen-penyelidikan/delete', 'id' => $model->dokumen_penyelidikan_id]).'", "'.GeneralMessage::confirmDelete.'", "dokumenPenyelidikanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['dokumen-penyelidikan/update', 'id' => $model->dokumen_penyelidikan_id]).'", "'.GeneralLabel::updateTitle . ' Dokumen Penyelidikan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['dokumen-penyelidikan/view', 'id' => $model->dokumen_penyelidikan_id]).'", "'.GeneralLabel::viewTitle . ' Dokumen Penyelidikan");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['dokumen-penyelidikan/create', 'permohonana_penyelidikan_id' => $permohonana_penyelidikan_id]).'", "'.GeneralLabel::createTitle . ' Dokumen Penyelidikan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3>Bajet Penyelidikan</h3>
    
    <?php Pjax::begin(['id' => 'bajetPenyelidikanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBajetPenyelidikan,
        //'filterModel' => $searchModelBajetPenyelidikan,
        'id' => 'bajetPenyelidikanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bajet_penyelidikan_id',
            //'permohonana_penyelidikan_id',
            //'jenis_bajet',
            [
                'attribute' => 'jenis_bajet',
                'value' => 'refJenisBajet.desc'
            ],
            'tahun',
            'jumlah',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bajet-penyelidikan/delete', 'id' => $model->bajet_penyelidikan_id]).'", "'.GeneralMessage::confirmDelete.'", "bajetPenyelidikanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bajet-penyelidikan/update', 'id' => $model->bajet_penyelidikan_id]).'", "'.GeneralLabel::updateTitle . ' Bajet Penyelidikan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bajet-penyelidikan/view', 'id' => $model->bajet_penyelidikan_id]).'", "'.GeneralLabel::viewTitle . ' Bajet Penyelidikan");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bajet-penyelidikan/create', 'permohonana_penyelidikan_id' => $permohonana_penyelidikan_id]).'", "'.GeneralLabel::createTitle . ' Bajet Penyelidikan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
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
                'biasa_dengan_keperluan_penyelidikan' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>'Ya', false=>'Tidak'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>4]],
                //'kelulusan_echics' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>'Ya', false=>'Tidak'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>4]],
            ],
        ],
    ]
]);
    ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-penyelidikan']['kelulusan_echics']) || $readonly): ?>
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
                'kelulusan_echics' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-penyelidikan']['kelulusan']) || $readonly): ?>
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
                'kelulusan' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>
    
    
    <?php if($model->kelulusan == 1  || $readonly): ?>
    <br>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::untuk_kegunaan_pejabat_sahaja?></strong>
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
                                'isnrp_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                                'tarikh_direkodkan' => [
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
                    ]
                ]);
            ?>
            
        </div>
    </div>
    <?php endif; ?>
    

    <!--<?= $form->field($model, 'nama_permohon')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_permohonan')->textInput() ?>

    <?= $form->field($model, 'tajuk_penyelidikan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'ringkasan_permohonan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'biasa_dengan_keperluan_penyelidikan')->textInput() ?>

    <?= $form->field($model, 'kelulusan_echics')->textInput() ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
