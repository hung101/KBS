<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use app\models\AtletPencapaian;
use yii\web\Session;

// table reference
use app\models\Atlet;
use app\models\RefKeputusan;
use app\models\RefAcara;
use app\models\PenyertaanSukan;
use app\models\PenyertaanSukanAcara;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtletSasaran */
/* @var $form yii\widgets\ActiveForm */

$session = new Session;
$session->open();

$atlet_list = null;
$kejohananTemasya = null;

if(isset($session['penilaian-pestasi_nama_kejohanan_temasya']) && $session['penilaian-pestasi_nama_kejohanan_temasya']){
    $penyertaanSukanIds = PenyertaanSukan::find()->select('penyertaan_sukan_id')->where(['nama_kejohanan_temasya' => $session['penilaian-pestasi_nama_kejohanan_temasya']]);
    
    $atlet_list = PenyertaanSukanAcara::find()->joinWith('refAtlet')->where(['IN', 'penyertaan_sukan_id', $penyertaanSukanIds])->groupBy('tbl_penyertaan_sukan_acara.atlet')->all();
	
	$atlet_id = 'refAtlet.atlet_id';
	$atlet_name = 'refAtlet.nameAndIC';
    
    $kejohananTemasya = $session['penilaian-pestasi_nama_kejohanan_temasya'];
    //var_dump(count($atlet_list)); die;
} else {
    $atlet_list = Atlet::find()->all();
	$atlet_id = 'atlet_id';
	$atlet_name = 'nameAndIC';
}

$acara_list = null;

if(isset($session['penilaian-pestasi_sukan_id']) && $session['penilaian-pestasi_sukan_id']){
    $acara_list = RefAcara::find()->where(['=', 'aktif', 1])->andWhere(['=', 'ref_sukan_id', $session['penilaian-pestasi_sukan_id']])->all();
} else {
    $acara_list = RefAcara::find()->where(['=', 'aktif', 1])->all();
}
$session->close();
?>

<div class="penilaian-prestasi-atlet-sasaran-form">

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
                        'data'=>ArrayHelper::map($atlet_list, $atlet_id, $atlet_name),
                        'options' => ['placeholder' => Placeholder::atlet],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'sasaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                'keputusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-keputusan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKeputusan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::keputusan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>2]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'acara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-acara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        //'data'=>ArrayHelper::map(RefAcara::find()->where(['=', 'aktif', 1])->all(),'id', 'disciplineAcara'),
                        'data'=>ArrayHelper::map($acara_list,'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'rekod_baru' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
                 
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'penilaian_pestasi_id')->textInput() ?>

    <?= $form->field($model, 'atlet')->textInput() ?>

    <?= $form->field($model, 'sasaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keputusan')->textInput() ?>

    <?= $form->field($model, 'session_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

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
$URLGetAtletSukan = Url::to(['/penyertaan-sukan-acara/get-atlet-sukan']);

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
          success: function (response) {
               // do something with response
               
                if(response != 1){
                    $('#modalContent').html(response);
                } else {
                    $(document).find('#modal').modal('hide');
                    form.trigger("reset");
                    $.pjax.defaults.timeout = 106000;
                    $.pjax.reload({container:'#penilaianPrestasiAtletSasaranGrid'});
                }
          }
     });
     return false;
});

$('#penilaianprestasiatletsasaran-atlet').change(function(){
    //alert($(this).val());
    clearForm();
    $.get('$URLGetAtletSukan', {atlet_id:$(this).val(), kejohanan:'$kejohananTemasya'}, function(data){
        //alert(data.nama_acara);
        if(data !== null){
            //alert(data.keputusan);
            $('#penilaianprestasiatletsasaran-catatan').val(data.catatan);
            $('#penilaianprestasiatletsasaran-sasaran').val(data.sasaran);
            $('#penilaianprestasiatletsasaran-keputusan').select2().val(data.keputusan).trigger("change");
            $('#penilaianprestasiatletsasaran-acara').select2().val(data.nama_acara).trigger("change");
        }
    });
});  

function clearForm()
{
    $('#penilaianprestasiatletsasaran-catatan').val('');
    $('#penilaianprestasiatletsasaran-sasaran').val('');
    $('#penilaianprestasiatletsasaran-keputusan').select2().val('').trigger("change");
    $('#penilaianprestasiatletsasaran-acara').select2().val('').trigger("change");
}

JS;
        
$this->registerJs($script);


$session->close();
?>

