<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BajetPenyelidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bajet Penyelidikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bajet-penyelidikan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Bajet Penyelidikan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bajet_penyelidikan_id',
            //'permohonana_penyelidikan_id',
            'jenis_bajet',
            'tahun',
            'jumlah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
