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
use app\models\RefPerkhidmatanBiomekanik;
use app\models\RefUjianStatusBiomekanik;
use app\models\RefSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanAnalisaPerlawananBiomekanik */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perkhidmatan-analisa-perlawanan-biomekanik-form">

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
                                'options' => ['placeholder' => Placeholder::atlet],],
                            'columnOptions'=>['colspan'=>6]],
                        'sukan' => [
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
                        'data'=>ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],
                    ],
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
                'perkhidmatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-perkhidmatan-biomekanik/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPerkhidmatanBiomekanik::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::perkhidmatan],],
                    'columnOptions'=>['colspan'=>6]],
                'tarikh' => [
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
                'pegawai_yang_bertanggungjawab' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'status_ujian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-ujian-status-biomekanik/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefUjianStatusBiomekanik::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusUjian],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catitan_ringkas' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
        
    ]
]);
    ?>
    
     <?php // Muat Naik Video
    if($model->muat_naik_video){
        echo "<label>" . $model->getAttributeLabel('muat_naik_video') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_video , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->perkhidmatan_analisa_perlawanan_biomekanik_id, 'field'=> 'muat_naik_video'], 
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
                        'muat_naik_video' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <h3><?=GeneralLabel::ujian_biomekanik?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'biomekanikUjianGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBiomekanikUjian,
        //'filterModel' => $searchModelBiomekanikUjian,
        'id' => 'biomekanikUjianGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'biomekanik_ujian_id',
            //'perkhidmatan_analisa_perlawanan_biomekanik_id',
            'tarikh',
            //'biomekanik_ujian',
            [
                'attribute' => 'biomekanik_ujian',
                'value' => 'refBiomekanikUjian.desc'
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['biomekanik-ujian/delete', 'id' => $model->biomekanik_ujian_id]).'", "'.GeneralMessage::confirmDelete.'", "biomekanikUjianGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['biomekanik-ujian/update', 'id' => $model->biomekanik_ujian_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::ujian_biomekanik.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['biomekanik-ujian/view', 'id' => $model->biomekanik_ujian_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::ujian_biomekanik.'");',
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
        $perkhidmatan_analisa_perlawanan_biomekanik_id = "";
        
        if(isset($model->perkhidmatan_analisa_perlawanan_biomekanik_id)){
            $perkhidmatan_analisa_perlawanan_biomekanik_id = $model->perkhidmatan_analisa_perlawanan_biomekanik_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['biomekanik-ujian/create', 'perkhidmatan_analisa_perlawanan_biomekanik_id' => $perkhidmatan_analisa_perlawanan_biomekanik_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::ujian_biomekanik.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <h3><?=GeneralLabel::biomekanik_anthropometric?></h3>
    
    <?php Pjax::begin(['id' => 'biomekanikAnthropometricsGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBiomekanikAnthropometrics,
        //'filterModel' => $searchModelBiomekanikAnthropometrics,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'biomekanikAnthropometricsGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'biomekanik_anthropometrics_id',
            //'perkhidmatan_analisa_perlawanan_biomekanik_id',
            //'anthropometrics',
            [
                'attribute' => 'anthropometrics',
                'value' => 'refAnthropometricsUjian.desc'
            ],
            'cm_kg',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['biomekanik-anthropometrics/delete', 'id' => $model->biomekanik_anthropometrics_id]).'", "'.GeneralMessage::confirmDelete.'", "biomekanikAnthropometricsGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['biomekanik-anthropometrics/update', 'id' => $model->biomekanik_anthropometrics_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::biomekanik_anthropometric.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['biomekanik-anthropometrics/view', 'id' => $model->biomekanik_anthropometrics_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::biomekanik_anthropometric.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['biomekanik-anthropometrics/create', 'perkhidmatan_analisa_perlawanan_biomekanik_id' => $perkhidmatan_analisa_perlawanan_biomekanik_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::biomekanik_anthropometric.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    

    <!--<?= $form->field($model, 'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id')->textInput() ?>

    <?= $form->field($model, 'perkhidmatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'status_ujian')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'catitan_ringkas')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
