<?php

use yii\helpers\Html;
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
use app\models\RefInstructorPenilaianPendidikan;

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
                 'nama_penganjuran_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'kod_kursus' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
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
                'instructor' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefInstructorPenilaianPendidikan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::instructor],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
    ]
]);
        ?>
    
    <h3>Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor</h3>
    
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-soalan-penilaian-pendidikan-penganjur/update', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id]).'", "'.GeneralLabel::updateTitle . ' Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-soalan-penilaian-pendidikan-penganjur/view', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id]).'", "'.GeneralLabel::viewTitle . ' Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-soalan-penilaian-pendidikan-penganjur/create', 'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => $pengurusan_penilaian_pendidikan_penganjur_intructor_id]).'", "'.GeneralLabel::createTitle . ' Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor");',
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
