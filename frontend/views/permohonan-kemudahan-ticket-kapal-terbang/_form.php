<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;

// table reference
use app\models\Jurulatih;
use app\models\Atlet;
use app\models\RefProgram;
use app\models\RefSukan;
use app\models\RefBahagianKemudahan;
use app\models\RefCawanganKemudahan;
use app\models\RefStatusPermohonanKemudahan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-kemudahan-ticket-kapal-terbang-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly,]); ?>
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
                'nama_pemohon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5]],
                'bahagian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBahagianKemudahan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bahagian],],
                    'columnOptions'=>['colspan'=>3]],
                'cawangan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-cawangan-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefCawanganKemudahan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::cawangan],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgram::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],],
                    'columnOptions'=>['colspan'=>6]],
                'no_fail_kelulusan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                'bil_penumpang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
            ]
        ],
        
    ]
]);
    ?>
    
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
                'aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5]],
                'kod_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                /*'sukan' => [
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
                        'data'=>ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],*/
            ]
        ],
        
    ]
]);
    ?>
    
    <?php
        // selected sukan list
        $sukan_selected = null;
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected=explode(',',$model->sukan);
        }

         // Senarai Sukan
        echo '<label class="control-label">'.$model->getAttributeLabel('sukan').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'permohonankemudahanticketkapalterbang-sukan',
            'name' => 'PermohonanKemudahanTicketKapalTerbang[sukan]',
            'value' => $sukan_selected, // initial value
            'data' => ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
            'options' => ['placeholder' => Placeholder::sukan, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);
    ?>
    <br>
    
    <?php
        // selected atlet list
        $atlet_selected = null;
        if(isset($model->atlet) && $model->atlet != ''){
            $atlet_selected=explode(',',$model->atlet);
        }

         // Senarai Atlet
        echo '<label class="control-label">'.$model->getAttributeLabel('atlet').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'permohonankemudahanticketkapalterbang-atlet',
            'name' => 'PermohonanKemudahanTicketKapalTerbang[atlet]',
            'value' => $atlet_selected, // initial value
            'data' => ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
            'options' => ['placeholder' => Placeholder::atlet, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);
    ?>
    
    <br>
    
    <?php
        // selected jurulatih list
        $jurulatih_selected = null;
        if(isset($model->jurulatih) && $model->jurulatih != ''){
            $jurulatih_selected=explode(',',$model->jurulatih);
        }

         // Senarai Jurulatih
        echo '<label class="control-label">'.$model->getAttributeLabel('jurulatih').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'permohonankemudahanticketkapalterbang-jurulatih',
            'name' => 'PermohonanKemudahanTicketKapalTerbang[jurulatih]',
            'value' => $jurulatih_selected, // initial value
            'data' => ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nameAndIC'),
            'options' => ['placeholder' => Placeholder::jurulatih, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);
    ?>
    
    <br>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'atlet' => [
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
                        'options' => ['placeholder' => Placeholder::atlet],],
                    'columnOptions'=>['colspan'=>6]],
            ]
        ],*/
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jurulatih' => [
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
                        'options' => ['placeholder' => Placeholder::jurulatih],],
                    'columnOptions'=>['colspan'=>6]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pegawai_teknikal' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100], 'hint'=>'Cth. masuk lebih dari satu pegawai: Mohd Ali, Camelian, Yusof'],
            ]
        ],
    ]
]);
    ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::pergi?></strong>
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
                                'destinasi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                                
                                'tarikh_ke' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pergi_2' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pergi_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                                
                                'ke_pergi_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pergi_3' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pergi_3' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                                
                                'ke_pergi_3' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::pulang?></strong>
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
                                'pulang' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'pulang_tarikh_dari' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                                'pulang_tarikh_ke' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pulang_2' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pulang_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                                'ke_pulang_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'tarikh_pulang_3' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=> DateControl::classname(),
                                    'ajaxConversion'=>false,
                                    'options'=>[
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                        ]
                                    ],
                                    'columnOptions'=>['colspan'=>3]],
                                'dari_pulang_3' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                                'ke_pulang_3' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>90],'columnOptions'=>['colspan'=>3]],
                            ]
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['kelulusan']) || $readonly): ?>
    <hr>
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
                /*'kelulusan' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],*/
                'kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanKemudahan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],],
                    'columnOptions'=>['colspan'=>3]],
                'bilangan_jkb' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>50]],
                'tarikh_jkb' => [
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
    ?>
    <?php endif; ?>

    <!--<?= $form->field($model, 'nama_pemohon')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'bahagian')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jawatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'destinasi')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'nama_program')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_fail_kelulusan')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'bil_penumpang')->textInput() ?>

    <?= $form->field($model, 'aktiviti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kod_perbelanjaan')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sukan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'atlet')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jurulatih')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'pegawai_teknikal')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('#permohonankemudahanticketkapalterbang-atlet').change(function(){
        calculateTotalPassager();
});
        
$('#permohonankemudahanticketkapalterbang-jurulatih').change(function(){
        calculateTotalPassager();
});
        
$('#permohonankemudahanticketkapalterbang-pegawai_teknikal').keypress(function(){
        calculateTotalPassager();
});
        
function calculateTotalPassager(){
    var valAtlet = String($("#permohonankemudahanticketkapalterbang-atlet").val());     
    var jumlahAtlet = valAtlet.split(",").length;
        
    var valJurulatih = String($("#permohonankemudahanticketkapalterbang-jurulatih").val());     
    var jumlahJurulatih = valJurulatih.split(",").length;
        
    var valPegawai = String($("#permohonankemudahanticketkapalterbang-pegawai_teknikal").val());     
    var jumlahPegawai = valPegawai.split(",").length;
        
        //alert(jumlahAtlet+ jumlahJurulatih + jumlahPegawai);
    $("#permohonankemudahanticketkapalterbang-bil_penumpang").val((jumlahAtlet+ jumlahJurulatih + jumlahPegawai));
}
            
$("#sama_alamat").change(function() {
    if(this.checked) {
        $("#atlet-alamat_surat_menyurat_1").val($("#atlet-alamat_rumah_1").val());
        $("#atlet-alamat_surat_menyurat_2").val($("#atlet-alamat_rumah_2").val());
        $("#atlet-alamat_surat_menyurat_3").val($("#atlet-alamat_rumah_3").val());
        $("#atlet-alamat_surat_negeri").val($("#atlet-alamat_rumah_negeri").val()).trigger("change");
        $("#atlet-alamat_surat_bandar").val($("#atlet-alamat_rumah_bandar").val()).trigger("change");
        $("#atlet-alamat_surat_poskod").val($("#atlet-alamat_rumah_poskod").val());
    }
});
            
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});

JS;
        
$this->registerJs($script);
?>
