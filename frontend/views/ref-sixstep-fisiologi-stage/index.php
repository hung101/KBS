<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefSixstepFisiologiStageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Sixstep Fisiologi Stages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sixstep-fisiologi-stage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Sixstep Fisiologi Stage', ['create'], ['class' => 'btn btn-success']) ?>
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
