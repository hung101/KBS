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
use app\models\RefPenilaianJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPemantauanDanPenilaianJurulatih */
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
                'nama_jurulatih_dinilai' => [
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
                        'data'=>ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
                'nama_sukan' => [
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
                'nama_acara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-acara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefAcara::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'nama_sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pusat_latihan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'penilaian_oleh' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-penilaian-jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPenilaianJurulatih::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::penilaian],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_dinilai' => [
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
       
    ]
]);
        ?>
    
    <h3>Kategori Penilaian Jurulatih</h3>
    
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
    
    <?php Pjax::begin(['id' => 'pengurusanPenilaianKategoriJurulatihGrid', 'timeout' => 100000]); ?>

    <?php 
    $dataProviderPengurusanPenilaianKategoriJurulatih->pagination->pageSize=0;
    
    echo GridView::widget([
        'dataProvider' => $dataProviderPengurusanPenilaianKategoriJurulatih,
        //'filterModel' => $searchModelPengurusanPenilaianKategoriJurulatih,
        'id' => 'pengurusanPenilaianKategoriJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_penilaian_kategori_jurulatih_id',
            //'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            //'penilaian_kategori',
            [
                'attribute' => 'penilaian_kategori',
                'value' => 'refKategoriPenilaianJurulatih.desc'
            ],
            //'penilaian_sub_kategori',
            [
                'attribute' => 'penilaian_sub_kategori',
                'value' => 'refSubKategoriPenilaianJurulatih.desc'
            ],
            'markah_penilaian',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-penilaian-kategori-jurulatih/delete', 'id' => $model->pengurusan_penilaian_kategori_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanPenilaianKategoriJurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-penilaian-kategori-jurulatih/update', 'id' => $model->pengurusan_penilaian_kategori_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' Kategori Penilaian Jurulatih");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-penilaian-kategori-jurulatih/view', 'id' => $model->pengurusan_penilaian_kategori_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' Kategori Penilaian Jurulatih");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php 
        $calculate_jumlah_markah = 0;
        foreach($dataProviderPengurusanPenilaianKategoriJurulatih->models as $PPPKJLmodel){
            $calculate_jumlah_markah += $PPPKJLmodel->markah_penilaian;
        }
        
        
    ?>
    
    <h4>Jumlah Markah Penilaian: <?=$calculate_jumlah_markah?></h4>
    
    <?php 
        $session = new Session;
        $session->open();
        
        if(isset($session['penilaian_oleh_id'])){
            $model->penilaian_oleh = $session['penilaian_oleh_id'];
        }
        
        $session->close();
        
        $penilaian_oleh = $model->penilaian_oleh;
        
        if($readonly){
            $penilaian_oleh = $model->penilaian_oleh_id;
        }
        
        if($penilaian_oleh){
            if (($modelRefPenilaianJurulatih = RefPenilaianJurulatih::findOne($penilaian_oleh)) !== null) {
                $calculate_jumlah_permarkahan = (($calculate_jumlah_markah/180) * ($modelRefPenilaianJurulatih->markah_peratus/100)); // formula (x/180*5%)
                echo "<h4>Jumlah Permarkahan (x/180*".$modelRefPenilaianJurulatih->markah_peratus."%): " . number_format($calculate_jumlah_permarkahan, 4) . "</h4>";
            } 
        }
    
    ?>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $pengurusan_pemantauan_dan_penilaian_jurulatih_id = "";
        
        if(isset($model->pengurusan_pemantauan_dan_penilaian_jurulatih_id)){
            $pengurusan_pemantauan_dan_penilaian_jurulatih_id = $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-penilaian-kategori-jurulatih/create', 'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $pengurusan_pemantauan_dan_penilaian_jurulatih_id]).'", "'.GeneralLabel::createTitle . ' Kategori Penilaian Jurulatih");',
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
        <?= Html::a(GeneralLabel::backToList, ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLJurulatih = Url::to(['/jurulatih/get-jurulatih']);

$URLJurulatihSukan = Url::to(['/jurulatih-sukan/get-jurulatih-sukan-acara']);

$URLSetPernilaianOleh = Url::to(['/pengurusan-pemantauan-dan-penilaian-jurulatih/set-pernilaian-oleh']);

$script = <<< JS
        
$('#pengurusanpemantauandanpenilaianjurulatih-penilaian_oleh').change(function(){
    $.get('$URLSetPernilaianOleh',{penilaian_oleh_id:$('#pengurusanpemantauandanpenilaianjurulatih-penilaian_oleh').val()},function(data){
        $.pjax.defaults.timeout = 106000;
        $.pjax.reload({container:'#pengurusanPenilaianKategoriJurulatihGrid'});
    });
});
        
$('#jurulatihId').change(function(){
    
    $.get('$URLJurulatih',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#pengurusanpemantauandanpenilaianjurulatih-pusat_latihan').attr('value',data.pusat_latihan);
            //$("#pengurusanpemantauandanpenilaianjurulatih-nama_sukan").val(data.nama_sukan).trigger("change");
            //$("#pengurusanpemantauandanpenilaianjurulatih-nama_acara").val(data.nama_acara).trigger("change");
        }
    });
        
    $.get('$URLJurulatihSukan',{jurulatih_id:$(this).val()},function(data){
        var data = $.parseJSON(data);
        
        if(data !== null){
            $("#pengurusanpemantauandanpenilaianjurulatih-nama_sukan").val(data.sukan).trigger("change");
            if(data.refJurulatihAcara !== null){ 
                $("#pengurusanpemantauandanpenilaianjurulatih-nama_acara").val(data.refJurulatihAcara[0].acara).trigger("change");
            }
        }
    });
});
     
function clearForm(){
    $('#pengurusanpemantauandanpenilaianjurulatih-pusat_latihan').attr('value','');
    $("#pengurusanpemantauandanpenilaianjurulatih-nama_sukan").val('').trigger("change");
    $("#pengurusanpemantauandanpenilaianjurulatih-nama_acara").val('').trigger("change");
}
        
JS;
        
$this->registerJs($script);
?>

