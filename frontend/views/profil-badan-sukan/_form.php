<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\DepDrop;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

// table reference
use app\models\RefPeringkatBadanSukan;
use app\models\RefSukan;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefStatusLaporanMesyuaratAgung;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilBadanSukan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-badan-sukan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php // gambar upload
    if($model->gambar){
        echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$model->gambar.'" width="200px">&nbsp;&nbsp;&nbsp;';
        if(!$readonly){
            echo Html::a(GeneralLabel::removeImage, ['deleteupload', 'id'=>$model->profil_badan_sukan, 'field'=> 'gambar'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br><br>';
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
                        'gambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'options'=>['accept' => 'image/*'], 'pluginOptions' => ['previewFileType' => 'image']],
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
                'nama_badan_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_badan_sukan_sebelum_ini' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ],
        ],
    ]
]);
    ?>
    
    <?php // Sijil Pendaftaran Upload
    if($model->no_pendaftaran_sijil_pendaftaran){
        echo "<label>" . $model->getAttributeLabel('no_pendaftaran_sijil_pendaftaran') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->no_pendaftaran_sijil_pendaftaran , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->profil_badan_sukan, 'field'=> 'no_pendaftaran_sijil_pendaftaran'], 
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
                        'no_pendaftaran_sijil_pendaftaran' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php
        $disabled = false;
        
        if($model->isNewRecord){
            $disabled = false;
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
                'no_pendaftaran' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30, 'disabled'=>$disabled],'columnOptions'=>['colspan'=>4]],
                'tarikh_lulus_pendaftaran' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                        , 'disabled'=>$disabled
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'peringkat_badan_sukan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-peringkat-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefPeringkatBadanSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::peringkatBadanSukan, 'disabled'=>$disabled],
                    ],
                    'columnOptions'=>['colspan'=>4]],
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
                        'options' => ['placeholder' => Placeholder::sukan, 'disabled'=>$disabled],
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        [
            'attributes' => [
                'alamat_tetap_badan_sukan_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_tetap_badan_sukan_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_tetap_badan_sukan_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_tetap_badan_sukan_negeri' => [
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
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_tetap_badan_sukan_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_tetap_badan_sukan_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_tetap_badan_sukan_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],
        /*[
            'attributes' => [
                'alamat_surat_menyurat_badan_sukan_1' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_badan_sukan_2' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'attributes' => [
                'alamat_surat_menyurat_badan_sukan_3' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>30]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'alamat_surat_menyurat_badan_sukan_negeri' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/controllers/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::negeri],],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_badan_sukan_bandar' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-bandar/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefBandar::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'pluginOptions' => [
                            'depends'=>[Html::getInputId($model, 'alamat_surat_menyurat_badan_sukan_negeri')],
                            'placeholder' => Placeholder::bandar,
                            'url'=>Url::to(['/ref-bandar/subbandars'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
                'alamat_surat_menyurat_badan_sukan_poskod' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>5]],
            ]
        ],*/
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_telefon_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14]],
                'no_telefon_pejabat_2' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14]],
                'no_telefon_pejabat_3' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'no_faks_pejabat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14]],
                'no_tel_bimbit' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>14]]
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'emel_badan_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pengiktirafan_yang_pernah_diterima_badan_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>100]],
            ],
        ],
        
    ]
]);
    ?>
    
    <!--<br>
    <pre style="text-align: center"><strong>PERLEMBAGAAN BADAN SUKAN</strong></pre>
    
    <?php
        /*echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'tarikh_kelulusan_Terkini' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\DatePicker',
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => GeneralVariable::displayDateFormat,
                                    'convertFormat' => true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>3]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'bilangan_pindaan_perlembagaan_dilakukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>90]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'tarikh_pindaan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\DatePicker',
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => GeneralVariable::displayDateFormat,
                                    'convertFormat' => true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>3]],
                        'tarikh_kelulusan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\DatePicker',
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => GeneralVariable::displayDateFormat,
                                    'convertFormat' => true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>3]],
                    ]
                ],
            ]
        ]);*/
    ?>
    
    <?php // Muat Naik
    if($model->muat_naik_perlembagaan_terkini){
        echo "<label>" . $model->getAttributeLabel('muat_naik_perlembagaan_terkini') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik_perlembagaan_terkini , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->profil_badan_sukan, 'field'=> 'muat_naik_perlembagaan_terkini'], 
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
                        'muat_naik_perlembagaan_terkini' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>-->

    <?php
        if(!Yii::$app->user->identity->profil_badan_sukan || $readonly){
            echo FormGrid::widget([
                'model' => $model,
                'form' => $form,
                'autoGenerateColumns' => true,
                'rows' => [
                        [
                            'columns'=>12,
                            'autoGenerateColumns'=>false, // override columns setting
                            'attributes' => [
                                'status' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2',
                                    'options'=>[
                                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                        [
                                            'append' => [
                                                'content' => Html::a(Html::icon('edit'), ['/ref-status-laporan-mesyuarat-agung/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                'asButton' => true
                                            ]
                                        ] : null,
                                        'data'=>ArrayHelper::map(RefStatusLaporanMesyuaratAgung::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                        'options' => ['placeholder' => Placeholder::status],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],],
                                    'columnOptions'=>['colspan'=>5]],
                            ],
                        ],
                    ]
                ]);
        }
    ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php
        if(!$model->isNewRecord){
            echo '&nbsp;&nbsp;' . Html::a('Ahli Jawatankuasa Induk', Url::to(['/ltbs-ahli-jawatankuasa-induk-kecil/index', 'profil_badan_sukan_id' => $model->profil_badan_sukan]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            echo '&nbsp;&nbsp;' . Html::a('Ahli Jawatankuasa Kecil / Biro', Url::to(['/ltbs-ahli-jawatankuasa-kecil/index', 'profil_badan_sukan_id' => $model->profil_badan_sukan]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            echo '&nbsp;&nbsp;' . Html::a('Senarai Ahli Gabungan', Url::to(['/ltbs-ahli-gabungan/index', 'profil_badan_sukan_id' => $model->profil_badan_sukan]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            echo '&nbsp;&nbsp;' . Html::a('Perlembagaan Badan Sukan', Url::to(['/perlembagaan-badan-sukan/index', 'profil_badan_sukan_id' => $model->profil_badan_sukan]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
            echo '&nbsp;&nbsp;' . Html::a('Maklumat Mesyuarat Agung Tahunan', Url::to(['/ltbs-minit-mesyuarat-jawatankuasa/index', 'profil_badan_sukan_id' => $model->profil_badan_sukan]), ['class'=>'btn btn-warning', 'target'=>'_blank']);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
