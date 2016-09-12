<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKejohananSirkitBayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penganjuran Kejohanan Bayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-bayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penganjuran Kejohanan Bayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kejohanan_bayaran_id',
            'bantuan_penganjuran_kejohanan_id',
            'jenis_bayaran',
            'lain_lain',
            'jumlah',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
