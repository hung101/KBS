<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspTuntutanElaunTesisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tuntutan Elaun Tesis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tuntutan-elaun-tesis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Tuntutan Elaun Tesis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_tuntutan_elaun_tesis_od',
            //'bsp_pemohon_id',
            'tarikh',
            'tajuk_tesis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
