<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefSubElemenBantuanPenganjuranKejohananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Sub Elemen Bantuan Penganjuran Kejohanans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-elemen-bantuan-penganjuran-kejohanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Sub Elemen Bantuan Penganjuran Kejohanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ref_sub_elemen_bantuan_penganjuran_kejohanan_id',
            'desc',
            'aktif',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
