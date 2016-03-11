<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefSukan;
use app\models\RefBandar;
use app\models\RefNegeri;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paobs-penganjur-form">

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
                'profil_syarikat' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>255]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_penganjur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_pendaftaran_syarikat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>30]],
                'tarikh_penubuhan_syarikat' => [
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
    ]
]);
    ?>
    
    <?php // Sijil Pendaftaran
    
    $label = $model->getAttributeLabel('sijil_pendaftaran');
    
    if($model->sijil_pendaftaran && !($model->isNewRecord)){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('sijil_pendaftaran') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->sijil_pendaftaran , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'sijil_pendaftaran' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                'alamat_penganjur_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_penganjur_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_penganjur_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_penganjur_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_penganjur_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_penganjur_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_penganjur_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon_penganjur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'no_faks_penganjur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>14]],
                'emel_penganjur' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
            ]
        ],
    ]
]);
    ?>
    
    <?php // Kertas Cadangan Pelaksanaan
    if($model->kertas_cadangan_pelaksanaan){
        echo "<div><label>" . $model->getAttributeLabel('kertas_cadangan_pelaksanaan') . "</label></div>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->kertas_cadangan_pelaksanaan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->penganjur_id, 'field'=> 'kertas_cadangan_pelaksanaan'], 
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
                        'kertas_cadangan_pelaksanaan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
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
                'nama_aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_sukan' => [
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
                    'columnOptions'=>['colspan'=>4]],
                'tarikh_aktiviti' => [
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
                'alamat_lokasi' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pemilik_lokasi' => ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>8],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bilangan_peserta' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>11]],
                'negara_peserta' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>11],'hint'=>'(Sekiranya Melibatkan Penyataan Antarabangsa)'],
                'kos_aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'sumber_kewangan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>10]],
            ]
        ],
    ]
]);
    ?>
    
    <?php // Surat Sokongan/Sanksi Dari Badan Antarabangsa
    if($model->surat_sokongan){
        echo "<div><label>" . $model->getAttributeLabel('surat_sokongan') . "</label></div>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->surat_sokongan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->penganjur_id, 'field'=> 'surat_sokongan'], 
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
                        'surat_sokongan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Laporan Penganjuran
    if($model->laporan_penganjuran){
        echo "<div><label>" . $model->getAttributeLabel('laporan_penganjuran') . "</label></div>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->laporan_penganjuran , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->penganjur_id, 'field'=> 'laporan_penganjuran'], 
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
                        'laporan_penganjuran' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>

    <!--<?= $form->field($model, 'penganjuran_id')->textInput() ?>

    <?= $form->field($model, 'profil_syarikat')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nama_penganjur')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_pendaftaran_syarikat')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tarikh_penubuhan_syarikat')->textInput() ?>

    <?= $form->field($model, 'sijil_pendaftaran')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'alamat_penganjur_1')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'no_telefon_penganjur')->textInput() ?>

    <?= $form->field($model, 'no_faks_penganjur')->textInput() ?>

    <?= $form->field($model, 'emel_penganjur')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'kertas_cadangan_pelaksanaan')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nama_aktiviti')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'jenis_sukan')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tarikh_aktiviti')->textInput() ?>

    <?= $form->field($model, 'alamat_lokasi')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'pemilik_lokasi')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'bilangan_peserta')->textInput() ?>

    <?= $form->field($model, 'negara_peserta')->textInput() ?>

    <?= $form->field($model, 'kos_aktiviti')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'sumber_kewangan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'surat_sokongan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'laporan_penganjuran')->textInput(['maxlength' => 100]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
