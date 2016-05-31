<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorangProfilPesertaKpskPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Borang Profil Peserta Kpsk Pesertas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-profil-peserta-kpsk-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Borang Profil Peserta Kpsk Peserta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'borang_profil_peserta_kpsk_peserta_id',
            'borang_profil_peserta_kpsk_id',
            'nama',
            'no_kad_pengenalan',
            'tarikh_lahir',
            // 'umur',
            // 'jantina',
            // 'bangsa',
            // 'agama',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_telefon',
            // 'no_telefon_bimbit',
            // 'emel',
            // 'facebook',
            // 'akademik',
            // 'pekerjaan',
            // 'nama_majikan',
            // 'keputusan',
            // 'objektif',
            // 'struktur',
            // 'esei',
            // 'jumlah',
            // 'catatan',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
