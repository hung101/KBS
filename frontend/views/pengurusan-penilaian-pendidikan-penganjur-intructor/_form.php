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
//use app\models\RefInstructorPenilaianPendidikan;
use app\models\ProfilPanelPenasihatKpsk;
use app\models\PengurusanPermohonanKursusPersatuan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianPendidikanPenganjurIntructor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-penilaian-pendidikan-penganjur-intructor-form">

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
                        'data'=>ArrayHelper::map(PengurusanPermohonanKursusPersatuan::find()->all(),'pengurusan_permohonan_kursus_persatuan_id', 'tarikh_kursus'),
                        'options' => ['placeholder' => Placeholder::tarikhKursus, 'id'=>'kursusId'],],
                    'columnOptions'=>['colspan'=>6]],
                'nama_penganjuran_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                'kod_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
                 
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_penyelaras' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                
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
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'instructor' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-instructor-penilaian-pendidikan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(ProfilPanelPenasihatKpsk::find()->all(),'profil_panel_penasihat_kpsk_id', 'nama'),
                        'options' => ['placeholder' => Placeholder::instructor],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
    ]
]);
        ?>
    
    <h3>Soalan Penilaian</h3>
    
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
    
    <?php Pjax::begin(['id' => 'pengurusanSoalanPenilaianPendidikanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanSoalanPenilaianPendidikan,
        //'filterModel' => $searchModelPengurusanSoalanPenilaianPendidikan,
        'id' => 'pengurusanSoalanPenilaianPendidikanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_soalan_penilaian_pendidikan_penganjur_id',
            //'pengurusan_penilaian_pendidikan_penganjur_intructor_id',
            //'soalan',
            [
                'attribute' => 'soalan',
                'value' => 'refSoalanPenilaianPendidikanPenganjurInstructor.desc'
            ],
            //'rating',
            [
                'attribute' => 'rating',
                'value' => 'refRatingSoalan.desc'
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-soalan-penilaian-pendidikan-penganjur/delete', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanSoalanPenilaianPendidikanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-soalan-penilaian-pendidikan-penganjur/update', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id]).'", "'.GeneralLabel::updateTitle . ' Soalan Penilaian");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-soalan-penilaian-pendidikan-penganjur/view', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id]).'", "'.GeneralLabel::viewTitle . ' Soalan Penilaian");',
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
        $pengurusan_penilaian_pendidikan_penganjur_intructor_id = "";
        
        if(isset($model->pengurusan_penilaian_pendidikan_penganjur_intructor_id)){
            $pengurusan_penilaian_pendidikan_penganjur_intructor_id = $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-soalan-penilaian-pendidikan-penganjur/create', 'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => $pengurusan_penilaian_pendidikan_penganjur_intructor_id]).'", "'.GeneralLabel::createTitle . ' Soalan Penilaian");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <!--<?= $form->field($model, 'nama_penganjuran_kursus')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kod_kursus')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tarikh_kursus')->textInput() ?>

    <?= $form->field($model, 'instructor')->textInput(['maxlength' => 80]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$URLKursus = Url::to(['/pengurusan-permohonan-kursus-persatuan/get-kursus']);

$script = <<< JS
        
$('#kursusId').change(function(){
    
    $.get('$URLKursus',{id:$(this).val()},function(data){
        clearForm();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#pengurusanpenilaianpendidikanpenganjurintructor-nama_penyelaras').attr('value',data.nama);
            $('#pengurusanpenilaianpendidikanpenganjurintructor-kod_kursus').attr('value',data.kod_kursus);
            $('#pengurusanpenilaianpendidikanpenganjurintructor-tempat_kursus').attr('value',data.tempat);
            $('#pengurusanpenilaianpendidikanpenganjurintructor-nama_penganjuran_kursus').attr('value',data.kursus);
        }
    });
});
     
function clearForm(){
    $('#pengurusanpenilaianpendidikanpenganjurintructor-nama_penyelaras').attr('value','');
    $('#pengurusanpenilaianpendidikanpenganjurintructor-kod_kursus').attr('value','');
    $('#pengurusanpenilaianpendidikanpenganjurintructor-tempat_kursus').attr('value','');
        $('#pengurusanpenilaianpendidikanpenganjurintructor-nama_penganjuran_kursus').attr('value','');
}
        
JS;
        
$this->registerJs($script);
?>
