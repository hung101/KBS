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
use yii\grid\GridView;

// table reference
use app\models\RefTahapPendidikan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihPendidikan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurulatih-pendidikan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data'], 'id'=>GeneralVariable::formJurulatihPendidikanID]); ?>
    
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
                    'tahun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>4]],
                    'tahap_pendidikan' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-tahap-pendidikan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'data'=>ArrayHelper::map(RefTahapPendidikan::find()->all(),'id', 'desc'),
                            'options' => ['placeholder' => Placeholder::tahapPendidikan],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],],
                        'columnOptions'=>['colspan'=>3]],
                     'sekolah_kolej_universiti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
                ],
            ],
            [
                'columns'=>12,
                'autoGenerateColumns'=>false, // override columns setting
                'attributes' => [
                     //'gred' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255], 'hint'=>'Contoh: [2010][SMK Sek 1 Bandar Kinrara][5A 5B]. [2014][UiTM Perak][3.87/Second Class].'],
                     'gred' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255], 'hint'=>'Contoh: SPM 1A,3B,2C. CGPA 3.28'],
                ],
            ],
           
        ]
    ]);

    $label = $model->getAttributeLabel('salinan_sijil');
    if($model->salinan_sijil){
        echo "<div><label>" . $model->getAttributeLabel('salinan_sijil') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->salinan_sijil , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'salinan_sijil' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>4], 'label' => $label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
    echo '<br />';

    ?>
    
    

    <!--<?= $form->field($model, 'jurulatih_id')->textInput() ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'sekolah_kolej_universiti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'gred')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabPendidikanJurulatihID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
