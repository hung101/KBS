<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;

// table reference
use app\models\Atlet;
use app\models\Jurulatih;
use app\models\RefNamaInsentif;
use app\models\RefKumpulan;
use app\models\RefRekodBaru;
use app\models\RefSukan;
use app\models\RefKelayakanPingat;
use app\models\RefPersatuan;
use app\models\RefAcaraOlimpik;
use app\models\RefPingat;
use app\models\RefKategoriInsentif;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengurusan-insentif-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
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
                'atlet_id' => [
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
                        'data'=>ArrayHelper::map(Atlet::find()->all(),'atlet_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::atlet],],
                    'columnOptions'=>['colspan'=>6]],
                'nama_insentif' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-nama-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNamaInsentif::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::namaInsentif],],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kumpulan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kumpulan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKumpulan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kumpulan],],
                    'columnOptions'=>['colspan'=>6]],
                'rekod_baru' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-rekod-baru/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefRekodBaru::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::rekodBaru],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_sukan' => [
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
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>6]],
                'kelayakan_pingat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kelayakan-pingat/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKelayakanPingat::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kelayakanPingat],],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah_insentif' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sgar_nama_jurulatih' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/jurulatih/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(Jurulatih::find()->all(),'jurulatih_id', 'nameAndIC'),
                        'options' => ['placeholder' => Placeholder::jurulatih],],
                    'columnOptions'=>['colspan'=>6]],
                'jumlah_sgar' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        
        [
           'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sikap_nama_persatuan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-persatuan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPersatuan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::persatuan],],
                    'columnOptions'=>['colspan'=>6]],
                'jumlah_sikap' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'siso_tarikh_kelayakan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'sisi_tarikh_olimpik' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah_siso' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        [
           'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sito_nama_acara_di_olimpik' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-acara-olimpik/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefAcaraOlimpik::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::acaraOlimpik],],
                    'columnOptions'=>['colspan'=>6]],
                'sito_pingat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-pingat/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPingat::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::pingat],],
                    'columnOptions'=>['colspan'=>3]],
                'jumlah_sito' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'category_insentif' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriInsentif::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriInsentif],],
                    'columnOptions'=>['colspan'=>6]],
            ],
        ],
        
    ]
]);
    ?>
    
    <?php // Laporan Kesihatan Upload
    if($model->muat_naik_dokumen){
        echo "<label>" . $model->getAttributeLabel('muat_naik_dokumen') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_dokumen , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->pengurusan_insentif_id, 'field'=> 'muat_naik_dokumen'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'muat_naik_dokumen' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['kelulusan']) || $readonly): ?>
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
                'kelulusan' => ['type'=>Form::INPUT_RADIO_LIST, 'items'=>[true=>GeneralLabel::yes, false=>GeneralLabel::no],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],
            ]
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'nama_insentif')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kumpulan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'rekod_baru')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'nama_sukan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'kelayakan_pingat')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jumlah_insentif')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'sgar_nama_jurulatih')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jumlah_sgar')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'sikap_nama_persatuan')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jumlah_sikap')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'siso_tarikh_kelayakan')->textInput() ?>

    <?= $form->field($model, 'sisi_tarikh_olimpik')->textInput() ?>

    <?= $form->field($model, 'jumlah_siso')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'sito_nama_acara_di_olimpik')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'sito_pingat')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'jumlah_sito')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'category_insentif')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'kelulusan')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
