<?php

use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan delete()*/

$this->title = GeneralLabel::cetak_surat_rasmi;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-penganjuran-acara">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
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
						'nama_penerima' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>255]],
						'jawatan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>255]],
						'address_1' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>255]],
						'address_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>255]],
						'address_3' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>255]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'bil_msnm' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>50]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'tarikh' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> DateControl::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								],
							],
							'columnOptions'=>['colspan'=>4]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'gelaran' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100],'hint'=>'Tuan/Puan/Prof/Dr'],
					]
				],
			]
		]);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton(GeneralLabel::generate, ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
