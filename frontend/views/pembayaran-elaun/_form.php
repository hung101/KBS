<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;

// table reference
use app\models\Atlet;
use app\models\RefKategoriElaun;
use app\models\RefStatusElaun;
use app\models\RefSukan;
use app\models\RefStatusTawaran;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranElaun */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
        $sukan_list = GeneralFunction::getSukan();
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['upaya']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['kurang-upaya'])){
            $sukan_list = GeneralFunction::getSukan();
        } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['upaya']))  {
            // Upaya Sukan List
            $param_sukan['cacat'] = 0;
            //$sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->all();
            $sukan_list = GeneralFunction::getSukan($param_sukan);
        } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['kurang-upaya']))  {
            // Upaya Sukan List
            $param_sukan['cacat'] = 1;
            $sukan_list = GeneralFunction::getSukan($param_sukan);
        }
        
        $atlet_list = Atlet::find()->where(['=', 'tawaran', RefStatusTawaran::LULUS_TAWARAN])->all();
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['upaya']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['kurang-upaya'])){
            $atlet_list = Atlet::find()->where(['=', 'tawaran', RefStatusTawaran::LULUS_TAWARAN])->all();
        } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['upaya']))  {
            // Upaya Sukan List
            $atlet_list = Atlet::find()->where(['=', 'tawaran', RefStatusTawaran::LULUS_TAWARAN])->andWhere(['=', 'cacat', 0])->all();
        } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['kurang-upaya']))  {
            // Upaya Sukan List
            $atlet_list = Atlet::find()->where(['=', 'tawaran', RefStatusTawaran::LULUS_TAWARAN])->andWhere(['=', 'cacat', 1])->all();
        }
?>

<div class="pembayaran-elaun-form">

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
                //'jenis_atlet' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Jenis Atlet --'],'columnOptions'=>['colspan'=>4]],
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
                        'data'=>ArrayHelper::map($sukan_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
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
                        'data'=>ArrayHelper::map($atlet_list,'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::atlet],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kategori_elaun' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-elaun/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriElaun::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriElaun],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'tarikh_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'options' => ['id'=>'tarikhDiberiId',],
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
                        'options' => ['id'=>'tarikhDipulangId',],
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tempoh_elaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>20,'id'=>'tempohPinjamanId','disabled'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sebab_elaun' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_elaun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
                'status_elaun' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-elaun/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusElaun::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::statusElaun],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
    ]
]);
    ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-elaun']['kelulusan']) || $readonly): ?>
    <?php
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kelulusan' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);*/
    ?>
    <?php endif; ?>

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

$script = <<< JS
        
$(document).ready(function(){
});
        
$("#tarikhDiberiId").change(function(){
    setDuration();
});
        
$("#tarikhDipulangId").change(function(){
    setDuration();
});
        
function setDuration(){
    if($("#tarikhDiberiId").val() !== "" && $("#tarikhDipulangId").val() !== ""){
        var fromDatetime = $("#tarikhDiberiId").val();
        var toDatetime = $("#tarikhDipulangId").val();

        var fromDate = moment(fromDatetime,'YYYY-MM-DD');
        var toDate = moment(toDatetime,'YYYY-MM-DD');

        if(fromDatetime != "" && toDatetime != ""){
            $("#tempohPinjamanId").val(getDurationBetweenDatetime(fromDate,toDate));
        }
    }
}
        
// enable all the disabled field before submit
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});
        
JS;
        
$this->registerJs($script);
?>
