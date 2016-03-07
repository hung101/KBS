<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiSemak */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-ebantuan-senarai-semak-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php // Kertas Kerja Projek / Program Upload
    
    $label = $model->getAttributeLabel('kertas_kerja_projek_program');
    
    if($model->kertas_kerja_projek_program){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('kertas_kerja_projek_program') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->kertas_kerja_projek_program , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'kertas_kerja_projek_program' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <?php // Salinan Sijil Pendaftaran Persatuan / Pertubuhan Upload
    
    $label = $model->getAttributeLabel('salinan_sijil_pendaftaran_persatuan_pertubuhan');
    
    if($model->salinan_sijil_pendaftaran_persatuan_pertubuhan){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('salinan_sijil_pendaftaran_persatuan_pertubuhan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_sijil_pendaftaran_persatuan_pertubuhan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'salinan_sijil_pendaftaran_persatuan_pertubuhan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <?php // Salinan Perlembagaan Persatuan / Pertubuhan Upload
    
    $label = $model->getAttributeLabel('salinan_perlembagaan_persatuan_pertubuhan');
    
    if($model->salinan_perlembagaan_persatuan_pertubuhan){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('salinan_perlembagaan_persatuan_pertubuhan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_perlembagaan_persatuan_pertubuhan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'salinan_perlembagaan_persatuan_pertubuhan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <?php // Salinan Buku Bank / Penyata Kewangan Persatuan / Pertubuhan Upload
    
    $label = $model->getAttributeLabel('salinan_buku_bank');
    
    if($model->salinan_buku_bank){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('salinan_buku_bank') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_buku_bank , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'salinan_buku_bank' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>

    <!--<?= $form->field($model, 'permohonan_e_bantuan_id')->textInput() ?>

    <?= $form->field($model, 'kertas_kerja_projek_program')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'salinan_sijil_pendaftaran_persatuan_pertubuhan')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'salinan_perlembagaan_persatuan_pertubuhan')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'salinan_buku_bank')->textInput(['maxlength' => 100]) ?>-->

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
                    //alert("error");
                    //$(document).find('#modal').html(response);
                    $('#modalContent').html(response);
                } else {
                    $(document).find('#modal').modal('hide');
                    form.trigger("reset");
                    //$.pjax.defaults.timeout = 100000;
                    //$.pjax.reload({container:'#senaraiPermohonanGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
