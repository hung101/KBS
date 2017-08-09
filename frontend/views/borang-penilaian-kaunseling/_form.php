<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;

// table reference
use app\models\RefKategoriMasalahKaunseling;
use app\models\Atlet;
use app\models\Jurulatih;
use app\models\RefLatarbelakangKes;
use app\models\RefJenisKlien;
use app\models\PermohonanBimbinganKaunseling;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaianKaunseling */
/* @var $form yii\widgets\ActiveForm */

$defaultStyle = ["display:none", "display:none", "display:none"];
echo '<script>var emptyValueFlag = true;</script>';
if($readonly){
	$defaultStyle[$jenisKlienID-1] = "display:block";
}

if(!$readonly && $model->isNewRecord === false){//update
	$defaultStyle[$jenisKlienID-1] = "display:block";
	echo '<script>var emptyValueFlag = false;</script>';
}
?>

<div class="borang-penilaian-kaunseling-form">

     <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
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
						'jenis_klien' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-jenis-klien/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefJenisKlien::find()->where(['aktif' => 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::jenis_klien, 'id' => 'jenisKlienID'],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>6]],
					],
				],
			]
		]);
    ?>
	<div id="atletWrap" style="<?= $defaultStyle[0] ?>">
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
						'atlet' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								//'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                                                            'data'=>ArrayHelper::map(PermohonanBimbinganKaunseling::find()->joinWith(['atlet'])
                                                                    ->groupBy('atlet_id')->where(['<>', 'tbl_atlet.atlet_id', ''])->all(),'atlet_id', 'atlet.nameAndIC'),
								'options' => ['placeholder' => Placeholder::atlet, 'id' => 'atletID'],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>6]],
					],
				],
			]
		]);
	?>
	</div>
	<div id="jurulatihWrap" style="<?= $defaultStyle[1] ?>">
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
						'jurulatih' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								//'data'=>ArrayHelper::map(GeneralFunction::getJurulatih(),'jurulatih_id', 'nameAndIC'),
                                                            'data'=>ArrayHelper::map(PermohonanBimbinganKaunseling::find()->joinWith(['refJurulatih'])
                                                                    ->groupBy('jurulatih')->where(['<>', 'tbl_jurulatih.jurulatih_id', ''])->all(),'jurulatih', 'refJurulatih.nameAndIC'),
								'options' => ['placeholder' => Placeholder::jurulatih, 'id' => 'jurulatihID'],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>6]],
					],
				],
			]
		]);
	?>	
	</div>
	<div id="pegawaiWrap" style="<?= $defaultStyle[2] ?>">
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
						'pegawai_anggota' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true, 'id' => 'pegawaiInput']],
					],
				],
			]
		]);
	?>	
	</div>
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
						'diagnosis' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'preskripsi' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'cadangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'tindakan_selanjutnya' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'rujukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'kategori_permasalahan' => [
							'type'=>Form::INPUT_WIDGET, 
							'widgetClass'=>'\kartik\widgets\Select2',
							'options'=>[
								'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
								[
									'append' => [
										'content' => Html::a(Html::icon('edit'), ['/ref-latarbelakang-kes/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
										'asButton' => true
									]
								] : null,
								'data'=>ArrayHelper::map(RefLatarbelakangKes::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
								'options' => ['placeholder' => Placeholder::kategoriMasalah],
		'pluginOptions' => [
									'allowClear' => true
								],],
							'columnOptions'=>['colspan'=>5]],
						// 'tarikh_temujanji' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
					],
				],
				[
					'columns'=>12,
					'autoGenerateColumns'=>false, // override columns setting
					'attributes' => [
						'lain_lain_nyatakan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>80]],
					],
				],
			]
		]);
    ?>

    <!--<?= $form->field($model, 'profil_konsultan_id')->textInput() ?>

    <?= $form->field($model, 'diagnosis')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'preskripsi')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'cadangan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'rujukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tindakan_selanjutnya')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kategori_permasalahan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'tarikh_temujanji')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
        
$('#jenisKlienID').change(function(){

	if($(this).val() != '' && $(this).val() != null){
		hideWraps();
		if($(this).val() === '1'){ $('#atletWrap').show(); }
		if($(this).val() === '2'){ $('#jurulatihWrap').show(); }
		if($(this).val() === '3'){ $('#pegawaiWrap').show(); }
	} else {
		hideWraps();
	}
});

function hideWraps(){
	if(emptyValueFlag === true){
		$('#atletID').val('').trigger("change"); $('#jurulatihID').val('').trigger("change"); $('#pegawaiInput').val('');
	}
	$('#atletWrap').hide(); $('#jurulatihWrap').hide(); $('#pegawaiWrap').hide();
}
        
JS;
        
$this->registerJs($script);
?>