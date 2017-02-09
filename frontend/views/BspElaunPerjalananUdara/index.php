<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspElaunPerjalananUdaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Elaun Perjalanan Udara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-perjalanan-udara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Elaun Perjalanan Udara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_elaun_perjalanan_udara_id',
            //'bsp_pemohon_id',
            'tarikh',
            'destinasi_pergi',
            // 'tarikh_pergi',
            'destinasi_balik',
            // 'tarikh_balik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
