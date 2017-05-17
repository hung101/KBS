<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

// table reference
use app\models\RefMasalahKesihatan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKesihatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-kesihatan-form">
    
    <?php
        if(!$readonly){
            $template = '{view}';
        
            // Update Access
            if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update'])){
                $template .= ' {update}';
            }

            // Delete Access
            if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])){
                $template .= ' {delete}';
            }
        } else {
            $template = '{view}';
        }
    ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>GeneralVariable::formJurulatihKesihatanID]); ?>
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
                'tinggi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'berat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
       /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'masalah_kesihatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-masalah-kesihatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefMasalahKesihatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::masalahKesihatan],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],*/
        [
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'pembedahan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'alahan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'sejarah_perubatan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'attributes' => [
                'kecacatan' => ['type'=>Form::INPUT_TEXTAREA,'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
        ?>
    
    <br>
    <h3><?php echo GeneralLabel::masalah_kesihatan; ?></h3>
    
    <?php 
    $modelTitleID = GeneralVariable::jurulatihKesihatanTabModalTitle;
    $modelID = GeneralVariable::jurulatihKesihatanTabModal;
    $modelContentID = GeneralVariable::jurulatihKesihatanTabModalContent;
    
            Modal::begin([
                'header' => '<h3 id='.$modelTitleID.'></h3>',
                'id' => $modelID,
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="'.$modelContentID.'"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'masalahGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderMasalah,
        //'filterModel' => $searchModelMasalah,
        'id' => 'masalahGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jurulatih_kesihatan_kesihatan_id',
            //'jurulatih_kesihatan_id',
            //'masalah_kesihatan',
            [
                'attribute' => 'masalah_kesihatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::masalah_kesihatan,
                ],
                'value' => 'refMasalahKesihatan.desc'
            ],
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
                        'onclick' => 'deleteRecordSubModalAjax("'.Url::to(['jurulatih-kesihatan-masalah/delete', 'id' => $model->jurulatih_kesihatan_kesihatan_id]).'", "'.GeneralMessage::confirmDelete.'", "masalahGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjaxTab("'.Url::to(['jurulatih-kesihatan-masalah/update', 'id' => $model->jurulatih_kesihatan_kesihatan_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::masalah_kesihatan.'", "'.GeneralVariable::jurulatihKesihatanTabModal.'", "'.GeneralVariable::jurulatihKesihatanTabModalContent.'", "'.GeneralVariable::jurulatihKesihatanTabModalTitle.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjaxTab("'.Url::to(['jurulatih-kesihatan-masalah/view', 'id' => $model->jurulatih_kesihatan_kesihatan_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::masalah_kesihatan.'", "'.GeneralVariable::jurulatihKesihatanTabModal.'", "'.GeneralVariable::jurulatihKesihatanTabModalContent.'", "'.GeneralVariable::jurulatihKesihatanTabModalTitle.'");',
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
        $jurulatih_kesihatan_id = "";
        
        if(isset($model->jurulatih_kesihatan_id)){
            $jurulatih_kesihatan_id = $model->jurulatih_kesihatan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjaxTab("'.Url::to(['jurulatih-kesihatan-masalah/create', 'jurulatih_kesihatan_id' => $jurulatih_kesihatan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::masalah_kesihatan.'", "'.GeneralVariable::jurulatihKesihatanTabModal.'", "'.GeneralVariable::jurulatihKesihatanTabModalContent.'", "'.GeneralVariable::jurulatihKesihatanTabModalTitle.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    <br>

    <!--<?= $form->field($model, 'jurulatih_id')->textInput() ?>

    <?= $form->field($model, 'tinggi')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'berat')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'masalah_kesihatan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'pembedahan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alahan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sejarah_perubatan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'kecacatan')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKesihatanID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
