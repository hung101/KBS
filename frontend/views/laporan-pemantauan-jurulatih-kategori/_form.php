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
use app\models\RefKategoriLaporanPenilaianJurulatih;
use app\models\RefSubKategoriLaporanPenilaianJurulatih;

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

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data'], 'id'=>$model->formName()]); ?>
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
                                        'content' => Html::a(Html::icon('edit'), ['/ref-kategori-laporan-penilaian-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : '<div></div>',
                                'data'=>ArrayHelper::map(RefKategoriLaporanPenilaianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::kategoriPenilaian],
        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
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
                                            'content' => Html::a(Html::icon('edit'), ['/ref-sub-kategori-laporan-penilaian-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                            'asButton' => true
                                        ]
                                    ] : '<div></div>',
                                    'pluginOptions'=>['allowClear'=>true]
                                ],
                                'data'=>ArrayHelper::map(RefSubKategoriLaporanPenilaianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options'=>['prompt'=>'',],
                                'pluginOptions' => [
                                    'depends'=>[Html::getInputId($model, 'penilaian_kategori')],
                                    'initialize' => true,
                                    'placeholder' => Placeholder::subKategoriPenilaian,
                                    'url'=>Url::to(['/ref-sub-kategori-laporan-penilaian-jurulatih/subkategori'])],
                                ],
                            'columnOptions'=>['colspan'=>5]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'syor' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
                        'ulasan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>true]],
                    ],
                ],
                // [
                    // 'columns'=>12,
                    // 'autoGenerateColumns'=>false, // override columns setting
                    // 'attributes' => [
                        // 'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    // ],
                // ],
            ]
        ]);
    ?>
    
    <?php 
    //upload
    if($model->muat_naik){
        echo "<label>" . $model->getAttributeLabel('muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::delete, ['deleteupload', 'id'=>$model->laporan_pemantauan_jurulatih_kategori_id, 'field'=> 'muat_naik'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
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
                    $.pjax.defaults.timeout = 106000;
                    $.pjax.reload({container:'#laporanPemantauanJurulatihKategoriGrid'});
                }
          }
     });
     return false;
});
     

JS;
        
$this->registerJs($script);
?>

