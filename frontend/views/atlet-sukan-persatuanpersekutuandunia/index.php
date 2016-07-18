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

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletSukanPersatuanpersekutuanduniaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::persatuanpersekutuan_dunia;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-sukan-persatuanpersekutuandunia-index">
    
    <?php
        $session = new Session;
        $session->open();
        
        $template = '{view}';
        
        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ){
            $template .= ' {update}';
        }
        
        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ){
            $template .= ' {delete}';
        }
        
        $session->close();
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ): ?>
        <p>
            <?= Html::button(GeneralLabel::createTitle . ' Persatuan/Persekutuan Dunia', ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listSukanPersatuanpersekutuanduniaID, 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listSukanPersatuanpersekutuanduniaID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'persatuan_persekutuan_dunia_id',
            //'atlet_id',
            //'jenis',
            [
                'attribute' => 'jenis',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis,
                ],
                'value' => 'refJenisSukanPersatuanPersekutuandunia.desc'
            ],
            //'name_persatuan_persekutuan_dunia',
            [
                'attribute' => 'name_persatuan_persekutuan_dunia',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::name_persatuan_persekutuan_dunia,
                ],
                'value' => 'refProfilBadanSukan.nama_badan_sukan'
            ],
            // 'alamat_1',
            [
                'attribute' => 'no_telefon',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_telefon,
                ]
            ],
            [
                'attribute' => 'emel',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::emel,
                ]
            ],
            [
                'attribute' => 'laman_web',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::laman_web,
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>

</div>
