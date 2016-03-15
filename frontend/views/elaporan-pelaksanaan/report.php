<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\RefNegeri;

use dosamigos\datepicker\DateRangePicker;

use app\models\general\Placeholder;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */

$this->title = 'Menjana E-Laporan Pelaksanaan / Program / Aktiviti';
$this->params['breadcrumbs'][] = ['label' => 'E-Laporan Pelaksanaan / Program / Aktiviti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-report">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_penganjur')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'nama_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'negeri')->dropDownList(
        ArrayHelper::map(RefNegeri::find()->all(),'id','desc'),
        ['prompt'=>Placeholder::negeri]
    ) ?>

    <?= $form->field($model, 'tarikh_dari')->widget(DateRangePicker::className(), [
        'attributeTo' => 'tarikh_pada', 
        'form' => $form, // best for correct client validation
        'language' => 'en',
        'size' => 'm',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>

    <?= $form->field($model, 'format')->dropDownList([ 'html' => 'HTML', 'pdf' => 'PDF', 'xls' => 'EXCEL', 'csv' => 'CSV'], ['prompt' => 'Format']) ?>

    <?= Html::submitButton('Menjana', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

</div>
