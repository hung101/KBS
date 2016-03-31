<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPrestasiAkademikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestasi Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan e-Biasiswa', 'url' => ['permohonan-e-biasiswa/view', 'id' => $bsp_pemohon_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-akademik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Prestasi Akademik', Url::to(['create', 'bsp_pemohon_id' => $bsp_pemohon_id]), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_prestasi_akademik_id',
            //'bsp_pemohon_id',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            [
                'attribute' => 'png',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::png,
                ]
            ],
            [
                'attribute' => 'pngk',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pngk,
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);

                    },
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>
