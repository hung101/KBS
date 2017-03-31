<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\helpers\Url;

// table reference
use app\models\RefMesyuaratAhliStatus;
use app\models\RefJawatan;
use app\models\RefAgensiJkk;
use app\models\RefJawatanJkkJkp;
use app\models\PengurusanJkkJkp;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratJkkKehadiran */
/* @var $form yii\widgets\ActiveForm */

    $session = new Session;
    $session->open();
    
    if(isset($session['mesyuarat-jkk_jenis_mesyuarat']) && $session['mesyuarat-jkk_jenis_mesyuarat']){
		$ahli_list = PengurusanJkkJkp::find()->where(['jenis_cawangan_kuasa' => $session['mesyuarat-jkk_jenis_mesyuarat']])->all();
	} else {
		$ahli_list = PengurusanJkkJkp::find()->all();
	}
	$session->close();
?>

<div class="mesyuarat-jkk-kehadiran-form">
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    
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
                'mesyuarat_id' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Mesyuarat --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                //'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
				'nama' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'data'=>ArrayHelper::map($ahli_list,'pengurusan_jkk_jkp_id', 'nama_pegawai_coach'),
                            'options' => ['placeholder' => Placeholder::namaAhli, 'id' => 'namaID'],
    'pluginOptions' => [
                                'allowClear' => true
                            ],],
                        'columnOptions'=>['colspan'=>6]],
                'agensi' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-agensi-jkk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAgensiJkk::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::agensi, 'disabled'=>true],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                //'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
				'jawatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jawatan-jkk-jkp/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJawatanJkkJkp::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jawatan, 'disabled'=>true],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
				'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>100, 'disabled' => true]],
            ]
        ],
/*         [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>100, 'disabled' => true]],
            ]
        ], */
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jawatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jawatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJawatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jawatan],],
                    'columnOptions'=>['colspan'=>5]],
                'organisasi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_tel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kehadiran' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>'Ya', false=>'Tidak'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],
            ]
        ],*/
    ]
]);
    ?>

    <!--<?= $form->field($model, 'mesyuarat_id')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'kehadiran')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],])  ?>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>


<?php
$URLAhliJKKJKP = Url::to(['/pengurusan-jkk-jkp/get-ahli']);

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {
    
     var \$form = $(this);
	 
	 $("form#{$model->formName()} input").prop("disabled", false);
	 $("#mesyuaratjkkkehadiran-jawatan").prop("disabled", false);
	 $("#mesyuaratjkkkehadiran-agensi").prop("disabled", false);
	 

     $.post(
        \$form.attr("action"), //serialize Yii2 form
        \$form.serialize()
    )
    .done( function(result) {
        if(result == 1)
        {
            //$('#modal').modal('hide');
            $(document).find('#modal').modal('hide');
            $(\$form).trigger("reset");
            $.pjax.defaults.timeout = 6000;
            $.pjax.reload({container:'#senaraiNamaAhliGrid'});
        } else {
            $("#message").html(result);
        }
        }).fail(function()
        {
            console.log("server error");
        });

    return false;
});

$('#namaID').change(function(){
	if($(this).val() != ''){
            
        $.get('$URLAhliJKKJKP',{id:$(this).val()},function(data){
            clearForm();

            var data = $.parseJSON(data);
            if(data !== null){
                $('#mesyuaratjkkkehadiran-emel').val(data.email);
                $("#mesyuaratjkkkehadiran-jawatan").val(data.jawatan).trigger("change");
                $("#mesyuaratjkkkehadiran-agensi").val(data.agensi).trigger("change");
            }
        });
    }
});

function clearForm(){
	$('#mesyuaratjkkkehadiran-emel').attr('value','');
    $("#mesyuaratjkkkehadiran-jawatan").val('').trigger("change");
    $("#mesyuaratjkkkehadiran-agensi").val('').trigger("change");
}

     

JS;
        
$this->registerJs($script);
?>
