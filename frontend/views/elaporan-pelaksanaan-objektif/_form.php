<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanObjektif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="elaporan-pelaksanaan-objektif-form">
    
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
                'objektif_pelaksanaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255]],
            ],
        ],
        
    ]
]);
    ?>

    <!--<?= $form->field($model, 'elaporan_pelaksaan_id')->textInput() ?>

    <?= $form->field($model, 'objektif_pelaksanaan')->textInput(['maxlength' => 255]) ?>-->

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
                $.pjax.reload({container:'#objektifGrid'});
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
