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
use app\models\RefKategoriMuatnaik;
use app\models\RefNegeri;
use app\models\PengurusanJawatankuasaKhasSukanMalaysia;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $model app\models\MuatNaikDokumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="muat-naik-dokumen-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data'], 'id'=>$model->formName()]); ?>
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
                'temasya' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanJawatankuasaKhasSukanMalaysia::find()->all(),'pengurusan_jawatankuasa_khas_sukan_malaysia_id', 'temasya'),
                        'options' => ['placeholder' => Placeholder::temasya, 'id'=>'pengurusanJawatankuasaId'],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>3]],
                'negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri, 'disabled'=>true],
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
                'tarikh_mula' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options'=>['disabled'=>true]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat' =>  [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options'=>['disabled'=>true]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'kategori_muat_naik' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-muatnaik/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriMuatnaik::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriMuatNaik],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>4]],
                'kategori_dokumen_nyatakan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                 /*'tarikh_muat_naik' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],*/
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
        ?>
    
    <?php // Muat Naik Dokumen
    
    $label = $model->getAttributeLabel('muat_naik_dokumen');
    
    if($model->muat_naik_dokumen){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('muat_naik_dokumen') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_dokumen , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'muat_naik_dokumen' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>

    <!--<?= $form->field($model, 'kategori_muat_naik')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'muat_naik_dokumen')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tarikh_muat_naik')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$URLPengurusanJawatankuasaKhasSukanMalaysia = Url::to(['/pengurusan-jawatankuasa-khas-sukan-malaysia/get-pengurusan-jawatankuasa-khas-sukan-malaysia']);

$script = <<< JS
        
$('#pengurusanJawatankuasaId').change(function(){
    
    $.get('$URLPengurusanJawatankuasaKhasSukanMalaysia',{id:$(this).val()},function(data){
        clearFormTemasya();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#muatnaikdokumen-tarikh_mula').attr('value',data.tarikh_mula);
            $("#muatnaikdokumen-tarikh_mula-disp").val(data.tarikh_mula);
            $('#muatnaikdokumen-tarikh_tamat').attr('value',data.tarikh_tamat);
            $("#muatnaikdokumen-tarikh_tamat-disp").val(data.tarikh_tamat);
            $("#muatnaikdokumen-negeri").val(data.negeri).trigger("change");
            //$("#muatnaikdokumen-sukan").val(data.sukan).trigger("change");
            
        }
    });
});
        
function clearFormTemasya(){
    $('#muatnaikdokumen-tarikh_mula').attr('value','');
    $("#muatnaikdokumen-tarikh_mula-disp").val('');
    $('#muatnaikdokumen-tarikh_tamat').attr('value','');
    $("#muatnaikdokumen-tarikh_tamat-disp").val('');
    $("#muatnaikdokumen-negeri").val('').trigger("change");
    //$("#muatnaikdokumen-sukan").val('').trigger("change");
}
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#muatnaikdokumen-negeri").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>
