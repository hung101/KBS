<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KhidmatPerubatanDanSainsSukanJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Khidmat Perubatan Dan Sains Sukan Jurulatihs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Khidmat Perubatan Dan Sains Sukan Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'khidmat_perubatan_dan_sains_sukan_jurulatih_id',
            'khidmat_perubatan_dan_sains_sukan_id',
            'program',
            'sukan',
            'jurulatih',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
