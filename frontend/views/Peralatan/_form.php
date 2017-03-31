<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\Peralatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peralatan-form">

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
                        'nama_peralatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5]],
                        'spesifikasi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                        'kuantiti_unit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5]],
                    ]
                ],*/
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'nama_peralatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'spesifikasi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
    ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::permohonan?></strong>
        </div>
        <div class="panel-body">

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
                                'harga_per_unit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                                'jumlah_unit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                                'bilangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                                'jumlah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
								'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>12]],
                            ]
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?=GeneralLabel::cadangan?></strong>
        </div>
        <div class="panel-body">

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
                                'harga_per_unit_cadangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                                'jumlah_unit_cadangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                                'bilangan_cadangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>true]],
                                'jumlah_cadangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
								'catatan_cadangan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>12]],
                            ]
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <?php
/*         echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>5]],
                    ]
                ],
            ]
        ]); */
    ?>
    


    <!--<?= $form->field($model, 'permohonan_peralatan_id')->textInput() ?>

    <?= $form->field($model, 'nama_peralatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'spesifikasi')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'kuantiti_unit')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => 255]) ?>-->

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
$script = <<< JS
        
$('#peralatan-harga_per_unit').on("keyup", function(){calculateJumlah();});
$('#peralatan-jumlah_unit').on("keyup", function(){calculateJumlah();});
$('#peralatan-bilangan').on("keyup", function(){calculateJumlah();});

$('#peralatan-harga_per_unit_cadangan').on("keyup", function(){calculateJumlahCadang();});
$('#peralatan-jumlah_unit_cadangan').on("keyup", function(){calculateJumlahCadang();});
$('#peralatan-bilangan_cadangan').on("keyup", function(){calculateJumlahCadang();});
        
function calculateJumlah(){
    var harga_per_unit = 0;
    var jumlah_unit = 0;
    var bilangan = 0;
    var jumlah = 0;
        
    if($('#peralatan-harga_per_unit').val() > 0){harga_per_unit = parseFloat($('#peralatan-harga_per_unit').val());}
    if($('#peralatan-jumlah_unit').val() > 0){jumlah_unit = parseInt($('#peralatan-jumlah_unit').val());}
    if($('#peralatan-bilangan').val() > 0){bilangan = parseInt($('#peralatan-bilangan').val());}
    
    // Jumlah formula
    jumlah = harga_per_unit * jumlah_unit * bilangan;
        
    //display at fields accordingly
    $('#peralatan-jumlah').val(jumlah);
}

function calculateJumlahCadang(){
    var harga_per_unit = 0;
    var jumlah_unit = 0;
    var bilangan = 0;
    var jumlah = 0;
        
    if($('#peralatan-harga_per_unit_cadangan').val() > 0){harga_per_unit = parseFloat($('#peralatan-harga_per_unit_cadangan').val());}
    if($('#peralatan-jumlah_unit_cadangan').val() > 0){jumlah_unit = parseInt($('#peralatan-jumlah_unit_cadangan').val());}
    if($('#peralatan-bilangan_cadangan').val() > 0){bilangan = parseInt($('#peralatan-bilangan_cadangan').val());}
    
    // Jumlah formula
    jumlah = harga_per_unit * jumlah_unit * bilangan;
        
    //display at fields accordingly
    $('#peralatan-jumlah_cadangan').val(jumlah);
} 
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {
    
     var \$form = $(this);

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
            $.pjax.reload({container:'#peralatanGrid'});
        } else {
            $("#message").html(result);
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
