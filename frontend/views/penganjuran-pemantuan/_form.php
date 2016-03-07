<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranPemantuan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penganjuran-pemantuan-form">

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
               
                 'permohonan_pendahuluan_pelagai' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'menghantar_surat_cuti_tanpa' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'keperluan_bengkel_telah' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'membuat_tempahan_penginapan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'membuat_tempahan_tempat_untuk' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'mengesahan_kehadiran_panel' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'mengesahan_pendaftaran_panel' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'memberi_taklimat' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'mengumpul_dan_membukukan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'membuat_pelarasan_kewangan' => ['type'=>Form::INPUT_CHECKBOX,'columnOptions'=>['colspan'=>6]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'permohonan_pendahuluan_pelagai')->textInput() ?>

    <?= $form->field($model, 'menghantar_surat_cuti_tanpa')->textInput() ?>

    <?= $form->field($model, 'keperluan_bengkel_telah')->textInput() ?>

    <?= $form->field($model, 'membuat_tempahan_penginapan')->textInput() ?>

    <?= $form->field($model, 'membuat_tempahan_tempat_untuk')->textInput() ?>

    <?= $form->field($model, 'mengesahan_kehadiran_panel')->textInput() ?>

    <?= $form->field($model, 'mengesahan_pendaftaran_panel')->textInput() ?>

    <?= $form->field($model, 'memberi_taklimat')->textInput() ?>

    <?= $form->field($model, 'mengumpul_dan_membukukan')->textInput() ?>

    <?= $form->field($model, 'membuat_pelarasan_kewangan')->textInput() ?>-->

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
                    //$.pjax.reload({container:'#permohonanPenganjuranKosGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
