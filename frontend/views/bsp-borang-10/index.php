<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspBorang10Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bsp Borang10s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-borang10-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bsp Borang10', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'bsp_borang_10_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bsp_borang_10_id,
                ]
            ],
            [
                'attribute' => 'bsp_borang_borang_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bsp_borang_borang_id,
                ]
            ],
            [
                'attribute' => 'bsp_10',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bsp_10,
                ]
            ],
            [
                'attribute' => 'session_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::session_id,
                ]
            ],

            // ,
            // ,
            // ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
