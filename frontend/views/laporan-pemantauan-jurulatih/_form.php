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
use yii\web\Session;

// table reference
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefPenilaianJurulatihKetua;
use app\models\RefStatusTawaran;
use app\models\RefProgramSemasaSukanAtlet;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-pemantauan-dan-penilaian-jurulatih-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

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
                    'nama_pegawai' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                ],
            ],
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
                            'data'=>ArrayHelper::map(Jurulatih::find()->where('status_tawaran = :status_tawaran', [':status_tawaran' => RefStatusTawaran::LULUS_TAWARAN])->all(),'jurulatih_id', 'nameAndIC'),
                            'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],],
                        'columnOptions'=>['colspan'=>5]],
                    'sukan_id' => [
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
                            'options' => ['placeholder' => Placeholder::sukan, 'disabled'=>true],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],],
                        'columnOptions'=>['colspan'=>3]],
/*                     'program_id' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-program-semasa-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->all(),'id', 'desc'),
                            'options' => ['placeholder' => Placeholder::program],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            //'options'=>['disabled'=>true]
                            ],
                        'columnOptions'=>['colspan'=>4]],    */
                    'program_id' => [
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
                            'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->all(),'id', 'desc'),
                            'options' => ['placeholder' => Placeholder::program, 'disabled'=>true],
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
                    'pusat_latihan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true, 'disabled'=>true]],
                    'tarikh_dinilai' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=> DateControl::classname(),
                        'ajaxConversion'=>false,
                        'options'=>[
                            'pluginOptions' => [
                                'autoclose'=>true,
                            ],
                        ],
                        'columnOptions'=>['colspan'=>3]],
                ],
            ],
           
        ]
    ]);
    ?>
    
    <h3><?php echo GeneralLabel::kategori_pemantauan_jurulatih; ?></h3>
    
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

    <?php Pjax::begin(['id' => 'laporanPemantauanJurulatihKategoriGrid', 'timeout' => 100000]); ?>
    <div class="CGridViewContainer">
        <?php 
        //$dataProviderLaporanPemantauanJurulatihKategori->pagination->pageSize=0;
        
        echo GridView::widget([
            'dataProvider' => $dataProviderLaporanPemantauanJurulatihKategori,
            //'filterModel' => $searchModelPengurusanPenilaianKategoriJurulatihKetua,
            'id' => 'laporanPemantauanJurulatihKategoriGrid',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'penilaian_kategori',
                    'value' => 'refKategoriLaporanPenilaianJurulatih.desc'
                ],
                //'penilaian_sub_kategori',
                [
                    'attribute' => 'penilaian_sub_kategori',
                    'value' => 'refSubKategoriLaporanPenilaianJurulatih.desc'
                ],
                'syor',
                'ulasan',
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                            'title' => Yii::t('yii', 'Delete'),
                            'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-pemantauan-jurulatih-kategori/delete', 'id' => $model->laporan_pemantauan_jurulatih_kategori_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPemantauanJurulatihKategoriGrid");',
                            ]);

                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                            'title' => Yii::t('yii', 'Update'),
                            'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pemantauan-jurulatih-kategori/update', 'id' => $model->laporan_pemantauan_jurulatih_kategori_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::kategori_laporan_pemantauan_jurulatih.'");',
                            ]);
                        },
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                            'title' => Yii::t('yii', 'View'),
                            'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pemantauan-jurulatih-kategori/view', 'id' => $model->laporan_pemantauan_jurulatih_kategori_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::kategori_laporan_pemantauan_jurulatih.'");',
                            ]);
                        }
                    ],
                    'template' => $template,
                ],
            ],
        ]); ?>
    </div>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $laporan_pemantauan_jurulatih_id = "";
        
        if(isset($model->laporan_pemantauan_jurulatih_id)){
            $laporan_pemantauan_jurulatih_id = $model->laporan_pemantauan_jurulatih_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pemantauan-jurulatih-kategori/create', 'laporan_pemantauan_jurulatih_id' => $laporan_pemantauan_jurulatih_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::kategori_laporan_pemantauan_jurulatih.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
        <?= Html::a(GeneralLabel::backToList, ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);

$URLJurulatihSukan = Url::to(['/jurulatih-sukan/get-jurulatih-sukan-acara']);

$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#laporanpemantauanjurulatih-sukan_id").prop("disabled", false);
    $("#laporanpemantauanjurulatih-program_id").prop("disabled", false);
});
        
$('#jurulatihId').change(function(){
    
    $.get('$URLJurulatih',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#laporanpemantauanjurulatih-pusat_latihan').attr('value',data.pusat_latihan);
        }
    });
        
    $.get('$URLJurulatihSukan',{jurulatih_id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        if(data !== null){
            $("#laporanpemantauanjurulatih-sukan_id").val(data.sukan).trigger("change");
            $("#laporanpemantauanjurulatih-program_id").val(data.program).trigger("change");
        }
    });
});
     
function clearForm(){
    $('#laporanpemantauanjurulatih-pusat_latihan').attr('value','');
    $("#laporanpemantauanjurulatih-sukan_id").val('').trigger("change");
    $("#laporanpemantauanjurulatih-program_id").val('').trigger("change");
}
        
JS;
        
$this->registerJs($script);
?>

