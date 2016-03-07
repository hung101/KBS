<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// table reference
use app\models\RefKategoriPenilaianJurulatih;
use app\models\RefSubKategoriPenilaianJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianKategoriJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-penilaian-kategori-jurulatih-form">

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
                'penilaian_kategori' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefKategoriPenilaianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriPenilaian],],
                    'columnOptions'=>['colspan'=>4]],
                'penilaian_sub_kategori' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefSubKategoriPenilaianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::subKategoriPenilaian],],
                    'columnOptions'=>['colspan'=>5]],
                'markah_penilaian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
            ],
        ],
       
    ]
]);
        ?>

    <!--<?= $form->field($model, 'pengurusan_pemantauan_dan_penilaian_jurulatih_id')->textInput() ?>

    <?= $form->field($model, 'penilaian_kategori')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'penilaian_sub_kategori')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'markah_penilaian')->textInput() ?>-->

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
               
                if(response != 1){
                    $('#modalContent').html(response);
                } else {
                    $(document).find('#modal').modal('hide');
                    form.trigger("reset");
                    $.pjax.defaults.timeout = 6000;
                    $.pjax.reload({container:'#pengurusanPenilaianKategoriJurulatihGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>

