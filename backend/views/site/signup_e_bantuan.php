<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Daftar';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>Please fill out the following fields to signup:</p>-->

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => 30])->hint('Sila guna No Pendaftaran Persatuan. Cth: ppm/001') ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 160]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => 80]) ?>
            <?= $form->field($model, 'tel_bimbit_no')->textInput(['maxlength' => 14]) ?>
            <?= $form->field($model, 'nama_persatuan_e_bantuan')->textInput(['maxlength' => 80]) ?>
            <?= $form->field($model, 'jawatan_e_bantuan')->textInput(['maxlength' => 80]) ?>
            <?php echo "<div class='required'>"; ?>
            <?= $form->field($model, 'sijil_pendaftaran')->fileInput() ?>
            <?php echo "</div>"; ?>
                <div class="form-group">
                    <?= Html::submitButton('Hantar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
