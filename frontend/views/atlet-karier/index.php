<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletKarierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Karier';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-karier-index">
    
    <?php
        $template = '{view}';
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])){
            $template .= ' {update}';
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])): ?>
        <p>
            <?= Html::button('Tambah Karier', ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabKarrierID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listKarrierID, 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listKarrierID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'karier_atlet_id',
            //'atlet_id',
            [
                'attribute' => 'syarikat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::syarikat,
                ]
            ],
            //'alamat',
            [
                'attribute' => 'laman_web',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::laman_web,
                ]
            ],
            // 'tel_no',
            // 'emel',
             [
                'attribute' => 'jawatan_kerja',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan_kerja,
                ]
            ],
            // 'pendapatan',
            [
                'attribute' => 'tahun_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_mula,
                ]
            ],
            [
                'attribute' => 'tahun_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tahun_tamat,
                ]
            ],
            // 'socso_no',
            // 'kwsp_no',
            // 'income_tax_no',
            // ,
            // ,
            // ,
            // ,

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabKarrierID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabKarrierID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabKarrierID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>

</div>
