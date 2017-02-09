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


// Session
    $session = new Session;
    $session->open();
    
    if(isset($session['pengurusan_program_binaan_sukan_id']) && $session['pengurusan_program_binaan_sukan_id']){
        $jurulatih_list = Jurulatih::find()->joinWith(['refJurulatihSukan' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->one();
                    },
                ])->where(['=', 'tbl_jurulatih_sukan.sukan', $session['pengurusan_program_binaan_sukan_id']])->all();
    } elseif(isset($session['pengurusan_program_binaan_program_id']) && $session['pengurusan_program_binaan_program_id']){
        $jurulatih_list = Jurulatih::find()->joinWith(['refJurulatihSukan' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->one();
                    },
                ])->where(['=', 'tbl_jurulatih_sukan.program', $session['pengurusan_program_binaan_program_id']])->all();
    } elseif(isset($session['pengurusan_program_binaan_sukan_id']) && $session['pengurusan_program_binaan_sukan_id'] && isset($session['pengurusan_program_binaan_program_id']) && $session['pengurusan_program_binaan_program_id']){
        $jurulatih_list = Jurulatih::find()->joinWith(['refJurulatihSukan' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->one();
                    },
                ])->where(['=', 'tbl_jurulatih_sukan.sukan', $session['pengurusan_program_binaan_sukan_id']])->andWhere(['=', 'tbl_jurulatih_sukan.program_semasa', $session['pengurusan_program_binaan_program_id']])->all();
    } else {
        $jurulatih_list = Jurulatih::find()->all();
    }
        
    $session->close();
?>

<div class="pengurusan-program-binaan-jurulatih-form">

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
                'jurulatih_id' => [
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
                        'data'=>ArrayHelper::map($jurulatih_list,'jurulatih_id', 'nameAndIC'),
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
                    $.pjax.defaults.timeout = 100000;
                    $.pjax.reload({container:'#pengurusanProgramBinaanJurulatihGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>




