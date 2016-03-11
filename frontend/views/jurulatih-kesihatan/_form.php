<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

// table reference
use app\models\RefMasalahKesihatan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKesihatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-kesihatan-form">

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
       [
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
        ],
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
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKesihatanID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
