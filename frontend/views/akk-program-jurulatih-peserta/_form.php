<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;

/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatihPeserta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akk-program-jurulatih-peserta-form">
    
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
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
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
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],
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
                        ],
                        'data'=>ArrayHelper::map(RefAcara::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'nama_sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'akk_program_jurulatih_id')->textInput() ?>

    <?= $form->field($model, 'jurulatih')->textInput() ?>

    <?= $form->field($model, 'sukan')->textInput() ?>

    <?= $form->field($model, 'acara')->textInput() ?>

    <?= $form->field($model, 'session_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);

$script = <<< JS
        
$('#jurulatihId').change(function(){
    
    $.get('$URLJurulatih',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#gajidanelaunjurulatih-no_kad_pengenalan').attr('value',data.ic_no);
            $("#akkprogramjurulatihpeserta-sukan").val(data.nama_sukan).trigger("change");
            $("#akkprogramjurulatihpeserta-acara").val(data.nama_acara).trigger("change");
        }
    });
});
     
function clearForm(){
    $("#akkprogramjurulatihpeserta-sukan").val('').trigger("change");
    $("#akkprogramjurulatihpeserta-acara").val('').trigger("change");
}
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {
    
     var \$form = $(this);

     $.post(
        \$form.attr("action"), //serialize Yii2 form
        \$form.serialize()
    )
    .done( function(result) {
            if(result != 1){
                $('#modalContent').html(result);
            } else {
                $(document).find('#modal').modal('hide');
                $(\$form).trigger("reset");
                $.pjax.defaults.timeout = 100000;
                $.pjax.reload({container:'#akkProgramJurulatihPesertaGrid'});
            }
        }).fail(function()
        {
            console.log("server error");
        });

    return false;
});
        
JS;
        
$this->registerJs($script);
?>