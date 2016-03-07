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
                'catitan_ringkas' => ['type'=>Form::INPUT_TEXTAREA,'items'=>[''=>'-- Pilih Perkhidmatan Pemakanan --'],'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
        
    ]
]);
    ?>
    
    <h3>Keputusan Analisi Tubuh Badan</h3>
    
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
            //'atlet',
            [
                'attribute' => 'atlet',
                'value' => 'refAtlet.name_penuh'
            ],
             'fit',
             'unfit',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['keputusan-analisi-tubuh-badan/update', 'id' => $model->keputusan_analisi_tubuh_badan_id]).'", "'.GeneralLabel::updateTitle . ' Keputusan Analisi Tubuh Badan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['keputusan-analisi-tubuh-badan/view', 'id' => $model->keputusan_analisi_tubuh_badan_id]).'", "'.GeneralLabel::viewTitle . ' Keputusan Analisi Tubuh Badan");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['keputusan-analisi-tubuh-badan/create', 'perkhidmatan_permakanan_id' => $perkhidmatan_permakanan_id]).'", "'.GeneralLabel::createTitle . ' Keputusan Analisi Tubuh Badan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <h3>Pemberian Suplemen/Jus</h3>
    
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
            'nama_suplemen_makanan_jus_rundingan_pendidikan',
            'kuantiti_ml_g',
            'harga',

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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-suplemen-makanan-jus-rundingan-pendidikan/update', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id]).'", "'.GeneralLabel::updateTitle . ' Pemberian Suplemen/Jus");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-suplemen-makanan-jus-rundingan-pendidikan/view', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id]).'", "'.GeneralLabel::viewTitle . ' Pemberian Suplemen/Jus");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pemberian-suplemen-makanan-jus-rundingan-pendidikan/create', 'perkhidmatan_permakanan_id' => $perkhidmatan_permakanan_id]).'", "'.GeneralLabel::createTitle . ' Pemberian Suplemen/Jus");',
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
