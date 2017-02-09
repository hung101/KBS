<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPrestasiAkademikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestasi Akademik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-akademik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Prestasi Akademik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_prestasi_akademik_id',
            //'bsp_pemohon_id',
            'tarikh',
            'png',
            'pngk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
