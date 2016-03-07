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
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratAgm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-minit-mesyuarat-agm-form">

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
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                //'masa' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>9],'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_ahli_yang_hadir' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>11]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_ahli_yang_layak_mengundi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>11]],
            ]
        ],
        [
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
        ],
    ]
]);
    ?>
    
    <br>
    
    
    <h3>Senarai Nama Kehadiran Mesyuarat Agong</h3>
    
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
        $mesyuarat_agm_id = "";
        
        if(isset($model->mesyuarat_agm_id)){
            $mesyuarat_agm_id = $model->mesyuarat_agm_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['ltbs-senarai-nama-hadir-agm/create', 'mesyuarat_agm_id' => $mesyuarat_agm_id]).'", "'.GeneralLabel::createTitle . ' Nama Kehadiran Mesyuarat Agong");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>

    <!--<?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'masa')->textInput() ?>

    <?= $form->field($model, 'tempat')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jumlah_ahli_yang_hadir')->textInput() ?>

    <?= $form->field($model, 'jumlah_ahli_yang_layak_mengundi')->textInput() ?>

    <?= $form->field($model, 'agenda_mesyuarat')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'keputusan_mesyuarat')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
