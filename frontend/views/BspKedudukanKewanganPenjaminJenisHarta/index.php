<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspKedudukanKewanganPenjaminJenisHartaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kedudukan Kewangan Penjamin (Jenis Harta)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kedudukan Kewangan Penjamin (Jenis Harta)', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_kedudukan_kewangan_penjamin_jenis_harta_id',
            //'bsp_kedudukan_kewangan_penjamin_id',
            'jenis_harta',
            'jumlah_ekar_kaki_persegi',
            'nilai',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
