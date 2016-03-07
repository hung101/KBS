<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenganjuranPemantuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penganjuran Pemantuans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-pemantuan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Penganjuran Pemantuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'penganjuran_pemantuan_id',
            'permohonan_pendahuluan_pelagai',
            'menghantar_surat_cuti_tanpa',
            'keperluan_bengkel_telah',
            'membuat_tempahan_penginapan',
            // 'membuat_tempahan_tempat_untuk',
            // 'mengesahan_kehadiran_panel',
            // 'mengesahan_pendaftaran_panel',
            // 'memberi_taklimat',
            // 'mengumpul_dan_membukukan',
            // 'membuat_pelarasan_kewangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
