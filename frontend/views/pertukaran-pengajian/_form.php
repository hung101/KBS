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
use app\models\Atlet;
use app\models\RefSebabPermohonanPertukaranPengajian;
use app\models\RefPengajian;
use app\models\RefKategoriPengajian;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefSukan;
use app\models\PerancanganProgram;
use app\models\RefStatusPermohonanPendidikan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PertukaranPengajian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pertukaran-pengajian-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
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
                'atlet_id' => [
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
                        'options' => ['placeholder' => Placeholder::atlet, 'id'=>'atletId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'program' => [
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
                        'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'sukan' => [
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
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'sebab_pemohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sebab-permohonan-pertukaran-pengajian/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSebabPermohonanPertukaranPengajian::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisPermohonan, 'id'=>'jenisPermohonanaId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
                'sebab' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                /*'kategori_pengajian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-pengajian/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPengajian::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriPengajian],],
                    'columnOptions'=>['colspan'=>6]],*/
                'kategori_pengajian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_pengajian_sekarang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                 'nama_pertukaran_pengajian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
        /*[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-pengajian/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPengajian::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::pengajian],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],*/
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sebab_pertukaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempoh_penangguhan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255],'hint'=>'cth: SEMESTER 2'],
                'sebab_penangguhan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>9],'options'=>['maxlength'=>255]],
            ],
        ],
        
    ]
]);
    ?>
    
    <br>
    <br>
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_kejohanan_program_h1; ?></strong></pre>
    
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
                'kejohanan_program' => [
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
                        'data'=>ArrayHelper::map(PerancanganProgram::find()->all(),'perancangan_program_id', 'nama_program'),
                        'options' => ['placeholder' => Placeholder::program],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                 'tarikh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_akhir' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
            ],
        ],
        
    ]
]);
    ?>
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['kelulusan']) || $readonly): ?>
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
                'status_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-permohonan-pendidikan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusPermohonanPendidikan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusPermohonan],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_permohonan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'type'=>DateControl::FORMAT_DATETIME,
                        'pluginOptions' => [
                            'autoclose'=>true,
                                    'todayBtn' => true,
                        ],
                        'options'=>['disabled'=>true]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                
            ],
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::send : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$PERTUKARAN = RefSebabPermohonanPertukaranPengajian::PERTUKARAN;
$PENANGGUHAN = RefSebabPermohonanPertukaranPengajian::PENANGGUHAN;
$PELEPASAN = RefSebabPermohonanPertukaranPengajian::PELEPASAN;

$URLAtlet = Url::to(['/atlet/get-atlet']);

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
            
$('#atletId').change(function(){
            
    if($(this).val() != ''){
            
        $.get('$URLAtlet',{id:$(this).val()},function(data){
            clearForm();

            var data = $.parseJSON(data);

            if(data !== null){
            
                if(data.refAtletSukan[0] !== null){ 
                    $('#pertukaranpengajian-program').val(data.refAtletSukan[0].program_semasa).trigger("change");
                    $('#pertukaranpengajian-sukan').val(data.refAtletSukan[0].nama_sukan).trigger("change");
                }
            
                if(data.refAtletPendidikan[0] !== null){ 
                    $('#pertukaranpengajian-kategori_pengajian').val(data.refAtletPendidikan[0].fakulti).trigger("change");
                    $('#pertukaranpengajian-nama_pengajian_sekarang').val(data.institusi_sekolah).trigger("change");
                    $('#pertukaranpengajian-sebab').val(data.refAtletPendidikan[0].no_matrix);
                }
            }
        });
    }
});
         
function clearForm(){
    $('#pertukaranpengajian-program').val('').trigger("change");
    $('#pertukaranpengajian-sukan').val('').trigger("change");
    $('#pertukaranpengajian-kategori_pengajian').val('').trigger("change");
    $('#pertukaranpengajian-nama_pengajian_sekarang').val('').trigger("change");
    $('#pertukaranpengajian-sebab').val('');
}

$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
        
$('#jenisPermohonanaId').change(function(){
    checkJenisPermohonan();
});
        
function checkJenisPermohonan(){
    if($('#jenisPermohonanaId')){
        $("#pertukaranpengajian-sebab_pertukaran").prop('disabled', true);
        $("#pertukaranpengajian-sebab_penangguhan").prop('disabled', true);
        $("#pertukaranpengajian-tempoh_penangguhan").prop('disabled', true);
        $("#pertukaranpengajian-nama_pertukaran_pengajian").prop('disabled', true);
    
        if($('#jenisPermohonanaId').val() === "$PERTUKARAN"){
            $("#pertukaranpengajian-nama_pertukaran_pengajian").prop('disabled', false);
            $("#pertukaranpengajian-sebab_pertukaran").prop('disabled', false);
            $("#pertukaranpengajian-sebab_penangguhan").val('');
        } else if($('#jenisPermohonanaId').val() === "$PENANGGUHAN"){
            $("#pertukaranpengajian-sebab_penangguhan").prop('disabled', false);
            $("#pertukaranpengajian-tempoh_penangguhan").prop('disabled', false);
            $("#pertukaranpengajian-sebab_pertukaran").val('');
            $("#pertukaranpengajian-nama_pertukaran_pengajian").val('').trigger("change");
        } else if($('#jenisPermohonanaId').val() === "$PELEPASAN"){
            $("#pertukaranpengajian-nama_pertukaran_pengajian").val('').trigger("change");
            $("#pertukaranpengajian-sebab_pertukaran").val('');
            $("#pertukaranpengajian-sebab_penangguhan").val('');
            $("#pertukaranpengajian-tempoh_penangguhan").val('');
        }
    }
}
            
$(document).ready(function(){
    checkJenisPermohonan();
});
            
JS;
        
$this->registerJs($script);
?>
