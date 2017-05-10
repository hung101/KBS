<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPeserta */

//$this->title = $model->penganjuran_kursus_peserta_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::penganjuran_kursus_senarai_peserta;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_kursus_senarai_peserta, 'url' => Url::to(['index', 'penganjuran_kursus_id' => $model->penganjuran_kursus_id, 'penganjuran_kursus_akk_id' => $model->penganjuran_kursus_akk_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['update'])): ?>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penganjuran_kursus_peserta_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-peserta']['delete'])): ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penganjuran_kursus_peserta_id], [
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
        'searchModelPenganjuranKursusPesertaSukan' => $searchModelPenganjuranKursusPesertaSukan,
        'dataProviderPenganjuranKursusPesertaSukan' => $dataProviderPenganjuranKursusPesertaSukan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penganjuran_kursus_peserta_id',
            'kategori_kursus',
            'nama_kursus',
            'kod_kursus',
            'tarikh',
            'tempat',
            'yuran',
            'nama_penuh',
            'muatnaik_gambar',
            'jantina',
            'taraf_perkahwinan',
            'no_passport',
            'no_kad_pengenalan',
            'no_kp_polis_tentera',
            'kaum',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel_bimbit',
            'no_tel_rumah',
            'emel',
            'pekerjaan',
            'nama_majikan',
            'alamat_majikan_1',
            'alamat_majikan_2',
            'alamat_majikan_3',
            'alamat_majikan_negeri',
            'alamat_majikan_bandar',
            'alamat_majikan_poskod',
            'no_tel_majikan',
            'no_faks_majikan',
            'kelulusan_akademi',
            'nama_kelulusan',
            'kelulusan_sukan_spesifik',
            'nama_sukan_akademi',
            'kelulusan_sains_sukan',
            'sijil_spkk_msn',
            'lesen_kejurulatihan_msn',
            'status_jurulatih',
            'lantikan',
            'nama_sukan_jurulatih',
            'tahun_berkhidmat_mula',
            'tahun_berkhidmat_tamat',
            'pencapaian',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
