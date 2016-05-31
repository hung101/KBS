<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenilaianPenganjurKursusSoalanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian Penganjur Kursus Soalans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-penganjur-kursus-soalan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Penilaian Penganjur Kursus Soalan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'penilaian_penganjur_kursus_soalan_id',
            'penilaian_penganjur_kursus_id',
            'kategori_soalan',
            'soalan',
            'skala',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
