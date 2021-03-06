<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatPegawaiTeknikal */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_pegawai_teknikal_paparan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-pegawai-teknikal-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['maklumat-pegawai-teknikal']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['maklumat-pegawai-teknikal']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id], [
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
        'searchModelMaklumatPegawaiTeknikalKejohanan' => $searchModelMaklumatPegawaiTeknikalKejohanan,
        'dataProviderMaklumatPegawaiTeknikalKejohanan' => $dataProviderMaklumatPegawaiTeknikalKejohanan,
        'readonly' => $readonly,
    ]) ?>
    
    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id',
            'bantuan_penganjuran_kursus_pegawai_teknikal_id',
            'badan_sukan',
            'sukan',
            'nama',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_kad_pengenalan',
            'umur',
            'no_passport',
            'jantina',
            'no_telefon',
            'alamat_e_mail',
            'tahap_akademik',
            'tahap_kelayakan_sukan_peringkat_kebangsaan',
            'tahap_kelayakan_sukan_peringkat_antarabangsa',
            'nama_majikan',
            'no_telefon_majikan',
            'no_faks',
            'jawatan',
            'gred',
            'nama_kejohanan_kursus',
            'tarikh_mula',
            'tarikh_tamat',
            'tempat',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
