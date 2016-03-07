<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefAcaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin - Acara';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-acara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Acara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'ref_sukan_id',
            'desc',
            'aktif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
