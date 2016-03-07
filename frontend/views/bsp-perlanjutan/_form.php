<?php

use yii\helpers\Html;
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
use app\models\RefPermohonanPelanjutan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-perlanjutan-form">

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
                'tempoh_mohon_perlanjutan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                'permohonan_pelanjutan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefPermohonanPelanjutan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::permohonanPelanjutan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);
        ?>
    
    <br>
    
    <h3>Sebab Pelanjutan</h3>
    
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
    

    <?php Pjax::begin(['id' => 'bspPerlanjutanSebabGrid', 'timeout' => 100000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderBspPerlanjutanSebab,
        //'filterModel' => $searchModelBspPerlanjutanSebab,
        'id' => 'bspPerlanjutanSebabGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_perlanjutan_sebab_id',
            //'bsp_perlanjutan_id',
            'sebab',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-perlanjutan-sebab/delete', 'id' => $model->bsp_perlanjutan_sebab_id]).'", "'.GeneralMessage::confirmDelete.'", "bspPerlanjutanSebabGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-perlanjutan-sebab/update', 'id' => $model->bsp_perlanjutan_sebab_id]).'", "'.GeneralLabel::updateTitle . ' Sebab Pelanjutan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-perlanjutan-sebab/view', 'id' => $model->bsp_perlanjutan_sebab_id]).'", "'.GeneralLabel::viewTitle . ' Sebab Pelanjutan");',
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
        $bsp_perlanjutan_id = "";
        
        if(isset($model->bsp_perlanjutan_id)){
            $bsp_perlanjutan_id = $model->bsp_perlanjutan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-perlanjutan-sebab/create', 'bsp_perlanjutan_id' => $bsp_perlanjutan_id]).'", "'.GeneralLabel::createTitle . ' Sebab Pelanjutan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3>Dokumen Pelanjutan</h3>
    
    <?php Pjax::begin(['id' => 'bspPerlanjutanDokumenGrid', 'timeout' => 100000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderBspPerlanjutanDokumen,
        //'filterModel' => $searchModelBspPerlanjutanDokumen,
        'id' => 'bspPerlanjutanDokumenGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_perlanjutan_dokumen_id',
            //'bsp_perlanjutan_id',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-perlanjutan-dokumen/delete', 'id' => $model->bsp_perlanjutan_dokumen_id]).'", "'.GeneralMessage::confirmDelete.'", "bspPerlanjutanDokumenGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-perlanjutan-dokumen/update', 'id' => $model->bsp_perlanjutan_dokumen_id]).'", "'.GeneralLabel::updateTitle . ' Dokumen Pelanjutan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-perlanjutan-dokumen/view', 'id' => $model->bsp_perlanjutan_dokumen_id]).'", "'.GeneralLabel::viewTitle . ' Dokumen Pelanjutan");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-perlanjutan-dokumen/create', 'bsp_perlanjutan_id' => $bsp_perlanjutan_id]).'", "'.GeneralLabel::createTitle . ' Dokumen Pelanjutan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'tempoh_mohon_perlanjutan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'permohonan_pelanjutan')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
