<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\datecontrol\DateControl;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// table reference
use app\models\RefJabatanUser;
use app\models\RefStatusUser;
use app\models\UserPeranan;
use app\models\ProfilBadanSukan;
use app\models\RefSukan;
use app\models\RefNegeri;
use common\models\User;
use app\models\RefBahagianUser;
use app\models\RefCawanganUser;

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
$counterAgency=0;

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['msn'])){
    $filterAgency[] = RefJabatanUser::MSN;
    $counterAgency ++;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['isn'])){
    $filterAgency[] = RefJabatanUser::ISN;
    $counterAgency ++;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['pjs'])){
    $filterAgency[] = RefJabatanUser::PJS;
    $counterAgency ++;
}

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['kbs'])){
    $filterAgency[] = RefJabatanUser::KBS;
    $counterAgency ++;
}


$jabatan_list = RefJabatanUser::find()->andWhere(['=', 'aktif', 1])->all();

if(count($filterAgency) > 0){
    $jabatan_list = RefJabatanUser::find()->andWhere(['=', 'aktif', 1])->andFilterWhere(['in', 'id', $filterAgency])->all();
}

$disabled_jabatan = false;

if(isset(Yii::$app->user->identity->jabatan_id) && !$readonly && Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN && ($counterAgency == 1 || $counterAgency == 0)){
    $model->jabatan_id = Yii::$app->user->identity->jabatan_id;
    $disabled_jabatan = true;
}

$user_peranan_list = UserPeranan::find()->where(['=', 'aktif', 1]);

if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user-peranan']['view_own_data'])){
    $user_peranan_list = UserPeranan::find()->where(['=', 'aktif', 1])->where(['=', 'created_by', Yii::$app->user->identity->id])
        ->andWhere(['<>', 'user_peranan_id', Yii::$app->user->identity->peranan]);
}

if(Yii::$app->user->identity->peranan && Yii::$app->user->identity->peranan != ""){
    $parrent_arr = explode(',',Yii::$app->user->identity->parent_path);
    
    if (isset($parrent_arr[1]) && ($modelCreator = User::findOne($parrent_arr[1])) !== null) {
    //echo "Created ID = " . Yii::$app->user->identity->created_by;
    //echo "<br>Creator Name = " . $modelCreator->full_name;
        if($modelCreator->peranan != UserPeranan::PERANAN_ADMIN){
            // creator is not admin
            $user_peranan_list = UserPeranan::find()->where(['=', 'aktif', 1])
                    ->where(['=', 'created_by', $modelCreator->id]); //exclude my own peranan
        }
    }
}

// filter out all parent peranan and this user peranan - START
$filterParentPeranan = array();

// this user peranan
if(Yii::$app->user->identity->peranan && Yii::$app->user->identity->peranan != "" && Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN){
    $filterParentPeranan[] = Yii::$app->user->identity->peranan;
}

// this parents peranan
if(Yii::$app->user->identity->parent_path && Yii::$app->user->identity->parent_path != ""){
    $parrent_arr = explode(',',Yii::$app->user->identity->parent_path);
    
    if(($modelUsers = User::find()->andFilterWhere(['in', 'id', $parrent_arr])->all()) !== null){
        foreach($modelUsers as $parent){
            $filterParentPeranan[] = $parent->peranan;
        }
    }
}

if(count($filterParentPeranan) > 0){
    $user_peranan_list = $user_peranan_list->andFilterWhere(['not in', 'user_peranan_id', $filterParentPeranan]);
}
// filter out all parent peranan and this user peranan - END



//$bahagian_list = RefBahagianUser::find()->where(['=', 'aktif', 1])->all();
$disabled_bahagian = false;

if(isset(Yii::$app->user->identity->bahagian) && !$readonly && Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN){
    $model->bahagian = Yii::$app->user->identity->bahagian;
    $disabled_bahagian = true;
    //$bahagian_list = RefBahagianUser::find()->where(['=', 'aktif', 1])->andWhere(['=', 'id', Yii::$app->user->identity->bahagian])->all();
    $user_peranan_list = $user_peranan_list->andWhere(['=', 'bahagian', Yii::$app->user->identity->bahagian]);
}


$disabled_cawangan = false;

if(isset(Yii::$app->user->identity->cawangan) && !$readonly && Yii::$app->user->identity->peranan != UserPeranan::PERANAN_ADMIN){
    $model->cawangan = Yii::$app->user->identity->cawangan;
    $disabled_cawangan = true;
    $user_peranan_list = $user_peranan_list->andWhere(['=', 'cawangan', Yii::$app->user->identity->cawangan]);
}

?>

<div class="user-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(),'options'=>['autocomplete'=>'off']]); ?>
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
                        'options' => ['placeholder' => Placeholder::jabatan,'disabled'=>$disabled_jabatan,],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'bahagian' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bahagian-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefBahagianUser::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'jabatan_id')],
                            'placeholder' => Placeholder::bahagian,
                            'url'=>Url::to(['/ref-bahagian-user/subbahagians'])],
                        'disabled'=>$disabled_bahagian,
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'cawangan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-cawangan-user/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefCawanganUser::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'bahagian')],
                            'placeholder' => Placeholder::cawangan,
                            'url'=>Url::to(['/ref-cawangan-user/subbahagiancawangans'])],
                        'disabled'=>$disabled_cawangan,
                        ],
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
                        'data'=>ArrayHelper::map($user_peranan_list->all(),'user_peranan_id', 'nama_peranan'),
                        'options' => ['placeholder' => Placeholder::peranan],
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

<?php
$DateDisplayFormat = GeneralVariable::displayDateFormat;

$script = <<< JS
 
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
    $("#user-jabatan_id").prop("disabled", false);
    $("#user-bahagian").prop("disabled", false);
    $("#user-cawangan").prop("disabled", false);
});
    
$('#user-bahagian').on('depdrop.afterChange', function(event, id, value) {
    if("$disabled_bahagian" == "1"){
            $("#user-bahagian").prop("disabled", true);
    }
});
            
$('#user-cawangan').on('depdrop.afterChange', function(event, id, value) {
    if("$disabled_cawangan" == "1"){
            $("#user-cawangan").prop("disabled", true);
    }
});
        
JS;
        
$this->registerJs($script);
?>
