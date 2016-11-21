<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\RefStatusKhidmatPerubatan;
use app\models\RefKategoriServis;
use app\models\RefKategoriServisSub;
use app\models\RefTempatKhidmatPerubatan;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khidmat-perubatan-dan-sains-sukan-form">

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
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kategori_servis' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-servis/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriServis::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriServis],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'servis' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-kategori-servis-sub/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefKategoriServisSub::find()->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'kategori_servis')],
                            'placeholder' => Placeholder::servis,
                            'url'=>Url::to(['/ref-kategori-servis-sub/sub-servis'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-tempat-khidmat-perubatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefTempatKhidmatPerubatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::tempat],
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
                 
            ],
        ],
    ]
]);
        ?>
    
    <?php // Muat Naik
    if($model->muat_naik){
        echo "<label>" . $model->getAttributeLabel('muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->khidmat_perubatan_dan_sains_sukan_id, 'field'=> 'muat_naik'], 
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
    
    <h3>Atlet</h3>
    
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
    
    <?php Pjax::begin(['id' => 'atletGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAtlet,
        //'filterModel' => $searchModelAtlet,
        'id' => 'atletGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'khidmat_perubatan_dan_sains_sukan_atlet_id',
            //'khidmat_perubatan_dan_sains_sukan_id',
            //'program',
            [
                'attribute' => 'program',
                'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
            //'sukan',
            [
                'attribute' => 'sukan',
                'value' => 'refSukan.desc'
            ],
            //'atlet',
            [
                'attribute' => 'atlet',
                'value' => 'refAtlet.name_penuh'
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-atlet/delete', 'id' => $model->khidmat_perubatan_dan_sains_sukan_atlet_id]).'", "'.GeneralMessage::confirmDelete.'", "atletGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-atlet/update', 'id' => $model->khidmat_perubatan_dan_sains_sukan_atlet_id]).'", "'.GeneralLabel::updateTitle . ' Atlet");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-atlet/view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_atlet_id]).'", "'.GeneralLabel::viewTitle . ' Atlet");',
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
        $khidmat_perubatan_dan_sains_sukan_id = "";
        
        if(isset($model->khidmat_perubatan_dan_sains_sukan_id)){
            $khidmat_perubatan_dan_sains_sukan_id = $model->khidmat_perubatan_dan_sains_sukan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-atlet/create', 'khidmat_perubatan_dan_sains_sukan_id' => $khidmat_perubatan_dan_sains_sukan_id]).'", "'.GeneralLabel::createTitle . ' Atlet");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3>Jurulatih</h3>
    
    
    <?php Pjax::begin(['id' => 'jurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderJurulatih,
        //'filterModel' => $searchModelJurulatih,
        'id' => 'jurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'khidmat_perubatan_dan_sains_sukan_jurulatih_id',
            //'khidmat_perubatan_dan_sains_sukan_id',
            //'program',
            [
                'attribute' => 'program',
                'value' => 'refProgramJurulatih.desc'
            ],
            //'sukan',
            [
                'attribute' => 'sukan',
                'value' => 'refSukan.desc'
            ],
            //'jurulatih',
            [
                'attribute' => 'program',
                'value' => 'refJurulatih.nama'
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-jurulatih/delete', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "jurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-jurulatih/update', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' Jurulatih");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-jurulatih/view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' Jurulatih");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-jurulatih/create', 'khidmat_perubatan_dan_sains_sukan_id' => $khidmat_perubatan_dan_sains_sukan_id]).'", "'.GeneralLabel::createTitle . ' Jurulatih");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    
    <h3>Pegawai</h3>
    
    
    <?php Pjax::begin(['id' => 'pegawaiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPegawai,
        //'filterModel' => $searchModelPegawai,
        'id' => 'pegawaiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'khidmat_perubatan_dan_sains_sukan_pegawai_id',
            //'khidmat_perubatan_dan_sains_sukan_id',
            'nama_pegawai',
            'jawatan',
            'agensi',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-pegawai/delete', 'id' => $model->khidmat_perubatan_dan_sains_sukan_pegawai_id]).'", "'.GeneralMessage::confirmDelete.'", "pegawaiGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-pegawai/update', 'id' => $model->khidmat_perubatan_dan_sains_sukan_pegawai_id]).'", "'.GeneralLabel::updateTitle . ' Pegawai");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-pegawai/view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_pegawai_id]).'", "'.GeneralLabel::viewTitle . ' Pegawai");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['khidmat-perubatan-dan-sains-sukan-pegawai/create', 'khidmat_perubatan_dan_sains_sukan_id' => $khidmat_perubatan_dan_sains_sukan_id]).'", "'.GeneralLabel::createTitle . ' Pegawai");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['khidmat-perubatan-dan-sains-sukan']['status'])){
        
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-khidmat-perubatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusKhidmatPerubatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
            ]
        ]);
    }
    ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
