<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanAnggaranPerbelanjaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-anggaran-perbelanjaan-form">

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
                'butir_butir_perbelanjaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>7],'options'=>['maxlength'=>255]],
                'jumlah_perbelanjaan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        
    ]
]);
    ?>
    
    <?php
    if($readonly){
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jumlah_disokong' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'jumlah_diperakuankan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        
    ]
]);*/
    }
    ?>

    <!--<?= $form->field($model, 'permohonan_e_bantuan_id')->textInput() ?>

    <?= $form->field($model, 'butir_butir_perbelanjaan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'jumlah_perbelanjaan')->textInput(['maxlength' => 10]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
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
               $(document).find('#modal').modal('hide');
                form.trigger("reset");
                $.pjax.defaults.timeout = 100000;
                //$.pjax.reload({container:'#anggaranPerbelanjaanGrid'});

                $.pjax.reload({container: "#anggaranPerbelanjaanGrid", async:false});
                $.pjax.reload({container: "#anggaranPerbelanjaanTotal", async:false});
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
