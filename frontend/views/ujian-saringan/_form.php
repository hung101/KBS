<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

// table reference
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefJantina;
use app\models\RefDarjah;
use app\models\RefSekolah;
use app\models\RefBangsa;
use app\models\RefSukan;
use app\models\RefMaklumatProgram;


// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\UjianSaringan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ujian-saringan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName()]); ?>
    <?php
    if(!$readonly){
        echo $form->field($model, 'tarikh_lahir')->hiddenInput()->label(false);
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
                'nama' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'maklumat_program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-maklumat-program/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefMaklumatProgram::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::maklumatProgram],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'no_kad_pengenalan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12, 'id'=>'noKadPengenalanId', 'class'=>'integer']],
                
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
                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'sekolah' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-sekolah/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefSekolah::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sekolah],],
                    'columnOptions'=>['colspan'=>4]],
                'darjah' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-darjah/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefDarjah::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::darjah],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'attributes' => [
                'alamat_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_negeri' => [
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
                        'options' => ['placeholder' => Placeholder::negeri],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_bandar' => [
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
                            'depends'=>[Html::getInputId($model, 'alamat_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'umur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>3, 'disabled'=>true, 'id'=>'umurId']],
                'bangsa' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-bangsa/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefBangsa::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::bangsa],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'jantina' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jantina/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJantina::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jantina],],
                    'columnOptions'=>['colspan'=>3]],
                'no_telefon' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'berat_badan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'id'=>'beratBadanId', 'class'=>'number calculateBMI']],
                'ketinggian' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'id'=>'ketinggianId', 'class'=>'number calculateBMI']],
                'tinggi_duduk' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>6, 'class'=>'number']],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'panjang_depa' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'class'=>'number']],
                'body_mass_index' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10, 'id'=>'BMIId', 'class'=>'number', 'disabled'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'catatan' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
    ?>

    <!--<?= $form->field($model, 'nama')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'sekolah')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'alamat_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_2')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_3')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'alamat_negeri')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'alamat_bandar')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'alamat_poskod')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'jantina')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'no_telefon')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'darjah')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'berat_badan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'ketinggian')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'tinggi_duduk')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'panjang_depa')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'body_mass_index')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$LELAKI_CODE = RefJantina::LELAKI;
$PEREMPUAN_CODE = RefJantina::PEREMPUAN;

$script = <<< JS
        
    $(document).ready(function(){
        if($("#noKadPengenalanId").val() != ""){
            getAgeFromICNo($("#noKadPengenalanId").val());
        }
    });
        
    $(".calculateBMI").keyup(function (e) {
        if($("#beratBadanId").val() > 0 && $("#ketinggianId").val() > 0){
            var height = $("#ketinggianId").val() / 100; //convert to meter
            var height2 = height * height;
            var BMI = $("#beratBadanId").val() / height2;
            $("#BMIId").val(BMI.toFixed(2));
        }
    }); 
        
    $("#noKadPengenalanId").focusout(function(){
        getAgeFromICNo(this.value);
    });
        
    function getAgeFromICNo(ICNo){
        var DOBVal = "";

        if(ICNo != ""){
            DOBVal = getDOBFromICNo(ICNo);
        
            $("#ujiansaringan-tarikh_lahir").val(DOBVal);  
        
            if(isEven(ICNo)){
                // if IC No is even then is woman
                $("#ujiansaringan-jantina").val('$PEREMPUAN_CODE').trigger("change");
            } else {
                // if IC No is odd then is guy
                $("#ujiansaringan-jantina").val('$LELAKI_CODE').trigger("change");
            }
        }

        $("#umurId").val(calculateAge(formatSaveDate(DOBVal)));
    }
 
    // enable all the disabled field before submit
    $('form#{$model->formName()}').on('beforeSubmit', function (e) {

        var form = $(this);
        
        $("form#{$model->formName()} input").prop("disabled", false);
    });
        
JS;
        
$this->registerJs($script);
?>
