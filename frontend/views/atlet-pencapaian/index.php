<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use yii\web\Session;

use app\models\RefProgramSemasaSukanAtlet;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View delete()*/
/* @var $searchModel frontend\models\AtletPencapaianSearch Atlet::findOne($id)*/
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel frontend\models\AtletPencapaianRekodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pencapaian;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-index">
    
    <?php
        $session = new Session;
        $session->open();
        
        $template = '{view}';
        
        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))  ){
            $template .= ' {update}';
        }
        
        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))  ){
            $template .= ' {delete}';
        }
        
        $session->close();
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))  ): ?>
        <p>
            <?= Html::button(GeneralLabel::createTitle . ' Pencapaian', ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabPencapaianID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listPencapaianID, 'timeout' => 100000,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listPencapaianID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pencapaian_id',
            //'atlet_id',
            [
                'attribute' => 'tarikh_mula_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula_kejohanan,
                ]
            ],
            [
                'attribute' => 'tarikh_tamat_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat_kejohanan,
                ]
            ],
            [
                'attribute' => 'nama_kejohanan_temasya',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_kejohanan_temasya,
                ]
            ],
            [
                'attribute' => 'lokasi_kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::lokasi_kejohanan,
                ]
            ],
            [
                'attribute' => 'pencapaian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pencapaian,
                ],
                'value' => 'refKeputusan.desc'
            ],
            //'peringkat_kejohanan',
            
             //'nama_sukan',
            // 'nama_acara',
            // 'insentif_id',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabPencapaianID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabPencapaianID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabPencapaianID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
        
        <br>
        <br>
        
    <!--<p>
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['value'=>Url::to(['index']),'class' => 'btn btn-info', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabPencapaianID.'");']) ?>
    </p>-->
    
    <!-- Pencapaian Rekod - START -->
    <div class="panel panel-default copyright-wrap" id="pencapaian_rekods-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#pencapaian_rekods-body">Rekod Penilaian Pestasi</a>
            <button type="button" class="close" data-target="#pencapaian_rekods-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="pencapaian_rekods-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPP,
            //'filterModel' => $searchModelPP,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'kejohanan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kejohanan,
                ],
                'value' => 'refPerancanganProgram.nama_program'
            ],
            [
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::acara,
                ],
                'value' => 'refAcara.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                            ['penilaian-pestasi/view', 'id' =>$model->penilaian_pestasi_id], 
                            [
                                'title' => GeneralLabel::view,
                                'target' => '_blank'
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 
                            ['penilaian-pestasi/update', 'id' =>$model->penilaian_pestasi_id], 
                            [
                                'title' => GeneralLabel::update,
                                'target' => '_blank'
                            ]);
                        },
                    ],
                    'template' => '{view} {update}',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Pencapaian Rekod - END -->

</div>
