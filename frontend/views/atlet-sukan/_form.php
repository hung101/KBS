<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use kartik\datecontrol\DateControl;
use yii\web\Session;

// table reference
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefCawangan;
use app\models\RefNegeri;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefStatusSukanAtlet;
use app\models\RefSource;
use app\models\RefStatusTawaran;
use app\models\ProfilPusatLatihan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukan */
/* @var $form yii\widgets\ActiveForm */

// Session
    $session = new Session;
    $session->open();
 
if($model->isNewRecord){
	echo "<script>var athlete_status = '1';</script>";
}
 
?>

<div class="atlet-sukan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>GeneralVariable::formAtletSukanID]); ?>
    
    <?php
        if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
            $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->all();
        } else {
            $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->all();
        }
        
        if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
            $cawangan_list = RefCawangan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->all();
        } else {
            $cawangan_list = RefCawangan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->all();
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
            
            if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
                $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
            } else {
                $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
            }
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
    ?>
    
    <?php
        if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
            $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->andWhere('podium = :podium', [':podium' => 0])->all();
        } else {
            $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->andWhere('podium = :podium', [':podium' => 0])->all();
        }
        
        // add filter base on sukan access role Atlet -> Podium Kemas Kini - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            if(isset($session['atlet_cacat']) && $session['atlet_cacat']){
                $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->all();
            } else {
                $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->all();
            }
        }
        // add filter base on sukan access role Atlet -> Podium Kemas Kini - END
        
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
                'program_semasa' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-semasa-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($program_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'cawangan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-cawangan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($cawangan_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::cawangan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'nama_sukan' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                        'data'=>ArrayHelper::map($sukan_list,'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => false,
                            'depends'=>[Html::getInputId($model, 'cawangan')],
                            'placeholder' => Placeholder::sukan,
                            'url'=>Url::to(['/ref-sukan/subsukan'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                /*'nama_sukan' => [
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
                    'columnOptions'=>['colspan'=>3]],*/
                'acara' => [
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
                            'depends'=>[Html::getInputId($model, 'nama_sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula_menyertai_program_msn' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat_menyertai_program_msn' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tahun_umur_permulaan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                /*'jurulatih_id' => [
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
                        'data'=>ArrayHelper::map(Jurulatih::find()->where(['=', 'status_tawaran', RefStatusTawaran::LULUS_TAWARAN])->all(),'jurulatih_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::jurulatih],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>6]],*/
                'jurulatih_id' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                        'data'=>ArrayHelper::map(Jurulatih::find()->where(['=', 'status_tawaran', RefStatusTawaran::LULUS_TAWARAN])->all(),'jurulatih_id', 'nameAndIC'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'program_semasa'), Html::getInputId($model, 'nama_sukan')],
                            'placeholder' => Placeholder::jurulatih,
                            'url'=>Url::to(['/jurulatih/get-jurulatih-for-atlet'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'profil_pusat_latihan_id' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                        'data'=>ArrayHelper::map(ProfilPusatLatihan::find()->all(),'profil_pusat_latihan_id', 'nama_pusat_latihan'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            //'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'jurulatih_id')],
                            'placeholder' => Placeholder::pusatLatihan,
                            'url'=>Url::to(['/profil-pusat-latihan/get-pusat-latihan-by-jurulatih'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                
                'source' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-source/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSource::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenis],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_lesen_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>20]],
                'atlet_persekutuan_dunia_id' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>20]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'negeri_diwakili' => [
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
                    'columnOptions'=>['colspan'=>4]],
                'status' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusSukanAtlet::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ]
        ],
    ]
]);
    ?>
    
    <?php
    if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['tawaran']) && !$model->isNewRecord){
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'kelulusan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80], 'hint'=>GeneralMessage::cth_jkk_bilangan_3_tahun_2015],
                        'tarikh_kelulusan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ],
                            ],
                            'columnOptions'=>['colspan'=>3],
                            'hint'=>'Cth. Tarikh JKB Bil3/2015'],
                            
                    ]
                ]
            ]
        ]);
    }
    ?>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'nama_sukan')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'acara')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tahun_umur_permulaan')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'tarikh_mula_menyertai_program_msn')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'program_semasa')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'no_lesen_sukan')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'atlet_persekutuan_dunia_id')->textInput(['maxlength' => 20]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabSukanID.'");']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php $session->close(); ?>
