<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspElaunLatihanPraktikalMonthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Praktikal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-month-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Praktikal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_elaun_latihan_praktikal_month_id',
            //'bsp_elaun_latihan_praktikal_id',
            'bulan',
            'jumlah_hari',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
