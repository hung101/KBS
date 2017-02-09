<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJenisSukanPersatuanPersekutuandunia;
use app\models\RefNamaSukanPersatuanPersekutuandunia;
use app\models\ProfilBadanSukan;
use app\models\RefStatusLaporanMesyuaratAgung;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukanPersatuanpersekutuandunia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-sukan-persatuanpersekutuandunia-form">
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>GeneralVariable::formAtletSukanPersatuanpersekutuanduniaID]); ?>
    
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
                'jenis' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-sukan-persatuan-persekutuandunia/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisSukanPersatuanPersekutuandunia::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenis],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'name_persatuan_persekutuan_dunia' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-nama-sukan-persatuan-persekutuandunia/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNamaSukanPersatuanPersekutuandunia::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::namaPersatuanPersekutuandunia],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'name_persatuan_persekutuan_dunia' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'data'=>ArrayHelper::map(ProfilBadanSukan::find()->where(['=', 'status', RefStatusLaporanMesyuaratAgung::DISAHKAN])->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                        'options' => ['placeholder' => Placeholder::persatuan, 'id'=>'persatuanId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_negeri' => [
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
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
                'laman_web' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>120]],
            ]
        ],
    ]
]);
    ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URL = Url::to(['/profil-badan-sukan/get-badan-sukan']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;
$formID = GeneralVariable::formAtletSukanPersatuanpersekutuanduniaID;

$script = <<< JS
 
$('form#{$formID}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$formID} input").prop("disabled", false);
});
        
$('#persatuanId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#atletsukanpersatuanpersekutuandunia-alamat_1').attr('value',data.alamat_tetap_badan_sukan_1);
            $('#atletsukanpersatuanpersekutuandunia-alamat_2').attr('value',data.alamat_tetap_badan_sukan_2);
            $('#atletsukanpersatuanpersekutuandunia-alamat_3').attr('value',data.alamat_tetap_badan_sukan_3);
            $('#atletsukanpersatuanpersekutuandunia-alamat_negeri').val(data.alamat_tetap_badan_sukan_negeri).trigger("change");
            $('#atletsukanpersatuanpersekutuandunia-alamat_bandar').val(data.alamat_tetap_badan_sukan_bandar).trigger("change");
            $('#atletsukanpersatuanpersekutuandunia-alamat_poskod').attr('value',data.alamat_tetap_badan_sukan_poskod);
            $('#atletsukanpersatuanpersekutuandunia-no_telefon').attr('value',data.no_telefon_pejabat);
            $('#atletsukanpersatuanpersekutuandunia-emel').attr('value',data.emel_badan_sukan);
        }
    });
});
     
function clearForm(){
    $('#atletsukanpersatuanpersekutuandunia-alamat_1').attr('value','');
    $('#atletsukanpersatuanpersekutuandunia-alamat_2').attr('value','');
    $('#atletsukanpersatuanpersekutuandunia-alamat_3').attr('value','');
    $('#atletsukanpersatuanpersekutuandunia-alamat_negeri').val('').trigger("change");
    $('#atletsukanpersatuanpersekutuandunia-alamat_bandar').val('').trigger("change");
    $('#atletsukanpersatuanpersekutuandunia-alamat_poskod').attr('value','');
    $('#atletsukanpersatuanpersekutuandunia-no_telefon').attr('value','');
    $('#atletsukanpersatuanpersekutuandunia-emel').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
