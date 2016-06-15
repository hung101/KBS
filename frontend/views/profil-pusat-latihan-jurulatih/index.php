<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProfilPusatLatihanJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil Pusat Latihan Jurulatihs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-pusat-latihan-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profil Pusat Latihan Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'profil_pusat_latihan_jurulatih_id',
            'profil_pusat_latihan_id',
            'jurulaith',
            'session_id',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
