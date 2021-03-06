<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;

// table reference
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefNegeri;
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefKategoriKejohananTemasya;
use common\models\User;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPestasi */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
        $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->all();
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['upaya']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['kurang-upaya'])){
                $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
            } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['upaya']))  {
                // Upaya Sukan List
                $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
            } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['kurang-upaya']))  {
                // Upaya Sukan List
                $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
            }
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
        
        $program_list = RefSukan::find()->where(['=', 'aktif', 1])->all();
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['upaya']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['kurang-upaya'])){
            $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->all();
        } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['upaya']))  {
            // Upaya Sukan List
            $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 0])->all();
        } elseif(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['kurang-upaya']))  {
            // Upaya Sukan List
            $sukan_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->all();
        }
        
    ?>

<div class="penilaian-pestasi-form">
    <?php
    $usersActive = 0;
    if (($modelUsers = User::find()->where('current_access_module = :current_access_module', [':current_access_module' => Yii::$app->request->url])
            ->andWhere('id <> :id', [':id' => Yii::$app->user->identity->id])->all()) !== null) {
        $usersActive =  count($modelUsers);
    }
    ?>
    <?php if($usersActive>0): ?>
    <div align="right"><h3><span class="label label-danger"><?=$usersActive?> &nbsp;<span class="glyphicon glyphicon-eye-open"></span></span></h3></div>
    <?php endif; ?>
    <br>
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>
    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        /*[
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
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
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
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kategori_kecergasan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kategori-kecergasan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKategoriKecergasan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategoriKecergasan],],
                    'columnOptions'=>['colspan'=>4]],
                'tahap_sihat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6]],
            ]
        ],*/
        /*[
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
                        'data'=>ArrayHelper::map($sukan_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::sukan, 'id'=>'sukanId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-semasa-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map($program_list,'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'negeri' => [
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
                        'options' => ['placeholder' => Placeholder::negeri],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],*/
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'disiplin' => [
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
                        'options' => ['placeholder' => Placeholder::disiplin],],
                    'columnOptions'=>['colspan'=>4]],
                'acara' => [
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
                            'pluginOptions'=>['allowClear'=>true]
                        ],
                        'data'=>ArrayHelper::map(RefAcara::find()->where(['=', 'aktif', 1])->all(),'id', 'disciplineAcara'),
                        'options'=>['prompt'=>'',],
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends'=>[Html::getInputId($model, 'sukan')],
                            'placeholder' => Placeholder::acara,
                            'url'=>Url::to(['/ref-acara/subacaras'])],
                        ],
                    'columnOptions'=>['colspan'=>4]],
            ],
        ],*/
        /*[
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kejohanan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        //'data'=>ArrayHelper::map(PerancanganProgram::find()->where('jenis_aktiviti = :id1 OR jenis_aktiviti = :id2', [':id1' => RefJenisAktiviti::KEJOHANAN_DALAM_NEGARA,':id2' => RefJenisAktiviti::KEJOHANAN_LUAR_NEGARA])->all(),'perancangan_program_id', 'nama_program'),
                        'data'=>ArrayHelper::map(\app\models\PerancanganProgramPlan::find()->joinWith('refKategoriPelan')
                            ->where(['LIKE', 'desc', 'kejohanan'])->all(),'perancangan_program_id', 'nama_program'),
                        'options' => ['placeholder' => Placeholder::kejohanan],
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
                'kategori' => [
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
                        'data'=>ArrayHelper::map(RefKategoriKejohananTemasya::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kategori],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],
                'nama_kejohanan_temasya' => [
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\DepDrop', 
                        'options'=>[
                            'type'=>DepDrop::TYPE_SELECT2,
                            'select2Options'=> [
                                /*'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                        'append' => [
                                                'content' => Html::a(Html::icon('edit'), ['/ref-jenis-pelan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                                'asButton' => true
                                        ]
                                ] : null,*/
                                'pluginOptions'=>['allowClear'=>true]
                            ],
                            'data'=>ArrayHelper::map(\app\models\PerancanganProgramPlan::find()->joinWith('refKategoriPelan')
                                                        ->where(['IS NOT', 'perancangan_program_plan_master_id', NULL])
                            ->andWhere(['LIKE', 'id', '1'])->orWhere(['LIKE', 'id', '8'])->all(),'perancangan_program_id', 'nama_program'),
                            'options'=>['prompt'=>'','id' => 'kejohananTemasya',],
                            'pluginOptions' => [
                                    'initialize' => true,
                                    'depends'=>[Html::getInputId($model, 'kategori')],
                                    'placeholder' => Placeholder::kejohanan_temasya,
                                    'url'=>Url::to(['/perancangan-program-plan/subitems'])],
                            ],
                        'columnOptions'=>['colspan'=>4]],
                /*'nama_kejohanan_temasya' => [
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
							->where(['IS NOT', 'perancangan_program_plan_master_id', NULL])
                            ->andWhere(['LIKE', 'desc', 'kejohanan'])->all(),'perancangan_program_id', 'nama_program'),
                    'options' => ['placeholder' => Placeholder::kejohanan_temasya, 'id' => 'kejohananTemasya'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],],
                'columnOptions'=>['colspan'=>4]],*/
            ],
        ],
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
                        'options' => ['placeholder' => Placeholder::sukan, 'id'=>'sukanId'],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                'program' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-program-semasa-sukan-atlet/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefProgramSemasaSukanAtlet::find()->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::program, 'id'=>'programId'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>4]],
                
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               
                 
                'tempat' =>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
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
                /*'negeri' => [
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
                        'options' => ['placeholder' => Placeholder::negeri],
'pluginOptions' => [
                            'allowClear' => true
                        ],],
                    'columnOptions'=>['colspan'=>3]],*/
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_nilai_mula' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'options' => ['id'=>'tarikhNilaiMulaId',],
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_nilai_tamat' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'options' => ['id'=>'tarikhNilaiTamatId','disabled'=>true],
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
            ],
        ],
    ]
]);
    ?>
    
    <?php // Laporan Kesihatan Upload
    /*if($model->laporan_kesihatan){
        echo "<label>" . $model->getAttributeLabel('laporan_kesihatan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->laporan_kesihatan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->penilaian_pestasi_id, 'field'=> 'laporan_kesihatan'], 
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
                        'laporan_kesihatan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }*/
    ?>
    
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
                'kejohanan' => [
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\Select2',
                    'options'=>[
                        'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                        [
                            'append' => [
                                'content' => Html::a(Html::icon('edit'), ['/ref-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                'asButton' => true
                            ]
                        ] : null,
                        'data'=>ArrayHelper::map(RefKejohanan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                        'options' => ['placeholder' => Placeholder::kejohanan],],
                    'columnOptions'=>['colspan'=>4]],
                'pencapaian_sukan_dalam_tahun_yang_dinilai' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>8]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'kecederaan_jika_ada' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>12],'options'=>['maxlength'=>100]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'elaun_yang_diterima' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'skim_hadiah_kemenangan_sukan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>100]],
            ]
        ],
    ]
]);*/
    ?>
    
    <h3><?php echo GeneralLabel::penilaian_prestasi_atlet; ?></h3>
    
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
    
    <?php Pjax::begin(['id' => 'penilaianPrestasiAtletSasaranGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPenilaianPrestasiAtletSasaran,
        //'filterModel' => $searchModelPenilaianPrestasiAtletSasaran,
        'id' => 'penilaianPrestasiAtletSasaranGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penilaian_prestasi_atlet_sasaran_id',
            //'penilaian_pestasi_id',
            [
                'attribute' => 'atlet',
                'value' => 'refAtlet.name_penuh',
            ],
            'sasaran',
            //'keputusan',
            [
                'attribute' => 'keputusan',
                'value' => 'refKeputusan.desc',
            ],
            // 'session_id',
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
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['penilaian-prestasi-atlet-sasaran/delete', 'id' => $model->penilaian_prestasi_atlet_sasaran_id]).'", "'.GeneralMessage::confirmDelete.'", "penilaianPrestasiAtletSasaranGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-prestasi-atlet-sasaran/update', 'id' => $model->penilaian_prestasi_atlet_sasaran_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::penilaian_prestasi_atlet.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-prestasi-atlet-sasaran/view', 'id' => $model->penilaian_prestasi_atlet_sasaran_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::penilaian_prestasi_atlet.'");',
                        ]);
                    },
                    'atlet' => function ($url, $model) {
                        return  Html::a('<span class="glyphicon glyphicon-user"></span>', 
                        ['atlet/view', 'id' =>$model->atlet], 
                        [
                            'title' => GeneralLabel::atlet_profil,
                            'target' => '_blank',
                            'class' => 'custom_button',
                            'value'=>Url::to(['/atlet/view', 'id' => $model->atlet])
                        ]);
                    },
/*                     'jadual' => function ($url, $model) {
                        return  Html::a('<span class="glyphicon glyphicon-calendar"></span>', 
                        ['perancangan-program-plan/index'], 
                        [
                            'title' => GeneralLabel::jadual_latihan_periodisasi_jurulatih,
                            'target' => '_blank',
                            'class' => 'custom_button',
                            // 'value'=>Url::to(['/penilaian-prestasi-atlet-latihan/index', 'penilaian_prestasi_atlet_sasaran_id' => $model->penilaian_prestasi_atlet_sasaran_id, 'atlet_id' =>$model->atlet, 'penilaian_pestasi_id' =>$model->penilaian_pestasi_id])
                            'value'=>Url::to(['/perancangan-program-plan/index'])
                        ]);
                    }, */
                ],
                'template' => $template . ' {atlet} {jadual}',
            ],
        ],
    ]); ?>
    
    <?php if(!$readonly): ?>
    <p>
        <?php 
        $penilaian_pestasi_id = "";
        
        if(isset($model->penilaian_pestasi_id)){
            $penilaian_pestasi_id = $model->penilaian_pestasi_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['penilaian-prestasi-atlet-sasaran/create', 'penilaian_pestasi_id' => $penilaian_pestasi_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::penilaian_prestasi_atlet.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <?php Pjax::end(); ?>
    
    <br>

    <!--<?= $form->field($model, 'atlet_id')->textInput() ?>

    <?= $form->field($model, 'tahap_sihat')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'pencapaian_sukan_dalam_tahun_yang_dinilai')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'kecederaan_jika_ada')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'laporan_kesihatan')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'elaun_yang_diterima')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'skim_hadiah_kemenangan_sukan')->textInput(['maxlength' => 100]) ?>-->

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
$DateDisplayFormat = GeneralVariable::displayDateFormat;
$URLSetSukan = Url::to(['/penilaian-pestasi/set-sukan']);
$URLSetKejohanan = Url::to(['/penilaian-pestasi/set-kejohanan']);
$URLGetKejohanan = Url::to(['/perancangan-program-plan/get-program-plan']);

$script = <<< JS
        
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);
});

$('#kejohananTemasya').on('select2:select', function (evt) {
    $.get('$URLGetKejohanan', {id:$(this).val()}, function(data){
        if(data !== null){
            $('#penilaianpestasi-tempat').val(data.tempat);
            $('#sukanId').val(data.sukan).trigger("change");
            $('#programId').val(data.program).trigger("change");
            $("#penilaianpestasi-tarikh_mula-disp").val(formatDisplayDate(data.tarikh_mula));
            $("#penilaianpestasi-tarikh_tamat-disp").val(formatDisplayDate(data.tarikh_tamat));
            $("#penilaianpestasi-tarikh_mula").val(data.tarikh_mula);
            $("#penilaianpestasi-tarikh_tamat").val(data.tarikh_tamat);
        }
    });
    setKejohanan();
});
        
        
$("#tarikhNilaiMulaId").change(function(){
    var startDate = $("#tarikhNilaiMulaId").val();
    startDate = new Date(startDate);
    var endDate = "", noOfDaysToAdd = 37, count = 0;
    while(count < noOfDaysToAdd){
        endDate = new Date(startDate.setDate(startDate.getDate() + 1));
        if(endDate.getDay() != 0 && endDate.getDay() != 6){
           //Date.getDay() gives weekday starting from 0(Sunday) to 6(Saturday)
           count++;
        }
    }
    //alert(formatSaveDate(endDate));
        
    $("#tarikhNilaiTamatId-disp").val(formatDisplayDate(endDate));
    $("#tarikhNilaiTamatId").val(formatSaveDate(endDate));
});
    
$('#sukanId').change(function(){
    setSukan();
});
    
function setSukan(){
    $.get('$URLSetSukan',{sukan_id:$('#sukanId').val()},function(data){
    });
}

function setKejohanan(){
    $.get('$URLSetKejohanan',{nama_kejohanan_temasya:$('#kejohananTemasya').val()},function(data){
    });
}
     

JS;
        
$this->registerJs($script);
?>
