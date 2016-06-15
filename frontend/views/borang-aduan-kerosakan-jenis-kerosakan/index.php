<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangAduanKerosakanJenisKerosakanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Borang Aduan Kerosakan Jenis Kerosakans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kerosakan-jenis-kerosakan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Borang Aduan Kerosakan Jenis Kerosakan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'borang_aduan_kerosakan_jenis_kerosakan_id',
            'borang_aduan_kerosakan_id',
            'lokasi',
            'jenis_kerosakan',
            'nama_pemeriksa',
            // 'tarikh_pemeriksaan',
            // 'kategori_kerosakan',
            // 'tindakan',
            // 'catatan',
            // 'selesai',
            // 'ulasan_pemeriksa',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
