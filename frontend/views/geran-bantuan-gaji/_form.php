<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

// table reference
use app\models\Jurulatih;
use app\models\RefStatusPermohonanGeranBantuanGajiJurulatih;
use app\models\RefKategoriGeranJurulatih;
use app\models\RefStatusGeranJurulatih;
use app\models\RefStatusJurulatih;
use app\models\RefSukan;
use app\models\RefProgramJurulatih;
use app\models\RefKelulusanGeranBantuanGajiJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\GeranBantuanGaji */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geran-bantuan-gaji-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    
    <?php //echo $form->errorSummary($model); ?>
    
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
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],],
                    'columnOptions'=>['colspan'=>6]],
                //'muatnaik_gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>2]],
                'status_jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusJurulatih,'disabled'=>true],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
       /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'cawangan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Cawangan --'],'columnOptions'=>['colspan'=>3]],
                'sub_cawangan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Sub Cawangan --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'lain_lain_program' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Lain-lain Program --'],'columnOptions'=>['colspan'=>4]],
                 'pusat_latihan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6]],
            ],
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
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
                        'options' => ['placeholder' => Placeholder::sukan,'disabled'=>true],],
                    'columnOptions'=>['colspan'=>4]],
                'program_msn' => [
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
                        'options' => ['placeholder' => Placeholder::program,'disabled'=>true],],
                    'columnOptions'=>['colspan'=>3]],
                'agensi' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'tarikh_mula_kontrak' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 'tarikh_tamat_kontrak' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                //'status_keaktifan_jurulatih' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Keaktifan Jurulatih --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
        
    ]
]);
        ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong>MAKLUMAT PEMBAYARAN GERAN BANTUAN</strong></pre>
    
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
                //'status_keaktifan_jurulatih' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Keaktifan Jurulatih --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                /*'kategori_geran' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-geran-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriGeranJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriGeran],],
                    'columnOptions'=>['colspan'=>4]],*/
                'kadar' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'bulan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>3]],
                'jumlah_geran' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'status_geran' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-geran-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusGeranJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusGeran],],
                    'columnOptions'=>['colspan'=>3]],
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
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['status_permohonan']) || $readonly): ?>
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
                'status_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-geran-bantuan-gaji-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanGeranBantuanGajiJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'rujukan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255],'hint'=>'cth: JKB:BIL 01/2015 BTH 10.01.2015(110)'],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'status_terkini_pengeluaran_cek' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ]
        ],*/
    ]
]);
    ?>
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Pengeluaran Cek</strong>
                </div>
                <div class="panel-body">
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
                                        'boucher' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                                        'no_cek' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                                        'tarikh_cek' => [
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
                            ]
                        ]);
                    ?>
                </div>
            </div>
    
    <?php endif; ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['kelulusan']) || $readonly): ?>
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
                'kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kelulusan-geran-bantuan-gaji-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKelulusanGeranBantuanGajiJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kelulusan],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <!--<?= $form->field($model, 'muatnaik_gambar')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nama_jurulatih')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'cawangan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'sub_cawangan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'program_msn')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'lain_lain_program')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'pusat_latihan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_sukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_acara')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'status_jurulatih')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'status_permohonan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'status_keaktifan_jurulatih')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'kategori_geran')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jumlah_geran')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status_geran')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>

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

$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);

$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function (e) {
    var form = $(this);
    
    $("#geranbantuangaji-status_jurulatih").prop("disabled", false);
    $("#geranbantuangaji-nama_sukan").prop("disabled", false);
    $("#geranbantuangaji-program_msn").prop("disabled", false);
    $("form#{$model->formName()} input").prop("disabled", false);
});
        
$('#geranbantuangaji-kadar').on("keyup", function(){calculateJumlahGeran();});
$('#geranbantuangaji-bulan').on("keyup", function(){calculateJumlahGeran();});
        
function calculateJumlahGeran(){
    var kadar = 0;
    var bulan = 0;
    var jumlah_geran = 0;
        
    if($('#geranbantuangaji-bulan').val() > 0){bulan = parseInt($('#geranbantuangaji-bulan').val());}
    if($('#geranbantuangaji-kadar').val() > 0){kadar = parseFloat($('#geranbantuangaji-kadar').val());}
    
        
    if(kadar > 0 && bulan >0){
        // Total Geran
        jumlah_geran = kadar * bulan;

        //display at fields accordingly
        $('#geranbantuangaji-jumlah_geran').val(jumlah_geran);
    }
}  
        
$('#jurulatihId').change(function(){
    
    $.get('$URLJurulatih',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#geranbantuangaji-status_jurulatih').val(data.status_jurulatih).trigger("change");
            $("#geranbantuangaji-nama_sukan").val(data.nama_sukan).trigger("change");
            $("#geranbantuangaji-program_msn").val(data.program).trigger("change");
        }
    });
});
     
function clearForm(){
    $("#geranbantuangaji-status_jurulatih").val('').trigger("change");
    $("#geranbantuangaji-nama_sukan").val('').trigger("change");
    $("#geranbantuangaji-program_msn").val('').trigger("change");
}
        
JS;
        
$this->registerJs($script);
?>
