<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanPendapatanTahunLepasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendapatan Tahun Lepas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-pendapatan-tahun-lepas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pendapatan Tahun Lepas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pendapatan_tahun_lepas_id',
            //'permohonan_e_bantuan_id',
            'jenis_pendapatan',
            'butir_butir',
            'jumlah_pendapatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
