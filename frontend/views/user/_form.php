<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;
use app\models\RefSukan;
use app\models\RefNegeri;
use common\models\User;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

// filter by agency
$filterAgency=array();

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['msn'])){
    $filterAgency[] = RefJabatanUser::MSN;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['isn'])){
    $filterAgency[] = RefJabatanUser::ISN;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['pjs'])){
    $filterAgency[] = RefJabatanUser::PJS;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['kbs'])){
    $filterAgency[] = RefJabatanUser::KBS;
}


$jabatan_list = RefJabatanUser::find()->andWhere(['=', 'aktif', 1])->all();

if(count($filterAgency) > 0){
    $jabatan_list = RefJabatanUser::find()->andWhere(['=', 'aktif', 1])->andFilterWhere(['in', 'id', $filterAgency])->all();
}

$user_peranan_list = UserPeranan::find()->where(['=', 'aktif', 1])->all();

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user-peranan']['view_own_data'])){
    $user_peranan_list = UserPeranan::find()->where(['=', 'aktif', 1])->where(['=', 'created_by', Yii::$app->user->identity->id])->all();
}

if (($modelCreator = User::findOne(Yii::$app->user->identity->created_by)) !== null) {
//echo "Created ID = " . Yii::$app->user->identity->created_by;
//echo "<br>Creator Name = " . $modelCreator->full_name;
    if($modelCreator->peranan != UserPeranan::PERANAN_ADMIN){
        // creator is not admin
        $user_peranan_list = UserPeranan::find()->where(['=', 'aktif', 1])
                ->where(['=', 'created_by', $modelCreator->id])
                ->andWhere(['<>', 'user_peranan_id', Yii::$app->user->identity->peranan])->all(); //exclude my own peranan
    }
}

?>

<div class="user-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly,'options'=>['autocomplete'=>'off']]); ?>
    <?php //echo $form->errorSummary($model); ?>
    <?php 
    if(!isset($model->oldAttributes['username']) || $model->oldAttributes['username'] != "admin"){
        echo FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                             'username' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>12, 'autocomplete'=>"off"]],  
                        ],
                    ],
                ]
            ]);
    }
    
    if(!$readonly){
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'columnSize' => Form::SIZE_TINY,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'new_password' => ['type'=>Form::INPUT_PASSWORD,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>50, 'autocomplete'=>"off"]],
                        'password_confirm' => ['type'=>Form::INPUT_PASSWORD,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>50, 'autocomplete'=>"off"]],
                    ]
                ],
            ]
        ]);
    }
        
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'full_name' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>50]],
                'jabatan_id' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jabatan-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($jabatan_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jabatan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'peranan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/user-peranan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($user_peranan_list,'user_peranan_id', 'nama_peranan'),
                        'options' => ['placeholder' => Placeholder::peranan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                /*'profil_badan_sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/controllers/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                        'options' => ['placeholder' => Placeholder::persatuan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],*/
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tel_mobile_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'tel_no' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'email' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'expiry_date' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ],
                        'options' => ['id'=>'ExpiryDateID'],
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'status' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-status-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefStatusUser::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::status],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
        
        // selected sukan list
        $sukan_selected = null;
        if(isset($model->sukan) && $model->sukan != ''){
            $sukan_selected=explode(',',$model->sukan);
        }
        
        // List Sukan for filter
        echo '<label class="control-label">'.$model->getAttributeLabel('sukan').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'user-sukan',
            'name' => 'User[sukan]',
            'value' => $sukan_selected, // initial value
            'data' => ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
            'options' => ['placeholder' => Placeholder::sukan, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);
        
        
        // selected negeri list
        $negeri_selected = null;
        if(isset($model->negeri) && $model->negeri != ''){
            $negeri_selected=explode(',',$model->negeri);
        }
        
        // List Negeri for filter
        echo '<br>';
        echo '<label class="control-label">'.$model->getAttributeLabel('negeri').'</label>';
        echo Select2::widget([
            'model' => $model,
            'id' => 'user-negeri',
            'name' => 'User[negeri]',
            'value' => $negeri_selected, // initial value
            'data' => ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
            'options' => ['placeholder' => Placeholder::negeri, 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'disabled' => $readonly
        ]);
        
        
        
        ?>
    
    <br>
    
    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
