<?php

use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;

use app\models\RefStatusTawaran;
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::senarai_atlet_cacat;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-index">
    
    <?php
        $template = '{view}';
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet-cacat']['update'])){
            $template .= ' {update}';
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet-cacat']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet-cacat']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::atlet, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
        
        <?php
        $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->all();
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $sukan_list = RefSukan::find()->where(['=', 'aktif', 1])->andWhere(['=', 'cacat', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->all();
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
    ?>
    
    <?php
        $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'cacat', 1])->andWhere(['=', 'aktif', 1])->andWhere('podium = :podium', [':podium' => 0])->all();
        
        // add filter base on sukan access role Atlet -> Podium Kemas Kini - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $program_list = RefProgramSemasaSukanAtlet::find()->where(['=', 'cacat', 1])->andWhere(['=', 'aktif', 1])->all();
        }
        // add filter base on sukan access role Atlet -> Podium Kemas Kini - END
        
    ?>
    
    <?php Pjax::begin(['timeout' => false, 'enablePushState' => false,]); ?>
    <?=Html::beginForm(['atlet/bulk'],'post');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           /* [
                'class' => 'yii\grid\CheckboxColumn',
            ],*/
            ['class' => 'yii\grid\SerialColumn'],
            //'atlet_id',
            [
                'attribute' => 'ic_no',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ic_no,
                ]
            ],
            [
                'attribute' => 'name_penuh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::name_penuh,
                ]
            ],
            /*[
                'attribute' => 'tawaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                ]
            ],*/
            /*[
                'attribute' => 'tawaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                ],
                'value' => function ($model) {
                    return $model->tawaran == 1 ? GeneralLabel::yes : GeneralLabel::no;
                },
            ],*/
            [
                'attribute' => 'sukan',
                'label' => GeneralLabel::sukan,
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                //'value' => 'refAtletSukan.nama_sukan'
                'value'=>function ($model) {
                    if(isset($model->refAtletSukan[0]->nama_sukan) && $sukanModel = RefSukan::find()->where(['=', 'id', $model->refAtletSukan[0]->nama_sukan])->one()){
                        return $sukanModel->desc;
                    } else {
                        return "";
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'sukan', ArrayHelper::map($sukan_list, 'id', 'desc'),['class'=>'form-control','prompt' => '-- Pilih Sukan --']),
            ],
            [
                'attribute' => 'program',
                'label' => GeneralLabel::program,
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                //'value' => 'refAtletSukan.nama_sukan'
                'value'=>function ($model) {
                    if(isset($model->refAtletSukan[0]->program_semasa) && $programModel = RefProgramSemasaSukanAtlet::find()->where(['=', 'id', $model->refAtletSukan[0]->program_semasa])->one()){
                        return $programModel->desc;
                    } else {
                        return "";
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'program', ArrayHelper::map($program_list, 'id', 'desc'),['class'=>'form-control','prompt' => '-- Pilih Program --']),
            ],
            [
                'attribute' => 'tawaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                ],
                'value' => 'refStatusTawaran.desc',
                'filter' => Html::activeDropDownList($searchModel, 'tawaran', ArrayHelper::map(RefStatusTawaran::find()->asArray()->all(), 'id', 'desc'),['class'=>'form-control','prompt' => '-- Pilih Status --']),
            ],
            /*[
                'attribute' => 'tarikh_lahir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_lahir,
                ]
            ],*/
            /*[
                'attribute' => 'umur',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::umur,
                ]
            ],*/
            //'tempat_lahir_bandar',
            // 'tempat_lahir_negeri',
            // 'bangsa',
            // 'agama',
            // 'jantina',
            // 'taraf_perkahwinan',
            /*[
                'attribute' => 'tinggi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tinggi,
                ]
            ],*/
            /*[
                'attribute' => 'berat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::berat,
                ]
            ],*/
            // 'bahasa_ibu',
            // 'no_sijil_lahir',
            // 'ic_no',
            // 'ic_no_lama',
            // 'passport_no',
            // 'passport_tempat_dikeluarkan',
            // 'lesen_memandu_no',
            // 'lesen_tamat_tempoh',
            // 'jenis_lesen',
            // 'tel_bimbit_no_1',
            // 'tel_bimbit_no_2',
            // 'tel_no',
            // 'emel',
            // 'facebook',
            // 'twitter',
            // 'alamat_rumah',
            // 'alamat_surat_menyurat',
            // 'msn',
            // 'dari_bahagian',
            // 'sumber',
            // 'negeri_diwakili',
            // 'nama_kecemasan',
            // 'pertalian_kecemasan',
            // 'tel_no_kecemasan',
            // 'tel_bimbit_no_kecemasan',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return (isset($model->refAtletSukan[0]->program_semasa) && $model->refAtletSukan[0]->program_semasa == RefProgramSemasaSukanAtlet::PODIUM && !isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ? '' :
                                Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => GeneralMessage::confirmDelete,
                                        'data-method'=>'post',
                                        ]);

                    },
                    'update' => function ($url, $model) {
                         $options = [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            ];
                        return (isset($model->refAtletSukan[0]->program_semasa) && $model->refAtletSukan[0]->program_semasa == RefProgramSemasaSukanAtlet::PODIUM && !isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ? '' :Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'view' => function ($url, $model) {
                        $options = [
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            ];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

        <!--<div class="row">
            <div class="col-lg-2">
                <?php 
        //echo Html::dropDownList('action','',ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),['class'=>'dropdown',]);
    
    echo Select2::widget([
    'name' => 'action',
    'data' => ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),
    'options' => [
        'placeholder' => Placeholder::tindakan,
    ],
]);
    ?>
            </div>
            <div class="col-lg-2">
                <?=Html::submitButton(GeneralLabel::send, ['class' => 'btn btn-info',]);?>
            </div>
        </div>-->
    
    
    <?= Html::endForm();?> 

    <?php Pjax::end(); ?>

</div>
