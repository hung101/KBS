<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\builder\Form;
use kartik\builder\FormGrid;

use kartik\helpers\Html;
use kartik\widgets\Select2;

use app\models\RefSukan;
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;

/* @var $this yii\web\View */
/* @var $model app\models\RefAcara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-acara-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::lapangan_mandatori ?></p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'discipline')->textInput() ?>
    
    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_sukan_id')->widget(Select2::classname(), [
        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
        [
            'append' => [
                'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                'asButton' => true
            ]
        ] : null,
        'data' => ArrayHelper::map(RefSukan::find()->where(['aktif' => 1])->all(),'id', 'desc'),
        'options' => ['placeholder' => Placeholder::sukan],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
    <?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
