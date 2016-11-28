<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\Atlet;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefSukan;
use app\models\RefJenisTuntutan;
use app\models\RefStatusPermohonanInsuran;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentifTetapan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-insentif-tetapan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    <div class="well">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>SGAR</strong>
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
                'sgar' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>5]],
                 
            ],
        ],
    ]
]);
        ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?php echo GeneralLabel::sikap_capital; ?></strong>
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
                'sikap' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>5]],
                 
            ],
        ],
    ]
]);
        ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>SISO</strong>
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
                'siso_olimpik' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>10]],
                'siso_paralimpik' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>10]],
            ],
        ],
    ]
]);
        ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>SITO</strong>
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
                'sito_emas' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
                'sito_perak' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
                'sito_gangsa' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
            ],
        ],
    ]
]);
        ?>
                </div>
            </div>
    
    
    
    <!--<?= $form->field($model, 'sgar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sikap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siso_olimpik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siso_paralimpik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sito_emas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sito_perak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sito_gangsa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton(GeneralLabel::save, ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    </div>
    
    <br>
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Tetapan SKIM Insentif</strong>
                </div>
                <div class="panel-body">
    
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
    
    <?php Pjax::begin(['id' => 'pengurusanInsentifTetapanShakamShakarGrid', 'timeout' => 100000]); ?>
<div class="CGridViewContainer">
    <?= GridView::widget([
        'dataProvider' => $dataProviderPengurusanInsentifTetapanShakamShakar,
        'filterModel' => $searchModelPengurusanInsentifTetapanShakamShakar,
        'id' => 'pengurusanInsentifTetapanShakamShakarGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_insentif_tetapan_shakam_shakar_id',
            //'pengurusan_insentif_tetapan_id',
            //'jenis_insentif',
            [
                'attribute' => 'jenis_insentif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_insentif,
                ],
                'value' => 'refJenisInsentif.desc'
            ],
            [
                'attribute' => 'kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kejohanan,
                ],
                'value' => 'refInsentifKejohanan.desc'
            ],
            //'pingat',
            [
                'attribute' => 'pingat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pingat,
                ],
                'value' => 'refPingatInsentif.desc'
            ],
            [
                'attribute' => 'peringkat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::peringkat,
                ],
                'value' => 'refInsentifPeringkat.desc'
            ],
            [
                'attribute' => 'kelas',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kelas,
                ],
                'value' => 'refInsentifKelas.desc'
            ],
            //'kumpulan_temasya_kejohanan',
            /*[
                'attribute' => 'kumpulan_temasya_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kumpulan_temasya_kejohanan,
                ],
            ],*/
            //'rekod_baharu',
            [
                'attribute' => 'nilai_individu',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nilai_individu,
                ],
            ],
            [
                'attribute' => 'nilai_berpasukan_kurang_5',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' Nilai Berpasukan < 5 Orang (RM)',
                ],
            ],
            [
                'attribute' => 'nilai_berpasukan_lebih_5',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' Nilai Berpasukan > 5 Orang (RM)',
                ],
            ],
            [
                'attribute' => 'rekod_baharu',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::rekod_baharu,
                ],
            ],
            /*[
                'attribute' => 'jumlah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah,
                ],
            ],*/
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-insentif-tetapan-shakam-shakar/delete', 'id' => $model->pengurusan_insentif_tetapan_shakam_shakar_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanInsentifTetapanShakamShakarGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-insentif-tetapan-shakam-shakar/update', 'id' => $model->pengurusan_insentif_tetapan_shakam_shakar_id]).'", "'.GeneralLabel::updateTitle . ' Tetapan SKIM Insentif");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-insentif-tetapan-shakam-shakar/view', 'id' => $model->pengurusan_insentif_tetapan_shakam_shakar_id]).'", "'.GeneralLabel::viewTitle . ' Tetapan SKIM Insentif");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    </div>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        $pengurusan_insentif_tetapan_id = "";
        
        if(isset($model->pengurusan_insentif_tetapan_id)){
            $pengurusan_insentif_tetapan_id = $model->pengurusan_insentif_tetapan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-insentif-tetapan-shakam-shakar/create', 'pengurusan_insentif_tetapan_id' => $pengurusan_insentif_tetapan_id]).'", "'.GeneralLabel::createTitle . ' Tetapan SKIM Insentif");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
        </div>
    </div>
    
    <br>
    
    

    

</div>

<?php
$script = <<< JS
        
$(document).on("keypress", "form", function(event) { 
    return event.keyCode != 13;
});
     

JS;
        
$this->registerJs($script);
?>
