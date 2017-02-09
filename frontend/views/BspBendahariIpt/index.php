<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspBendahariIptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bendahari IPT';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-bendahari-ipt-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Bendahari IPT', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_bendahari_ipt_id',
            'nama_pelajar',
            'no_kad_pengenalan',
            'no_uni_matrix',
            //'yuran_pengajian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
