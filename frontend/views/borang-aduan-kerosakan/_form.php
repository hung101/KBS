<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\PengurusanPenyelia;
use app\models\UserPeranan;
use app\models\RefBahagianAduan;
use app\models\RefVenueAduan;
use app\models\RefKawasanKemudahan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKerosakan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borang-aduan-kerosakan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
     <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
        
        $disabled = false; // default
        
        if(Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_ADUAN_PENYELIA){
            $disabled = true;
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
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
                'tarikh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'penyelia' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/pengurusan-penyelia/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanPenyelia::find()->where('peranan = :peranan', [':peranan' => UserPeranan::PERANAN_MSN_ADUAN_PENYELIA])->all(),'id', 'full_name'),
                        'options' => ['placeholder' => Placeholder::penyelia, 'id'=>'penyeliaId', 'disabled'=>$disabled],],
                    'columnOptions'=>['colspan'=>5]],
                'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80, 'disabled'=>$disabled]],
            ],
        ],
        
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bahagian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-aduan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBahagianAduan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bahagian, 'disabled'=>$disabled],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'no_tel_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disabled]],
                'no_tel_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14, 'disabled'=>$disabled]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'venue' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-venue-aduan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefVenueAduan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::venue, 'disabled'=>$disabled],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'kawasan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-kawasan-kemudahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefKawasanKemudahan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'', 'disabled'=>$disabled,],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'venue')],
                            //'initialize' => true,
                            'placeholder' => Placeholder::kawasanKemudahan,
                            'url'=>Url::to(['/ref-kawasan-kemudahan/subchilds'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        
    ]
]);
    ?>
    
             <h3><?php echo GeneralLabel::jenis_kerosakan; ?></h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'borangAduanKerosakanJenisKerosakanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBorangAduanKerosakanJenisKerosakan,
        //'filterModel' => $searchModelBorangAduanKerosakanJenisKerosakan,
        'id' => 'borangAduanKerosakanJenisKerosakanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'borang_aduan_kerosakan_jenis_kerosakan_id',
            //'borang_aduan_kerosakan_id',
            'lokasi',
            'jenis_kerosakan',
            //'nama_pemeriksa',
            [
                'attribute' => 'nama_pemeriksa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pemeriksa,
                ],
                'value' => 'refNamaPemeriksaAduan.desc'
            ],
            //'tarikh_pemeriksaan',
            [
                'attribute' => 'tarikh_pemeriksaan',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_pemeriksaan, GeneralFunction::TYPE_DATE);
                },
            ],
            //'kategori_kerosakan',
            [
                'attribute' => 'kategori_kerosakan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_kerosakan,
                ],
                'value' => 'refKategoriKerosakan.desc'
            ],
            //'tindakan',
            // 'catatan',
            //'selesai',
            [
                'attribute' => 'selesai',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::selesai,
                ],
                'value' => 'refKelulusan.desc'
            ],
            'ulasan_pemeriksa',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['borang-aduan-kerosakan-jenis-kerosakan/delete', 'id' => $model->borang_aduan_kerosakan_jenis_kerosakan_id]).'", "'.GeneralMessage::confirmDelete.'", "borangAduanKerosakanJenisKerosakanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['borang-aduan-kerosakan-jenis-kerosakan/update', 'id' => $model->borang_aduan_kerosakan_jenis_kerosakan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::jenis_kerosakan.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['borang-aduan-kerosakan-jenis-kerosakan/view', 'id' => $model->borang_aduan_kerosakan_jenis_kerosakan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::jenis_kerosakan.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        $borang_aduan_kerosakan_id = "";
        
        if(isset($model->borang_aduan_kerosakan_id)){
            $borang_aduan_kerosakan_id = $model->borang_aduan_kerosakan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['borang-aduan-kerosakan-jenis-kerosakan/create', 'borang_aduan_kerosakan_id' => $borang_aduan_kerosakan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jenis_kerosakan.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
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
                'tarikh_siap_tindakan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                        , 'disabled'=>$disabled
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        
    ]
]);
    ?>

    <!--<?= $form->field($model, 'penyelia')->textInput() ?>

    <?= $form->field($model, 'jawatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'venue')->textInput() ?>

    <?= $form->field($model, 'bahagian')->textInput() ?>

    <?= $form->field($model, 'no_tel_pejabat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_tel_bimbit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kawasan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

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
$URL = Url::to(['/pengurusan-penyelia/get-penyelia']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('#penyeliaId').change(function(){
    
    $.get('$URL',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#borangaduankerosakan-jawatan').attr('value',data.aduan_jawatan);
            $('#borangaduankerosakan-bahagian').val(data.aduan_bahagian).trigger("change");
            $('#borangaduankerosakan-no_tel_pejabat').val(data.tel_no).trigger("change");
            $('#borangaduankerosakan-no_tel_bimbit').attr('value',data.tel_mobile_no);
            $('#borangaduankerosakan-venue').val(data.aduan_venue).trigger("change");
            $('#borangaduankerosakan-kawasan').val(data.aduan_kawasan_kemudahan).trigger("change");
        }
    });
});
     
function clearForm(){
    $('#borangaduankerosakan-jawatan').attr('value','');
    $('#borangaduankerosakan-bahagian').val('').trigger("change");
    $('#borangaduankerosakan-no_tel_pejabat').val('').trigger("change");
    $('#borangaduankerosakan-no_tel_bimbit').attr('value','');
    $('#borangaduankerosakan-venue').val('').trigger("change");
    $('#borangaduankerosakan-kawasan').val('').trigger("change");
}
        
JS;
        
$this->registerJs($script);
?>
