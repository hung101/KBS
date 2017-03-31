<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MaklumatAkademikJadualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maklumat Akademik Jaduals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-jadual-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Maklumat Akademik Jadual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'maklumat_akademik_jadual_id',
            'maklumat_akademik_id',
            'session_id',
            'tarikh',
            'masa_dari',
            // 'masa_hingga',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
