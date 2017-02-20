<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// table reference
use app\models\RefKategoriKosProgramBinaan;
use app\models\RefKategoriPerbelanjaan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhimpunanKemKos */
/* @var $form yii\widgets\ActiveForm */

if($readonly){
    if(isset($model->kategori_perbelanjaan) && $model->kategori_perbelanjaan != null)
    {
        $model->kategori_perbelanjaan = RefKategoriPerbelanjaan::findOne($model->kategori_perbelanjaan)->desc;
    }
}
?>

<div class="pengurusan-perhimpunan-kem-kos-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    <?php
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kategori_kos' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-kos-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriKosProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriKos],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'anggaran_kos_per_kategori' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                 'revised_kos_per_kategori' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                 'approved_kos_per_kategori' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
            ],
        ],
       [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                 'catatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);*/
    ?>
    
    <div>
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
                        'kategori_perbelanjaan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-kategori-perbelanjaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefKategoriPerbelanjaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::bahagian],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'perbelanjaan_dipohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
    ?>
    </div>
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Permohonan</strong>
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
                        'kadar_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'pohon'], 'label' => GeneralLabel::kadar.' (RM)'],
                        'bilangan_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'pohon']],
                        'hari_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'pohon']],
                        'jumlah_dipohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
        ?>
                </div>
            </div>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-program-binaan']['kelulusan']) || $readonly): ?>
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Cadangan</strong>
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
                        'kadar_cadangan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'cadangan'], 'label' => GeneralLabel::kadar.' (RM)'],
                        'bilangan_cadangan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'cadangan']],
                        'hari_cadangan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'cadangan']],
                        'anggaran_perbelanjaan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true], 'label' =>GeneralLabel::jumlah],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan_cadangan' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
        ?>
                </div>
            </div>
    <?php endif; ?>

    <!--<?= $form->field($model, 'pengurusan_program_binaan_id')->textInput() ?>

    <?= $form->field($model, 'kategori_kos')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'anggaran_kos_per_kategori')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'revised_kos_per_kategori')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'approved_kos_per_kategori')->textInput(['maxlength' => 10]) ?>

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
                    $.pjax.reload({container:'#programBinaanKosGrid'});
                }
          }
     });
     return false;
}); 

$('.calculate_total').change(function(e){
    var type = $(this).attr('data-type');
    calculateTotal(type);
    var targetId = $(this).attr('id');
    if(targetId === 'pengurusanprogrambinaankos-kadar_pohon' || targetId === 'pengurusanprogrambinaankos-kadar_cadangan')
    {
        var value = parseFloat($(this).val());
        $(this).val(value.toFixed(2));
    }
});
     
function calculateTotal(type){
    if(type === 'pohon'){
        var kadar_pohon = $('#pengurusanprogrambinaankos-kadar_pohon').val();
        var bilangan_pohon = $('#pengurusanprogrambinaankos-bilangan_pohon').val();
        var hari_pohon = $('#pengurusanprogrambinaankos-hari_pohon').val();
        if(kadar_pohon != '' && bilangan_pohon != '' && hari_pohon != '')
        {
            var jumlah_pohon = kadar_pohon*bilangan_pohon*hari_pohon;
            $('#pengurusanprogrambinaankos-jumlah_dipohon').val(jumlah_pohon.toFixed(2));
        }
    } else if(type === 'cadangan'){
        var kadar_cadangan = $('#pengurusanprogrambinaankos-kadar_cadangan').val();
        var bilangan_cadangan = $('#pengurusanprogrambinaankos-bilangan_cadangan').val();
        var hari_cadangan = $('#pengurusanprogrambinaankos-hari_cadangan').val();
        if(kadar_cadangan != '' && bilangan_cadangan != '' && hari_cadangan != '')
        {
            var jumlah_cadangan = kadar_cadangan*bilangan_cadangan*hari_cadangan;
            $('#pengurusanprogrambinaankos-anggaran_perbelanjaan').val(jumlah_cadangan);
        }
    }
}

JS;
        
$this->registerJs($script);
?>