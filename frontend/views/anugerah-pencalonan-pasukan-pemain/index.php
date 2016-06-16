<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AnugerahPencalonanPasukanPemainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anugerah Pencalonan Pasukan Pemains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-pasukan-pemain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anugerah Pencalonan Pasukan Pemain', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anugerah_pencalonan_pasukan_pemain_id',
            'anugerah_pencalonan_pasukan_id',
            'nama_pemain',
            'session_id',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
