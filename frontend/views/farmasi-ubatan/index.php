<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FarmasiUbatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ubatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-ubatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Ubatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'farmasi_ubatan_id',
            //'farmasi_permohonan_ubatan_id',
            'nama_ubat',
            'size',
            'kuantiti',
            // 'harga',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
