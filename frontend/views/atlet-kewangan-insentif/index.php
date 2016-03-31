<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletKewanganInsentifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Insentif';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-insentif-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])): ?>
        <p>
            <?= Html::button(GeneralLabel::createTitle . ' Insentif', ['value'=>Url::to(['create']),'class' => 'btn btn-success', 'onclick' => 'updateRenderAjax("'.Url::to(['create']).'", "'.GeneralVariable::tabKewanganInsentifID.'");']) ?>
        </p>
    <?php endif; ?>
    
    <?php Pjax::begin(['id' => GeneralVariable::listKewanganInsentifID, 'timeout' => false, 'enablePushState' => false,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => GeneralVariable::listKewanganInsentifID,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'insentif_id',
            //'atlet_id',
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ]
            ],
            //'jenis_insentif',
            [
                'attribute' => 'jenis_insentif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jenis_insentif,
                ],
                'value' => 'refJenisInsentif.desc'
            ],
            [
                'attribute' => 'jumlah',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah,
                ]
            ],
            //'pertandingan',
            [
                'attribute' => 'pencapaian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pencapaian,
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordAjax("'.$url.'", "'.GeneralVariable::tabKewanganInsentifID.'", "'.GeneralMessage::confirmDelete.'");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabKewanganInsentifID.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'updateRenderAjax("'.$url.'", "'.GeneralVariable::tabKewanganInsentifID.'");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>

</div>
