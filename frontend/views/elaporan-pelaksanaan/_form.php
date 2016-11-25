<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;

// table reference
use app\models\RefKategoriELaporan;
use app\models\RefPeringkatELaporan;
use app\models\RefProgramRumusan;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefParlimen;
use app\models\RefBahagianELaporan;
use app\models\RefCawanganELaporan;
use app\models\RefKelulusanELaporan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-pelaksanaan-form">

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
                'kategori_elaporan' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-e-laporan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriELaporan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriELaporan],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>5]],
                'bahagian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-e-laporan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBahagianELaporan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bahagian],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>3]],
                'cawangan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-cawangan-e-laporan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefCawanganELaporan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'bahagian')],
                            'placeholder' => Placeholder::cawangan,
                            'url'=>Url::to(['/ref-cawangan-e-laporan/subcawangans'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_projek_program_aktiviti_kejohanan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'nama_penganjur_persatuan_kerjasama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'peringkat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peringkat-e-laporan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeringkatELaporan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkat],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_bantuan_peruntukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'jumlah_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                //'no_cek_eft' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                //'tarikh_cek_eft' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_pelaksanaan_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_pelaksanaan_akhir' => [
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
            'attributes' => [
                'alamat_tempat_pelaksanaan_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_tempat_pelaksanaan_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_tempat_pelaksanaan_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_tempat_pelaksanaan_negeri' => [
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
                'alamat_tempat_pelaksanaan_bandar' => [
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
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_tempat_pelaksanaan_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_tempat_pelaksanaan_parlimen' => [
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
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefParlimen::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_tempat_pelaksanaan_negeri')],
                            'placeholder' => Placeholder::parlimen,
                            'url'=>Url::to(['/ref-parlimen/subparlimens'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_tempat_pelaksanaan_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'l_melayu' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'l_melayu']],
                'l_cina' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'l_cina']],
                'l_india' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'l_india']],
                'l_lain_lain' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'l_lain_lain']],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'p_melayu' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'p_melayu']],
                'p_cina' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'p_cina']],
                'p_india' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'p_india']],
                'p_lain_lain' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'p_lain_lain']],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'perempuan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'perempuan']],
                'lelaki' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'lelaki']],
                'jumlah_penyertaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11, 'id'=>'jumlah_penyertaan']],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'dirasmikan_oleh' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                
            ]
        ],
    ]
]);
    ?>
    
    <?php // Muat Naik
    if($model->muat_naik){
        echo "<label>" . $model->getAttributeLabel('muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->elaporan_pelaksaan_id, 'field'=> 'muat_naik'], 
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
    
    <br>
    <br>
    
    <h3><?=GeneralLabel::rumusan_kekurangan;?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'kekuranganGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKekurangan,
        //'filterModel' => $searchModelKekurangan,
        'id' => 'kekuranganGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_kekurangan_id',
            //'elaporan_pelaksaan_id',
            'kekurangan',
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['elaporan-pelaksanaan-kekurangan/delete', 'id' => $model->elaporan_pelaksanaan_kekurangan_id]).'", "'.GeneralMessage::confirmDelete.'", "kekuranganGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kekurangan/update', 'id' => $model->elaporan_pelaksanaan_kekurangan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::rumusan_kekurangan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kekurangan/view', 'id' => $model->elaporan_pelaksanaan_kekurangan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::rumusan_kekurangan.'");',
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
        $elaporan_pelaksaan_id = "";
        
        if(isset($model->elaporan_pelaksaan_id)){
            $elaporan_pelaksaan_id = $model->elaporan_pelaksaan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kekurangan/create', 'elaporan_pelaksaan_id' => $elaporan_pelaksaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::rumusan_kekurangan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    
    <h3><?=GeneralLabel::rumusan_kelebihan;?></h3>
    
    <?php Pjax::begin(['id' => 'kelebihanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKelebihan,
        //'filterModel' => $searchModelKelebihan,
        'id' => 'kelebihanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_kelebihan_id',
            //'elaporan_pelaksaan_id',
            'kelebihan',
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['elaporan-pelaksanaan-kelebihan/delete', 'id' => $model->elaporan_pelaksanaan_kelebihan_id]).'", "'.GeneralMessage::confirmDelete.'", "kelebihanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kelebihan/update', 'id' => $model->elaporan_pelaksanaan_kelebihan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::rumusan_kelebihan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kelebihan/view', 'id' => $model->elaporan_pelaksanaan_kelebihan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::rumusan_kelebihan.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kelebihan/create', 'elaporan_pelaksaan_id' => $elaporan_pelaksaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::rumusan_kelebihan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    
    <h3><?=GeneralLabel::kerjasama;?></h3>
    
    <?php Pjax::begin(['id' => 'kerjasamaGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKerjasama,
        //'filterModel' => $searchModelKerjasama,
        'id' => 'kerjasamaGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_kerjasama_id',
            //'elaporan_pelaksaan_id',
            'nama_kerjasama',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['elaporan-pelaksanaan-kerjasama/delete', 'id' => $model->elaporan_pelaksanaan_kerjasama_id]).'", "'.GeneralMessage::confirmDelete.'", "kerjasamaGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kerjasama/update', 'id' => $model->elaporan_pelaksanaan_kerjasama_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::kerjasama.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kerjasama/view', 'id' => $model->elaporan_pelaksanaan_kerjasama_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::kerjasama.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-kerjasama/create', 'elaporan_pelaksaan_id' => $elaporan_pelaksaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::kerjasama.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    
    <br>
    <br>
    <h3><?=GeneralLabel::objektif_pelaksanaan;?></h3>
    
    <?php Pjax::begin(['id' => 'objektifGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderObjektif,
        //'filterModel' => $searchModelObjektif,
        'id' => 'objektifGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_objektif_id',
            //'elaporan_pelaksaan_id',
            'objektif_pelaksanaan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['elaporan-pelaksanaan-objektif/delete', 'id' => $model->elaporan_pelaksanaan_objektif_id]).'", "'.GeneralMessage::confirmDelete.'", "objektifGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-objektif/update', 'id' => $model->elaporan_pelaksanaan_objektif_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::objektif_pelaksanaan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-objektif/view', 'id' => $model->elaporan_pelaksanaan_objektif_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::objektif_pelaksanaan.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-objektif/create', 'elaporan_pelaksaan_id' => $elaporan_pelaksaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::objektif_pelaksanaan.'");',
                        'class' => 'btn btn-success',
                        ]);
        ?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    <h3><?=GeneralLabel::gambar;?></h3>
    
    <div class="alert alert-warning alert-dismissible" role="alert">
  <!--<strong>Note:</strong> Mininum 4 gambar dan 10 gambar maksimum. Hanya format .jpg atau .png sahaja-->
        <strong><?=GeneralLabel::nota;?>:</strong> <?=GeneralMessage::minimum_4_gambar_dan_10_gambar_maksimum;?>.
</div>

    <?php Pjax::begin(['id' => 'gambarGrid', 'timeout' => 100000]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProviderGambar,
        //'filterModel' => $searchModelGambar,
        'id' => 'gambarGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_gambar_id',
            //'elaporan_pelaksaan_id',
            //'muat_naik_gambar',
            [
                'attribute' => 'muat_naik_gambar',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->muat_naik_gambar){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->muat_naik_gambar .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            'tajuk',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['elaporan-pelaksanaan-gambar/delete', 'id' => $model->elaporan_pelaksanaan_gambar_id]).'", "'.GeneralMessage::confirmDelete.'", "gambarGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-gambar/update', 'id' => $model->elaporan_pelaksanaan_gambar_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::gambar.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-gambar/view', 'id' => $model->elaporan_pelaksanaan_gambar_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::gambar.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaporan-pelaksanaan-gambar/create', 'elaporan_pelaksaan_id' => $elaporan_pelaksaan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::gambar.'");',
                        'class' => 'btn btn-success',
                        ]);
        ?>
    </p>
    <?php endif; ?>
    
    <br>
    
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
                        'creator_nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                        'creator_emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
                        'creator_mobile_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14]],
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
                        'kelulusan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-kelulusan-e-laporan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefKelulusanELaporan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::kelulusan],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                    ],
                ],

            ]
        ]);
    ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS

$('#l_melayu').on("keyup", function(){calculatePeserta();});
$('#l_cina').on("keyup", function(){calculatePeserta();});
$('#l_india').on("keyup", function(){calculatePeserta();});
$('#l_lain_lain').on("keyup", function(){calculatePeserta();});
$('#p_melayu').on("keyup", function(){calculatePeserta();});
$('#p_cina').on("keyup", function(){calculatePeserta();});
$('#p_india').on("keyup", function(){calculatePeserta();});
$('#p_lain_lain').on("keyup", function(){calculatePeserta();});
        
function calculatePeserta(){
    var l_melayu = 0;
    var l_cina = 0;
    var l_india = 0;
    var l_lain_lain = 0;
    var p_melayu = 0;
    var p_cina = 0;
    var p_india = 0;
    var p_lain_lain = 0;
    var perempuan = 0;
    var lelaki = 0;
    var jumlah_peserta = 0;
        
    if($('#l_melayu').val() > 0){l_melayu = parseInt($('#l_melayu').val());}
    if($('#l_cina').val() > 0){l_cina = parseInt($('#l_cina').val());}
    if($('#l_india').val() > 0){l_india = parseInt($('#l_india').val());}
    if($('#l_lain_lain').val() > 0){l_lain_lain = parseInt($('#l_lain_lain').val());}
    if($('#p_melayu').val() > 0){p_melayu = parseInt($('#p_melayu').val());}
    if($('#p_cina').val() > 0){p_cina = parseInt($('#p_cina').val());}
    if($('#p_india').val() > 0){p_india = parseInt($('#p_india').val());}
    if($('#p_lain_lain').val() > 0){p_lain_lain = parseInt($('#p_lain_lain').val());}
    
    // Total Lelaki Peserta
    lelaki = l_melayu + l_cina + l_india + l_lain_lain;
    // Total Perempuan Peserta
    perempuan = p_melayu + p_cina + p_india + p_lain_lain;
    // Total Overall Peserta
    jumlah_peserta = perempuan + lelaki;
        
    //display at fields accordingly
    $('#lelaki').val(lelaki);
    $('#perempuan').val(perempuan);
    $('#jumlah_penyertaan').val(jumlah_peserta);
}  
        
JS;
        
$this->registerJs($script);
?>
