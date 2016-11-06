<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenganjuranBengkel */

//$this->title = $model->permohonan_penganjuran_bengkel_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_penganjuran_bengkel;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_bengkel, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penganjuran-bengkel-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-penganjuran-bengkel']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_penganjuran_bengkel_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-penganjuran-bengkel']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_penganjuran_bengkel_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'permohonan_penganjuran_bengkel_id',
            'badan_sukan',
            'sukan',
            'no_pendaftaran',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_telefon',
            'no_faks',
            'laman_sesawang',
            'facebook',
            'twitter',
            'nama_bank',
            'no_akaun',
            'nama_kursus_seminar_bengkel',
            'tarikh',
            'tempat',
            'tujuan',
            'bil_penceramah',
            'bil_peserta',
            'bil_urusetia',
            'anggaran_perbelanjaan',
            'kertas_kerja',
            'surat_rasmi_badan_sukan_ms_negeri',
            'butiran_perbelanjaan',
            'maklumat_lain_sokongan',
            'jumlah_bantuan_yang_dipohon',
            'status_permohonan',
            'catatan',
            'tarikh_permohonan',
            'jumlah_dilulus',
            'jkb',
            'tarikh_jkb',
            'tarikh_tamat',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ])*/ ?>

</div>
