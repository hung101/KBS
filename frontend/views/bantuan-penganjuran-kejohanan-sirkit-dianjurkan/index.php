<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKejohananSirkitDianjurkanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bantuan Penganjuran Kejohanan Dianjurkans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-dianjurkan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bantuan Penganjuran Kejohanan Dianjurkan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bantuan_penganjuran_kejohanan_dianjurkan_id',
            'bantuan_penganjuran_kejohanan_id',
            'kejohanan',
            'tarikh_mula',
            'tarikh_tamat',
            // 'tempat',
            // 'peringkat_penganjuran',
            // 'jumlah',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
