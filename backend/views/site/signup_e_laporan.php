<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = GeneralLabel::daftar;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>Please fill out the following fields to signup:</p>-->

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => 12])->hint('Sila guna No Kad Pengenalan. Cth: 744412-12-1111 -> 744412121111') ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 160]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => 80]) ?>
            <?= $form->field($model, 'tel_bimbit_no')->textInput(['maxlength' => 14]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Hantar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
