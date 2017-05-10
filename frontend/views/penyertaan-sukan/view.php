<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use app\models\RefStatusPermohonanProgramBinaan;

//check date
$isTamat = false;
if(time() > strtotime($model->tarikh_tamat))
{
	$isTamat = true;
}

$isLulus = false;
if (strpos($model->jkb_status_permohonan, 'Lulus') !== false) {
    $isLulus = true;
}

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukan */

//$this->title = $model->penyertaan_sukan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::penilaian_prestasi_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_prestasi_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penyertaan_sukan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['update'])): ?>
            <?= Html::a(GeneralLabel::print_jkb, ['print-jkk-jkp', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-info custom_button', 'target' => '_blank']) ?>
        <?php endif; ?>
		<?php if($isTamat): ?>
			<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['update'])): ?>
				<?= Html::a(GeneralLabel::laporan_penyertaan_kejohanan, ['laporan-penyertaan-kejohanan', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-success custom_button', 'target' => '_blank']) ?>
			<?php endif; ?>
			<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['update'])): ?>
				<?= Html::a(GeneralLabel::laporan_pendedahan_latihan, ['laporan-pendedahan-latihan', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-warning custom_button', 'target' => '_blank']) ?>
			<?php endif; ?>
			<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['update'])): ?>
				<?= Html::a(GeneralLabel::cetak_pencapaian_atlet, ['print-penilaian-prestasi', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-default custom_button', 'target' => '_blank']) ?>
			<?php endif; ?>
		<?php endif; ?>
    </p>
	<p>
	<?= Html::a(GeneralLabel::surat_makluman, ['surat-makluman', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['update']) && $isLulus): ?>
        <?= Html::a(GeneralLabel::tempah_tiket_kapal_terbang, ['/permohonan-kemudahan-ticket-kapal-terbang/create', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    <?php endif; ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
        'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
        'searchModelPenyertaanSukanJurulatih' => $searchModelPenyertaanSukanJurulatih,
        'dataProviderPenyertaanSukanJurulatih' => $dataProviderPenyertaanSukanJurulatih,
        'searchModelPenyertaanSukanPegawai' => $searchModelPenyertaanSukanPegawai,
        'dataProviderPenyertaanSukanPegawai' => $dataProviderPenyertaanSukanPegawai,
        'searchModelPenyertaanSukanPengurus' => $searchModelPenyertaanSukanPengurus,
        'dataProviderPenyertaanSukanPengurus' => $dataProviderPenyertaanSukanPengurus,
        'searchModelPenyertaanSukanPerbelanjaan' => $searchModelPenyertaanSukanPerbelanjaan,
        'dataProviderPenyertaanSukanPerbelanjaan' => $dataProviderPenyertaanSukanPerbelanjaan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penyertaan_sukan_id',
            'nama_sukan',
            'tempat_penginapan',
            'tempat_latihan',
            'nama_atlet',
            'nama_pegawai',
            'jawatan_pegawai',
            'nama_pengurus_sukan',
            'nama_sukarelawan',
        ],
    ]);*/ ?>

</div>
