<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletKewanganPinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pinjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pinjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pinjaman_id',
            //'atlet_id',
            'nama_bank',
            'jenis_pinjaman',
            'no_akaun',
            'nilai_pinjaman',
            'tahun_pinjaman',
            // 'tahun_permulaan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
