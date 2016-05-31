<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\Jurulatih;

/* @var $this yii\web\View */
/* @var $model frontend\models\AkkProgramJurulatihSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akk-program-jurulatih-search">
    
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
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
                'jurulatih' => [
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
                        'options' => ['placeholder' => Placeholder::jurulatih, 'id'=>'jurulatihId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>5]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'akk_program_jurulatih_id') ?>

    <?= $form->field($model, 'peningkatan_kerjaya_jurulatih_id') ?>

    <?= $form->field($model, 'nama_program') ?>

    <?= $form->field($model, 'tarikh_program') ?>

    <?= $form->field($model, 'tempat_program') ?>-->

    <?php // echo $form->field($model, 'kod_kursus') ?>

    <?php // echo $form->field($model, 'tahap') ?>

    <div class="form-group">
        <?= Html::submitButton(GeneralLabel::search, ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(GeneralLabel::reset, ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
