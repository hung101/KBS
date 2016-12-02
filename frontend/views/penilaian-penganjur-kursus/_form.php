<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\PengurusanPermohonanKursusPersatuan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-penganjur-kursus-form">
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
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
                'pengurusan_permohonan_kursus_persatuan_id' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/pengurusan-permohonan-kursus-persatuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanPermohonanKursusPersatuan::find()->all(),'pengurusan_permohonan_kursus_persatuan_id', 'agensi'),
                        'options' => ['placeholder' => Placeholder::agensi, 'id'=>'kursusId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
                'kod_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                 'tarikh_kursus' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_penganjur_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                 
            ],
        ],
    ]
]);
        ?>
    
    
    <h3><?php echo GeneralLabel::soalan_penilaian; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'penilaianPenganjurKursusSoalanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenilaianPenganjurKursusSoalan,
        //'filterModel' => $searchModelPenilaianPenganjurKursusSoalan,
        'id' => 'penilaianPenganjurKursusSoalanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penilaian_penganjur_kursus_soalan_id',
            //'penilaian_penganjur_kursus_id',
            //'kategori_soalan',
            [
                'attribute' => 'kategori_soalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_soalan,
                ],
                'value' => 'refKategoriSoalanPenganjur.desc'
            ],
            //'soalan',
            [
                'attribute' => 'soalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::soalan,
                ],
                'value' => 'refSoalanPenganjur.desc'
            ],
            //'skala',
            [
                'attribute' => 'skala',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::skala,
                ],
                'value' => 'refRatingSoalan.desc'
            ],
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penilaian-penganjur-kursus-soalan/delete', 'id' => $model->penilaian_penganjur_kursus_soalan_id]).'", "'.GeneralMessage::confirmDelete.'", "penilaianPenganjurKursusSoalanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-penganjur-kursus-soalan/update', 'id' => $model->penilaian_penganjur_kursus_soalan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::soalan_penilaian.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-penganjur-kursus-soalan/view', 'id' => $model->penilaian_penganjur_kursus_soalan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::soalan_penilaian.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $penilaian_penganjur_kursus_id = "";
        
        if(isset($model->penilaian_penganjur_kursus_id)){
            $penilaian_penganjur_kursus_id = $model->penilaian_penganjur_kursus_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-penganjur-kursus-soalan/create', 'penilaian_penganjur_kursus_id' => $penilaian_penganjur_kursus_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::soalan_penilaian.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLKursus = Url::to(['/pengurusan-permohonan-kursus-persatuan/get-kursus']);
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
        
$('#kursusId').change(function(){
    
    $.get('$URLKursus',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#penilaianpenganjurkursus-kod_kursus').attr('value',data.kod_kursus);
            $('#penilaianpenganjurkursus-tempat_kursus').attr('value',data.tempat);
            $('#penilaianpenganjurkursus-nama_penganjur_kursus').attr('value',data.nama_penganjur);
            $("#penilaianpenganjurkursus-tarikh_kursus-disp").val(formatDisplayDate(data.tarikh_kursus));
            $("#penilaianpenganjurkursus-tarikh_kursus").val(data.tarikh_kursus);
            $("#penilaianpenganjurkursus-tarikh_kursus").kvDatepicker("$DateDisplayFormat", new Date(data.tarikh_kursus)).kvDatepicker({
                format: "$DateDisplayFormat"
            });
        }
    });
});
     
function clearForm(){
    $('#penilaianpenganjurkursus-kod_kursus').attr('value','');
    $('#penilaianpenganjurkursus-tempat_kursus').attr('value','');
    $('#penilaianpenganjurkursus-nama_penganjur_kursus').attr('value','');
    $('#penilaianpenganjurkursus-tarikh_kursus').attr('value','');
    $('#penilaianpenganjurkursus-tarikh_kursus-disp').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
