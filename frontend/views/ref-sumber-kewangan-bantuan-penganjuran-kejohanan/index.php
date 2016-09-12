<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefSumberKewanganBantuanPenganjuranKejohananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Sumber Kewangan Bantuan Penganjuran Kejohanans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sumber-kewangan-bantuan-penganjuran-kejohanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Sumber Kewangan Bantuan Penganjuran Kejohanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'desc',
            'aktif',
            'created_by',
            'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
