<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPembayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembayaran Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pembayaran Biasiswa Sukan Persekutuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_pembayaran_id',
            'bsp_pemohon_id',
            'tarikh',
            'bayaran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
