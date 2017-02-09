<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPerlanjutanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pelanjutan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pelanjutan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_perlanjutan_id',
            //'bsp_pemohon_id',
            'tarikh',
            'tempoh_mohon_perlanjutan',
            'permohonan_pelanjutan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
