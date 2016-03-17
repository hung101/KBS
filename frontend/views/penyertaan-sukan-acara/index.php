<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenyertaanSukanAcaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyertaan Acara Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-acara-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Penyertaan Acara Sukan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyertaan_sukan_acara_id',
            //'penyertaan_sukan_id',
            'nama_acara',
            'tarikh_acara',
            'keputusan_acara',
            // 'jumlah_pingat',
            // 'rekod_baru',
            // 'catatan_rekod_baru',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
