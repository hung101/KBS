<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefSubKategoriPenilaianJurulatihKetuaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Sub Kategori Laporan Penilaian Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-kategori-penilaian-jurulatih-ketua-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Sub Kategori Laporan Penilaian Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ref_kategori_laporan_penilaian_jurulatih_id',
            'desc',
            'aktif',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
