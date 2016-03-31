<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspElaunPerjalananUdaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Elaun Perjalanan Udara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-perjalanan-udara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Elaun Perjalanan Udara', Url::to(['create', 'bsp_pemohon_id' => $bsp_pemohon_id]), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_elaun_perjalanan_udara_id',
            //'bsp_pemohon_id',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ]
            ],
            [
                'attribute' => 'destinasi_pergi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::destinasi_pergi,
                ]
            ],
            // 'tarikh_pergi',
            [
                'attribute' => 'destinasi_balik',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::destinasi_balik,
                ]
            ],
            // 'tarikh_balik',

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
