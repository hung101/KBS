<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanAnjuranNegaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Anjuran Negaras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-anjuran-negara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengurusan Anjuran Negara', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pengurusan_anjuran_negara_id',
            'pengurusan_anjuran_id',
            'negara',
            'nama_delegasi_luar_negara',
            'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
