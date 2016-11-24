<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

// table reference
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefNegara;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKeluarga */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-keluarga-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>GeneralVariable::formJurulatihKeluargaID]); ?>
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
                'nama_suami_isteri_waris' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                'hubungan_keluargaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>30]],
            ],
        ],
       [
            'attributes' => [
                'alamat_surat_menyurat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'negara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegara::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negara],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_menyurat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
       [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_telefon_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>100]],
            ]
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'jurulatih_id')->textInput() ?>

    <?= $form->field($model, 'nama_suami_isteri_waris')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_surat_menyurat_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'emel')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'no_telefon')->textInput(['maxlength' => 14]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKeluargaJurulatihID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
