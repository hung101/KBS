<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BiomekanikUjianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ujian Biomekanik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-ujian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Ujian Biomekanik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'biomekanik_ujian_id',
            //'perkhidmatan_analisa_perlawanan_biomekanik_id',
            'tarikh',
            'biomekanik_ujian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
