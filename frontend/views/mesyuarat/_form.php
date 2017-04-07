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

use app\models\MesyuaratSenaraiNamaHadir;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\Mesyuarat */
/* @var $form yii\widgets\ActiveForm */


$MesyuaratSenaraiNamaHadir = null;
if($model->isNewRecord){
    $MesyuaratSenaraiNamaHadir = MesyuaratSenaraiNamaHadir::find()->where(['=', 'session_id', Yii::$app->session->id])->all();
} else {
    $MesyuaratSenaraiNamaHadir = MesyuaratSenaraiNamaHadir::find()->where(['=', 'mesyuarat_id', $model->mesyuarat_id])->all();
}
?>

<div class="mesyuarat-form">
    
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
                'nama_mesyuarat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'bil_mesyuarat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>20]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'agenda' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
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
                //'masa' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\TimePicker','columnOptions'=>['colspan'=>3]],
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>20]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pengurusi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pencatat_minit' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'perkara_perkara_dan_tindakan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'mesyuarat_tamat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'mesyuarat_seterusnya' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ]
        ],
        
    ]
]);
    ?>
    
    <?php // Laporan Kesihatan Upload
    if($model->muat_naik){
        echo "<label>" . $model->getAttributeLabel('muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->mesyuarat_id, 'field'=> 'muat_naik'], 
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
    
    
    
    <h3><?=GeneralLabel::senarai_nama_ahli?></h3>
    
    <?php Pjax::begin(['id' => 'senaraiNamaAhliGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $SNHdataProvider,
        //'filterModel' => $SNHsearchModel,
        'id' => 'senaraiNamaAhliGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_nama_hadir_id',
            //'mesyuarat_id',
            'nama',
            //'kehadiran',
            [
                'attribute' => 'kehadiran',
                'value' => 'refKelulusan.desc'
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax2Containers("'.Url::to(['mesyuarat-senarai-nama-hadir/delete', 'id' => $model->senarai_nama_hadir_id]).'", "'.GeneralMessage::confirmDelete.'", "senaraiNamaAhliGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['mesyuarat-senarai-nama-hadir/update', 'id' => $model->senarai_nama_hadir_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::senarai_nama_ahli.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['mesyuarat-senarai-nama-hadir/view', 'id' => $model->senarai_nama_hadir_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::senarai_nama_ahli.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['mesyuarat-senarai-nama-hadir/create', 'mesyuarat_id' => $mesyuarat_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::senarai_nama_ahli.'");',
                        'class' => 'btn btn-success',
                        ]);
        ?>
    </p>
    <?php endif; ?>
    
     <br>
    <br>
    
    <h3><?=GeneralLabel::senarai_tugas?></h3>
    
    <?php Pjax::begin(['id' => 'senaraiTugasGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $STdataProvider,
        //'filterModel' => $STsearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_tugas_id',
            //'mesyuarat_id',
            'name_tugas',
            'tarikh_tamat',
            //'pegawai',
            [
                'attribute' => 'pegawai',
                'value' => 'refMesyuaratSenaraiNamaHadir.nama'
            ],
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'atlet.name_penuh'
            ],
            // 'persatuan',
            // 'status',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['mesyuarat-senarai-tugas/delete', 'id' => $model->senarai_tugas_id]).'", "'.GeneralMessage::confirmDelete.'", "senaraiTugasGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['mesyuarat-senarai-tugas/update', 'id' => $model->senarai_tugas_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::senarai_tugas.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['mesyuarat-senarai-tugas/view', 'id' => $model->senarai_tugas_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::senarai_tugas.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['mesyuarat-senarai-tugas/create', 'mesyuarat_id' => $mesyuarat_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::senarai_tugas.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    <br>
    
    <?php
    Pjax::begin(['id' => 'boxPajax']);
    
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'disedia_oleh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'data'=>ArrayHelper::map($MesyuaratSenaraiNamaHadir,'senarai_nama_hadir_id', 'nama'),
                        'options' => ['placeholder' => Placeholder::pegawai],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'disemak_oleh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'data'=>ArrayHelper::map($MesyuaratSenaraiNamaHadir,'senarai_nama_hadir_id', 'nama'),
                        'options' => ['placeholder' => Placeholder::pegawai],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'tarikh_semakan' => [
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
    ]
]);
        Pjax::end();
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
        

     

JS;
        
$this->registerJs($script);
?>
