<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusPencalonan;
use app\models\Atlet;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanPasukan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-pencalonan-pasukan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
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
               
                 'kategori' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::kategori],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sukan' => [
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
                 'nama_pasukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>14]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'gambar_pasukan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'ulasan_pencapaian' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
        ?>
    
    <h3>Senarai Pemain</h3>
    
    
    
    <?php Pjax::begin(['id' => 'anugerahPencalonanPasukanPemainGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAnugerahPencalonanPasukanPemain,
        //'filterModel' => $searchModelAnugerahPencalonanPasukanPemain,
        'id' => 'anugerahPencalonanPasukanPemainGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'anugerah_pencalonan_pasukan_pemain_id',
            //'anugerah_pencalonan_pasukan_id',
            'nama_pemain',
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['anugerah-pencalonan-pasukan-pemain/delete', 'id' => $model->anugerah_pencalonan_pasukan_pemain_id]).'", "'.GeneralMessage::confirmDelete.'", "anugerahPencalonanPasukanPemainGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-pencalonan-pasukan-pemain/update', 'id' => $model->anugerah_pencalonan_pasukan_pemain_id]).'", "'.GeneralLabel::updateTitle . ' Senarai Pemain");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-pencalonan-pasukan-pemain/view', 'id' => $model->anugerah_pencalonan_pasukan_pemain_id]).'", "'.GeneralLabel::viewTitle . ' Senarai Pemain");',
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
        $anugerah_pencalonan_pasukan_id = "";
        
        if(isset($model->anugerah_pencalonan_pasukan_id)){
            $anugerah_pencalonan_pasukan_id = $model->anugerah_pencalonan_pasukan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-pencalonan-pasukan-pemain/create', 'anugerah_pencalonan_pasukan_id' => $anugerah_pencalonan_pasukan_id]).'", "'.GeneralLabel::createTitle . ' Senarai Pemain");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <!--<?= $form->field($model, 'kategori')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sukan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pasukan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gambar_pasukan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ulasan_pencapaian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>