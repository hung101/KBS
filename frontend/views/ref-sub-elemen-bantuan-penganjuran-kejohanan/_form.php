<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\builder\Form;
use kartik\builder\FormGrid;

use kartik\helpers\Html;
use kartik\widgets\Select2;

use app\models\RefElemenBantuanPenganjuranKejohanan;
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;
/* @var $this yii\web\View */
/* @var $model app\models\RefSubElemenBantuanPenganjuranKejohanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-sub-elemen-bantuan-penganjuran-kejohanan-form">
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::lapangan_mandatori ?></p>
    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'ref_sub_elemen_bantuan_penganjuran_kejohanan_id')->widget(Select2::classname(), [
        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
        [
            'append' => [
                'content' => Html::a(Html::icon('edit'), ['/ref-elemen-bantuan-penganjuran-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                'asButton' => true
            ]
        ] : null,
        'data' => ArrayHelper::map(RefElemenBantuanPenganjuranKejohanan::find()->where(['aktif' => 1])->all(),'id', 'desc'),
        'options' => ['placeholder' => Placeholder::bantuan_penganjuran_kejohanan],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?php $model->isNewRecord ? $model->aktif = 1: $model->aktif = $model->aktif ;  ?>
    <?= $form->field($model, 'aktif')->radioList(array(true=>GeneralLabel::yes,false=>GeneralLabel::no)); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
