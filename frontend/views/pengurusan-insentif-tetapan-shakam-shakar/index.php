<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanInsentifTetapanShakamShakarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Insentif Tetapan Shakam Shakars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-tetapan-shakam-shakar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengurusan Insentif Tetapan Shakam Shakar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pengurusan_insentif_tetapan_shakam_shakar_id',
            'pengurusan_insentif_tetapan_id',
            'jenis_insentif',
            'pingat',
            'kumpulan_temasya_kejohanan',
            // 'rekod_baharu',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
