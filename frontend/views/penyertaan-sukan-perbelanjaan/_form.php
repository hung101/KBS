<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

use app\models\RefKategoriPerbelanjaanSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPerbelanjaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyertaan-sukan-perbelanjaan-form">

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
                    'kategori_perbelanjaan' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-kategori-perbelanjaan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'data'=>ArrayHelper::map(RefKategoriPerbelanjaanSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                            'options' => ['placeholder' => Placeholder::kategori],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],],
                        'columnOptions'=>['colspan'=>3]],
                ],
            ],
            
        ]
    ]);
    ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= GeneralLabel::permohonan ?></strong>
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
                        'harga_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'pohon'], 'label' => GeneralLabel::harga.' (RM)'],
                        'orang_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'pohon']],
                        'hari_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'pohon']],
                        'jumlah_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan_pohon' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
        ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= GeneralLabel::cadangan ?></strong>
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
                        'harga_cadang' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'cadang'], 'label' => GeneralLabel::harga.' (RM)'],
                        'orang_cadang' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'cadang']],
                        'hari_cadang' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'cadang']],
                        'jumlah_cadang' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan_cadang' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
        ?>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= GeneralLabel::kelulusan ?></strong>
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
                        'harga_lulus' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'lulus'], 'label' => GeneralLabel::harga.' (RM)'],
                        'orang_lulus' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'lulus']],
                        'hari_lulus' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true, 'class' => 'calculate_total', 'data-type' => 'lulus']],
                        'jumlah_lulus' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'catatan_lulus' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
        ?>
        </div>
    </div>
    
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
                    $.pjax.reload({container:'#penyertaanSukanPerbelanjaanGrid'});
                }
          }
     });
     return false;
});  

$('.calculate_total').change(function(e){
    var type = $(this).attr('data-type');
    calculateTotal(type);

});

function calculateTotal(type){
    var kadar_pohon = $('#penyertaansukanperbelanjaan-harga_pohon');
    var orang_pohon = $('#penyertaansukanperbelanjaan-orang_pohon');
    var hari_pohon = $('#penyertaansukanperbelanjaan-hari_pohon');
    var jumlah_pohon = $('#penyertaansukanperbelanjaan-jumlah_pohon');
    var kadar_cadang = $('#penyertaansukanperbelanjaan-harga_cadang');
    var orang_cadang = $('#penyertaansukanperbelanjaan-orang_cadang');
    var hari_cadang = $('#penyertaansukanperbelanjaan-hari_cadang');
    var jumlah_cadang = $('#penyertaansukanperbelanjaan-jumlah_cadang');
    var kadar_lulus = $('#penyertaansukanperbelanjaan-harga_lulus');
    var orang_lulus = $('#penyertaansukanperbelanjaan-orang_lulus');
    var hari_lulus = $('#penyertaansukanperbelanjaan-hari_lulus');
    var jumlah_lulus = $('#penyertaansukanperbelanjaan-jumlah_lulus');
    
    if(type === 'pohon'){
        if(kadar_pohon.val() != '')
        {
            kadar_pohon.val(parseFloat(kadar_pohon.val()).toFixed(2));
            var total_pohon = kadar_pohon.val();
            if(orang_pohon.val() != '') total_pohon = total_pohon*orang_pohon.val();
            if(hari_pohon.val() != '') total_pohon = total_pohon*hari_pohon.val();
            total_pohon = parseFloat(total_pohon);
            jumlah_pohon.val(total_pohon.toFixed(2));
        }
    } else if(type === 'cadang'){
        if(kadar_cadang.val() != '')
        {
            kadar_cadang.val(parseFloat(kadar_cadang.val()).toFixed(2));
            var total_cadang = kadar_cadang.val();
            if(orang_cadang.val() != '') total_cadang = total_cadang*orang_cadang.val();
            if(hari_cadang.val() != '') total_cadang = total_cadang*hari_cadang.val();
            total_cadang = parseFloat(total_cadang);
            jumlah_cadang.val(total_cadang.toFixed(2));
        }
    } else if(type === 'lulus'){
        if(kadar_lulus.val() != '')
        {
            kadar_lulus.val(parseFloat(kadar_lulus.val()).toFixed(2));
            var total_lulus = kadar_lulus.val();
            if(orang_lulus.val() != '') total_lulus = total_lulus*orang_lulus.val();
            if(hari_lulus.val() != '') total_lulus = total_lulus*hari_lulus.val();
            total_lulus = parseFloat(total_lulus);
            jumlah_lulus.val(total_lulus.toFixed(2));
        }
    } 
}

JS;
        
$this->registerJs($script);
?>
