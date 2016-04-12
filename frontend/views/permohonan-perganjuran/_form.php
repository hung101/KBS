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
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerganjuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-perganjuran-form">

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
                'tempat_kursus' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 'aktiviti' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
                //'nama_instructor' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6]],
                
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'tarikh_kursus')->textInput() ?>

    <?= $form->field($model, 'tempat_kursus')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'aktiviti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_instructor')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>-->
    
    
    <h3>Instruktur</h3>
    
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
    
    <?php Pjax::begin(['id' => 'permohonanPerganjuranInstructorGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanPerganjuranInstructor,
        //'filterModel' => $searchModelPermohonanPerganjuranInstructor,
        'id' => 'permohonanPerganjuranInstructorGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_perganjuran_instructor_id',
            //'permohonan_perganjuran_id',
            'nama_instructor',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-perganjuran-instructor/delete', 'id' => $model->permohonan_perganjuran_instructor_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanPerganjuranInstructorGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-perganjuran-instructor/update', 'id' => $model->permohonan_perganjuran_instructor_id]).'", "'.GeneralLabel::updateTitle . ' Instruktur");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-perganjuran-instructor/view', 'id' => $model->permohonan_perganjuran_instructor_id]).'", "'.GeneralLabel::viewTitle . ' Instruktur");',
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
        $permohonan_perganjuran_id = "";
        
        if(isset($model->permohonan_perganjuran_id)){
            $permohonan_perganjuran_id = $model->permohonan_perganjuran_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-perganjuran-instructor/create', 'permohonan_perganjuran_id' => $permohonan_perganjuran_id]).'", "'.GeneralLabel::createTitle . ' Instruktur");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    
    <h3>Kos</h3>
    
    <?php Pjax::begin(['id' => 'permohonanPenganjuranKosGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermohonanPenganjuranKos,
        //'filterModel' => $searchModelPermohonanPenganjuranKos,
        'id' => 'permohonanPenganjuranKosGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_perhimpunan_kem_kos_id',
            //'permohonan_perganjuran_id',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['permohonan-penganjuran-kos/delete', 'id' => $model->pengurusan_perhimpunan_kem_kos_id]).'", "'.GeneralMessage::confirmDelete.'", "permohonanPenganjuranKosGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-penganjuran-kos/update', 'id' => $model->pengurusan_perhimpunan_kem_kos_id]).'", "'.GeneralLabel::updateTitle . ' Kos");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-penganjuran-kos/view', 'id' => $model->pengurusan_perhimpunan_kem_kos_id]).'", "'.GeneralLabel::viewTitle . ' Kos");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['permohonan-penganjuran-kos/create', 'permohonan_perganjuran_id' => $permohonan_perganjuran_id]).'", "'.GeneralLabel::createTitle . ' Kos");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['kelulusan']) || $readonly): ?>
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
                'kelulusan' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if(!$model->isNewRecord): ?>
            <?php 
            if(!$model->isNewRecord){
                echo Html::a('Penganjuran Pemantauan', 'javascript:void(0);', [
                                'onclick' => 'loadModalRenderAjax("'.Url::to(['penganjuran-pemantuan/load', 'permohonan_perganjuran_id' => $permohonan_perganjuran_id]).'", "Penganjuran Pemantauan");',
                                'class' => 'btn btn-success',
                                ]);
            }
            ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
