<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// table reference
use app\models\RefKategoriHakmilik;
use app\models\RefJenisPenggunaEKemudahan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = GeneralLabel::kemaskini_profil;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>Please fill out the following fields to signup:</p>-->

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
            <?php //echo $form->errorSummary($model); ?>
            <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
            <?php
        /*echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_pengguna_e_kemudahan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2', 
                    'options'=>[
                        'data'=>ArrayHelper::map(RefJenisPenggunaEKemudahan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenis, 'id'=>'jenisPengguna'],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);*/
    ?>
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => 80]) ?>
            <?= $form->field($model, 'alamat_kemudahan_msn')->textInput(['maxlength' => 90]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'tel_bimbit_no')->textInput(['maxlength' => 14]) ?>
            <?= $form->field($model, 'majikan_kemudahan_msn')->textInput(['maxlength' => 80]) ?>
            <?= $form->field($model, 'majikan_alamat_kemudahan_msn')->textInput(['maxlength' => 90]) ?>
            <div class="form-group">
                <?= Html::submitButton(GeneralLabel::update, ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php

$script = <<< JS
        
$(document).ready(function(){
    $("#kategoriHakmilikDiv").hide();
}); 

$('#jenisPengguna').change(function(){
    if(this.value == '1'){
        $("#kategoriHakmilikDiv").show();
    } else if(this.value == '2') {
        $("#kategoriHakmilikDiv").hide();
    }
});
     

JS;
        
$this->registerJs($script);
?>
