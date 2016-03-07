<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TempahanKursusPersatuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tempahan Kursus Persatuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kursus-persatuan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Tempahan Kursus Persatuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tempahan_kursus_persatuan_id',
            //'kursus_persatuan_id',
            'tarikh',
            'jenis_tempahan',
            'unit_tempahan',
            // 'kos_tempahan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
