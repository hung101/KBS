<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PaobsPenganjuranSumberKewanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paobs Penganjuran Sumber Kewangans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paobs-penganjuran-sumber-kewangan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Paobs Penganjuran Sumber Kewangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'paobs_penganjuran_sumber_kewangan_id',
            //'penganjuran_id',
            'sumber',
            'jumlah',
            //'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
