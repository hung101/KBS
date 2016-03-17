<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EkemudahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'e-Kemudahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ekemudahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah e-Kemudahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ekemudahan_id',
            'kategori',
            'jenis',
            //'gambar',
            'lokasi',
            'dihubungi',
            // 'kadar_sewa',
            // 'url:url',
            // 'nama_perniagaan_perkhidmatan_organisasi',
            // 'kapasiti_penggunaan',
            // 'no_lesen_pendaftaran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
