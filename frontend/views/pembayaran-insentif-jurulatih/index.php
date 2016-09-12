<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PembayaranInsentifJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembayaran Insentif Jurulatihs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-insentif-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pembayaran Insentif Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pembayaran_pembayaran_insentif_jurulatih_id',
            'pembayaran_insentif_id',
            'nama_jurulatih',
            'nilai',
            'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
