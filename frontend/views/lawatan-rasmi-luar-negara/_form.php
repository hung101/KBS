<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;

// table reference
use app\models\RefNegara;
use app\models\RefLawatan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LawatanRasmiLuarNegara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lawatan-rasmi-luar-negara-form">
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    <?php echo $form->errorSummary($model); ?>
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
                'lawatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-lawatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefLawatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::lawatan],
                        'pluginOptions' => ['allowClear' => true,],],
                    'columnOptions'=>['colspan'=>3]],
                'negara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegara::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negara],
                        'pluginOptions' => ['allowClear' => true,],],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                //'jumlah_delegasi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11,'disabled'=>true]],
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'delegasi' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>9],'options'=>['maxlength'=>255],'hint'=> "cth: Ismahanis, Nurul Ain, Sukhdur, Safiah"],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_pegawai_terlibat' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255],'hint'=> "cth: Dato' Ahmad Shapawi, Dato; Ab Jalil"],
            ],
        ],*/
    ]
]);
        ?>
    
    
    <h3><?php echo GeneralLabel::delegasi; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'lawatanRasmiLuarNegaraDelegasiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderLawatanRasmiLuarNegaraDelegasi,
        //'filterModel' => $searchModelLawatanRasmiLuarNegaraDelegasi,
        'id' => 'lawatanRasmiLuarNegaraDelegasiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'lawatan_rasmi_luar_negara_delegasi_id',
            //'lawatan_rasmi_luar_negara_id',
            'delegasi',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['lawatan-rasmi-luar-negara-delegasi/delete', 'id' => $model->lawatan_rasmi_luar_negara_delegasi_id]).'", "'.GeneralMessage::confirmDelete.'", "lawatanRasmiLuarNegaraDelegasiGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['lawatan-rasmi-luar-negara-delegasi/update', 'id' => $model->lawatan_rasmi_luar_negara_delegasi_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::delegasi.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['lawatan-rasmi-luar-negara-delegasi/view', 'id' => $model->lawatan_rasmi_luar_negara_delegasi_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::delegasi.'");',
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
        $lawatan_rasmi_luar_negara_id = "";
        
        if(isset($model->lawatan_rasmi_luar_negara_id)){
            $lawatan_rasmi_luar_negara_id = $model->lawatan_rasmi_luar_negara_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['lawatan-rasmi-luar-negara-delegasi/create', 'lawatan_rasmi_luar_negara_id' => $lawatan_rasmi_luar_negara_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::delegasi.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php 
        $jumlahDelegasi = $dataProviderLawatanRasmiLuarNegaraDelegasi->getTotalCount();
    ?>
    
    <h4><?=GeneralLabel::jumlah_delegasi?>: <?=$jumlahDelegasi?></h4>
    
    <?php Pjax::end(); ?>

    <br>
    
    <h3><?php echo GeneralLabel::nama_pegawai_terlibat; ?></h3>
    
    
    <?php Pjax::begin(['id' => 'lawatanRasmiLuarNegaraPegawaiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderLawatanRasmiLuarNegaraPegawai,
        //'filterModel' => $searchModelLawatanRasmiLuarNegaraPegawai,
        'id' => 'lawatanRasmiLuarNegaraPegawaiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'lawatan_rasmi_luar_negara_pegawai_id',
            //'lawatan_rasmi_luar_negara_id',
            'nama_pegawai_terlibat',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['lawatan-rasmi-luar-negara-pegawai/delete', 'id' => $model->lawatan_rasmi_luar_negara_pegawai_id]).'", "'.GeneralMessage::confirmDelete.'", "lawatanRasmiLuarNegaraPegawaiGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['lawatan-rasmi-luar-negara-pegawai/update', 'id' => $model->lawatan_rasmi_luar_negara_pegawai_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::nama_pegawai_terlibat.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['lawatan-rasmi-luar-negara-pegawai/view', 'id' => $model->lawatan_rasmi_luar_negara_pegawai_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::nama_pegawai_terlibat.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['lawatan-rasmi-luar-negara-pegawai/create', 'lawatan_rasmi_luar_negara_id' => $lawatan_rasmi_luar_negara_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::nama_pegawai_terlibat.'");',
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
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255],'hint'=> "cth: Keputusan / Tujuan / Impak Lawatan-lawatan"],
            ],
        ],
    ]
]);
        ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
