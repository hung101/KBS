<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use kartik\widgets\DepDrop;

// table reference
use app\models\RefKategoriAnugerah;
use app\models\RefSukan;
use app\models\RefAcara;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianAnugerah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atlet-pencapaian-anugerah-form">
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>GeneralVariable::formAtletPencapaianAnugerahID]); ?>
    
    <?php
        if(isset($session['cacat']) && $session['cacat']){
            $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->all();
        } else {
            $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->all();
        }
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            if(isset($session['cacat']) && $session['cacat']){
                $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
            } else {
                $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
            }
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
    ?>
    
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
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-anugerah/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriAnugerah::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'nama_anugerah_pingat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>80]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tahun' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>4]],
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
                        'data'=>ArrayHelper::map($sukan_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'nama_acara' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-acara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefAcara::find()->where(['=', 'aktif', 1])->all(),'id', 'disciplineAcara'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'remark' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>
    
    <?= $form->field($model, 'kategori')->dropDownList(
                        [''=>'-- Pilih Kategori --'],
                        ['prompt'=>'-- Pilih Kategori --']
                        ) ?>
    
    <?= $form->field($model, 'tahun')->textInput();?>

    <?= $form->field($model, 'nama_acara')->dropDownList(
                        [''=>'-- Pilih Acara --'],
                        ['prompt'=>'-- Pilih Acara --']
                        ) ?>
    
    <?= $form->field($model, 'remark')->textInput() ?>-->
    
    

    <!--<?= $form->field($model, 'insentif_id')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabPencapaianAnugerahID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
