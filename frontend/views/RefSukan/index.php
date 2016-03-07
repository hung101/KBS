<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin - Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ref_sukan_id',
            'nama_sukan',
            'aktif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
