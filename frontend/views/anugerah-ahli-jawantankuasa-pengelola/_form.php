<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\RefAjk;
use app\models\RefBahagianAjk;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahAhliJawantankuasaPengelola */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anugerah-ahli-jawantankuasa-pengelola-form">

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
                        'tahun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
        /*                 'ajk' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-ajk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefAjk::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::ajk],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                        'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>true]],
                        'bahagian' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-ajk/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefBahagianAjk::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::bahagian],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]], */
                    ],
                ],
            ]
        ]);
        ?>
        
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
        
    <h3><?php echo GeneralLabel::ahli_jawatankuasa; ?></h3>
    
    <?php Pjax::begin(['id' => 'anugerahAhliJawatankuasaPengelolaItemGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAnugerahAhliJawantankuasaPengelolaItem,
        'id' => 'anugerahAhliJawatankuasaPengelolaItemGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'ajk',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ahli_jawatankuasa,
                ],
                'value' => 'refAjk.desc',
            ],
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ],
            ],
            [
                'attribute' => 'bahagian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bahagian,
                ],
                'value' => 'refBahagianAjk.desc'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['anugerah-ahli-jawantankuasa-pengelola-item/delete', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_item_id]).'", "'.GeneralMessage::confirmDelete.'", "anugerahAhliJawatankuasaPengelolaItemGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-ahli-jawantankuasa-pengelola-item/update', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_item_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::ahli_jawatankuasa.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-ahli-jawantankuasa-pengelola-item/view', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_item_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::ahli_jawatankuasa.'");',
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
        $anugerah_ahli_jawantankuasa_pengelola_id = "";
        
        if(isset($model->anugerah_ahli_jawantankuasa_pengelola_id)){
            $anugerah_ahli_jawantankuasa_pengelola_id = $model->anugerah_ahli_jawantankuasa_pengelola_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['anugerah-ahli-jawantankuasa-pengelola-item/create', 'anugerah_ahli_jawantankuasa_pengelola_id' => $anugerah_ahli_jawantankuasa_pengelola_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::ahli_jawatankuasa.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <!--<?= $form->field($model, 'ajk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bahagian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
