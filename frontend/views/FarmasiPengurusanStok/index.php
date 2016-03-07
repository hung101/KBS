<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FarmasiPengurusanStokSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Stok';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-pengurusan-stok-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Stok', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'farmasi_pengurusan_stok',
            'nama_ubat',
            'dos',
            'harga',
            'kuantiti',
            // 'jumlah_harga',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
