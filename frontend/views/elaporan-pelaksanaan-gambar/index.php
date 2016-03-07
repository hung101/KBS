<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanPelaksanaanGambarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gambar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-gambar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Gambar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_pelaksanaan_gambar_id',
            //'elaporan_pelaksaan_id',
            'muat_naik_gambar',
            'tajuk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
