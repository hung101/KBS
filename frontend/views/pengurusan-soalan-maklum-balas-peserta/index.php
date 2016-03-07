<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanSoalanMaklumBalasPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian Prestasi Kejohanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-maklum-balas-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Penilaian Prestasi Kejohanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_soalan_maklum_balas_peserta_id',
            //'pengurusan_maklum_balas_peserta_id',
            'soalan',
            'rating',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
