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
/* @var $model app\models\AnugerahPencalonanPasukanPemain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pencalonan-pasukan-pemain-form">

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
                'nama_pemain' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'anugerah_pencalonan_pasukan_id')->textInput() ?>

    <?= $form->field($model, 'nama_pemain')->textInput(['maxlength' => true]) ?>

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
                $.pjax.reload({container:'#anugerahPencalonanPasukanPemainGrid'});
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
