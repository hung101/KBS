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
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\RefJantina;
use app\models\RefSukan;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanPermakanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perkhidmatan-permakanan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
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
                'pegawai_yang_bertanggungjawab' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jantina/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJantina::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jantina],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
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
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catitan_ringkas' => ['type'=>Form::INPUT_TEXTAREA,'items'=>[''=>'-- Pilih Perkhidmatan Pemakanan --'],'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
        
    ]
]);
    ?>
    
    <h3><?=GeneralLabel::keputusan_analisi_tubuh_badan?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'analisiTubuhBadanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKeputusanAnalisiTubuhBadan,
        //'filterModel' => $searchModelKeputusanAnalisiTubuhBadan,
        'id' => 'analisiTubuhBadanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'keputusan_analisi_tubuh_badan_id',
            //'perkhidmatan_permakanan_id',
            //'kategori_atlet',
            //'sukan',
            //'acara',
            'tarikh',
            /*[
                'attribute' => 'atlet',
                'value' => 'refAtlet.name_penuh'
            ],*/
            [
                'attribute' => 'kandungan_lemak_badan',
                'value' => 'refKandunganLemakBadan.desc'
            ],
             //'fit',
             //'unfit',
             'refer',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['keputusan-analisi-tubuh-badan/delete', 'id' => $model->keputusan_analisi_tubuh_badan_id]).'", "'.GeneralMessage::confirmDelete.'", "analisiTubuhBadanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['keputusan-analisi-tubuh-badan/update', 'id' => $model->keputusan_analisi_tubuh_badan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::keputusan_analisi_tubuh_badan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['keputusan-analisi-tubuh-badan/view', 'id' => $model->keputusan_analisi_tubuh_badan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::keputusan_analisi_tubuh_badan.'");',
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
        $perkhidmatan_permakanan_id = "";
        
        if(isset($model->perkhidmatan_permakanan_id)){
            $perkhidmatan_permakanan_id = $model->perkhidmatan_permakanan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['keputusan-analisi-tubuh-badan/create', 'perkhidmatan_permakanan_id' => $perkhidmatan_permakanan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::keputusan_analisi_tubuh_badan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <h3><?=GeneralLabel::pemberian_suplemenjus?></h3>
    
    <?php Pjax::begin(['id' => 'pemberianSuplemenJusGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPemberianSuplemenMakananJusRundinganPendidikan,
        //'filterModel' => $searchModelPemberianSuplemenMakananJusRundinganPendidikan,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'pemberianSuplemenJusGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pemberian_suplemen_makanan_jus_rundingan_pendidikan_id',
            //'perkhidmatan_permakanan_id',
            'tarikh',
            'nama_suplemen_makanan_jus_rundingan_pendidikan',
            'kuantiti_ml_g',
            //'harga',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pemberian-suplemen-makanan-jus-rundingan-pendidikan/delete', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id]).'", "'.GeneralMessage::confirmDelete.'", "pemberianSuplemenJusGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-suplemen-makanan-jus-rundingan-pendidikan/update', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pemberian_suplemenjus.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-suplemen-makanan-jus-rundingan-pendidikan/view', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pemberian_suplemenjus.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-suplemen-makanan-jus-rundingan-pendidikan/create', 'perkhidmatan_permakanan_id' => $perkhidmatan_permakanan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pemberian_suplemenjus.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <h3><?=GeneralLabel::pemberian_jus?></h3>
    
    <?php Pjax::begin(['id' => 'pemberianJusPemulihanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPemberianJusPemulihan,
        //'filterModel' => $searchModelPemberianJusPemulihan,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'pemberianJusPemulihanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pemberian_jus_pemulihan_id',
            //'perkhidmatan_permakanan_id',
            //'kategori_atlet',
            //'sukan',
            //'acara',
            // 'atlet',
            //'nama_jus',
            'tarikh',
            [
                'attribute' => 'nama_jus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_jus,
                ],
                'value' => 'refNamaJus.desc'
            ],
            // 'jenis_jus',
            'kuantiti',
            // 'berat_badan',
            // 'buah',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pemberian-jus-pemulihan/delete', 'id' => $model->pemberian_jus_pemulihan_id]).'", "'.GeneralMessage::confirmDelete.'", "pemberianJusPemulihanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-jus-pemulihan/update', 'id' => $model->pemberian_jus_pemulihan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pemberian_jus.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-jus-pemulihan/view', 'id' => $model->pemberian_jus_pemulihan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pemberian_jus.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-jus-pemulihan/create', 'perkhidmatan_permakanan_id' => $perkhidmatan_permakanan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pemberian_jus.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <!--<?= $form->field($model, 'permohonan_perkhidmatan_permakanan_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'pegawai_yang_bertanggungjawab')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'catitan_ringkas')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
