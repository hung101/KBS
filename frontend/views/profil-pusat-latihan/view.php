<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use app\models\RefStatusBantuanPenganjuranKejohanan;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilPusatLatihan */

//$this->title = $model->profil_pusat_latihan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_pusat_latihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_pusat_latihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-pusat-latihan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['create']) && $model->hantar_flag == 0)): ?>
            <?= Html::a(GeneralLabel::send, ['hantar', 'id' => $model->profil_pusat_latihan_id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                    'method' => 'post',
                ],
                ]) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['update']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->profil_pusat_latihan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['delete']) && $model->hantar_flag == 0) || isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['kelulusan'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->profil_pusat_latihan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['update']) && $model->hantar_flag == 1): ?>
        <?php if($model->status_permohonan_id && $model->status_permohonan_id == RefStatusBantuanPenganjuranKejohanan::LULUS): ?>
            <?= Html::a(GeneralLabel::permohonan_peralatan, ['/permohonan-peralatan/index', 'profil_pusat_latihan_id' => $model->profil_pusat_latihan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
        <?php endif; ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProfilPusatLatihanJurulatih' => $searchModelProfilPusatLatihanJurulatih,
        'dataProviderProfilPusatLatihanJurulatih' => $dataProviderProfilPusatLatihanJurulatih,
        'searchModelProfilPusatLatihanPeralatan' => $searchModelProfilPusatLatihanPeralatan,
        'dataProviderProfilPusatLatihanPeralatan' => $dataProviderProfilPusatLatihanPeralatan,
        'searchModelProfilPusatLatihanKemudahan' => $searchModelProfilPusatLatihanKemudahan,
        'dataProviderProfilPusatLatihanKemudahan' => $dataProviderProfilPusatLatihanKemudahan,
        'searchModelProfilPusatLatihanSukan' => $searchModelProfilPusatLatihanSukan,
        'dataProviderProfilPusatLatihanSukan' => $dataProviderProfilPusatLatihanSukan,
        'searchModelProfilPusatLatihanProgram' => $searchModelProfilPusatLatihanProgram,
        'dataProviderProfilPusatLatihanProgram' => $dataProviderProfilPusatLatihanProgram,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'profil_pusat_latihan_id',
            'nama_pusat_latihan',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_telefon',
            'no_faks',
            'emel',
            'tarikh_program_bermula',
            'tahun_siap_pembinaan',
            'kos_project',
            'keluasan_venue',
            'hakmilik',
            'kadar_sewaan',
            'status',
            'catatan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
