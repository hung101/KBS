<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBiasiswaPenyertaanKejohananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyertaan Kejohanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-penyertaan-kejohanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Penyertaan Kejohanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyertaan_kejohanan_id',
            //'permohonan_e_biasiswa_id',
            'sukan',
            'tarikh',
            'anjuran',
             'kejohanan_mewakili',
             'acara',
             'nama_kejohanan',
             'tempat',
             'pencapaian',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
