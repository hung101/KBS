<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefTujuanUjianFisiologiSubSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Tujuan Ujian Fisiologi Subs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tujuan-ujian-fisiologi-sub-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Tujuan Ujian Fisiologi Sub', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'desc',
            'aktif',
            'created_by',
            'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
