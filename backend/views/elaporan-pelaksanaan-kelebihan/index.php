<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksanaanKelebihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Elaporan Pelaksanaan Kelebihans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kelebihan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Elaporan Pelaksanaan Kelebihan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_kelebihan_id',
            //'elaporan_pelaksaan_id',
            'kekurangan',
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
