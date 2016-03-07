<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaporanKomposisiPenyertaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'e-Laporan Komposisi Penyertaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-komposisi-penyertaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah e-Laporan Komposisi Penyertaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaporan_komposisi_penyertaan_id',
            //'elaporan_pelaksaan_id',
            'kumpulan_penyertaan',
            'jenis_komposisi',
            'bilangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
