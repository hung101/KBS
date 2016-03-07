<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-pertukaran-program-pengajian-form">

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
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bidang_pengajian_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'fakulti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula_pengajian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat_pengajian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tempoh_perlanjutan_semester' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);
        ?>
    
    <br>
    
    <h3>Sebab Pertukaran Program Pengajian</h3>
    
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
    

    <?php Pjax::begin(['id' => 'bspPertukaranProgramPengajianSebabGrid', 'timeout' => 100000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderBspPertukaranProgramPengajianSebab,
        //'filterModel' => $searchModelBspPertukaranProgramPengajianSebab,
        'id' => 'bspPertukaranProgramPengajianSebabGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_pertukaran_program_pengajian_sebab_id',
            //'bsp_pertukaran_program_pengajian_id',
            'sebab',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-pertukaran-program-pengajian-sebab/delete', 'id' => $model->bsp_pertukaran_program_pengajian_sebab_id]).'", "'.GeneralMessage::confirmDelete.'", "bspPertukaranProgramPengajianSebabGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-pertukaran-program-pengajian-sebab/update', 'id' => $model->bsp_pertukaran_program_pengajian_sebab_id]).'", "'.GeneralLabel::updateTitle . ' Sebab Pertukaran Program Pengajian");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-pertukaran-program-pengajian-sebab/view', 'id' => $model->bsp_pertukaran_program_pengajian_sebab_id]).'", "'.GeneralLabel::viewTitle . ' Sebab Pertukaran Program Pengajian");',
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
        $bsp_pertukaran_program_pengajian_id = "";
        
        if(isset($model->bsp_pertukaran_program_pengajian_id)){
            $bsp_pertukaran_program_pengajian_id = $model->bsp_pertukaran_program_pengajian_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-pertukaran-program-pengajian-sebab/create', 'bsp_pertukaran_program_pengajian_id' => $bsp_pertukaran_program_pengajian_id]).'", "'.GeneralLabel::createTitle . ' Sebab Pertukaran Program Pengajian");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3>Dokumen Pertukaran Program Pengajian</h3>
    
    <?php Pjax::begin(['id' => 'bspPertukaranProgramPengajianDokumenGrid', 'timeout' => 100000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderBspPertukaranProgramPengajianDokumen,
        //'filterModel' => $searchModelBspPertukaranProgramPengajianDokumen,
        'id' => 'bspPertukaranProgramPengajianDokumenGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_pertukaran_program_pengajian_dokumen_id',
            //'bsp_pertukaran_program_pengajian_id',
            'nama_dokumen',
            //'upload',
            [
                'attribute' => 'upload',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->upload){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->upload .'");'
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-pertukaran-program-pengajian-dokumen/delete', 'id' => $model->bsp_pertukaran_program_pengajian_dokumen_id]).'", "'.GeneralMessage::confirmDelete.'", "bspPertukaranProgramPengajianDokumenGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-pertukaran-program-pengajian-dokumen/update', 'id' => $model->bsp_pertukaran_program_pengajian_dokumen_id]).'", "'.GeneralLabel::updateTitle . ' Dokumen Pertukaran Program Pengajian");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-pertukaran-program-pengajian-dokumen/view', 'id' => $model->bsp_pertukaran_program_pengajian_dokumen_id]).'", "'.GeneralLabel::viewTitle . ' Dokumen Pertukaran Program Pengajian");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-pertukaran-program-pengajian-dokumen/create', 'bsp_pertukaran_program_pengajian_id' => $bsp_pertukaran_program_pengajian_id]).'", "'.GeneralLabel::createTitle . ' Dokumen Pertukaran Program Pengajian");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'bidang_pengajian_kursus')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'fakulti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_mula_pengajian')->textInput() ?>

    <?= $form->field($model, 'tarikh_tamat_pengajian')->textInput() ?>

    <?= $form->field($model, 'tempoh_perlanjutan_semester')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
