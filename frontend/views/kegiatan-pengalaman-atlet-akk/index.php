<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KegiatanPengalamanAtletAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kegiatan/Pengalaman Atlet AKK';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-pengalaman-atlet-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kegiatan/Pengalaman Atlet AKK', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kegiatan_pengalaman_atlet_akk_id',
            //'akademi_akk_id',
            'nama_sukan_pertandingan',
            'tahun',
            'sukan_acara',
            // 'pencapaian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
