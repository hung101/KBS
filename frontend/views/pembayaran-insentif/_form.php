<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\RefJenisInsentif;
use app\models\RefPingatInsentif;
use app\models\PengurusanInsentifTetapanShakamShakar;
use app\models\RefInsentifKejohanan;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefSukan;
use app\models\RefInsentifPeringkat;
use app\models\RefInsentifKelas;
use app\models\RefAcaraInsentif;
use app\models\RefKelulusanInsentif;
use app\models\ProfilBadanSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembayaran-insentif-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    <?php //echo $form->errorSummary($model); ?>
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
                'sukan' => [
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
                        'data'=>ArrayHelper::map(RefSukan::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan],],
                    'columnOptions'=>['colspan'=>3]],
                'nama_kejohanan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-penilaian/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PerancanganProgram::find()->where('jenis_aktiviti = :id1 OR jenis_aktiviti = :id2', [':id1' => RefJenisAktiviti::KEJOHANAN_DALAM_NEGARA, ':id2' => RefJenisAktiviti::KEJOHANAN_LUAR_NEGARA])->all(),'perancangan_program_id', 'nama_program'),
                        'options' => ['placeholder' => Placeholder::kejohanan, 'id'=>'kejohananId'],],
                    'columnOptions'=>['colspan'=>5]],
                
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>90]],
                'tarikh_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'jenis_insentif' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefJenisInsentif::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::jenisInsentif],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'kejohanan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-insentif-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefInsentifKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kejohanan],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'pingat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(PengurusanInsentifTetapanShakamShakar::find()->groupBy('pingat')->all(),'pingat', 'refPingatInsentif.desc'),
                        'options' => ['placeholder' => Placeholder::pingat],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'peringkat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DepDrop', 
                    'options'=>[
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=> [
                            'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                            [
                                'append' => [
                                    'content' => Html::a(Html::icon('edit'), ['/ref-insentif-peringkat/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                    'asButton' => true
                                ]
                            ] : null,
                        ],
                        'data'=>ArrayHelper::map(RefInsentifPeringkat::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'kejohanan')],
                            'placeholder' => Placeholder::peringkat,
                            'url'=>Url::to(['/ref-insentif-peringkat/sub-peringkats'])],
                        ],
                    'columnOptions'=>['colspan'=>3]],
            ]
        ],
        
        
    ]
]);
    ?>
    
    <div id="kelasID" style="display: none;">
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
                        'kelas' =>  [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-insentif-kelas/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefInsentifKelas::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::kelas],
                                'pluginOptions'=>['allowClear'=>true]],
                            'columnOptions'=>['colspan'=>3]],
                    ]
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
                        'acara' =>  [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-acara-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefAcaraInsentif::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::acara],
                                'pluginOptions'=>['allowClear'=>true]],
                            'columnOptions'=>['colspan'=>3]],
                    ]
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        /*'kumpulan_temasya_kejohanan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\DepDrop', 
                            'options'=>[
                                'type'=>DepDrop::TYPE_SELECT2,
                                'select2Options'=> [
                                    'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                    [
                                        'append' => [
                                            'content' => Html::a(Html::icon('edit'), ['/ref-acara/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                            'asButton' => true
                                        ]
                                    ] : null,
                                ],
                                'data'=>ArrayHelper::map(PengurusanInsentifTetapanShakamShakar::find()->all(),'pengurusan_insentif_tetapan_shakam_shakar_id', 'kumpulan_temasya_kejohanan'),
                                'options'=>['prompt'=>'','id'=>'kumpulanId',],
                                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                'pluginOptions' => [
                                    'depends'=>[Html::getInputId($model, 'jenis_insentif'), Html::getInputId($model, 'pingat'), Html::getInputId($model, 'rekod_baharu')],
                                    'initialize' => true,
                                    'placeholder' => Placeholder::kumpulan,
                                    'url'=>Url::to(['/pengurusan-insentif-tetapan-shakam-shakar/subkumpulans'])],
                                ],
                            'columnOptions'=>['colspan'=>4]],*/
                        'jumlah' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                        'nilai_rekod_baharu' =>  ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                    ]
                ],
            ]
        ]);
    ?>
    
    <!--<div class="panel panel-default" id="sikapID" style="display: none;">-->
    <div class="panel panel-default" id="sikapID" >
        <div class="panel-heading">
            <strong>SIKAP</strong>
        </div>
        <div class="panel-body">
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
                                'persatuan' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2',
                                    'options'=>[
                                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                        [
                                            'append' => [
                                                'content' => Html::a(Html::icon('edit'), ['/profil-badan-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                'asButton' => true
                                            ]
                                        ] : null,
                                        'data'=>ArrayHelper::map(ProfilBadanSukan::find()->all(),'profil_badan_sukan', 'nama_badan_sukan'),
                                        'options' => ['placeholder' => Placeholder::persatuan],],
                                    'columnOptions'=>['colspan'=>3]],
                                'nilai_sikap' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                            ],
                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <h3>Atlet</h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'pembayaranInsentifAtletGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPembayaranInsentifAtlet,
        //'filterModel' => $searchModelPembayaranInsentifAtlet,
        'id' => 'pembayaranInsentifAtletGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pembayaran_insentif_atlet_id',
            //'pembayaran_insentif_id',
            //'atlet',
            [
                'attribute' => 'atlet',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet,
                ],
                'value' => 'refAtlet.name_penuh'
            ],
            [
                'attribute' => 'acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::acara,
                ],
                'value' => 'refAcara.desc'
            ],
            'negara',
            //'nilai',
            //'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pembayaran-insentif-atlet/delete', 'id' => $model->pembayaran_insentif_atlet_id]).'", "'.GeneralMessage::confirmDelete.'", "pembayaranInsentifAtletGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pembayaran-insentif-atlet/update', 'id' => $model->pembayaran_insentif_atlet_id]).'", "'.GeneralLabel::updateTitle . ' Atlet");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pembayaran-insentif-atlet/view', 'id' => $model->pembayaran_insentif_atlet_id]).'", "'.GeneralLabel::viewTitle . ' Atlet");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    <?php 
    $totalAtlets = $dataProviderPembayaranInsentifAtlet->getTotalCount();
    if(($model->acara == RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG || $model->acara_id == RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG) && $totalAtlets > 0 && $model->jumlah){
        echo "<h4>Setiap Atlet Peroleh : RM" . number_format($model->jumlah / $totalAtlets , 2) . "</h4>"; 
    }
    ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        $pembayaran_insentif_id = "";
        
        if(isset($model->pembayaran_insentif_id)){
            $pembayaran_insentif_id = $model->pembayaran_insentif_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pembayaran-insentif-atlet/create', 'pembayaran_insentif_id' => $pembayaran_insentif_id]).'", "'.GeneralLabel::createTitle . ' Atlet");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <h3>Jurulatih</h3>
    
    
    <?php Pjax::begin(['id' => 'pembayaranInsentifJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPembayaranInsentifJurulatih,
        //'filterModel' => $searchModelPembayaranInsentifJurulatih,
        'id' => 'pembayaranInsentifJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pembayaran_pembayaran_insentif_jurulatih_id',
            //'pembayaran_insentif_id',
            //'nama_jurulatih',
            [
                'attribute' => 'nama_jurulatih',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_jurulatih,
                ],
                'value' => 'refJurulatih.nama'
            ],
            'nilai',
            //'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pembayaran-insentif-jurulatih/delete', 'id' => $model->pembayaran_pembayaran_insentif_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "pembayaranInsentifJurulatihGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pembayaran-insentif-jurulatih/update', 'id' => $model->pembayaran_pembayaran_insentif_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' Jurulatih");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pembayaran-insentif-jurulatih/view', 'id' => $model->pembayaran_pembayaran_insentif_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' Jurulatih");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pembayaran-insentif-jurulatih/create', 'pembayaran_insentif_id' => $pembayaran_insentif_id]).'", "'.GeneralLabel::createTitle . ' Jurulatih");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pembayaran-insentif']['kelulusan']) || $readonly): ?>
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
                'kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kelulusan-insentif/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKelulusanInsentif::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kelulusan],
                        'pluginOptions'=>['allowClear'=>true]],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_kelulusan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_pembayaran_insentif' => [
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
                'catatan' =>  ['type'=>Form::INPUT_TEXTAREA,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>255]],
            ],
        ],
    ]
]);
    ?>
    <?php endif; ?>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$URL = Url::to(['/pengurusan-insentif-tetapan-shakam-shakar/get-jumlah']);
$URL_PROGRAM = Url::to(['/perancangan-program/get-program']);
$URL_SET_ACARA = Url::to(['/pembayaran-insentif/set-acara']);
$URL_SET_SUKAN = Url::to(['/pembayaran-insentif/set-sukan']);

$ACARA_INDIVIDU = RefAcaraInsentif::INDIVIDU;
$ACARA_BERPASUKAN_KURANG_5_ORANG = RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG;
$ACARA_BERPASUKAN_LEBIH_5_ORANG = RefAcaraInsentif::BERPASUKAN_LEBIH_5_ORANG;

$KEJOHANAN_TEMASYA = RefInsentifKejohanan::TEMASYA;
$KEJOHANAN_INDIVIDU = RefInsentifKejohanan::INDIVIDU;

$script = <<< JS
        
$(document).ready(function(){
        changeSukan();
});
     
JS;
        
$this->registerJs($script);

$script = <<< JS
        
var nilai_individu = 0;
var nilai_berpasukan_kurang_5_orang = 0;
var nilai_berpasukan_lebih_5_orang = 0;
var peratus_sikap = 0;
var peratus_sgar = 0;
        
$('#pembayaraninsentif-jenis_insentif').change(function(){
    getJumlah();
});
        
$('#pembayaraninsentif-kejohanan').change(function(){
    getJumlah();
});
        
$('#pembayaraninsentif-pingat').change(function(){
    getJumlah();
});
        
$('#pembayaraninsentif-peringkat').change(function(){
    getJumlah();
});
        
$('#pembayaraninsentif-kelas').change(function(){
    getJumlah();
});

$('#pembayaraninsentif-acara').change(function(){
    changeAcara();
});
        
$('#pembayaraninsentif-kejohanan').change(function(){
    toggleKelas();
});
        
$('#pembayaraninsentif-sukan').change(function(){
    changeSukan();
});

$(document).ready(function(){
    toggleKelas();
    changeAcara();
});
        
function toggleKelas(){
    if($('#pembayaraninsentif-kejohanan').val() !== ''){
        if($('#pembayaraninsentif-kejohanan').val() === '$KEJOHANAN_INDIVIDU'){
            $('#kelasID').show("slow");
        } else {
            $('#kelasID').hide("slow");
        }
    }
}
        
function getJumlah(){
    if($('#pembayaraninsentif-jenis_insentif').val() !== '' &&
        $('#pembayaraninsentif-kejohanan').val() !== '' &&
        $('#pembayaraninsentif-pingat').val() !== '' &&
        $('#pembayaraninsentif-peringkat').val() !== ''){
        
        $.get('$URL',{
            jenis_insentif:$('#pembayaraninsentif-jenis_insentif').val(), 
            kejohanan:$('#pembayaraninsentif-kejohanan').val(),
            pingat:$('#pembayaraninsentif-pingat').val(),
            peringkat:$('#pembayaraninsentif-peringkat').val(),
            kelas:$('#pembayaraninsentif-kelas').val(),
            },
            function(data){
            clearForm();

            var data = $.parseJSON(data);

            if(data !== null){
                // SIKAP & SGAR value
                if(data.refPengurusanInsentifTetapan !== null){
                    peratus_sikap = data.refPengurusanInsentifTetapan.sikap;
                    peratus_sgar = data.refPengurusanInsentifTetapan.sgar;
                }
                nilai_individu = data.nilai_individu;
                nilai_berpasukan_kurang_5_orang = data.nilai_berpasukan_kurang_5;
                nilai_berpasukan_lebih_5_orang = data.nilai_berpasukan_lebih_5;
                if($('#pembayaraninsentif-acara').val() !== ''){
                    changeAcara();
                }
                $('#pembayaraninsentif-nilai_rekod_baharu').attr('value',data.rekod_baharu);
            }
        });
    }
}
        
function changeAcara(){
    $.get('$URL_SET_ACARA',{acara_id:$('#pembayaraninsentif-acara').val()},function(data){
    });
    
    if($('#pembayaraninsentif-acara').val() == '$ACARA_INDIVIDU'){
        $('#pembayaraninsentif-jumlah').val(nilai_individu);
        //$('#pembayaraninsentif-nilai_sikap').val(0.0);
        
        var nilai_sikap = nilai_berpasukan_kurang_5_orang * (peratus_sikap/100);
        $('#pembayaraninsentif-nilai_sikap').val(nilai_sikap.toFixed(2));
        //$('#sikapID').hide("slow");
    }else if($('#pembayaraninsentif-acara').val() == '$ACARA_BERPASUKAN_KURANG_5_ORANG'){
        $('#pembayaraninsentif-jumlah').val(nilai_berpasukan_kurang_5_orang);
        //$('#sikapID').show("slow");
        
        var nilai_sikap = nilai_berpasukan_kurang_5_orang * (peratus_sikap/100);
        $('#pembayaraninsentif-nilai_sikap').val(nilai_sikap.toFixed(2));
    }else if($('#pembayaraninsentif-acara').val() == '$ACARA_BERPASUKAN_LEBIH_5_ORANG'){
        $('#pembayaraninsentif-jumlah').val(nilai_berpasukan_lebih_5_orang);
        //$('#sikapID').show("slow");
        
        var nilai_sikap = nilai_berpasukan_lebih_5_orang * (peratus_sikap/100);
        $('#pembayaraninsentif-nilai_sikap').val(nilai_sikap.toFixed(2));
    }
}
        
        
function changeSukan(){
    $.get('$URL_SET_SUKAN',{sukan_id:$('#pembayaraninsentif-sukan').val()},function(data){
    });
}
     
function clearForm(){
    $('#pembayaraninsentif-jumlah').attr('value','');
    $('#pembayaraninsentif-nilai_rekod_baharu').attr('value','');
}
        
$("#pembayaraninsentif-jumlah").keyup(function(){
    var nilai_sikap = $("#pembayaraninsentif-jumlah").val() * (peratus_sikap/100);
        $('#pembayaraninsentif-nilai_sikap').val(nilai_sikap.toFixed(2));
});
        
$('#kejohananId').change(function(){
    
    $.get('$URL_PROGRAM',{id:$(this).val()},function(data){
        clearProgram();
        
        var data = $.parseJSON(data);
        
        if(data !== null){
            $('#pembayaraninsentif-tempat').attr('value',data.lokasi);
            $("#pembayaraninsentif-tarikh_mula-disp").val(formatDisplayDate(data.tarikh_mula));
            $("#pembayaraninsentif-tarikh_mula").val(formatSaveDate(data.tarikh_mula));
            $("#pembayaraninsentif-tarikh_tamat-disp").val(formatDisplayDate(data.tarikh_tamat));
            $("#pembayaraninsentif-tarikh_tamat").val(formatSaveDate(data.tarikh_tamat));
        }
    });
    
});
     
function clearProgram(){
    $('#pembayaraninsentif-tempat').attr('value','');
        
    $("#pembayaraninsentif-tarikh_mula-disp").val('');
    $("#pembayaraninsentif-tarikh_mula").val('');
        
    $("#pembayaraninsentif-tarikh_tamat-disp").val('');
    $("#pembayaraninsentif-tarikh_tamat").val('');
}
        
JS;
        
$this->registerJs($script);
?>
