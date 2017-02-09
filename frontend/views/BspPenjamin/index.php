<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPenjaminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penjamin Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-penjamin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Penjamin Biasiswa Sukan Persekutuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_penjamin_id',
            //'bsp_pemohon_id',
            'nama',
            'no_kad_pengenalan',
            // 'alamat_tetap_1',
            // 'alamat_tetap_2',
            // 'alamat_tetap_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'alamat_surat_menyurat_1',
            // 'alamat_surat_menyurat_2',
            // 'alamat_surat_menyurat_3',
            // 'alamat_surat_menyurat_negeri',
            // 'alamat_surat_menyurat_bandar',
            // 'alamat_surat_menyurat_poskod',
            // 'no_telefon_rumah',
            // 'no_telefon_pejabat',
            // 'no_telefon_bimbit',
            // 'email:email',
            // 'alamat_pejabat_1',
            // 'alamat_pejabat_2',
            // 'alamat_pejabat_3',
            // 'alamat_pejabat_negeri',
            // 'alamat_pejabat_bandar',
            // 'alamat_pejabat_poskod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
