<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

// table reference
use app\models\ProfilBadanSukan;
use app\models\RefStatusLaporanMesyuaratAgung;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\Placeholder;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-minit-mesyuarat-jawatankuasa-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php
    if(!Yii::$app->user->identity->profil_badan_sukan || $readonly){
        echo FormGrid::widget([
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
                                'options' => ['placeholder' => Placeholder::badanSukan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                            'columnOptions'=>['colspan'=>3]],
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
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'masa' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh' => [
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
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>9],'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'mengikut_perlembagaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>255]],
                'kehadiran_ahli_yang_layak_mengundi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>11]],
                //'korum_mesyuarat_jumlah_ahli_yang_hadir' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>255]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_ahli_yang_hadir' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>11]],
            ]
        ],*/
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'agenda_mesyuarat' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'keputusan_mesyuarat' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>255]],
            ]
        ],*/
    ]
]);
        
        
        
    ?>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('minit_ajk_muat_naik');
    
    if($model->minit_ajk_muat_naik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('minit_ajk_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->minit_ajk_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'minit_ajk_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <br>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('notis_agm_muat_naik');
    
    if($model->notis_agm_muat_naik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('notis_agm_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->notis_agm_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'notis_agm_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    <br>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('minit_agm_muat_naik');
    
    if($model->minit_agm_muat_naik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('minit_agm_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->minit_agm_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'minit_agm_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    <br>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    if(Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN){

       $label = $model->getAttributeLabel('laporan_kewangan_muat_naik');

       if($model->laporan_kewangan_muat_naik){
           echo "<div class='required'>";
           echo "<label>" . $model->getAttributeLabel('laporan_kewangan_muat_naik') . "</label><br>";
           echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->laporan_kewangan_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                               'laporan_kewangan_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                           ],
                       ],
                   ]
               ]);
           echo "</div>";
       }
    }
    ?>
    
    <br>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('laporan_aktiviti_muat_naik');
    
    if($model->laporan_aktiviti_muat_naik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('laporan_aktiviti_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->laporan_aktiviti_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'laporan_aktiviti_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    <br>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('borang_pt_muat_naik');
    
    if($model->borang_pt_muat_naik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('borang_pt_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->borang_pt_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'borang_pt_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    <br>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('senarai_ahli_jawatankuasa_muat_naik');
    
    if($model->senarai_ahli_jawatankuasa_muat_naik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('senarai_ahli_jawatankuasa_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->senarai_ahli_jawatankuasa_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'senarai_ahli_jawatankuasa_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    <br>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('senarai_ahli_gabungan_terkini_muat_naik');
    
    if($model->senarai_ahli_gabungan_terkini_muat_naik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('senarai_ahli_gabungan_terkini_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->senarai_ahli_gabungan_terkini_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'senarai_ahli_gabungan_terkini_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label, 'hint'=>GeneralLabel::getFileUploadHint()],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    <br>
    
    <?php
    $disabledStatus = true;
    if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['status'])){
        $disabledStatus = false;
    }
    
        if(!Yii::$app->user->identity->profil_badan_sukan || $readonly){
            echo FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'status' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2',
                                    'options'=>[
                                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                        [
                                            'append' => [
                                                'content' => Html::a(Html::icon('edit'), ['/ref-status-laporan-mesyuarat-agung/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                'asButton' => true
                                            ]
                                        ] : null,
                                        'data'=>ArrayHelper::map(RefStatusLaporanMesyuaratAgung::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                        'options' => ['placeholder' => Placeholder::status, 'disabled' => $disabledStatus],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],],
                                    'columnOptions'=>['colspan'=>5]],
                            ],
                        ],
                    [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                 'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>9],'options'=>['maxlength'=>255]],
                            ],
                        ],
                    ]
                ]);
        }
    ?>
    
    <!--<br>
    
    <h3>Senarai Nama Kehadiran Mesyuarat Agong</h3>
    
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

    <?php Pjax::begin(['id' => 'senaraiNamaKehadiranGrid', 'timeout' => 100000]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProviderSNKMA,
        //'filterModel' => $searchModelSNKMA,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_nama_hadir_id',
            //'mesyuarat_agm_id',
            'nama_penuh',
            'no_kad_pengenalan',
            //'jantina',
            //'jawatan',
            //'kategori_keahlian',
            [
                'attribute' => 'kategori_keahlian',
                'value' => 'refKategoriKeahlian.desc'
            ],
            //'kehadiran',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['ltbs-senarai-nama-hadir-agm/delete', 'id' => $model->senarai_nama_hadir_id]).'", "'.GeneralMessage::confirmDelete.'", "senaraiNamaKehadiranGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-senarai-nama-hadir-agm/update', 'id' => $model->senarai_nama_hadir_id]).'", "'.GeneralLabel::updateTitle . ' Nama Kehadiran Mesyuarat Agong");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-senarai-nama-hadir-agm/view', 'id' => $model->senarai_nama_hadir_id]).'", "'.GeneralLabel::viewTitle . ' Nama Kehadiran Mesyuarat Agong");',
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
        $mesyuarat_id = "";
        
        if(isset($model->mesyuarat_id)){
            $mesyuarat_id = $model->mesyuarat_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-senarai-nama-hadir-agm/create', 'mesyuarat_agm_id' => $mesyuarat_id]).'", "'.GeneralLabel::createTitle . ' Nama Kehadiran Mesyuarat Agong");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3>Muat Naik Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong</h3>
    
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

    <?php Pjax::begin(['id' => 'muatNaikGrid', 'timeout' => 100000]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProviderDMN,
        //'filterModel' => $searchModelDMN,
        'id' => 'muatNaikGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'dokumen_muat_naik_id',
            //'mesyuarat_id',
            'nama_dokumen',
            //'muat_naik',
            [
                'attribute' => 'muat_naik',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->muat_naik){
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik/delete', 'id' => $model->dokumen_muat_naik_id]).'", "'.GeneralMessage::confirmDelete.'", "muatNaikGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik/update', 'id' => $model->dokumen_muat_naik_id]).'", "'.GeneralLabel::updateTitle . ' Muat Naik Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik/view', 'id' => $model->dokumen_muat_naik_id]).'", "'.GeneralLabel::viewTitle . ' Muat Naik Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik/create', 'mesyuarat_id' => $mesyuarat_id]).'", "'.GeneralLabel::createTitle . ' Muat Naik Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <h3>Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong</h3>
    
    <?php Pjax::begin(['id' => 'senaraiKehadiranGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderSNH,
        //'filterModel' => $searchModelSNH,
        'id' => 'senaraiKehadiranGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'mesyuarat_id',
            'nama_penuh',
            'jawatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['ltbs-senarai-nama-hadir-jawatankuasa/delete', 'id' => $model->senarai_nama_hadi_id]).'", "'.GeneralMessage::confirmDelete.'", "senaraiKehadiranGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-senarai-nama-hadir-jawatankuasa/update', 'id' => $model->senarai_nama_hadi_id]).'", "'.GeneralLabel::updateTitle . ' Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-senarai-nama-hadir-jawatankuasa/view', 'id' => $model->senarai_nama_hadi_id]).'", "'.GeneralLabel::viewTitle . ' Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-senarai-nama-hadir-jawatankuasa/create', 'mesyuarat_id' => $mesyuarat_id]).'", "'.GeneralLabel::createTitle . ' Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <h3>Notis Mesyuarat Agong</h3>
    
    <?php Pjax::begin(['id' => 'notisMesyuaratAgongGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderNMA,
        //'filterModel' => $searchModelNMA,
        'id' => 'notisMesyuaratAgongGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tbl_ltbs_id',
            'nama_mesyuarat_agong',
            'tahun',
            //'notis_agm',
            [
                'attribute' => 'notis_agm',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->notis_agm){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->notis_agm .'");'
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['ltbs-notis-agm/delete', 'id' => $model->tbl_ltbs_id]).'", "'.GeneralMessage::confirmDelete.'", "notisMesyuaratAgongGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-notis-agm/update', 'id' => $model->tbl_ltbs_id]).'", "'.GeneralLabel::updateTitle . ' Notis Mesyuarat Agong");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-notis-agm/view', 'id' => $model->tbl_ltbs_id]).'", "'.GeneralLabel::viewTitle . ' Notis Mesyuarat Agong");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-notis-agm/create', 'mesyuarat_id' => $mesyuarat_id]).'", "'.GeneralLabel::createTitle . ' Notis Mesyuarat Agong");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>-->

    <!--<?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'masa')->textInput() ?>

    <?= $form->field($model, 'tempat')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'mengikut_perlembagaan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'jumlah_ahli_yang_hadir')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
        
// enable all the disabled field before submit
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>