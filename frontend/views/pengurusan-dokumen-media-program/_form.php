<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// table reference
use app\models\RefKategoriDokumen;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanDokumenMediaProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-dokumen-media-program-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
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
                'kategori_dokumen' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-dokumen/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriDokumen::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriDokumen],],
                    'columnOptions'=>['colspan'=>4]],
                'nama_dokumen' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                //'muatnaik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>5]],
                 
            ],
        ],
        
    ]
]);
    ?>
    
    <?php // Muat Naik Gambar
    
    $label = $model->getAttributeLabel('muatnaik');
    
    if($model->muatnaik){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('muatnaik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muatnaik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'muatnaik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>

    <!--<?= $form->field($model, 'pengurusan_media_program_id')->textInput() ?>

    <?= $form->field($model, 'kategori_dokumen')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_dokumen')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'muatnaik')->textInput(['maxlength' => 100]) ?>-->

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
                    $.pjax.defaults.timeout = 106000;
                    $.pjax.reload({container:'#dokumenMediaProgramGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
