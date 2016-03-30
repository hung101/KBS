<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

// table reference
use app\models\RefJenisBajetSumbangan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BajetPenyelidikan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bajet-penyelidikan-form">

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
                'jenis_bajet' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-bajet-sumbangan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisBajetSumbangan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisBajet, 'id'=>'jenisBajetID'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'tahun_1' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>10]],
                'tahun_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>10]],
                'tahun_3' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>10]],
            ],
        ],
        
    ]
]);
    ?>
    
<div class="row">
  <div class="col-sm-12">
    <div class="row">
      <div class="col-md-4" id="jenisBajetButiranID">
      </div>
    </div><!--/row-->    
  </div><!--/col-12-->
</div><!--/row-->
    
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
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'permohonana_penyelidikan_id')->textInput() ?>

    <?= $form->field($model, 'jenis_bajet')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tahun_1')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => 10]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLGetButiran = Url::to(['/ref-jenis-bajet/get-butiran']);
$jenisBajetID = $model->jenis_bajet;

if($readonly){
    $jenisBajetID = $model->jenis_bajet_id;
}

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
                    $.pjax.reload({container:'#bajetPenyelidikanSumbanganGrid'});
                }
          }
     });
     return false;
});

$(document).ready(function(){
    var jenisBajetID = "$jenisBajetID";
        
    if(jenisBajetID != "") {
        //getButiran(jenisBajetID);
    }
}); 

$('#jenisBajetID').change(function(){
    //alert(this.value);
    //getButiran(this.value);
});
        
function getButiran(id){
    $.get('$URLGetButiran',{id:id},function(data){
        // Clear the butiran before get new one
        $('#jenisBajetButiranID').html('');
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#jenisBajetButiranID').html( '<div class="well" >' + data.butiran + '</div>');
        }
    });  
}
     

JS;
        
$this->registerJs($script);
?>
