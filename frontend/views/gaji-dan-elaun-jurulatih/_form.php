<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\Jurulatih;
use app\models\RefBank;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\GajiDanElaunJurulatih */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gaji-dan-elaun-jurulatih-form">

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
                'nama_jurulatih' => [
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
                        'options' => ['placeholder' => Placeholder::jurulatih],],
                    'columnOptions'=>['colspan'=>6]],
                //'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4]],
                //'nama_sukan' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Sukan --'],'columnOptions'=>['colspan'=>5]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 'tarikh_tamat' => [
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
                 'bank' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bank/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBank::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bank],],
                    'columnOptions'=>['colspan'=>4]],
                'no_akaun' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>50]],
                'cawangan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
        ?>
    
    <h3>Elaun Jurulatih</h3>
    
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
    
    <?php Pjax::begin(['id' => 'elaunJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderElaunJurulatih,
        //'filterModel' => $searchModelElaunJurulatih,
        'id' => 'elaunJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaun_jurulatih_id',
            //'gaji_dan_elaun_jurulatih_id',
            //'jenis_elaun',
            [
                'attribute' => 'jenis_elaun',
                'value' => 'refJenisElaunJurulatih.desc'
            ],
            'jumlah_elaun',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['elaun-jurulatih/delete', 'id' => $model->elaun_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "elaunJurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaun-jurulatih/update', 'id' => $model->elaun_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' Elaun Jurulatih");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaun-jurulatih/view', 'id' => $model->elaun_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' Elaun Jurulatih");',
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
        $gaji_dan_elaun_jurulatih_id = "";
        
        if(isset($model->gaji_dan_elaun_jurulatih_id)){
            $gaji_dan_elaun_jurulatih_id = $model->gaji_dan_elaun_jurulatih_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['elaun-jurulatih/create', 'gaji_dan_elaun_jurulatih_id' => $gaji_dan_elaun_jurulatih_id]).'", "'.GeneralLabel::createTitle . ' Elaun Jurulatih");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <!--<?= $form->field($model, 'nama_jurulatih')->textInput() ?>

    <?= $form->field($model, 'no_kad_pengenalan')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'no_passport')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'nama_sukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_mula')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'bank')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_akaun')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cawangan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
