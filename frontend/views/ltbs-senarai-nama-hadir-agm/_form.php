<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;

// table reference
use app\models\RefJantina;
use app\models\RefKategoriKeahlian;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirAgm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltbs-senarai-nama-hadir-agm-form">

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
                'nama_penuh' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jantina' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefJantina::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jantina],],
                    'columnOptions'=>['colspan'=>3]],
                'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>50]],
                'kategori_keahlian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKategoriKeahlian::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriKeahlian],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'mesyuarat_agm_id')->textInput() ?>

    <?= $form->field($model, 'nama_penuh')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'no_kad_pengenalan')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'jantina')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'jawatan')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'kategori_keahlian')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'kehadiran')->textInput() ?>-->

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
                $.pjax.defaults.timeout = 6000;
                $.pjax.reload({container:'#senaraiNamaKehadiranGrid'});
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
