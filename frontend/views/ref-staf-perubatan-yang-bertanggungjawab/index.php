<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefStafPerubatanYangBertanggungjawabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Staf Perubatan Yang Bertanggungjawabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-staf-perubatan-yang-bertanggungjawab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Staf Perubatan Yang Bertanggungjawab', ['create'], ['class' => 'btn btn-success']) ?>
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
