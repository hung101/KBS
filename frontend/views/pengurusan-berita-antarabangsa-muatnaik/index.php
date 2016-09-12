<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanBeritaAntarabangsaMuatnaikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Berita Antarabangsa Muatnaiks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-berita-antarabangsa-muatnaik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengurusan Berita Antarabangsa Muatnaik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pengurusan_berita_antarabangsa_muatnaik_id',
            'pengurusan_berita_antarabangsa_id',
            'muatnaik',
            'tarikh',
            'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
