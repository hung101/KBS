<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefKategoriSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-sukan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kategori Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ref_kategori_sukan_id',
            'nama_kategori_sukan',
            'aktif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
