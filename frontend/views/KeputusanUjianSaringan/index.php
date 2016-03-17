<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KeputusanUjianSaringanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Keputusan Ujian Saringan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keputusan-ujian-saringan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Keputusan Ujian Saringan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'keputusan_ujian_saringan_id',
            //'ujian_saringan_id',
            'jenis_ujian_saringan',
            //'percubaan_1',
            //'percubaan_2',
            'terbaik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
