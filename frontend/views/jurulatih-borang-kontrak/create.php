<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\web\Session;

// table reference
use app\models\Jurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanJurulatih */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="jurulatih-borang-kontrak-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id'=>'jurulatih-borang-kontrak', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php
    //$label = $model->getAttributeLabel('borang_maklumat');
    
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'borang_maklumat' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'borang_kesihatan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'borang_hrmis' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'borang_rawatan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'borang_keselamatan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'borang_pelekat' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'borang_income_tax' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(GeneralLabel::upload, ['class' => 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS
        
$('form#jurulatih-borang-kontrak').on('beforeSubmit', function (e) {

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
                    $.pjax.defaults.timeout = 100000;
                    $.pjax.reload({container:'#jurulatihBorangGrid'});
                    $('#borangKontrakMsg').show();
                    setTimeout(function(){ $('#borangKontrakMsg').hide(); }, 4000);
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>




