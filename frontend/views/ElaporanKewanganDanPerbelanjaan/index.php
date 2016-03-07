<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanKewanganDanPerbelanjaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'e-Laporan Kewangan Dan Perbelanjaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-kewangan-dan-perbelanjaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah e-Laporan Kewangan Dan Perbelanjaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_kewangan_dan_perbelanjaan_id',
            //'elaporan_pelaksaan_id',
            'program_aktiviti_butir',
            'jenis_kewangan',
            'jumlah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
