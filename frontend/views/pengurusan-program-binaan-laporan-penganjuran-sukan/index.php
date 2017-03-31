<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanProgramBinaanAtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Program Binaan Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-sukan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengurusan Program Binaan Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'laporan_penganjuran_sukan_id',
            'pengurusan_program_binaan_id',
            'sukan_id',
            'session_id',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
