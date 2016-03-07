<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangPenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Borang Penilaian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Borang Penilaian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'borang_penilaian_id',
            'nama_program',
            'tarikh_program',
            'tempat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
