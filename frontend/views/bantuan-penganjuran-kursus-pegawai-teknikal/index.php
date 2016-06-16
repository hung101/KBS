<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BantuanPenganjuranKursusPegawaiTeknikalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::bantuan_penganjuran_kursus_pegawai_teknikal, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_pegawai_teknikal_id',
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
            // 'nama_kursus_seminar_bengkel',
            // 'tarikh',
            // 'tempat',
            // 'tujuan',
            // 'yuran_penyertaan',
            // 'surat_rasmi_badan_sukan',
            // 'surat_jemputan_daripada_pengelola',
            // 'butiran_perbelanjaan',
            // 'salinan_passport',
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
