<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\KursusPersatuan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kursus-persatuan-form">

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
                'nama_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
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
                 'activiti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                'pegawai_terlibat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                 
            ],
        ],
    ]
]);
        ?>
    
    <h3>Tempahan Kursus Persatuan</h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'tempahanKursusPersatuanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderTempahanKursusPersatuan,
        //'filterModel' => $searchModelTempahanKursusPersatuan,
        'id' => 'tempahanKursusPersatuanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tempahan_kursus_persatuan_id',
            //'kursus_persatuan_id',
            'tarikh',
            //'jenis_tempahan',
            [
                'attribute' => 'jenis_tempahan',
                'value' => 'refJenisTempahanKursusPersatuan.desc'
            ],
            'unit_tempahan',
            // 'kos_tempahan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['tempahan-kursus-persatuan/delete', 'id' => $model->tempahan_kursus_persatuan_id]).'", "'.GeneralMessage::confirmDelete.'", "tempahanKursusPersatuanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['tempahan-kursus-persatuan/update', 'id' => $model->tempahan_kursus_persatuan_id]).'", "'.GeneralLabel::updateTitle . ' Tempahan Kursus Persatuan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['tempahan-kursus-persatuan/view', 'id' => $model->tempahan_kursus_persatuan_id]).'", "'.GeneralLabel::viewTitle . ' Tempahan Kursus Persatuan");',
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
        $kursus_persatuan_id = "";
        
        if(isset($model->kursus_persatuan_id)){
            $kursus_persatuan_id = $model->kursus_persatuan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['tempahan-kursus-persatuan/create', 'kursus_persatuan_id' => $kursus_persatuan_id]).'", "'.GeneralLabel::createTitle . ' Tempahan Kursus Persatuan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    
    <h3>Pengurusan Kos Kursus Persatuan</h3>
    
    <?php Pjax::begin(['id' => 'pengurusanKosKursusPersatuanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanKosKursusPersatuan,
        //'filterModel' => $searchModelPengurusanKosKursusPersatuan,
        'id' => 'pengurusanKosKursusPersatuanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_perhimpunan_kem_kos_id',
            //'pengurusan_perhimpunan_kem_id',
            //'kategori_kos',
            [
                'attribute' => 'kategori_kos',
                'value' => 'refKategoriKosPerhimpunanKem.desc'
            ],
            'anggaran_kos_per_kategori',
            'revised_kos_per_kategori',
            'approved_kos_per_kategori',
            // 'catatan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-kos-kursus-persatuan/delete', 'id' => $model->pengurusan_perhimpunan_kem_kos_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanKosKursusPersatuanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-kos-kursus-persatuan/update', 'id' => $model->pengurusan_perhimpunan_kem_kos_id]).'", "'.GeneralLabel::updateTitle . ' Pengurusan Kos Kursus Persatuan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-kos-kursus-persatuan/view', 'id' => $model->pengurusan_perhimpunan_kem_kos_id]).'", "'.GeneralLabel::viewTitle . ' Pengurusan Kos Kursus Persatuan");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-kos-kursus-persatuan/create', 'kursus_persatuan_id' => $kursus_persatuan_id]).'", "'.GeneralLabel::createTitle . ' Pengurusan Kos Kursus Persatuan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <!--<?= $form->field($model, 'nama_kursus')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'activiti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tempat')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'pegawai_terlibat')->textInput(['maxlength' => 80]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
