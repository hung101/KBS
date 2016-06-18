<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InventoriPeralatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventori Peralatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventori-peralatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Inventori Peralatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'inventori_peralatan_id',
            'inventori_id',
            'nama_peralatan',
            'no_inv_do',
            'kuantiti',
            // 'harga_per_unit',
            // 'jumlah',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
