<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LawatanRasmiLuarNegaraDelegasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lawatan Rasmi Luar Negara Delegasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lawatan-rasmi-luar-negara-delegasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lawatan Rasmi Luar Negara Delegasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'lawatan_rasmi_luar_negara_delegasi_id',
            'lawatan_rasmi_luar_negara_id',
            'delegasi',
            'session_id',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
