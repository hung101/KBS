<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CadanganElaunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadangan Elaun';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadangan-elaun-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Cadangan Elaun', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'cadangan_elaun_id',
            //'atlet',
            'elaun_semasa',
            'elaun_cadangan',
            'tarikh_mula',
             'tarikh_tamat',
            // 'ulasan',
             'jenis_kelulusan',
            // 'muat_naik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
