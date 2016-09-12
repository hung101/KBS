<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// table reference
use app\models\RefKategoriPenilaianJurulatih;
use app\models\RefSubKategoriPenilaianJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianKategoriJurulatihKetua */
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
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-penilaian-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriPenilaianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriPenilaian],],
                    'columnOptions'=>['colspan'=>4]],
                'penilaian_sub_kategori' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-sub-kategori-penilaian-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefSubKategoriPenilaianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'penilaian_kategori')],
                            'initialize' => true,
                            'placeholder' => Placeholder::subKategoriPenilaian,
                            'url'=>Url::to(['/ref-sub-kategori-penilaian-jurulatih/subkategori'])],
                        ],
                    'columnOptions'=>['colspan'=>5]],
                'markah_penilaian' => [
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'],
                    'value'=>false,
                    'options'=>['inline'=>true],
                    'columnOptions'=>['colspan'=>3]],
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
                    $.pjax.defaults.timeout = 106000;
                    $.pjax.reload({container:'#pengurusanPenilaianKategoriJurulatihGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>

