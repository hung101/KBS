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
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefTemasya;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */

$this->title = GeneralLabel::laporan_acara_kejohanan_temasya;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-badan-sukan">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    <!--<div class="alert alert-info"><?=GeneralMessage::sila_pilih_salah_satu_butiran_kejohanan_temasya?></div>-->
    
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
                'kejohanan' => /*[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'data'=>ArrayHelper::map(PerancanganProgram::find()->where('jenis_aktiviti = :id1 OR jenis_aktiviti = :id2', [':id1' => RefJenisAktiviti::KEJOHANAN_DALAM_NEGARA,':id2' => RefJenisAktiviti::KEJOHANAN_LUAR_NEGARA])->all(),'perancangan_program_id', 'nama_program'),
                        'options' => ['placeholder' => Placeholder::kejohanan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],*/
                [
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    // 'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                    // [
                        // 'append' => [
                            // 'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                            // 'asButton' => true
                        // ]
                    // ] : null,
                    'data'=>ArrayHelper::map(\app\models\PerancanganProgramPlan::find()->joinWith('refKategoriPelan')
                            ->where(['LIKE', 'desc', 'kejohanan'])->all(),'perancangan_program_id', 'nama_program'),
                    'options' => ['placeholder' => Placeholder::kejohanan, 'id' => 'kejohananTemasya'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],],
                'columnOptions'=>['colspan'=>4]],
            ],
        ],
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'temasya' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'data'=>ArrayHelper::map(RefTemasya::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::temasya],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'format' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-report-format/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefReportFormat::find()->where(['=', 'aktif', 1])->all(),'file_extension', 'desc'),
                        'options' => ['placeholder' => Placeholder::format],
                        'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                    'columnOptions'=>['colspan'=>3]],
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
