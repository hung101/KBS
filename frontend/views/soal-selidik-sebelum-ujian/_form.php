<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\widgets\Pjax;

// table reference
use app\models\Atlet;
use app\models\RefSoalanSoalSelidik;
use app\models\RefJawapanSoalSelidik;
use app\models\RefSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\SoalSelidikSebelumUjian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soal-selidik-sebelum-ujian-form">
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

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
                'jenis_sukan' => [
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
                        'options' => ['placeholder' => Placeholder::sukan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'atlet_id' =>  /*[
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
                        'options' => ['placeholder' => Placeholder::atlet],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],*/
                [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'jenis_sukan')],
                            'placeholder' => Placeholder::atlet,
                            'url'=>Url::to(['/atlet/sub-atlets-sukan'])],
                        ],
                    'columnOptions'=>['colspan'=>6]],
                 
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
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'pemilihan_ujian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                'pegawai_bertanggungjawab' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
    ?>
    
    <h3><?=GeneralLabel::soalan?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'soalSelidikSebelumUjianSoalanJawapanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderSoalSelidikSebelumUjianSoalanJawapan,
        //'filterModel' => $searchModelSoalSelidikSebelumUjianSoalanJawapan,
        'id' => 'soalSelidikSebelumUjianSoalanJawapanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'soal_selidik_sebelum_ujian_soalan_jawapan_id',
            //'soal_selidik_sebelum_ujian_id',
            [
                'attribute' => 'soalan',
                'value' => 'refSoalanSoalSelidik.desc'
            ],
            [
                'attribute' => 'jawapan',
                'value' => 'refJawapanSoalSelidik.desc'
            ],
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['soal-selidik-sebelum-ujian-soalan-jawapan/delete', 'id' => $model->soal_selidik_sebelum_ujian_soalan_jawapan_id]).'", "'.GeneralMessage::confirmDelete.'", "soalSelidikSebelumUjianSoalanJawapanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['soal-selidik-sebelum-ujian-soalan-jawapan/update', 'id' => $model->soal_selidik_sebelum_ujian_soalan_jawapan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::soalan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['soal-selidik-sebelum-ujian-soalan-jawapan/view', 'id' => $model->soal_selidik_sebelum_ujian_soalan_jawapan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::soalan.'");',
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
        $soal_selidik_sebelum_ujian_id = "";
        
        if(isset($model->soal_selidik_sebelum_ujian_id)){
            $soal_selidik_sebelum_ujian_id = $model->soal_selidik_sebelum_ujian_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['soal-selidik-sebelum-ujian-soalan-jawapan/create', 'soal_selidik_sebelum_ujian_id' => $soal_selidik_sebelum_ujian_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::soalan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'soalan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jawapan')->textInput(['maxlength' => 30]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$URLAtlet = Url::to(['/atlet/get-atlet']);

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
            
$('#soalselidiksebelumujian-atlet_id').change(function(){
            
    if($(this).val() != ''){
            
        $.get('$URLAtlet',{id:$(this).val()},function(data){
            clearForm();

            var data = $.parseJSON(data);

            if(data !== null){
            
                if(data.refAtletSukan[0] !== null){ 
                    //$('#soalselidiksebelumujian-acara').val(data.refAtletSukan[0].acara).trigger("change");
                    $('#soalselidiksebelumujian-jenis_sukan').val(data.refAtletSukan[0].nama_sukan).trigger("change");
                    //$('#soalselidiksebelumujian-kategori_atlet').val(data.refAtletSukan[0].program_semasa).trigger("change");
                }
            
                if(data.refAtletPendidikan[0] !== null){ 
                    //$('#soalselidiksebelumujian-tahap_pendidikan').val(data.refAtletPendidikan[0].jenis_peringkatan_pendidikan).trigger("change");
                }
            }
        });
    }
});
         
function clearForm(){
    //$('#soalselidiksebelumujian-acara').val('').trigger("change");
    $('#soalselidiksebelumujian-jenis_sukan').val('').trigger("change");
            //$('#soalselidiksebelumujian-kategori_atlet').val('').trigger("change");
}

JS;
        
$this->registerJs($script);
?>
