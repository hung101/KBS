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
use app\models\Jurulatih;
use app\models\RefBank;
use app\models\RefSukan;
use app\models\RefProgramJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\GajiDanElaunJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gaji-dan-elaun-jurulatih-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            //$template = '{view} {update} {delete}';
            $template = '{view}';
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
                'nama_jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                'no_pekerja' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                'no_kwsp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgramJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'nama_sukan' => [
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
                    'columnOptions'=>['colspan'=>3]],
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
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'bank' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bank/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBank::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bank],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'no_akaun' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>50]],
                'cawangan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
        ?>
    
    <h3>Gaji Jurulatih</h3>
    
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
    
    <?php Pjax::begin(['id' => 'gajiJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderGajiJurulatih,
        //'filterModel' => $searchModelGajiJurulatih,
        'id' => 'gajiJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'gaji_jurulatih_id',
            //'gaji_dan_elaun_jurulatih_id',
            'jumlah',
            'tarikh_mula',
            'tarikh_tamat',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['gaji-jurulatih/delete', 'id' => $model->gaji_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "gajiJurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['gaji-jurulatih/update', 'id' => $model->gaji_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' Gaji Jurulatih");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['gaji-jurulatih/view', 'id' => $model->gaji_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' Gaji Jurulatih");',
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
        $gaji_dan_elaun_jurulatih_id = "";
        
        if(isset($model->gaji_dan_elaun_jurulatih_id)){
            $gaji_dan_elaun_jurulatih_id = $model->gaji_dan_elaun_jurulatih_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['gaji-jurulatih/create', 'gaji_dan_elaun_jurulatih_id' => $gaji_dan_elaun_jurulatih_id]).'", "'.GeneralLabel::createTitle . ' Gaji Jurulatih");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    <h3>Elaun Jurulatih</h3>
    
    <?php Pjax::begin(['id' => 'elaunJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderElaunJurulatih,
        //'filterModel' => $searchModelElaunJurulatih,
        'id' => 'elaunJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaun_jurulatih_id',
            //'gaji_dan_elaun_jurulatih_id',
            //'jenis_elaun',
            [
                'attribute' => 'jenis_elaun',
                'value' => 'refJenisElaunJurulatih.desc'
            ],
            'jumlah_elaun',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['elaun-jurulatih/delete', 'id' => $model->elaun_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "elaunJurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaun-jurulatih/update', 'id' => $model->elaun_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' Elaun Jurulatih");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaun-jurulatih/view', 'id' => $model->elaun_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' Elaun Jurulatih");',
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
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaun-jurulatih/create', 'gaji_dan_elaun_jurulatih_id' => $gaji_dan_elaun_jurulatih_id]).'", "'.GeneralLabel::createTitle . ' Elaun Jurulatih");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>
    
    <?php // Dokumen Muat Naik (Buku Akaun) Upload
    if($model->dokumen_muat_naik){
        echo "<label>" . $model->getAttributeLabel('dokumen_muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->dokumen_muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->gaji_dan_elaun_jurulatih_id, 'field'=> 'dokumen_muat_naik'], 
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
                        'dokumen_muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>

    <!--<?= $form->field($model, 'nama_jurulatih')->textInput() ?>

    <?= $form->field($model, 'no_kad_pengenalan')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'no_passport')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'nama_sukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_mula')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'bank')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_akaun')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cawangan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?= Html::a(GeneralLabel::backToList, ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);

$URLJurulatihSukan = Url::to(['/jurulatih-sukan/get-jurulatih-sukan-acara']);

$script = <<< JS
        
$('#jurulatihId').change(function(){
        
    clearForm();
    
    $.get('$URLJurulatih',{id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        if(data !== null){
            if(data.ic_no){
                $('#gajidanelaunjurulatih-no_kad_pengenalan').attr('value',data.ic_no);
            }
            //$("#gajidanelaunjurulatih-program").val(data.program).trigger("change");
            //$("#gajidanelaunjurulatih-nama_sukan").val(data.nama_sukan).trigger("change");
        }
    });
        
    $.get('$URLJurulatihSukan',{jurulatih_id:$(this).val()},function(data){
        var data = $.parseJSON(data);

        if(data !== null){
            $("#gajidanelaunjurulatih-program").val(data.program).trigger("change");
            $("#gajidanelaunjurulatih-nama_sukan").val(data.sukan).trigger("change");
            $("#gajidanelaunjurulatih-tarikh_mula").attr('value',data.tarikh_mula_lantikan);
            $("#gajidanelaunjurulatih-tarikh_tamat").attr('value',data.tarikh_tamat_lantikan);
            $("#gajidanelaunjurulatih-tarikh_mula-disp").val(formatDisplayDate(data.tarikh_mula_lantikan));
            $("#gajidanelaunjurulatih-tarikh_tamat-disp").val(formatDisplayDate(data.tarikh_tamat_lantikan));
            $("#gajidanelaunjurulatih-tarikh_mula").kvDatepicker("$DateDisplayFormat", new Date(data.tarikh_mula_lantikan)).kvDatepicker({
                format: "$DateDisplayFormat"
            });
            $("#gajidanelaunjurulatih-tarikh_tamat").kvDatepicker("$DateDisplayFormat", new Date(data.tarikh_tamat_lantikan)).kvDatepicker({
                format: "$DateDisplayFormat"
            });
        }
    });
});
     
function clearForm(){
    $('#gajidanelaunjurulatih-no_kad_pengenalan').attr('value','');
    $("#gajidanelaunjurulatih-program").val('').trigger("change");
    $("#gajidanelaunjurulatih-nama_sukan").val('').trigger("change");
    $('#gajidanelaunjurulatih-tarikh_mula').attr('value','');
    $("#gajidanelaunjurulatih-tarikh_mula-disp").val('');
    $('#gajidanelaunjurulatih-tarikh_tamat').attr('value','');
    $('#gajidanelaunjurulatih-tarikh_tamat-disp').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>


