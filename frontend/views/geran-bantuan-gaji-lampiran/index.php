<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanInsuranLampiranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Insuran Lampirans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insuran-lampiran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengurusan Insuran Lampiran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'geran_bantuan_gaji_lampiran_id',
            'geran_bantuan_gaji_id',
            'lampiran',
            'session_id',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
