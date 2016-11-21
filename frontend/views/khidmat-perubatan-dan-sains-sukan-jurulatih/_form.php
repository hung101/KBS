<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\DepDrop;

// table reference
use app\models\RefSukan;
use app\models\RefProgramJurulatih;
use app\models\Jurulatih;
use app\models\RefStatusTawaran;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khidmat-perubatan-dan-sains-sukan-jurulatih-form">

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
                        'program' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-program-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefProgramJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::program],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        'sukan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::sukan],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        'jurulatih' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(Jurulatih::find()->where('status_tawaran = :status_tawaran', [':status_tawaran' => RefStatusTawaran::LULUS_TAWARAN])->all(),'jurulatih_id', 'nameAndIC'),
                                'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>6]],
                    ],
                ],
            ]
        ]);
    ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


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
                    $.pjax.reload({container:'#jurulatihGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>
