<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefJenisCawanganKuasaJkkJkp;
use app\models\RefStatusJkkJkp;
use app\models\RefNamaAhliJkkJkp;
use app\models\RefJawatanJkkJkp;
use app\models\RefSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJkkJkp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-jkk-jkp-form">

   <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

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
                //'nama_setiausaha_jkk_jkp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>9],'options'=>['maxlength'=>80]],
                'jenis_cawangan_kuasa' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-cawangan-kuasa-jkk-jkp/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisCawanganKuasaJkkJkp::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisCawanganKuasa],],
                    'columnOptions'=>['colspan'=>3]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_pelantikan_jkk_jkp' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tempoh_hak_jkk_jkp' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'status' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-jkk-jkp/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusJkkJkp::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_pegawai_coach' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-nama-ahli-jkk-jkp/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNamaAhliJkkJkp::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::namaAhli],],
                    'columnOptions'=>['colspan'=>5]],
                'jawatan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jawatan-jkk-jkp/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJawatanJkkJkp::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jawatan],],
                    'columnOptions'=>['colspan'=>5]],
                
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_pelantikan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'peranan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>30]],
                'tempoh_hak' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
            ]
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
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>4]],
                'agensi' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
                'jawatan_agensi' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
            ]
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                
                'nama_acara' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Acara --'],'columnOptions'=>['colspan'=>4]],
                'nama_atlet' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Atlet --'],'columnOptions'=>['colspan'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_jurulatih' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Jurulatih --'],'columnOptions'=>['colspan'=>5]],
            ]
        ],*/
    ]
]);
    ?>
   
   <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-jkk-jkp']['status_pilihan']) || $readonly): ?>
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
                'status_pilihan' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>
    

    <!--<?= $form->field($model, 'nama_setiausaha_jkk_jkp')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_pelantikan_jkk_jkp')->textInput() ?>

    <?= $form->field($model, 'tempoh_hak_jkk_jkp')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'nama_pegawai_coach')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jawatan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_pelantikan')->textInput() ?>

    <?= $form->field($model, 'tempoh_hak')->textInput() ?>

    <?= $form->field($model, 'sukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_acara')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'nama_atlet')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'status_pilihan')->textInput() ?>

    <?= $form->field($model, 'nama_jurulatih')->textInput(['maxlength' => 80]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
