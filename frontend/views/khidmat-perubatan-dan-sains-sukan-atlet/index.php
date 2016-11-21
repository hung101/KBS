<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KhidmatPerubatanDanSainsSukanAtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Khidmat Perubatan Dan Sains Sukan Atlets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-atlet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Khidmat Perubatan Dan Sains Sukan Atlet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'khidmat_perubatan_dan_sains_sukan_atlet_id',
            'khidmat_perubatan_dan_sains_sukan_id',
            'program',
            'sukan',
            'atlet',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
