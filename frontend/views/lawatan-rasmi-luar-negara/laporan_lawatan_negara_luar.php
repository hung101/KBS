<?php
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefReportFormat;
use app\models\RefNegara;
use app\models\RefLawatan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-lawatan-negara-luar">

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
						'tarikh_dari' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> DateControl::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
						'tarikh_hingga' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=> DateControl::classname(),
							'ajaxConversion'=>false,
							'options'=>[
								'pluginOptions' => [
									'autoclose'=>true,
								]
							],
							'columnOptions'=>['colspan'=>3]],
					]
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'negara' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-negara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefNegara::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::negara],
								'pluginOptions' => ['allowClear' => true,],],
							'columnOptions'=>['colspan'=>4]],
						'jenis_lawatan' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-lawatan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefLawatan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::lawatan],
								'pluginOptions' => ['allowClear' => true,],],
							'columnOptions'=>['colspan'=>4]],
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
