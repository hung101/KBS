<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKejohananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kejohanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::bantuan_penganjuran_kejohanan, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kejohanan_id',
            'badan_sukan',
            'sukan',
            'no_pendaftaran',
            //'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_telefon',
            // 'no_faks',
            // 'laman_sesawang',
            // 'facebook',
            // 'twitter',
            // 'nama_bank',
            // 'no_akaun',
            // 'nama_kejohanan_pertandingan',
            // 'peringkat',
            // 'tarikh_mula',
            // 'tarikh_tamat',
            // 'tempat',
            // 'tujuan',
            // 'bil_pasukan',
            // 'bil_peserta',
            // 'bil_pengadil_hakim',
            // 'bil_pegawai_teknikal',
            // 'bilangan_pembantu',
            // 'anggaran_perbelanjaan',
            // 'kertas_kerja',
            // 'surat_rasmi_badan_sukan_ms_negeri',
            // 'permohonan_rasmi_dari_ahli_gabungan',
            // 'maklumat_lain_sokongan',
            // 'jumlah_bantuan_yang_dipohon',
            // 'status_permohonan',
            // 'catatan',
            // 'tarikh_permohonan',
            // 'jumlah_dilulus',
            // 'jkb',
            // 'tarikh_jkb',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
